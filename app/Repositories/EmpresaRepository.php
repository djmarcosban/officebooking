<?php

namespace App\Repositories;

use App\Interfaces\EmpresaRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Instituicao;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EmpresaRepository implements EmpresaRepositoryInterface
{
  public function findAll()
  {
    $empresas = Instituicao::all();

    return $empresas;
  }

  public function findById($id)
  {
    $instituicao = Instituicao::find($id);

    return $instituicao;
  }

  public function create($request)
  {
    $query = new Instituicao;

    $logo = $request->file('logo');
    $hasPhoto = 0;

    $query->cnpj = $request->cnpj;
    $query->company_name = $request->company_name;
    $query->cep = $request->cep;
    $query->address = $request->address;
    $query->contact = $request->contact;
    $query->number = $request->number;
    $query->complement = $request->complement;
    $query->neighborhood = $request->neighborhood;
    $query->state = $request->state;
    $query->city = $request->city;
    $query->status = $request->status;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $query = Instituicao::find($request->instituicao_id);

    $query->cnpj = $request->cnpj;
    $query->company_name = $request->company_name;
    $query->cep = $request->cep;
    $query->contact = $request->contact;
    $query->address = $request->address;
    $query->number = $request->number;
    $query->complement = $request->complement;
    $query->neighborhood = $request->neighborhood;
    $query->state = $request->state;
    $query->city = $request->city;
    $query->status = $request->status;
    $query->country = $request->country;
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