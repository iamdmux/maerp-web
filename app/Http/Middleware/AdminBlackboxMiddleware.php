<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminBlackboxMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), ['pass'       => '']);

        if ($request->input('pass') !== 'attento') {
            return back()->withErrors(['error' => ['password non corretta']]);
        }

        return $next($request);
    }
}
