<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class acessoAdmMiddleware
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
        $usuario_adm = auth('api')->user();

        if($usuario_adm == null) {

            return response()->json(['msg' => 'Invalid OR Expired Token'], 401);
        }

        if($usuario_adm->status === 'desativado') {

            return response()->json(['msg' => 'your account has a problem or is disabled contact support'], 401);
        }

        if($usuario_adm){

            if($usuario_adm->nivel_acesso === 'adm' && $usuario_adm->status === 'ativado') {
                return $next($request);
            }
            elseif($usuario_adm->nivel_acesso == 'usuario'){
                return response()->json(['msg' => 'Token cannot access this Route'], 401);
            }

        }

        return $next($request);
    }
}
