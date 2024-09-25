<?php

namespace App\Repositories;

use App\Interfaces\ProfessorRepositoryInterface;
use App\Repositories\InstituicaoRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfessorRepository implements ProfessorRepositoryInterface
{
  public function findAll()
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $instituicaoRepository = new InstituicaoRepository;

    $professores = User::where('funcao', 'professor')->where('instituicao_id', $instituicao_id)->get();

    foreach($professores as $key => $professor)
    {
      $professores[$key]['instituicao'] = $instituicaoRepository->findById($professor->instituicao_id);
    }

    return $professores;
  }

  public function findById($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $professor = User::where('funcao', 'professor')->where('instituicao_id', $instituicao_id)->where('id', $id)->first();

    return $professor;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new User;
    $query->nome = $request->nome;
    $query->instituicao_id = $request->instituicao_id ?? $instituicao_id;
    $query->email = $request->email;
    $query->telefone = $request->telefone;
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
    $query->telefone = $request->telefone;

    if(!empty($request->password)){
      $query->primeiro_acesso = 1;
      $query->password = Hash::make($request->password);
    }

    $query->update_user_id = Auth::user()->id;

    $query->save();

    return true;
  }

  public function delete($id)
  {
    $professor = User::where('funcao', 'professor')->where('id', $id)->first();
    if($professor){
      $professor->delete();
    }

    return true;
  }
}
