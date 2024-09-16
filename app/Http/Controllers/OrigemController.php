<?php

namespace App\Http\Controllers;

use App\Interfaces\OrigemRepositoryInterface;
use Illuminate\Http\Request;

class OrigemController extends Controller
{
  private OrigemRepositoryInterface $origemRepository;

  public function __construct(
    OrigemRepositoryInterface $origemRepository,
  )
  {
    $this->origemRepository = $origemRepository;
  }

  public function findAll()
  {
    $this->validateSession();
    $origens = $this->origemRepository->findAll(pagination: 'true');

    if(request('origemReq') && request('origemReq') == 'ajax')
    {
      return response()->json([
        'data' => $origens
      ]);
    }

    return view('content.origens.listar')->with([
      "origens" => $origens
    ]);
  }

  public function create()
  {
    $this->validateSession();
    return view('content.origens.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $this->validateSession();

    $origemId = $this->origemRepository->create($request);

    if(!empty($request->return_url)){
      return redirect($request->return_url.'?status=success&origem_id='.$origemId);
    }

    if($request->origemReq && $request->origemReq == 'ajax')
    {
      return response()->json([
        'status' => 'success'
      ]);
    }

    return redirect('/origens?status=success');
  }

  public function delete()
  {
    $this->validateSession();
    $origemId = request('origem_id');
    $this->origemRepository->delete($origemId);

    return redirect('/origens?status=success');
  }

  public function update()
  {
    $this->validateSession();
    $origemId = request('origem_id');
    $origem = $this->origemRepository->findById($origemId);

    return view('content.origens.editar')->with([
      "origem" => $origem
    ]);
  }

  public function handleUpdate(Request $request)
  {
    $this->validateSession();
    $this->origemRepository->update($request);

    return redirect('/origens?status=success');
  }
}

