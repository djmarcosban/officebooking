<?php

namespace App\Repositories;

use App\Interfaces\VoucherRepositoryInterface;
use App\Repositories\EmpresaRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\UsuarioRepository;
use App\Repositories\EtapaRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Voucher;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VoucherRepository implements VoucherRepositoryInterface
{
  private function checkCustomer($cliente, int $cliente_id)
  {
    if(!$cliente)
    {
      $cliente = (object)[
        "id" => 0,
        "nome" => $cliente_id == 0 ? "<span class='text-warning'>Sem cliente</span>" : "<span class='text-danger'>Cliente excluido</span>",
        "acompanhantes" => "",
        "qtd_acompanhantes" => 0
      ];
    }

    return $cliente;
  }

  public function findAll($pagination = 'false', $columns = ['*'], $orderBy = "id", $orderType = "DESC", $per_page = 10)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Voucher;
    $query = $query->where('instituicao_id', $instituicao_id);
    $query = $query->orderBy($orderBy, $orderType);

    if($pagination == 'false')
    {
      $query = $query->get($columns);
    }else{
      $query = $query->paginate($perPage = $per_page, $columns, $pageName = 'page');
    }

    if(!$query){
      return 0;
    }

    $clienteRepository = new ClienteRepository;
    $etapaRepository = new EtapaRepository;
    $usuarioRepository = new UsuarioRepository;

    foreach($query as $key => $value)
    {
      $query[$key]['cliente'] = $this->checkCustomer(cliente: $clienteRepository->findById($value->cliente_id), cliente_id: $value->cliente_id);
      $query[$key]['etapa'] = $etapaRepository->findById($value->etapa_id);
      $query[$key]['servicos'] = unserialize($value->servicos);
      $query[$key]["data_criacao"] = Carbon::parse($value->created_at)->format('d/m/Y - H:i:s');
    }

    return $query;
  }
  public function findAllByEtapaId($etapa_id, $pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Voucher;
    $query = $query->where('instituicao_id', $instituicao_id)->where('etapa_id', $etapa_id);

    if(Auth::user()->funcao == 'operador')
    {
      $query = $query->where('create_user_id', Auth::id());
    }

    if($pagination == 'false')
    {
      $query = $query->get($columns);
    }else{
      $query = $query->paginate($perPage = $per_page, $columns, $pageName = 'page');
    }

    if(!$query){
      return 0;
    }

    $clienteRepository = new ClienteRepository;
    $usuarioRepository = new UsuarioRepository;

    foreach($query as $key => $value)
    {
      $query[$key]['servicos'] = unserialize($value->servicos);
      $query[$key]['operador'] = $usuarioRepository->findById($value->create_user_id);
      $query[$key]['cliente'] = $this->checkCustomer(cliente: $clienteRepository->findById($value->cliente_id), cliente_id: $value->cliente_id);
      $query[$key]["data_criacao"] = Carbon::parse($value->created_at)->format('d/m/Y - H:i:s');
    }

    return $query;
  }

  public function findById($id, $columns = ["*"])
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Voucher::where('instituicao_id', $instituicao_id)->where("id", $id)->first($columns);

    if(!$query){
      return 0;
    }

    $clienteRepository = new ClienteRepository;
    $etapaRepository = new EtapaRepository;

    $query['cliente'] = $this->checkCustomer(cliente: $clienteRepository->findById($query->cliente_id), cliente_id: $query->cliente_id);
    $query['etapa'] = $etapaRepository->findById($query->etapa_id);
    $query["data_criacao"] = Carbon::parse($query->created_at)->format('d/m/Y');
    $query['servicos'] = unserialize($query->servicos);

    return $query;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $qtd_acompanhantes = 1;
    if($request->cliente)
    {
      if($request->cliente[0]->acompanhantes)
      {
        $qtd_acompanhantes += count(explode(',', $request->cliente[0]->acompanhantes));
      }

      $cliente = Cliente::where('id', $request->cliente[0]->id)->update([
        "numero_voo" => $request->cliente[0]->numero_voo,
        "acompanhantes" => $request->cliente[0]->acompanhantes,
        "qtd_acompanhantes" => $qtd_acompanhantes
      ]);
    }

    $query = new Voucher;
    $query->cliente_id = $request->cliente ? $request->cliente[0]->id : 0;
    $query->etapa_id = $request->etapa_id;
    $query->data_emissao = Carbon::now();
    $query->servicos = $request->servicos_serialized;
    $query->valor_reserva = $request->valor_reserva;
    $query->valor_restante = $request->valor_restante;
    $query->valor_desconto = $request->valor_desconto;
    $query->valor_total = $request->valor_total;
    $query->instituicao_id = $instituicao_id;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $qtd_acompanhantes = 1;
    if($request->cliente)
    {
      if($request->cliente[0]->acompanhantes)
      {
        $qtd_acompanhantes += count(explode(',', $request->cliente[0]->acompanhantes));
      }

      $cliente = Cliente::where('id', $request->cliente[0]->id)->update([
        "numero_voo" => $request->cliente[0]->numero_voo,
        "acompanhantes" => $request->cliente[0]->acompanhantes,
        "qtd_acompanhantes" => $qtd_acompanhantes
      ]);
    }

    $query = Voucher::find($request->voucher_id);

    $query->cliente_id = $request->cliente ? $request->cliente[0]->id : 0;
    $query->etapa_id = $request->etapa_id;
    $query->servicos = $request->servicos_serialized;
    $query->valor_reserva = $request->valor_reserva;
    $query->valor_restante = $request->valor_restante;
    $query->valor_desconto = $request->valor_desconto;
    $query->valor_total = $request->valor_total;
    $query->instituicao_id = $instituicao_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function updateEtapa($etapa_id, $voucher_id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Voucher::find($voucher_id);
    $query->etapa_id = $etapa_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Voucher::where('instituicao_id', $instituicao_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }
}
