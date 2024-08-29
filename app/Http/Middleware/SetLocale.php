<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale {
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response {
        if(in_array($request->segment(1), ['az', 'ru'], true)) {
            app()->setLocale($request->segment(1));
            Session::put('locale', $request->segment(1));
        } else {
            app()->setLocale('en');
            Session::put('locale', 'en');
        }
        return $next($request);
    }
}
