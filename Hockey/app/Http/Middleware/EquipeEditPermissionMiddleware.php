<?php

namespace App\Http\Middleware;

use Closure;
use App\Equipe;

class EquipeEditPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $equipe = $request->route('equipe');

        if(\Auth::check() == false)
            return redirect('/');           
        if(\Auth::user()->cant('update', $equipe ))
            return redirect('/');

        return $next($request);
    }
}
