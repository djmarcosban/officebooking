<?php

namespace App\Repositories;

use App\Interfaces\UsuarioRepositoryInterface;
use App\Repositories\EmpresaRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UsuarioRepository implements UsuarioRepositoryInterface
{
  public function findAll($pagination = 'false', $columns = ['*'], $order = "DESC", $per_page = 10, $only_active = false)
  {
    $query = new User;
    $query->OrderBy('created_at', $order);

    if(Auth::user()->funcao == 'admin')
    {
      $query = $query->where('instituicao_id', Auth::user()->instituicao_id);
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

    $empresaRepository = new EmpresaRepository;

    foreach($query as $key => $q){

      $query[$key]["instituicao"] = $empresaRepository->findById($q->instituicao_id);
      $query[$key]["data_criacao"] = Carbon::parse($q->created_at)->format('d/m/Y - H:i:s');
    }

    return $query;
  }

  public function findById($id, $columns = ["*"])
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $columns = array_merge($columns, ["funcao"]);

    $query = User::where('id', $id)->where('instituicao_id', $instituicao_id)->first($columns);

    if(!$query){
      return 0;
    }

    $empresaRepository = new EmpresaRepository;

    $query["instituicao"] = $empresaRepository->findById($query->instituicao_id);
    $query["data_criacao"] = Carbon::parse($query->created_at)->format('d/m/Y - H:i:s');

    return $query;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new User;
    $query->nome = $request->nome;
    $query->instituicao_id = $request->instituicao_id ?? $instituicao_id;
    $query->funcao = $request->funcao;
    $query->email = $request->email;
    $query->status = $request->status;
    $query->primeiro_acesso = 1;
    $query->password = Hash::make($request->password);
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = User::where('id', $request->id)->where('instituicao_id', $instituicao_id)->first();
    $query->nome = $request->nome;
    $query->email = $request->email;
    $query->status = $request->status;
    $query->funcao = $request->funcao;

    if(!empty($request->password)){
      $query->primeiro_acesso = 1;
      $query->password = Hash::make($request->password);
    }

    $query->update_user_id = Auth::user()->id;

    $query->save();

    return true;
  }

  public function updateMeusDados($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = User::where('id', $request->id)->where('instituicao_id', $instituicao_id)->first();
    $query->nome = $request->nome;

    if(!empty($request->password)){
      $query->password = Hash::make($request->password);
    }

    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = User::where('instituicao_id', $instituicao_id)->where("id", $id)->first();

    if($query){
      $query->delete();
    }

    return true;
  }

  public function updatePassword($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = User::where('id', $request->id)->where('instituicao_id', $instituicao_id)->first();
    $query->password = Hash::make($request->password);
    $query->primeiro_acesso = 0;
    $query->save();
  }
}
