<?php

namespace App\Http\Controllers;

use App\Interfaces\ReservaRepositoryInterface;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
  private ReservaRepositoryInterface $reservaRepository;

  public function __construct(
    ReservaRepositoryInterface $reservaRepository,
  )
  {
    $this->validateSession();
    $this->reservaRepository = $reservaRepository;
  }

  public function findAll()
  {
    $etapas = $this->reservaRepository->findAll();

    return view('content.reservas.listar', compact("etapas"));
  }

  public function create()
  {
    return view('content.reservas.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email',
      "password" => "required|string",
    ]);

    $this->reservaRepository->create($request);

    return redirect('/reservas?status=success');
  }

  public function update()
  {
    $reservaId = request('reserva_id');
    $reserva = $this->reservaRepository->findById($reservaId);

    return view('content.reservas.editar', compact('reserva'));
  }

  public function handleUpdate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email,'.$request->id
    ]);

    $this->reservaRepository->update($request);

    return redirect('/reservas?status=success');
  }

  public function delete()
  {
    $reservaId = request('reserva_id');
    $this->reservaRepository->delete($reservaId);

    return redirect('/reservas?status=success');
  }
}
