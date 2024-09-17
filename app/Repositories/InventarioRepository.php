<?php

namespace App\Repositories;

use App\Interfaces\InventarioRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Inventario;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class InventarioRepository implements InventarioRepositoryInterface
{
  public function findAll()
  {
    $instituicoes = Inventario::all();

    return $instituicoes;
  }

  public function findById($id)
  {
    $instituicao = Inventario::find($id);

    return $instituicao;
  }

  public function create($request)
  {
    $query = new Inventario;
    $query->nome = $request->nome;
    $query->endereco = $request->endereco;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $query = Inventario::find($request->instituicao_id);
    $query->nome = $request->nome;
    $query->endereco = $request->endereco;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $instituicao = Inventario::find($id);
    if($instituicao){
      $instituicao->delete();
    }

    return true;
  }
}
