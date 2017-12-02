<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;

use PocketByR\Http\Controllers\Controller;

class TiendaController extends Controller
{

  public function index(request $request){
    return view('Tienda/inicio');
  }
}

use Auth;
use PocketByR\Mesa;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Tienda;

use Illuminate\Support\Facades\Validator;
use PocketByR\User;
use Laracasts\Flash\Flash;



class TiendaController extends Controller
{
//
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
    public function index(Request $request){
		return view('Tienda.tienda');
    } 
}

