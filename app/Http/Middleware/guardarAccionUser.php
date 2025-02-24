<?php

namespace PocketByR\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // clase para obtener la Hora del registro, función Now()

use Illuminate\Support\Facades\Log;
class guardarAccionUser
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
        $registroAccion = Auth::User()->registros->last();
        $registroAccion->fill(['salida'=>Carbon::now()]);
        $registroAccion->save();
        /*if (Carbon::now()->lessThanOrEqualTo(Carbon(Auth::User()->empresa()->first()->fechaFinMembresia))) {
            return $next($request);
        }else{
            return redirect('/WelcomeAdmin');
            //return redirect('/WelcomeTrabajador');
        }*/
        return $next($request);
    }
}
