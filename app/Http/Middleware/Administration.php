<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class Administration
 *
 * @package App\Http\Middleware
 */
class Administration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var \App\User $user */
        $user = Auth::user() ?? new User();

        if (!$user->isAdmin()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
