<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Input;
use Illuminate\Http\Request;

class Sopeksis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
     public function __construct($slug)
     {
        $input        = Input::where('slug', $slug)->first();
     }

     public function handle(Request $request, Closure $next): mixed
    {
        $user = $request->user();
        

        if($user)
            if($user->level === 'Penerbit' || $user->level === 'Approval' || $user->id === $input->user_id)
                return $next($request);
                
                return abort(403);
    }
}
