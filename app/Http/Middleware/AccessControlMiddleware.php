<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $id = $request->user()->id;
        $user = User::findOrFail($id);
        $role = $user->roles->pluck('name');

        // dd([ $role, $roles ]);

        if ($role->intersect($roles)->isNotEmpty()) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
