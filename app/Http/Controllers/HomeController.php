<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
  public function index()
  { 
    return redirect('/painel');
    // return view('content.home.index');
  }
}
