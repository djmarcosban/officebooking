<?php

namespace App\Http\Controllers;

use App\Repositories\InstituicaoRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Request as Req;
use Session;
use Image;
use URL;

class Controller
{
  public function generatePassword()
  {
    $output = shell_exec('../storage/app/password_generator_new_version');
    return response($output);
  }

  public function abortTo($to = '/')
  {
    throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect($to));
  }

  public function setSession(string $session, string $param)
  {
    return request()->session()->put($session, $param);
  }

  public static function getSession(string $session)
  {
    return request()->session()->get($session);
  }

  public function validateSession()
  {
    $session = $this->getSession(session: 'instituicao_nome');

    if (empty($session)) {
      $redirectTo = Req::url();

      if (Auth::user()->funcao == 'admin') {
        $this->abortTo('/instituicoes?status=select&redirectTo=' . $redirectTo);
      } else {
        $this->configureSession(Auth::user()->instituicao_id);
      }
    }
  }

  public static function hasSession()
  {
    return request()->session()->has('instituicao_nome');
  }

  public function configureSession($instituicao_id = null)
  {
    $instituicaoRepository = new InstituicaoRepository;
    $instituicaoId = $instituicao_id ?? request('instituicao_id');

    $instituicao = $instituicaoRepository->findById($instituicaoId);

    if (!$instituicao) {
      return redirect('/instituicoes?status=error');
    }

    $this->setSession(session: 'instituicao_id', param: $instituicao->id);
    $this->setSession(session: 'instituicao_nome', param: $instituicao->nome);

    if (!empty(request('redirectTo'))) {
      return redirect(request('redirectTo'));
    }

    return redirect('/instituicoes');
  }

  public function etapas()
  {
    $etapas = [
      [
        "slug" => "pendente",
        "title" => "Pendentes"
      ],
      [
        "slug" => "aprovada",
        "title" => "Aprovadas"
      ],
      [
        "slug" => "cancelada",
        "title" => "Canceladas"
      ],
      [
        "slug" => "historico",
        "title" => "Histórico"
      ],
    ];

    return $etapas;
  }
}
