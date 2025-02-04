<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'register',    // Exclude register route from CSRF verification
        'login',       // Exclude login route from CSRF verification
        // You can also add any specific route paths, e.g.,
        // 'auth/register',
        // 'auth/login',
    ];
}
