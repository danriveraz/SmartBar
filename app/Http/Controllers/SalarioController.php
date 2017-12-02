<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use Auth;
use PocketByR\Mesa;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Tienda;

use Illuminate\Support\Facades\Validator;
use PocketByR\User;
use Laracasts\Flash\Flash;

class SalarioController extends Controller
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
  public function index(Request $request){
  return view('Salario.salario');
  }
    //
}
