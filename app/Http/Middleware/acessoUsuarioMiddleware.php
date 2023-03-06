<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class acessoUsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $usuario_comum = auth('api')->user();

        if($usuario_comum == null) {

            return response()->json(['msg' => 'Invalid OR Expired Token'], Response::HTTP_UNAUTHORIZED);
        }

        if($usuario_comum->status === 'desativado') {

            return response()->json(['msg' => 'your account has a problem or is disabled contact support'], Response::HTTP_UNAUTHORIZED);
        }

        if($usuario_comum){

            if(($usuario_comum->nivel_acesso === 'usuario' || $usuario_comum->nivel_acesso === 'adm') && $usuario_comum->status === 'ativado') {
                return $next($request);
            }
            // elseif($usuario_comum->nivel_acesso == 'adm'){
            //     return response()->json(['msg' => 'Token não pode acessar essa Rota'], 401);
            // }

        }

    }
}
