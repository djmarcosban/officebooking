<?php

namespace App\Http\Controllers;

use App\Interfaces\ReservaRepositoryInterface;
use App\Interfaces\InventarioRepositoryInterface;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
  private InventarioRepositoryInterface $inventarioRepository;
  private ReservaRepositoryInterface $reservaRepository;

  public function __construct(
    InventarioRepositoryInterface $inventarioRepository,
    ReservaRepositoryInterface $reservaRepository,
  ) {
    $this->validateSession();
    $this->inventarioRepository = $inventarioRepository;
    $this->reservaRepository = $reservaRepository;
  }

  public function findAll()
  {
    $etapas = $this->reservaRepository->findAllRaw();

    return view('content.reservas.listar', compact("etapas"));
  }

  public function findAllByTeacher()
  {
    $reservas = $this->reservaRepository->findAllByTeacher();

    return view('content.reservas.minhas-reservas', compact("reservas"));
  }

  public function create()
  {
    $inventarios = $this->inventarioRepository->findAll();

    return view('content.reservas.adicionar', compact('inventarios'));
  }

  public function handleCreate(Request $request)
  {
    $request->validate([
      "inventario" => "required|string",
      "horario" => "required|string",
    ]);

    $this->reservaRepository->create($request);

    (new MailController)->send(type: 'new_request');

    return redirect('/minhas-reservas?status=success');
  }

  public function update()
  {
    $reservaId = request('reserva_id');
    $reserva = $this->reservaRepository->findById($reservaId);

    return view('content.reservas.editar', compact('reserva'));
  }

  public function change(Request $request)
  {
    $this->reservaRepository->updateStatus($request);
    $reserva = $this->reservaRepository->findById($request->reserva_id);
    $professor = User::find($reserva->professor_id);

    (new MailController)->send(type: 'request_updated', params: ["email" => $professor->email]);

    return response()->json([
      'status' => 'success'
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email,' . $request->id
    ]);

    $this->reservaRepository->update($request);

    return redirect('/reservas?status=success');
  }

  public function delete()
  {
    $reservaId = request('reserva_id');
    $this->reservaRepository->delete($reservaId);

    if (Auth::user()->funcao = 'professor') {
      return redirect('/minhas-reservas?status=success');
    }

    return redirect('/reservas?status=success');
  }
}
