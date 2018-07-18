<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use PocketByR\Notificaciones;
use Auth;
use Laracasts\Flash\Flash;
use PocketByR\AgendaTrabajadores;
use Carbon\Carbon;

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
        $ids = array();
        $empleadosIzq = array();
        $empleadosDer = array();
        $turnosEmpleados = array();
        foreach ($empleados as $key => $empleado) {
            array_push($ids, $key);
            if ($key % 2 == 0) {
                array_push($empleadosIzq, $empleado);
            }else{
                array_push($empleadosDer, $empleado);
            }

            $turnos = AgendaTrabajadores::Turnos($empleado->id)->get();
            if($turnos->count() > 0){
                $turnos->push($empleado->nombrePersona);
                array_push($turnosEmpleados, $turnos);
            }
        }

        $numeroEmpleadosIzq = count($empleadosIzq);

        $notificaciones = Notificaciones::Usuario(Auth::id())->get();
        $nuevas = 0;
        $fechaActual = Carbon::now();
        $fecha2array = array();
        for ($i=0; $i < sizeof($notificaciones); $i++) { 
     		if($notificaciones[$i]->estado == "nueva"){
     			$nuevas++;
     		}
     		$fechaNotificacion = Carbon::parse($notificaciones[$i]->fecha);
     		$diferencia = $fechaActual->diffInDays($fechaNotificacion,true);
     		array_push($fecha2array, array($notificaciones[$i]->id, $diferencia));
        }
        
        return view('AgendaTrabajadores.index')->with('empleadosIzq',$empleadosIzq)->with('empleadosDer',$empleadosDer)->with('numeracion',$ids)->with('numEmpleadosIzq', $numeroEmpleadosIzq)->with('turnos', json_encode($turnosEmpleados))->with('notificaciones', $notificaciones)->with('nuevas', $nuevas)->with('fecha2array', $fecha2array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    }

    public function diaSemana($num, $agenda){
        
        if($num == 0){
        return $agenda->lun;
        }else if($num == 1){
            return $agenda->mar;
        }else if($num == 2){
            return $agenda->mie;
        }else if($num == 3){
            return $agenda->jue;
        }else if($num == 4){
            return $agenda->vie;
        }else if($num == 5){
            return $agenda->sab;
        }else if($num == 6){
            return $agenda->dom;
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(count($request->entities) == 3){
            $jornada = $request->entities[0][0];
            $idEmpleado = $request->entities[1][0];
            $semanas = $request->entities[2];
            $tieneTurnos = AgendaTrabajadores::Turnos($idEmpleado)->get();
            
            if($tieneTurnos->count() == 0){
                $numero = 0;
                foreach ($semanas as $semana) {
                    $numero++;
                    $agenda = new AgendaTrabajadores;
                    $agenda->idUsuario = $idEmpleado;
                    $agenda->idEmpresa = Auth::user()->empresaActual;
                    $agenda->idSemana = $numero;
                    foreach ($semana as $dia) {
                        if($dia == "lun"){
                            $agenda->lun = $jornada;
                        }elseif($dia == "mar"){
                            $agenda->mar = $jornada;
                        }elseif($dia == "mir"){
                            $agenda->mie = $jornada;
                        }elseif($dia == "jue"){
                            $agenda->jue = $jornada;
                        }elseif($dia == "vie"){
                            $agenda->vie = $jornada;
                        }elseif($dia == "sab"){
                            $agenda->sab = $jornada;
                        }elseif($dia == "dom"){
                            $agenda->dom = $jornada;
                        }
                    }
                    $agenda->save();
                } 
            }else{
                $numero = 0;
                foreach ($semanas as $semana) {
                    $agenda = $tieneTurnos[$numero];
                    foreach ($semana as $key => $dia) {
                        if($dia == "no"){
                            $diaAnterior = $this->diaSemana($key, $agenda);
                            if($diaAnterior == $jornada){
                                if($key == 0){
                                    $agenda->lun = 0;
                                }else if($key == 1){
                                    $agenda->mar = 0;
                                }else if($key == 2){
                                    $agenda->mie = 0;
                                }else if($key == 3){
                                    $agenda->jue = 0;
                                }else if($key == 4){
                                    $agenda->vie = 0;
                                }else if($key == 5){
                                    $agenda->sab = 0;
                                }else if($key == 6){
                                    $agenda->dom = 0;
                                }
                            }
                        }elseif($dia == "lun"){
                            if($agenda->lun != $jornada){
                                $agenda->lun = $jornada;
                            }
                        }elseif($dia == "mar"){
                            if($agenda->mar != $jornada){
                                $agenda->mar = $jornada;
                            }
                        }elseif($dia == "mir"){
                            if($agenda->mie != $jornada){
                                $agenda->mie = $jornada;
                            }
                        }elseif($dia == "jue"){
                            if($agenda->jue != $jornada){
                                $agenda->jue = $jornada;
                            }
                        }elseif($dia == "vie"){
                            if($agenda->vie != $jornada){
                                $agenda->vie = $jornada;
                            }
                        }elseif($dia == "sab"){
                            if($agenda->sab != $jornada){
                                $agenda->sab = $jornada;
                            }
                        }elseif($dia == "dom"){
                            if($agenda->dom != $jornada){
                                $agenda->dom = $jornada;
                            }
                        }
                    }
                    $numero++;
                    $agenda->save();
                } 
            }
            
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
