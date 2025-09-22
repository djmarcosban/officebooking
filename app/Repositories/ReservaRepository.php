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
  public function findAll()
  {
    $etapas = (new Controller)->etapas();
    $instituicao_id = Controller::getSession('instituicao_id');

    // Busca tudo da VIEW de uma vez (sem N+1)
    $rows = DB::table('vw_reservas_basico')
      ->when($instituicao_id, fn($q) => $q->where('instituicao_id', $instituicao_id)) // <- nome da coluna na view
      ->orderByDesc('created_at')
      ->get()
      ->map(function ($r) {
        // Mantém a estrutura que teu front espera
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

    // Agrupa por etapa (status) reaproveitando teu array
    foreach ($etapas as $k => $etapa) {
      $etapas[$k]['reservas'] = $rows->where('status', $etapa['slug'])->values();
    }

    return $etapas;
  }


  public function findAllByTeacher()
  {
    $etapas = (new Controller)->etapas();
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

      if ($reserva->status == 'cancelada') {
        $statusText = 'badge-danger';
      }

      if ($reserva->status == 'aprovada') {
        $statusText = 'badge-success';
      }

      if ($reserva->status == 'pendente') {
        $statusText = 'badge-warning';
      }

      if ($reserva->status == 'historico') {
        $statusText = 'bg-label-dark';
      }

      $status = sprintf('<span class="badge %s">%s</span>', $statusText, strtoupper($reserva->status));

      $reservas[$keyR]["status"] = ($status);
      $reservas[$keyR]["data_criacao"] = Carbon::parse($reserva->created_at)->format('d/m/Y - H:i:s');
    }

    return $reservas;
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
