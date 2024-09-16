<?php

namespace App\Http\Controllers;

use App\Interfaces\VeiculoRepositoryInterface;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
  private VeiculoRepositoryInterface $veiculoRepository;

  public function __construct(
    VeiculoRepositoryInterface $veiculoRepository,
  )
  {
    $this->veiculoRepository = $veiculoRepository;
  }

  public function findAll()
  {
    $this->validateSession();
    $veiculos = $this->veiculoRepository->findAll(pagination: 'true');

    return view('content.veiculos.listar')->with([
      "veiculos" => $veiculos
    ]);
  }

  public function create()
  {
    $this->validateSession();
    return view('content.veiculos.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $this->validateSession();
    $veiculoId = $this->veiculoRepository->create($request);

    if(!empty($request->return_url)){
      return redirect($request->return_url.'?status=success&veiculo_id='.$veiculoId);
    }

    return redirect('/veiculos?status=success');
  }

  public function delete()
  {
    $this->validateSession();
    $veiculoId = request('veiculo_id');
    $this->veiculoRepository->delete($veiculoId);

    return redirect('/veiculos?status=success');
  }

  public function update()
  {
    $this->validateSession();
    $veiculoId = request('veiculo_id');
    $veiculo = $this->veiculoRepository->findById($veiculoId);

    return view('content.veiculos.editar')->with([
      "veiculo" => $veiculo
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->validateSession();
    $this->veiculoRepository->update($request);

    return redirect('/veiculos?status=success');
  }
}

