<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    //Vide pour l'instant, mais on peut filtrer les  requêtes pour faire ce qu'on veut
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
