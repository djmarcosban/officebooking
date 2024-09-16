<?php

namespace App\Repositories;

use App\Interfaces\ClienteRepositoryInterface;
use App\Repositories\EmpresaRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ClienteRepository implements ClienteRepositoryInterface
{
  public function findAll($pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10, $only_active = false)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = new Cliente;
    $query = $query->where('empresa_id', $empresa_id)
                   ->OrderBy('created_at', $order);

    if($only_active)
    {
      $query = $query->where('status', 'ativo');
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

    foreach($query as $key => $q){
      $query[$key]["data_criacao"] = Carbon::parse($q->created_at)->format('d/m/Y - H:i:s');
      $query[$key]["uniqueId"] = $q->id.mt_rand('0', '9999');
    }

    return $query;
  }

  public function findById($id, $columns = ["*"])
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = Cliente::where('empresa_id', $empresa_id)->where("id", $id)->first($columns);

    if(!$query){
      return 0;
    }

    $query["data_criacao"] = Carbon::parse($query->created_at)->format('d/m/Y - H:i:s');
    $query["uniqueId"] = $query->id.mt_rand('0', '9999');

    return $query;
  }

  public function create($request)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = new Cliente;
    $query->nome = mb_convert_case($request->nome, MB_CASE_UPPER, 'UTF-8');
    $query->tipo = $request->tipo;
    $query->documento = $request->documento;
    $query->acompanhantes = mb_convert_case($request->acompanhantes, MB_CASE_UPPER, 'UTF-8');
    $query->numero_voo = $request->numero_voo;
    $query->status = $request->status;
    $query->empresa_id = $empresa_id;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = Cliente::find($request->id);
    $query->nome = mb_convert_case($request->nome, MB_CASE_UPPER, 'UTF-8');
    $query->tipo = $request->tipo;
    $query->documento = $request->documento;
    $query->acompanhantes = mb_convert_case($request->acompanhantes, MB_CASE_UPPER, 'UTF-8');
    $query->numero_voo = $request->numero_voo;
    $query->status = $request->status;
    $query->empresa_id = $empresa_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = Cliente::where('empresa_id', $empresa_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }
}
