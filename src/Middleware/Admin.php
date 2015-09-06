<?php

namespace O2s\Users\Middleware;

use Closure;

class Admin
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
        // Current user must be an administrative user
        if ( ! \Auth::user() ) { throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException; }
        if ( \Auth::user()->id != 1 && \Auth::user()->isAdmin != 1) { throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException; }

        return $next($request);
    }
}
