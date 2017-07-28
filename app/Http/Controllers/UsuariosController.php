<?php
namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use Laracasts\Flash\Flash;

class UsuariosController extends Controller
{
  public function index(){
    $usuarios = User::orderBy('id','ASC')->paginate(5);
    return view('usuario.index')->with('usuarios',$usuarios);
  }

  public function create(){
    return view('usuario.create');
  }

  public function store(Request $request){
    $rules = [
            'nombre' => 'required|min:3|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'numeroIdentificacion' => 'required|unique:usuario,numeroIdentificacion',
            'contraseña' => 'required|min:6|max:18|confirmed',
            'fechaNacimiento' => 'required',
            'sexo' => 'required'
            ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()){
        return redirect()->route('auth.usuario.create')->withErrors($validator)->withInput();
      }else{
      $usuario = new Usuario;
      $usuario->nombre = $request->nombre;
      $usuario->numeroIdentificacion = $request->numeroIdentificacion;
      $usuario->contraseña = bcrypt($request->contraseña);
      $usuario->sexo = $request->sexo;
      $usuario->fechaNacimiento = $request->fechaNacimiento;
      $usuario->tipoMesero = $request->tipoMesero;
      $usuario->tipoBartender = $request->tipoBartender;
      $usuario->tipoCajero = $request->tipoCajero;
      $usuario->save();
      Flash::success("El usuario se ha registrado satisfactoriamente")->important();
      return redirect()->route('auth.usuario.index');
      //->with("message", "El usuario se ha registrado satisfactoriamente");
    }
  }

  public function show($id){

  }

  public function edit($id){
    $usuario = Usuario::find($id);
    return view('usuario.edit')->with('usuario',$usuario);
  }

  public function update(Request $request, $id){
    $usuario = Usuario::find($id);
    $usuario->nombre = $request->nombre;
    $usuario->numeroIdentificacion = $request->numeroIdentificacion;
    $usuario->sexo = $request->sexo;
    $usuario->fechaNacimiento = $request->fechaNacimiento;

    if($request->tipoMesero == null){
      $usuario->tipoMesero = "0";
    }else{
      $usuario->tipoMesero = $request->tipoMesero;
    }

    if($request->tipoBartender == null){
      $usuario->tipoBartender = "0";
    }else{
      $usuario->tipoBartender = $request->tipoBartender;
    }

    if($request->tipoCajero == null){
      $usuario->tipoCajero = "0";
    }else{
      $usuario->tipoCajero = $request->tipoCajero;
    }

    $usuario->save();
    flash::warning('El usuario ha sido modificado satisfactoriamente')->important();
    return redirect()->route('auth.usuario.index');
    //->with("message", "El usuario se ha editado satisfactoriamente");
  }

  public function destroy($id){
    $usuario = Usuario::find($id);
    $usuario->delete();
    Flash::success('El usuario ha sido eliminado de forma exitosa')->important();
    return redirect()->route('auth.usuario.index');
  }
}
