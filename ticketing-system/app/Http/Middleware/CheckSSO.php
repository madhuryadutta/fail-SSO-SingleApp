<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckSSO
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        // Call the auth subdomain to verify if the user is logged in
        $response = Http::withCookies($request->cookies->all(), config('session.domain'))
            // ->get('https://auth.yourdomain.com/api/check-session');
            ->get('https://' . config('services.auth.domain') . '/api/check-session');
        // 
        // 

        if ($response->successful() && $response->json('authenticated')) {
            return $next($request);
        }

        // If not authenticated, redirect to auth subdomain
        $loginUrl = 'https://' . config('services.auth.domain') . '/login?redirect=' . urlencode($request->fullUrl());

        return redirect()->to($loginUrl);
    }
}
