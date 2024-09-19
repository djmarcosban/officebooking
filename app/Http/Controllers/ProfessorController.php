<?php

namespace App\Http\Controllers;

use App\Interfaces\ProfessorRepositoryInterface;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
  private ProfessorRepositoryInterface $professorRepository;

  public function __construct(
    ProfessorRepositoryInterface $professorRepository,
  )
  {
    $this->validateSession();
    $this->professorRepository = $professorRepository;
  }

  public function findAll()
  {
    $professores = $this->professorRepository->findAll();

    return view('content.professores.listar')->with([
      "professores" => $professores
    ]);
  }

  public function create()
  {
    return view('content.professores.adicionar');
  }

  public function handleCreate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email',
      "password" => "required|string",
    ]);

    $this->professorRepository->create($request);

    return redirect('/professores?status=success');
  }

  public function update()
  {
    $professorId = request('professor_id');
    $professor = $this->professorRepository->findById($professorId);

    return view('content.professores.editar', compact('professor'));
  }

  public function handleUpdate(Request $request)
  {
    $request->validate([
      "nome" => "required|string",
      "email" => 'required|email|unique:users,email,'.$request->id
    ]);

    $this->professorRepository->update($request);

    return redirect('/professores?status=success');
  }

  public function delete()
  {
    $professorId = request('professor_id');
    $this->professorRepository->delete($professorId);

    return redirect('/professores?status=success');
  }
}
