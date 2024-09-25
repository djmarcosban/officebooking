<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAcoesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('post') || $request->isMethod('get') || $request->isMethod('put') || $request->isMethod('delete')) {
            $app_env = env('APP_ENV');

            $dados = 'null';
            if($request->method() == 'POST')
            {
                if(isset($request->password))
                {
                    unset($request['password']);
                }

                if(isset($request->password_confirmation))
                {
                    unset($request['password_confirmation']);
                }

                $dados = json_encode($request->all());
            }

            if(Auth::check())
            {
                if($app_env != 'local'){
                    Log::info($request->method() . ' em ' . $request->fullUrl() . ' por ' . Auth::user()->nome . ' (user_id: ' . Auth::id() . ', funcao: ' . Auth::user()->funcao . '). Dados completos: '.$dados);
                }
            }else{
                Log::info($request->method() . ' em ' . $request->fullUrl().'. Dados completos: '.$dados);
            }
        }

        return $response;
    }
}
