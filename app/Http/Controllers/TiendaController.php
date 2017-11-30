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
