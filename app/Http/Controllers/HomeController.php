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
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view('Home.preguntasFrecuentes')->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }

    public function AmigoInseparable(){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view('Home.AmigoInseparable')->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }

    public function PocketClub(){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view('Home.PocketClub')->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }
    public function politicas(){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view('Home.politicas')->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }

    public function contactos(){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view('Home.contactos')->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }


}
