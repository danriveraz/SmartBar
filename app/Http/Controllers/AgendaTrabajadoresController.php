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

class AgendaTrabajadoresController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('guardarAccionUser');// solo con colocar este middleware aquí, ya en todas las vistas se le va a estar actualizando las horas de las actividades que ha estado haciendo, esto se debe a en todas las vistas hay un ajax que verifica que el usuario esté logueado y hace un llamado a este controlador, por lo tanto en las todas las vistas se está ejecutando este middleware
        $this->middleware('Permisos:Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      return view('AgendaTrabajadores.agenda');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    	//modificar lista de trabajadores
        $trabajadores = User::find(Auth::user()->id)->empresa->empleados->where('estado',1)->lists('nombrePersona','id');
        return view('AgendaTrabajadores/crearAgenda', compact('trabajadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
        $rules = [
            'fechaTrabajo' => 'required',
            'idUsuario' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('Auth.usuario.create')->withErrors($validator)->withInput();
        }else{
            $trabajadores = $request['idUsuario'];
            foreach ($trabajadores as $trabajador){
                AgendaTrabajadores::create([
                    // Empaquetamos los Datos  y los envamos al Insert
                    'fechaTrabajo' => $request['fechaTrabajo'],
                    'idUsuario' => $trabajador
                ]);
            }
            flash::success('Se han agregado las agendas de trabajo')->important();
            return redirect()->action('UsuariosController@index');
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
        $agenda = AgendaTrabajadores::find($id);
        return view('AgendaTrabajadores/editarAgenda' , ['agenda' => $agenda] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $agenda = AgendaTrabajadores::find($id);
        $agenda -> fill([
            // Empaquetamos los Datos  y los envamos al Insert
            'fechaTrabajo' => $request['fechaTrabajo']
            ]);
        $agenda -> save();
        flash::success('Agenda actualizada')->important();
        return redirect()->action('UsuariosController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $agenda = AgendaTrabajadores::find($id);
        $agenda->delete();
        flash::success('Se ha eliminado la agenda')->important();
        return redirect()->action('UsuariosController@index');
    }
}
