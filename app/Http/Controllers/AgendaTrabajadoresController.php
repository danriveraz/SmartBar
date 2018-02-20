<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use Auth;
use Laracasts\Flash\Flash;
use PocketByR\AgendaTrabajadores;
use DateTime;

class AgendaTrabajadoresController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $userActual = Auth::user();
        if($userActual != null){
          if (!$userActual->esAdmin) {
              flash('No Tiene Los Permisos Necesarios')->error()->important();
              return redirect('/WelcomeTrabajador')->send();
          }
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $empleados = User::usuariosEmpresa(Auth::user()->empresaActual)->get();
        $empleadosIzq = array();
        $empleadosDer = array();
        foreach ($empleados as $key => $empleado) {
            if ($key % 2 == 0) {
                array_push($empleadosIzq, $empleado);
            }else{
                array_push($empleadosDer, $empleado);
            }
        }
            
        return view('AgendaTrabajadores.index')->with('empleadosIzq',$empleadosIzq)->with('empleadosDer',$empleadosDer);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        if($request->entities[0] != null && $request->entities[1] != null && $request->entities[2] != null){
            $jornada = $request->entities[0][0];
            $idEmpleado = $request->entities[1][0];
            $diasTrabajo = $request->entities[2];
            $date = new DateTime();
            $week = $date->format("W");

            $agenda = new AgendaTrabajadores;
            $agenda->idUsuario = $idEmpleado;
            $agenda->idEmpresa = Auth::user()->empresaActual;
            $agenda->idSemana = $week;
            foreach ($diasTrabajo as $key => $dia) {
                if($dia == "lun"){
                    $agenda->lun = $jornada;
                }elseif($dia == "mar"){
                    $agenda->mar = $jornada;
                }elseif($dia == "mie"){
                    $agenda->mie = $jornada;
                }elseif($dia == "jue"){
                    $agenda->jue = $jornada;
                }elseif($dia == "vie"){
                    $agenda->vie = $jornada;
                }elseif($dia == "sab"){
                    $agenda->sab = $jornada;
                }else{
                    $agenda->dom = $jornada;
                }
            }
            $agenda->save();

            return redirect('/agenda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
    }
}
