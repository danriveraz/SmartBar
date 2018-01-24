<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Departamento;
use PocketByR\Ciudad;
use PocketByR\Http\Requests;

class HomeController extends Controller
{
	public function __construct(){
    	$this->middleware('guest');

    }

    public function home(){
    	$departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return View('Home.Home')->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }
    public function prueba(){
    	return view('Zohoverify.verifyforzoho');
    }

    public function preguntasFrecuentes(){
        return view('Home.preguntasFrecuentes');
    }

    public function AmigoInseparable(){
        return view('Home.AmigoInseparable');
    }

        public function PocketClub(){
        return view('Home.PocketClub');
    }
        public function politicas(){
        return view('Home.politicas');
    }


}
