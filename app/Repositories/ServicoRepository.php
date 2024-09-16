<?php

namespace App\Repositories;

use App\Interfaces\ServicoRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ServicoRepository implements ServicoRepositoryInterface
{
  public function findAll($pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10, $only_active = false)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = new Servico;
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
    }

    return $query;
  }

  public function findById($id, $columns = ["*"])
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = Servico::where('empresa_id', $empresa_id)->where("id", $id)->first($columns);

    if(!$query){
      return 0;
    }

    $query["data_criacao"] = Carbon::parse($query->created_at)->format('d/m/Y - H:i:s');

    return $query;
  }

  public function create($request)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = new Servico;
    $query->nome = mb_convert_case($request->nome, MB_CASE_UPPER, 'UTF-8');
    $query->apelido = mb_convert_case($request->apelido, MB_CASE_UPPER, 'UTF-8');
    $query->status = $request->status;
    $query->tipo = $request->tipo;
    $query->valor = $request->valor;
    $query->empresa_id = $empresa_id;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = Servico::find($request->id);
    $query->nome = mb_convert_case($request->nome, MB_CASE_UPPER, 'UTF-8');
    $query->apelido = mb_convert_case($request->apelido, MB_CASE_UPPER, 'UTF-8');
    $query->status = $request->status;
    $query->tipo = $request->tipo;
    $query->valor = $request->valor;
    $query->empresa_id = $empresa_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $empresa_id = Controller::getSession('empresa_id');

    $query = Servico::where('empresa_id', $empresa_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }
}
