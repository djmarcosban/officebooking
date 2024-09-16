<?php

namespace App\Repositories;

use App\Interfaces\OrigemRepositoryInterface;
use App\Repositories\EmpresaRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Origem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrigemRepository implements OrigemRepositoryInterface
{
  public function findAll($pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10, $only_active = false)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Origem;
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

    $query = Origem::where('instituicao_id', $instituicao_id)->where("id", $id)->first($columns);

    if(!$query){
      return 0;
    }

    $query["data_criacao"] = Carbon::parse($query->created_at)->format('d/m/Y - H:i:s');

    return $query;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Origem;
    $query->nome = mb_convert_case($request->nome, MB_CASE_UPPER, 'UTF-8');
    $query->status = $request->status ?? 'ativo';
    $query->address = $request->address;
    $query->cep = $request->cep;
    $query->number = $request->number;
    $query->complement = $request->complement;
    $query->city = $request->city;
    $query->state = $request->state;
    $query->neighborhood = $request->neighborhood;
    $query->instituicao_id = $instituicao_id;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Origem::find($request->id);
    $query->nome = mb_convert_case($request->nome, MB_CASE_UPPER, 'UTF-8');
    $query->status = $request->status;
    $query->address = $request->address;
    $query->cep = $request->cep;
    $query->number = $request->number;
    $query->complement = $request->complement;
    $query->city = $request->city;
    $query->state = $request->state;
    $query->neighborhood = $request->neighborhood;
    $query->instituicao_id = $instituicao_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Origem::where('instituicao_id', $instituicao_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }
}
