<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTerbit
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
        $user = $request->user();

        if($user)
            if($user->level === 'Penerbit' || $user->level === 'Approval')
                return $next($request);

                return abort(404);
    }
}
