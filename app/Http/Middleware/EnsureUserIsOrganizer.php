<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsOrganizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return  redirect()->route('login');
        }

        if(Auth::user()->role !== 'organizer') {
            return redirect()->route('events.index')->with('error', 'Acesso negado. Você não é um organizador.');
        }

        return $next($request);
    }
}
