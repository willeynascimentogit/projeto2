<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Cliente extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
      if(!auth()->check()){
        return abort(403, "Acesso não autorizado");
      }
      if($request->user()->nivel < 1 || $request->user()->nivel > 2){
        return redirect()->route('login');
      }
      return $next($request);

    }
}
