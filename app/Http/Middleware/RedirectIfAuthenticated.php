<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard.admin');
                case 'dosen':
                    return redirect()->route('dashboard.dosen');
                case 'mahasiswa':
                    return redirect()->route('dashboard.mahasiswa');
                case 'dospem':
                    return redirect()->route('dashboard.dospem');
                case 'kaprodi':
                    return redirect()->route('dashboard.kaprodi');
                case 'koordinator':
                    return redirect()->route('dashboard.koordinator');
                case 'dpl':
                    return redirect()->route('dashboard.dpl');
                default:
                    return abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
