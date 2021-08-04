<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Logging
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
        $response = $next($request);

        $parameters = array_values($request->route()->parameters());

        $log = ['user_id' => Auth::id(), 'user_ip' => $request->ip(), 'method' => $request->method(), 'url' => $request->getPathInfo()];

        if(count($request->route()->parameters()) > 0) {
            // $log['register_id'] = $parameters[0];
        } elseif($request->method() === "POST") {
            $log['register_id'] = DB::getPdo()->lastInsertId();
        }

        Log::create($log);

        return $response;
    }
}
