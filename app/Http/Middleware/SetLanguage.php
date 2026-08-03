<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('language')) {
            session(['language' => 'en']);
        }

        app()->setLocale(session('language'));

        return $next($request);
    }
}