<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use Closure;

class IsInstalled
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
        $envPath = base_path('.env');
        if (!file_exists($envPath)) {
            return redirect(url('/') . '/install');
		//bugs
        }
        
        return $next($request);
    }
}
