<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Http\Requests;

class HomeController extends Controller
{
	public function __construct(){
    	$this->middleware('guest');

    }

    public function home(){
        return View('Home.Home');
    }
}
