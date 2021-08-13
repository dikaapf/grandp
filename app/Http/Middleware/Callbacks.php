<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use Closure;

class Callbacks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(file_exists(base_path('.env'))){
		//bugs
        }

        return $next($request);
    }
}
