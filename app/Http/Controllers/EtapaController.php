<?php

namespace App\Http\Controllers;

use App\Interfaces\EtapaRepositoryInterface;
use Illuminate\Http\Request;

class EtapaController extends Controller
{
  private EtapaRepositoryInterface $etapaRepository;

  public function __construct(
    EtapaRepositoryInterface $etapaRepository,
  )
  {
    $this->validateSession();
    $this->etapaRepository = $etapaRepository;
  }

  public function findAll()
  {
    $etapas = $this->etapaRepository->findAll(only_active: false);

    return view('content.etapas.listar')->with([
      "etapas" => $etapas
    ]);
  }

  public function create()
  {
    $lastPosition = $this->etapaRepository->findLastPosition();

    return view('content.etapas.adicionar', compact('lastPosition'));
  }

  public function handleCreate(Request $request)
  {
    $validator = $request->validate([
      'titulo' => 'bail|required|string',
      'posicao' => 'required|integer'
    ],
    [
      'titulo.required' => 'O campo Título é obrigatório!',
      'posicao.required' => 'O campo Posição é obrigatório!',
      'posicao.integer' => 'O campo Posição deve ser numérica'
    ]);

    $etapaId = $this->etapaRepository->create($request);

    if(!empty($request->return_url)){
      return redirect($request->return_url.'?status=success&etapa_id='.$etapaId);
    }

    return redirect('/etapas?status=success');
  }

  public function delete()
  {
    $etapaId = request('etapa_id');
    $this->etapaRepository->delete($etapaId);

    return redirect('/etapas?status=success');
  }

  public function update()
  {
    $etapaId = request('etapa_id');
    $etapa = $this->etapaRepository->findById($etapaId);

    if(!$etapa)
    {
      return redirect('/etapas?status=wrong');
    }

    return view('content.etapas.editar')->with([
      "etapa" => $etapa
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->etapaRepository->update($request);

    return redirect('/etapas?status=success');
  }
}

