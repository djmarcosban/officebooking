<?php

namespace App\Http\Controllers;

use App\Interfaces\ServicoRepositoryInterface;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
  private ServicoRepositoryInterface $servicoRepository;

  public function __construct(
    ServicoRepositoryInterface $servicoRepository,
  )
  {
    $this->servicoRepository = $servicoRepository;
  }

  public function findAll()
  {
    $this->validateSession();
    $servicos = $this->servicoRepository->findAll(pagination: 'true');

    return view('content.servicos.listar')->with([
      "servicos" => $servicos
    ]);
  }

  public function create()
  {
    $this->validateSession();
    return view('content.servicos.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $this->validateSession();
    $servicoId = $this->servicoRepository->create($request);

    if(!empty($request->return_url)){
      $url = base64_decode($request->return_url);

      if(str_contains($url, '?')) {
        $url = $url.'&servico_id='.$servicoId;
      }else{
        $url = $url.'?servico_id='.$servicoId;
      }

      return redirect($url);
    }

    return redirect('/servicos?status=success');
  }

  public function delete()
  {
    $this->validateSession();
    $servicoId = request('servico_id');
    $this->servicoRepository->delete($servicoId);

    return redirect('/servicos?status=success');
  }

  public function update()
  {
    $this->validateSession();
    $servicoId = request('servico_id');
    $servico = $this->servicoRepository->findById($servicoId);

    return view('content.servicos.editar')->with([
      "servico" => $servico
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->validateSession();
    $this->servicoRepository->update($request);

    return redirect('/servicos?status=success');
  }
}

