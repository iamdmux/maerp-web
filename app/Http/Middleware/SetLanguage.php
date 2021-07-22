<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
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
        if($request->language){
            if (! in_array($request->language, help_language_locale_array())) {
                abort(404);
            }

            \App::setLocale($request->language);
        }
        return $next($request);
    }
}
