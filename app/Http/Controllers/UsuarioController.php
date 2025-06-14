<?php

namespace App\Http\Controllers;

use App\Interfaces\UsuarioRepositoryInterface;
use App\Interfaces\InstituicaoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  private InstituicaoRepositoryInterface $instituicaoRepository;
  private UsuarioRepositoryInterface $usuarioRepository;

  public function __construct(
    InstituicaoRepositoryInterface $instituicaoRepository,
    UsuarioRepositoryInterface $usuarioRepository
  )
  {
    $this->usuarioRepository = $usuarioRepository;
    $this->instituicaoRepository = $instituicaoRepository;
  }

  public function findAll()
  {
    $usuarios = $this->usuarioRepository->findAll(pagination: 1, order: "ASC", per_page: 30);

    return view('content.usuarios.listar')->with([
      "usuarios" => $usuarios
    ]);
  }

  public function update()
  {
    $usuarioId = request('usuario_id');
    $usuario = $this->usuarioRepository->findById($usuarioId);
    $instituicoes = $this->instituicaoRepository->findAll();

    return view('content.usuarios.editar', compact('usuario', 'instituicoes'));
  }

  public function handleUpdate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email,'.$request->id,
      "status" => "required|string",
      "instituicao_id" => "required"
    ]);

    $this->usuarioRepository->update($request);

    return redirect(url()->previous().'?status=success');
  }

  public function create()
  {
    $instituicoes = $this->instituicaoRepository->findAll();

    return view('content.usuarios.adicionar', compact('instituicoes'));
  }

  public function handleCreate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email',
      "password" => "required|string",
      "status" => "required|string"
    ]);

    $this->usuarioRepository->create($request);

    return redirect('/usuarios?status=success');
  }

  public function delete()
  {
    $usuarioId = request('usuario_id');
    $this->usuarioRepository->delete($usuarioId);

    return redirect('/usuarios?status=success');
  }

  public function firstAccess()
  {
    if(!Auth::user()->primeiro_acesso){
      return to_route('dashboard');
    }

    return view('content.authentications.auth-first-access');
  }

  public function handleFirstAccess(Request $request)
  {
    $request->validate([
      'password' => 'required|string',
      'password_confirmation' => 'required|string'
    ]);

    if($request->password != $request->password_confirmation){
      $args = [
        'erro' => true,
        'content' => 'Senhas não conferem'
      ];
      return view('content.authentications.auth-first-access')->with($args);
    }

    $request["id"] = Auth::id();
    $this->usuarioRepository->updatePassword($request);

    return redirect('/');
  }

  public function updateMeusDados()
  {
    $id = Auth::id();
    $user = $this->usuarioRepository->findById($id);

    return view('content.meus-dados.editar')->with([
      "user" => $user,
    ]);
  }

  public function handleUpdateMeusDados(Request $request){
    $request->id = Auth::id();

    $update = $this->usuarioRepository->updateMeusDados($request);

    return redirect('/meus-dados?status=success');
  }
}
