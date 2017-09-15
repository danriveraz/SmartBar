<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;

class RegistroLoginController extends Controller
{
    //
    public function show($id){
    	$usuario = User::find($id);
    	return view('RegistroLogin.show')->with('usuario',$usuario);
    }
}
