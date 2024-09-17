<?php

namespace App\Http\Controllers;

use App\Interfaces\InstituicaoRepositoryInterface;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
  private InstituicaoRepositoryInterface $instituicaoRepository;

  public function __construct(
    InstituicaoRepositoryInterface $instituicaoRepository,
  )
  {
    $this->instituicaoRepository = $instituicaoRepository;
  }

  public function findAll()
  {
    $instituicoes = $this->instituicaoRepository->findAll();

    return view('content.instituicoes.listar')->with([
      "instituicoes" => $instituicoes
    ]);
  }

  public function create()
  {
    return view('content.instituicoes.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $instituicaoId = $this->instituicaoRepository->create($request);

    if(!empty($request->return_url)){
      return redirect($request->return_url.'?status=success&instituicao_id='.$instituicaoId);
    }

    return redirect('/instituicoes?status=success');
  }

  public function delete()
  {
    $instituicaoId = request('instituicao_id');
    $this->instituicaoRepository->delete($instituicaoId);

    return redirect('/instituicoes?status=success');
  }

  public function update()
  {
    $instituicaoId = request('instituicao_id');
    $instituicao = $this->instituicaoRepository->findById($instituicaoId);

    return view('content.instituicoes.editar')->with([
      "instituicao" => $instituicao
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->instituicaoRepository->update($request);

    return redirect('/instituicoes?status=success');
  }
}

