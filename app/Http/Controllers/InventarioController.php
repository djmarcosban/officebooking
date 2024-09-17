<?php

namespace App\Http\Controllers;

use App\Interfaces\InventarioRepositoryInterface;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
  private InventarioRepositoryInterface $inventarioRepository;

  public function __construct(
    InventarioRepositoryInterface $inventarioRepository,
  )
  {
    $this->inventarioRepository = $inventarioRepository;
  }

  public function findAll()
  {
    $inventarios = $this->inventarioRepository->findAll();

    return view('content.inventarios.listar')->with([
      "inventarios" => $inventarios
    ]);
  }

  public function create()
  {
    return view('content.inventarios.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $inventarioId = $this->inventarioRepository->create($request);

    if(!empty($request->return_url)){
      return redirect($request->return_url.'?status=success&inventario_id='.$inventarioId);
    }

    return redirect('/inventarios?status=success');
  }

  public function delete()
  {
    $inventarioId = request('inventario_id');
    $this->inventarioRepository->delete($inventarioId);

    return redirect('/inventarios?status=success');
  }

  public function update()
  {
    $inventarioId = request('inventario_id');
    $inventario = $this->inventarioRepository->findById($inventarioId);

    return view('content.inventarios.editar')->with([
      "inventario" => $inventario
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->inventarioRepository->update($request);

    return redirect('/inventarios?status=success');
  }
}

