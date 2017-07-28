<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class WelcomeTrabajadorController extends Controller
{
    public function index()
    {
        return View('WelcomeTrabajador/welcome');
    }
}
