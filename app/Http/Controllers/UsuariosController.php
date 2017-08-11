<?php
namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use Auth;
use Laracasts\Flash\Flash;

class UsuariosController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('Permisos:Admin')->except(['edit','update']);
    $this->middleware('PermisoEditarUsuario')->only(['edit','update']);
  }  

  public function index(){
    $usuarios = User::where('idEmpresa',Auth::User()->idEmpresa)->orderBy('id','ASC')->paginate(10);
    return view('Usuario.index')->with('usuarios',$usuarios);
  }

  public function create(){
    return view('Usuario.create');
  }

  public function store(Request $request){
    $rules = [
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:usuario,email',
            'cedula' => 'required|min:1|max:9999999999|numeric|unique:usuario,cedula',
            'password' => 'required|min:6|max:18|confirmed',
            'fechaNacimiento' => 'required',
            'sexo' => 'required'
            ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()){
        return redirect()->route('Auth.usuario.create')->withErrors($validator)->withInput();
      }else{
      $Permisos = $request['Permisos'];
      $usuario = new User;
      $usuario->nombrePersona = $request->nombrePersona;
      $usuario->email = $request->email;
      $usuario->cedula = $request->cedula;
      $usuario->password = bcrypt($request->password);
      $usuario->sexo = $request->sexo;
      $usuario->fechaNacimiento = $request->fechaNacimiento;
      $usuario->pais= "Colombia";
      $usuario->departamento= Auth::user()->departamento;
      $usuario->ciudad= Auth::user()->ciudad;
      $usuario->confirmoEmail = 1;
      $usuario->imagenPerfil = "perfil.jpg";
      $usuario->imagenNegocio = "perfil.jpg";
      $usuario->remember_token = str_random(100);
      $usuario->confirm_token = str_random(100);
      $usuario->idEmpresa = Auth::user()->idEmpresa; // id de la empresa para saber a quién pertenece

      foreach ($Permisos as $key => $value) {
        if($value=='Administrador'){
          $usuario->esMesero = 1;
          $usuario->esBartender = 1;
          $usuario->esCajero = 1;
          $usuario->esAdmin = 1;
        }else{
          if($value=='Mesero'){
            $usuario->esMesero = 1;
          }
          if($value=='Cajero'){
            $usuario->esCajero = 1;
          }
          if($value=='Bartender'){
            $usuario->esBartender = 1;
          }
        }
      }

      $usuario->save();

      Flash::success("El usuario se ha registrado satisfactoriamente")->important();
      return redirect()->route('Auth.usuario.index');
      //->with("message", "El usuario se ha registrado satisfactoriamente");
    }
  }

  public function show($id){

  }

  public function edit($id){
    $usuario = User::find($id);
    return view('Usuario.edit')->with('usuario',$usuario);
  }

  public function update(Request $request, $id){
    
        $rules = [
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'fechaNacimiento' => 'required',
            'sexo' => 'required'
            ];
    $usuario = User::find($id);
    if($request->cedula!=$usuario->cedula){
      $rules += ['cedula' => 'required|min:1|max:9999999999|numeric|unique:usuario,cedula']; 
    }
    if ($request->password!=null) {
      $rules += ['password' => 'required|min:6|max:18|confirmed'];
    }

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()){
      return redirect()->route('Auth.usuario.edit',$id)->withErrors($validator)->withInput();
    }else{
      $Permisos = $request['Permisos'];
      if($request->cedula!=$usuario->cedula){
        $usuario->cedula = $request->cedula;
      }
      if($request->password!=null){
        $usuario->password = bcrypt($request->password);
      }
      $usuario->nombrePersona = $request->nombrePersona;
      $usuario->sexo = $request->sexo;
      $usuario->fechaNacimiento = $request->fechaNacimiento;
      $usuario->esMesero = 0;
      $usuario->esBartender = 0;
      $usuario->esCajero = 0;
      $usuario->esAdmin = 0;
      foreach ($Permisos as $key => $value) {
        if($value=='Administrador'){
          $usuario->esMesero = 1;
          $usuario->esBartender = 1;
          $usuario->esCajero = 1;
          $usuario->esAdmin = 1;
        }else{
          if($value=='Mesero'){
            $usuario->esMesero = 1;
          }
          if($value=='Cajero'){
            $usuario->esCajero = 1;
          }
          if($value=='Bartender'){
            $usuario->esBartender = 1;
          }
        }
      }
      $usuario->save();
      flash::warning('El usuario ha sido modificado satisfactoriamente')->important();
      return redirect()->route('Auth.usuario.index');
    }
  }

  public function destroy($id){
    $usuario = User::find($id);
    $usuario->delete();
    Flash::success('El usuario ha sido eliminado de forma exitosa')->important();
    return redirect()->route('Auth.usuario.index');
  }
}
