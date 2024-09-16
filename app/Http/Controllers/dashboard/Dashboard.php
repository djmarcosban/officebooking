<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\UsuarioRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
  private UsuarioRepositoryInterface $usuarioRepository;

  public function __construct(UsuarioRepositoryInterface $usuarioRepository){
    $this->usuarioRepository = $usuarioRepository;
  }

  public function logout(Request $request){
    Auth::logout();
  
    session()->invalidate();
    session()->regenerateToken();
  
    return redirect('/login');
  }  

  public function index(){
    return view('content.dashboard.index')->with([
      "nome" => Auth::user()->nome,
    ]);
  }
}