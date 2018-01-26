<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class checkApiAuthentication
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
        $usuarios = DB::table('usersApi')->select('token')->get();
        for ($i=0; $i<sizeof($usuarios); $i++){
            if ($request->token == $usuarios[$i]->token){
                return $next($request);
            }
        }

        //AQUI RETORNAR ERROR
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
