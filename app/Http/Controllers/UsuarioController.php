<?php

namespace App\Http\Controllers;

use App\Interfaces\UsuarioRepositoryInterface;
use App\Interfaces\EmpresaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  private EmpresaRepositoryInterface $empresaRepository;
  private UsuarioRepositoryInterface $usuarioRepository;

  public function __construct(
    EmpresaRepositoryInterface $empresaRepository,
    UsuarioRepositoryInterface $usuarioRepository
  )
  {
    $this->usuarioRepository = $usuarioRepository;
    $this->empresaRepository = $empresaRepository;
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
    $empresas = $this->empresaRepository->findAll();

    return view('content.usuarios.editar', compact('usuario', 'empresas'));
  }

  public function handleUpdate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email,'.$request->id,
      "status" => "required|string",
      "empresa_id" => "required"
    ]);

    $this->usuarioRepository->update($request);

    return redirect(url()->previous().'?status=success');
  }

  public function create()
  {
    $empresas = $this->empresaRepository->findAll();

    return view('content.usuarios.adicionar', compact('empresas'));
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
      return to_route('/painel');
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

    return redirect('/painel');
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
