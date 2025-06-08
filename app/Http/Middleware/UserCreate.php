<?php

namespace App\Http\Middleware;

use Closure;

class UserCreate
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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        return $next($request);
    }
}
