<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class adminUserMiddleware
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
        if (!$this->shouldPassThrough()) {
            abort(404);
        }

        return $next($request);
    }

    private function shouldPassThrough()
    {
        return (Auth::user()->email == 'azuresky07@gmail.com');
    }
}
