<?php

namespace App\Http\Middleware;

use App\Models\LogAcesso;
use Closure;
use Illuminate\Http\Request;


class LogAcessoMiddleware
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
        // vejo as config de quem ta acessando e onde vai acessar
        // dd($request->server);
        
        $user = auth('api')->user();
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();

        LogAcesso::create([
            'log' => "Usuario: $user->name do Email: $user->email usou a Maquina do IP: $ip e acessou a Rota: $rota "
        ]);
        
        return $next($request);
    }
}
