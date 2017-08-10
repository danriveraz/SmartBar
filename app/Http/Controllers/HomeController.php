<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Http\Requests;

class HomeController extends Controller
{
    public function home(){
    	if(Auth::check()){
	        $userActual = Auth::user();
	        if ($userActual->esAdmin) {
	            return redirect('/WelcomeAdmin')->send();
	        }else{
	        	return redirect('/WelcomeTrabajador')->send();
	        }
    	}else{
        	return View('Home.Home');
    	}
    }
}
