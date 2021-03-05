<?php

namespace App\Http\Middleware;
use App\Http\Middleware\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use App\User;

class Adm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
      if(!auth()->check()){
        return abort(403, "Acesso não autorizado");
      }
      if($request->user()->nivel != 2){
        return redirect()->route('login');
      }
      return $next($request);
    }
}
