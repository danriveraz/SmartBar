<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;

class HomeController extends Controller
{
    public function home(){
        return View('Home.Home');
    }
}
