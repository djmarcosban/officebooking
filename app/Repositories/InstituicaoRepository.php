<?php

namespace App\Repositories;

use App\Interfaces\InstituicaoRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Instituicao;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class InstituicaoRepository implements InstituicaoRepositoryInterface
{
  public function findAll()
  {
    $instituicoes = Instituicao::all();

    return $instituicoes;
  }

  public function findById($id)
  {
    $instituicao = Instituicao::find($id);

    return $instituicao;
  }

  public function create($request)
  {
    $query = new Instituicao;
    $query->nome = $request->nome;
    $query->endereco = $request->endereco;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $query = Instituicao::find($request->instituicao_id);
    $query->nome = $request->nome;
    $query->endereco = $request->endereco;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao = Instituicao::find($id);
    if($instituicao){
      $instituicao->delete();
    }

    return true;
  }
}
