<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class WelcomeTrabajadorController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}  

    public function index()
    {
        return View('WelcomeTrabajador/welcome');
    }
}
