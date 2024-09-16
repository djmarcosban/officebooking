<?php

namespace App\Http\Controllers;

use App\Repositories\EmpresaRepository;
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

    public function abortTo($to = '/') {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect($to));
    }

    public function setSession(string $session, string $param)
    {
        return request()->session()->put($session, $param);
    }

    public static function getSession(string $session)
    {
        // return request()->session()->get($session);
        return 1;
    }

    public function validateSession()
    {
        $session = $this->getSession(session: 'empresa_nome');

        if(empty($session)){
            $redirectTo = Req::url();

            if(Auth::user()->funcao == 'master')
            {
                $this->abortTo('/empresas?status=select&redirectTo='.$redirectTo);
            }else
            {
                $this->configureSession(Auth::user()->instituicao_id);
            }
        }
    }

    public static function hasSession()
    {
        return request()->session()->has('empresa_nome');
    }

    public function configureSession($instituicao_id = null)
    {
        $empresaRepository = new EmpresaRepository;
        $empresaId = $instituicao_id ?? request('instituicao_id');

        $instituicao = $empresaRepository->findById($empresaId);

        if(!$instituicao){
            return redirect('/empresas?status=error');
        }

        $this->setSession(session: 'instituicao_id', param: $instituicao->id);
        $this->setSession(session: 'empresa_nome', param: $instituicao->company_name);

        if(!empty(request('redirectTo'))){
            return redirect(request('redirectTo'));
        }

        return redirect('/empresas');
    }
}
