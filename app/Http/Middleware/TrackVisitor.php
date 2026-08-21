<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get') && !$request->is('admin*')) {
            \App\Models\Visitor::firstOrCreate([
                'ip_address' => $request->ip(),
                'visited_date' => date('Y-m-d')
            ]);
        }

        return $next($request);
    }
}
