<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use Auth;
use Carbon\Carbon;

class Extraoficiales extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $userActual = Auth::user();
        if($userActual != null){
            if (!$userActual->esAdmin) {
                flash('No Tiene Los Permisos Necesarios')->error()->important();
                return redirect('/WelcomeTrabajador')->send();
            }
        }

    }
}
