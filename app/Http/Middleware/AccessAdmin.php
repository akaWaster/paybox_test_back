<?php

namespace App\Http\Middleware;

use App\Roles;
use Closure;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->roles->role === Roles::ADMIN_ROLE) return $next($request);

        return response('', 101);
    }
}
