<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

class FirstAccess
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
        $user = auth()->user();
        if($user->first_access == 1) {
            return redirect()->route('admin.password.reset');
        }
        return $next($request);
    }
}
