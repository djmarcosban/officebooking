<?php

namespace App\Repositories;

use App\Interfaces\EtapaRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Etapa;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EtapaRepository implements EtapaRepositoryInterface
{
  public function findAll($pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10, $only_active = false)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Etapa;
    $query = $query->where('instituicao_id', $instituicao_id);

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

    return $query;
  }

  public function findLastPosition()
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Etapa::where('instituicao_id', $instituicao_id)->orderBy('posicao', 'DESC')->first(['posicao']);

    return $query;
  }

  public function findById($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Etapa::where('instituicao_id', $instituicao_id)->where("id", $id)->first();

    return $query;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Etapa;
    $query->titulo = $request->titulo;
    $query->posicao = $request->posicao;
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

    $query = Etapa::find($request->etapa_id);
    $query->titulo = $request->titulo;
    $query->posicao = $request->posicao;
    $query->status = $request->status;
    $query->instituicao_id = $instituicao_id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Etapa::where('instituicao_id', $instituicao_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }
}
