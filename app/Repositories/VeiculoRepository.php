<?php

namespace App\Repositories;

use App\Interfaces\VeiculoRepositoryInterface;
use App\Repositories\EmpresaRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Veiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VeiculoRepository implements VeiculoRepositoryInterface
{
  public function findAll($pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10, $only_active = false)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Veiculo;
    $query = $query->where('instituicao_id', $instituicao_id)
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
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Veiculo::where('instituicao_id', $instituicao_id)->where("id", $id)->first($columns);

    if(!$query){
      return 0;
    }

    $empresaRepository = new EmpresaRepository;

    $query["empresa"] = $empresaRepository->findById($query->instituicao_id);
    $query["data_criacao"] = Carbon::parse($query->created_at)->format('d/m/Y - H:i:s');

    return $query;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Veiculo;
    $query->marca = $request->marca;
    $query->modelo = $request->modelo;
    $query->placa = $request->placa;
    $query->ano = $request->ano;
    $query->status = $request->status;
    $query->instituicao_id = $instituicao_id;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Veiculo::find($request->id);
    $query->marca = $request->marca;
    $query->modelo = $request->modelo;
    $query->placa = $request->placa;
    $query->ano = $request->ano;
    $query->status = $request->status;
    $query->instituicao_id = $instituicao_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Veiculo::where('instituicao_id', $instituicao_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }
}
