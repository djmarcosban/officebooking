<?php

namespace App\Repositories;

use App\Interfaces\ReservaRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Reserva;
use App\Repositories\InventarioRepository;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReservaRepository implements ReservaRepositoryInterface
{
  public function findAll()
  {
    $etapas = (new Controller)->etapas();
    $instituicao_id = Controller::getSession('instituicao_id');

    $inventarioRepository = new InventarioRepository;
    $usuarioRepository = new UsuarioRepository;

    foreach ($etapas as $key => $etapa) {
      $reservas = Reserva::where('status', $etapa['slug'])->where('instituicao_id', $instituicao_id)->get();

      foreach($reservas as $keyR => $reserva)
      {
        $professor = $usuarioRepository->findById($reserva->professor_id);
        $inventario = $inventarioRepository->findById($reserva->inventario_id);

        $reservas[$keyR]["professor"] = $professor;
        $reservas[$keyR]["inventario"] = $inventario;
      }

      $etapas[$key]["reservas"] = $reservas;
    }

    return $etapas;
  }

  public function findById($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $reserva = Reserva::where('instituicao_id', $instituicao_id)->where('id', $id)->first();

    if(!$reserva)
    {
      return false;
    }

    return $reserva;
  }

  public function create($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Reserva;
    $query->professor_id = $request->professor_id;
    $query->inventario_id = $request->inventario_id;
    $query->instituicao_id = $instituicao_id;
    $query->data = $request->data;
    $query->horario = $request->horario;
    $query->descricao = $request->descricao;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $instituicao_id = Controller::getSession('instituicao_id');

    $query = Reserva::find($request->reserva_id);
    $query->professor_id = $request->professor_id;
    $query->inventario_id = $request->inventario_id;
    $query->instituicao_id = $instituicao_id;
    $query->data = $request->data;
    $query->horario = $request->horario;
    $query->descricao = $request->descricao;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    return true;
  }

  public function delete($id)
  {
    $reserva = $this->findById($id);
    if($reserva){
      $reserva->delete();
    }

    return true;
  }
}
