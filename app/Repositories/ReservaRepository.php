<?php

namespace App\Repositories;

use App\Interfaces\ReservaRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Reserva;
use App\Repositories\InventarioRepository;
use App\Repositories\InstituicaoRepository;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ReservaRepository implements ReservaRepositoryInterface
{
  public function findAllRaw(): array
  {
    $etapas = (new Controller)->etapas();
    $instituicaoId = Controller::getSession('instituicao_id');

    $sql = <<<SQL
      SELECT
        id, status, professor_id, professor_nome,
        inventario_id, inventario_nome,
        instituicao_id, instituicao_nome,
        data, horario, created_at, updated_at
      FROM vw_reservas_basico
      WHERE instituicao_id = COALESCE(:instituicao_id, instituicao_id)
      ORDER BY created_at DESC
    SQL;

    $rows = DB::select($sql, [
      'instituicao_id' => $instituicaoId,
    ]);

    $rows = collect($rows)->map(function ($r) {
      $r = (object) $r;

      $r->data_criacao = Carbon::parse($r->created_at)->format('d/m/Y - H:i:s');

      $r->professor = (object) [
        'id' => $r->professor_id,
        'nome' => $r->professor_nome,
      ];

      $r->inventario = (object) [
        'id' => $r->inventario_id,
        'nome' => $r->inventario_nome,
      ];

      $r->instituicao = (object) [
        'id' => $r->instituicao_id,
        'nome' => $r->instituicao_nome,
      ];

      return $r;
    });

    foreach ($etapas as $k => $etapa) {
      $etapas[$k]['reservas'] = $rows
        ->where('status', $etapa['slug'])
        ->values();
    }

    return $etapas;
  }

  public function findAll()
  {
    $etapas = (new Controller)->etapas();
    $instituicao_id = Controller::getSession('instituicao_id');

    $rows = DB::table('vw_reservas_basico')
      ->when($instituicao_id, fn($q) => $q->where('instituicao_id', $instituicao_id))
      ->orderByDesc('created_at')
      ->get()
      ->map(function ($r) {
        $r->data_criacao = Carbon::parse($r->created_at)->format('d/m/Y - H:i:s');
        $r->professor = (object) [
          'id' => $r->professor_id,
          'nome' => $r->professor_nome,
        ];
        $r->inventario = (object) [
          'id' => $r->inventario_id,
          'nome' => $r->inventario_nome,
        ];
        return $r;
      });

    foreach ($etapas as $k => $etapa) {
      $etapas[$k]['reservas'] = $rows->where('status', $etapa['slug'])->values();
    }

    return $etapas;
  }

  public function findAllByTeacher()
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $inventarioRepository = new InventarioRepository;
    $usuarioRepository = new UsuarioRepository;
    $instituicaoRepository = new InstituicaoRepository;

    $reservas = Reserva::where('instituicao_id', $instituicao_id)->where('professor_id', Auth::id())->get();

    foreach ($reservas as $keyR => $reserva) {
      $professor = $usuarioRepository->findById($reserva->professor_id);
      $inventario = $inventarioRepository->findById($reserva->inventario_id);
      $instituicao = $instituicaoRepository->findById($reserva->instituicao_id);

      $reservas[$keyR]["professor"] = $professor;
      $reservas[$keyR]["inventario"] = $inventario;
      $reservas[$keyR]["instituicao"] = $instituicao;
      $reservas[$keyR]["status"] = $this->badgeHtml($reserva->status ?? '');
      $reservas[$keyR]["data_criacao"] = Carbon::parse($reserva->created_at)->format('d/m/Y - H:i:s');
    }

    return $reservas;
  }

  private function badgeClass(string $status): string
  {
    switch ($status) {
      case 'cancelada':
        return 'badge-danger';
      case 'aprovada':
        return 'badge-success';
      case 'pendente':
        return 'badge-warning';
      case 'historico':
        return 'bg-label-dark';
      default:
        return 'badge-secondary';
    }
  }

  private function badgeHtml(string $status): string
  {
    $cls = $this->badgeClass($status);
    return '<span class="badge ' . $cls . '">' . mb_strtoupper($status, 'UTF-8') . '</span>';
  }

  public function findAllByTeacherRaw(): array
  {
    $instituicaoId = Controller::getSession('instituicao_id');
    $professorId = Auth::id();

    $sql = <<<SQL
      SELECT
        r.id,
        r.instituicao_id,
        r.professor_id,
        r.inventario_id,
        r.status,
        r.data,
        DATE_FORMAT(r.created_at, '%d/%m/%Y - %H:%i:%s') AS data_criacao,

        u.id   AS prof_id,  u.nome  AS prof_nome,  u.email AS prof_email,
        i.id   AS inv_id,   i.nome  AS inv_nome,   i.nome AS inv_patrimonio,
        inst.id AS inst_id, inst.nome AS inst_nome

      FROM reservas r
      JOIN users u        ON u.id    = r.professor_id
      JOIN inventarios i     ON i.id    = r.inventario_id
      JOIN instituicaos inst ON inst.id = r.instituicao_id
      WHERE r.instituicao_id = :instituicao_id
        AND r.professor_id   = :professor_id
      ORDER BY r.created_at DESC
    SQL;

    $rows = DB::select($sql, [
      'instituicao_id' => $instituicaoId,
      'professor_id' => $professorId,
    ]);

    $data = array_map(function ($row) {
      $r = (array) $row;

      $r['professor'] = [
        'id' => $r['prof_id'] ?? null,
        'nome' => $r['prof_nome'] ?? null,
        'email' => $r['prof_email'] ?? null,
      ];
      $r['inventario'] = [
        'id' => $r['inv_id'] ?? null,
        'nome' => $r['inv_nome'] ?? null,
        'patrimonio' => $r['inv_patrimonio'] ?? null,
      ];
      $r['instituicao'] = [
        'id' => $r['inst_id'] ?? null,
        'nome' => $r['inst_nome'] ?? null,
      ];

      unset(
        $r['prof_id'],
        $r['prof_nome'],
        $r['prof_email'],
        $r['inv_id'],
        $r['inv_nome'],
        $r['inv_patrimonio'],
        $r['inst_id'],
        $r['inst_nome'],
        $r['inst_cnpj']
      );

      $r['status_class'] = $this->badgeClass($r['status'] ?? '');
      $r['status'] = $this->badgeHtml($r['status'] ?? '');

      return $r;
    }, $rows);

    return $data;
  }

  public function findById($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $reserva = Reserva::where('instituicao_id', $instituicao_id)->where('id', $id)->first();

    if (!$reserva) {
      return false;
    }

    return $reserva;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Reserva;
    $query->professor_id = Auth::id();
    $query->inventario_id = $request->inventario;
    $query->instituicao_id = $instituicao_id;
    $query->data = $request->horario;
    $query->horario = $request->horario;
    $query->descricao = $request->descricao;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Reserva::find($request->reserva_id);
    $query->professor_id = $request->professor_id;
    $query->inventario_id = $request->inventario_id;
    $query->instituicao_id = $instituicao_id;
    $query->data = $request->data;
    $query->horario = $request->horario;
    $query->descricao = $request->descricao;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function updateStatus($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Reserva::find($request->reserva_id);
    $query->status = $request->status;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $reserva = $this->findById($id);
    if ($reserva) {
      $reserva->delete();
    }

    return true;
  }
}
