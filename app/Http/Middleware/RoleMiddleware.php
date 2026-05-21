<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat membuka halaman pasien.')
                : redirect()->route('dashboard')->with('error', 'Pasien tidak dapat membuka halaman admin.');
        }

        return $next($request);
    }
}
