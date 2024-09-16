<?php

namespace App\Http\Controllers;

use App\Interfaces\ClienteRepositoryInterface;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
  private ClienteRepositoryInterface $clienteRepository;

  public function __construct(
    ClienteRepositoryInterface $clienteRepository,
  )
  {
    $this->clienteRepository = $clienteRepository;
  }

  public function findAll()
  {
    $this->validateSession();
    $clientes = $this->clienteRepository->findAll(pagination: 'true');

    return view('content.clientes.listar')->with([
      "clientes" => $clientes
    ]);
  }

  public function create()
  {
    $this->validateSession();
    return view('content.clientes.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $this->validateSession();

    $clienteId = $this->clienteRepository->create($request);

    if(!empty($request->return_url)){
      $url = base64_decode($request->return_url);

      if(str_contains($url, '?')) {
        $url = $url.'&cliente_id='.$clienteId;
      }else{
        $url = $url.'?cliente_id='.$clienteId;
      }

      return redirect($url);
    }

    return redirect('/clientes?status=success');
  }

  public function delete()
  {
    $this->validateSession();
    $clienteId = request('cliente_id');
    $this->clienteRepository->delete($clienteId);

    return redirect('/clientes?status=success');
  }

  public function update()
  {
    $this->validateSession();
    $clienteId = request('cliente_id');
    $cliente = $this->clienteRepository->findById($clienteId);

    return view('content.clientes.editar')->with([
      "cliente" => $cliente
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->validateSession();
    $this->clienteRepository->update($request);

    return redirect('/clientes?status=success');
  }
}

