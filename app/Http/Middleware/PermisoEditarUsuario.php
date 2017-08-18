<?php

namespace PocketByR\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PermisoEditarUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userActual = Auth::user();
        if(!($userActual->esAdmin)&&$request->route()->usuario!=$userActual->id){
            flash('No Tiene Los Permisos Necesarios para editar este usuario, ya que no eres tú mismo')->error()->important();
            return redirect('/WelcomeTrabajador')->send();
        }
        return $next($request);
    }
}
