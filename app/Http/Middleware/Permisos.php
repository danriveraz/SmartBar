<?php

namespace PocketByR\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permiso = null)
    {
        $userActual = Auth::user();
        if(!$userActual->esAdmin){

            if($permiso=='Mesero' && $userActual->esMesero){
                return $next($request);
            }elseif($permiso=='Bartender' && $userActual->esBartender){
                return $next($request);
            }elseif($permiso=='Cajero' && $userActual->esCajero){
                return $next($request);
            }else{
                flash('No Tiene Los Permisos Necesarios de '.$permiso.' para acceder a esta función')->error()->important();
                return redirect('/WelcomeTrabajador')->send();
            }

        }
        return $next($request);
    }
}
