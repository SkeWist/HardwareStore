<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            $userRole = Role::find($user->role_id);

            if ($userRole && $userRole->code === $role) {
                return $next($request);
            }
        }

        return response()->json(['error' => 'Forbidden for you'], 403);
    }
}
