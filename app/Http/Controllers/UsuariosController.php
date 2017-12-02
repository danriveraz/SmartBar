<?php
namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use Auth;
use Mail;
use Laracasts\Flash\Flash;
use PocketByR\Empresa;
use PocketByR\Proveedor;

class UsuariosController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('guardarAccionUser');// solo con colocar este middleware aquí, ya en todas las vistas se le va a estar actualizando las horas de las actividades que ha estado haciendo, esto se debe a en todas las vistas hay un ajax que verifica que el usuario esté logueado y hace un llamado a este controlador, por lo tanto en las todas las vistas se está ejecutando este middleware
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

  public function tutorial(){
    $userActual = Auth::user();
    if($userActual->estadoTut == 0 | $userActual->estadoTut == 1){
      if($userActual->estadoTut == 0){
          $userActual->estadoTut += 1;
          $userActual->save();
        }
      return redirect()->route('proveedor.index');
    }
    if($userActual->estadoTut == 2 | $userActual->estadoTut == 3){
      if($userActual->estadoTut == 2){
          $userActual->estadoTut += 1;
          $userActual->save();
        }
      return redirect()->route('categoria.index');
    }
    if($userActual->estadoTut == 4 | $userActual->estadoTut == 5){
      if($userActual->estadoTut == 4){
          $userActual->estadoTut += 1;
          $userActual->save();
        }
      return redirect()->route('insumo.index');
    }
    if($userActual->estadoTut == 6 | $userActual->estadoTut == 7){
      if($userActual->estadoTut == 6){
          $userActual->estadoTut += 1;
          $userActual->save();
        }
      return redirect()->route('producto.index');
    }
    if($userActual->estadoTut == 9 | $userActual->estadoTut == 10){
      if($userActual->estadoTut == 9){
          $userActual->estadoTut += 1;
          $userActual->save();
        }
      return redirect()->route('Auth.usuario.index');
    }
    if($userActual->estadoTut == 11 | $userActual->estadoTut == 12){
      if($userActual->estadoTut == 11){
          $userActual->estadoTut += 1;
          $userActual->save();
        }
      return redirect()->route('mesas.index');
    }
  }

  public function store(Request $request){
    $rules = [
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            'cedula' => 'required|min:1|max:9999999999|numeric',
            'fechaNacimiento' => 'required',
            'sexo' => 'required',
            'Permisos' => 'required'
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
          $contrasena = str_random(8);
          $usuario->password = bcrypt($contrasena);
          $usuario->sexo = $request->sexo;
          $usuario->fechaNacimiento = $request->fechaNacimiento;
          $usuario->pais= "Colombia";
          $usuario->departamento= Auth::user()->departamento;
          $usuario->ciudad= Auth::user()->ciudad;
          $usuario->confirmoEmail = 1;
          $usuario->estado = true;
          $usuario->imagenPerfil = "perfil.jpg";
          $usuario->imagenNegocio = "perfil.jpg";
          $usuario->remember_token = str_random(100);
          $usuario->confirm_token = str_random(100);
          $usuario->idEmpresa = Auth::user()->idEmpresa; // id de la empresa para saber a quién pertenece

          //asignar username
          // parte del código para generar el username inicial
          $numeroRepetido = 0; // numero que se agregará al username por si ya hay alguno parecido y poderlo diferenciar
          $auxiliarBool = true;
          $auxiliarUser;
          $auxiliarUsername;
          while ($auxiliarBool) {
              if($numeroRepetido==0){
                  $auxiliarUsername = str_replace(' ','',$request->nombrePersona).'-'.str_replace(' ','',Auth::User()->empresa->nombreEstablecimiento);
                  $auxiliarUser = User::where('username', $auxiliarUsername)->first();
              }else{
                  $auxiliarUsername = str_replace(' ','',$request->nombrePersona).'-'.str_replace(' ','',Auth::User()->empresa->nombreEstablecimiento).$numeroRepetido;
                  $auxiliarUser = User::where('username', $auxiliarUsername)->first();
              }
              if($auxiliarUser==null){
                  $auxiliarBool= false;
              }
              $numeroRepetido++;

          }
          $usuario->username = $auxiliarUsername;


          //Guardar imagen
          //obtenemos el campo file definido en el formulario
          $file = $request->file('imagenPerfil');
          if($file!=null){// verifica que se haya subido una imagen nueva
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));
            $usuario->imagenPerfil = $nombre;// guarda la imagen en la base de datos
          }

          foreach ($Permisos as $key => $value) {
            if($value=='Administrador'){
                  $usuario->esMesero = 1;
                  $usuario->esBartender = 1;
                  $usuario->esCajero = 1;
                  $usuario->esAdmin = 1;
                  $usuario->obsequio = 1;
            }else{
              if($value=='Mesero'){
                  $usuario->esMesero = 1;
              }if($value=='Cajero'){
                  $usuario->esCajero = 1;
              }if($value=='Bartender'){
                  $usuario->esBartender = 1;
              }
            }
          }
          if($request['Obsequio']='Obsequio'){
            $usuario->obsequio = 1;
          }
          $usuario->save();// guardar el usuario
          // enviar mail
          $data = ['user'=>$usuario, 'contrasena' => $contrasena];
          Mail::send('Emails.confirmacionDatosTrabajador', ['data' => $data], function($mail) use($data){
              $mail->to($data['user']->email)->subject('Bienvenido a SMARTBAR');
          });

          flash::success('El usuario ha sido registrado satisfactoriamente')->important();
          return redirect()->route('Auth.usuario.index');
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
        'imagenPerfil' => 'image',
        ];
    $usuario = User::find($id);
    if(Auth::User()->esAdmin){ // validar que cuadno sea admin el que modifica, los usuarios deben de quedar con permisos
        $rules += ['Permisos' => 'required',];
    }
    if($request->username!=$usuario->username){// agrega la regla si el username ha sido modificado
      $rules += ['username'=> 'required|min:3|max:40|alpha_dash|unique:usuario,username'];
    }
    if($request->cedula!=$usuario->cedula){// agrega la regla si la cedula ha sido modificada
      $rules += ['cedula' => 'required|min:1|max:9999999999|numeric'];
    }
    if ($request->password!=null) {// agrega la regla si el password ha sido modificado
      $rules += ['password' => 'required|min:6|max:18|confirmed'];
    }
    if($request->telefono!=$usuario->telefono){ // agrega la regla si el telefomo ha sido modificado
      $rules += ['telefono' => 'required|min:1|max:9999999999|numeric'];
    }

    $messages = [
      'Permisos.required' => 'Debe tener asignado por lo menos un Permiso',
    ];

    $validator = Validator::make($request->all(), $rules,$messages);
    if ($validator->fails()){
      return redirect()->route('Auth.usuario.edit',$id)->withErrors($validator)->withInput();
    }else{
      if($request->cedula!=$usuario->cedula){
        $usuario->cedula = $request->cedula;
      }
      if($request->password!=null){
        $usuario->password = bcrypt($request->password);
      }
      if($request->username!=$usuario->username){
        $usuario->username=$request->username;
      }
      if($request->telefono!=$usuario->telefono){
        $usuario->telefono=$request->telefono;
      }
      $usuario->nombrePersona = $request->nombrePersona;
      $usuario->sexo = $request->sexo;
      $usuario->fechaNacimiento = $request->fechaNacimiento;

      //obtenemos el campo file definido en el formulario
      $file = $request->file('imagenPerfil');
      if($file!=null){// verifica que se haya subido una imagen nueva
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));
        $usuario->imagenPerfil = $nombre;// guarda la imagen en la base de datos
      }


      if(Auth::User()->esAdmin&&Auth::id()!=$usuario->id){// si es admin asigna los permisos
        $usuario->esMesero = 0;
        $usuario->esBartender = 0;
        $usuario->esCajero = 0;
        $usuario->esAdmin = 0;
        $usuario->obsequio = 0;

        if($request['Obsequiar']=='Obsequiar'){
          $usuario->obsequio = 1;
        }

        $Permisos = $request['Permisos'];

        foreach ($Permisos as $key => $value) {
          if($value=='Administrador'){
            $usuario->esMesero = 1;
            $usuario->esBartender = 1;
            $usuario->esCajero = 1;
            $usuario->esAdmin = 1;
            $usuario->obsequio = 1;
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

  public function cambiarEstado($id){
    $usuario = User::find($id);
      if ($usuario->estado == true){
          $usuario -> fill([
          'estado' => false
          ]);
          $usuario -> save();
      }else{
          $usuario -> fill([
          'estado' => true
          ]);
          $usuario -> save();
      }

    Flash::success('El estado del usuario cambió satisfactoriamente')->important();
    return redirect()->route('Auth.usuario.index');
  }


  public function registerUser(Request $request){

      if($request->ajax()){
        $validator = Validator::make($request->all(), [
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            'cedula' => 'required|min:1|max:9999999999|numeric',
            'fechaNacimiento' => 'required',
            'sexo' => 'required',
            'Permisos' => 'required'
         ]);

      if($validator->passes()){
          $Permisos = $request['Permisos'];
          $usuario = new User;
          $usuario->nombrePersona = $request->nombrePersona;
          $usuario->email = $request->email;
          $usuario->cedula = $request->cedula;
          $contrasena = str_random(8);
          $usuario->password = bcrypt($contrasena);
          $usuario->sexo = $request->sexo;
          $usuario->fechaNacimiento = $request->fechaNacimiento;
          $usuario->pais= "Colombia";
          $usuario->departamento= Auth::user()->departamento;
          $usuario->ciudad= Auth::user()->ciudad;
          $usuario->confirmoEmail = 1;
          $usuario->estado = true;
          $usuario->imagenPerfil = "perfil.jpg";
          $usuario->imagenNegocio = "perfil.jpg";
          $usuario->remember_token = str_random(100);
          $usuario->confirm_token = str_random(100);
          $usuario->idEmpresa = Auth::user()->idEmpresa; // id de la empresa para saber a quién pertenece

          //asignar username
          // parte del código para generar el username inicial
          $numeroRepetido = 0; // numero que se agregará al username por si ya hay alguno parecido y poderlo diferenciar
          $auxiliarBool = true;
          $auxiliarUser;
          $auxiliarUsername;
          while ($auxiliarBool) {
              if($numeroRepetido==0){
                  $auxiliarUsername = str_replace(' ','',$request->nombrePersona).'-'.str_replace(' ','',Auth::User()->empresa->nombreEstablecimiento);
                  $auxiliarUser = User::where('username', $auxiliarUsername)->first();
              }else{
                  $auxiliarUsername = str_replace(' ','',$request->nombrePersona).'-'.str_replace(' ','',Auth::User()->empresa->nombreEstablecimiento).$numeroRepetido;
                  $auxiliarUser = User::where('username', $auxiliarUsername)->first();
              }
              if($auxiliarUser==null){
                  $auxiliarBool= false;
              }
              $numeroRepetido++;

          }
          $usuario->username = $auxiliarUsername;


          //Guardar imagen
          //obtenemos el campo file definido en el formulario
          $file = $request->file('imagenPerfil');
          if($file!=null){// verifica que se haya subido una imagen nueva
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));
            $usuario->imagenPerfil = $nombre;// guarda la imagen en la base de datos
          }

          foreach ($Permisos as $key => $value) {
            if($value=='Administrador'){
                  $usuario->esMesero = 1;
                  $usuario->esBartender = 1;
                  $usuario->esCajero = 1;
                  $usuario->esAdmin = 1;
                  $usuario->obsequio = 1;
            }else{
              if($value=='Mesero'){
                  $usuario->esMesero = 1;
              }if($value=='Cajero'){
                  $usuario->esCajero = 1;
              }if($value=='Bartender'){
                  $usuario->esBartender = 1;
              }
            }
          }
          if($request['regalar']){
            $usuario->obsequio = 1;
          }
          $userActual = Auth::user();
          $usuarios = User::where('idEmpresa' , $userActual->idEmpresa)->
                                lists('id');
          if(sizeof($usuarios) == 1){
            $userActual->estadoTut += 1;
            $userActual->save();
          }
          $usuario->save();// guardar el usuario

          // enviar mail
          $data = ['user'=>$usuario, 'contrasena' => $contrasena];
          Mail::send('Emails.confirmacionDatosTrabajador', ['data' => $data], function($mail) use($data){
              $mail->to($data['user']->email)->subject('Bienvenido a SMARTBAR');
          });

          $user = User::all()->last()->toJson();
          return response()->json(['success' => true,'message' => 'record updated', 'user' => $user], 200);
          Flash::success("El usuario se ha registrado satisfactoriamente")->important();
          return redirect()->route('Auth.usuario.index');

        }if ($validator->fails()) {
            $errors = $validator->errors();
            $errors =  json_decode($errors);
            return response()->json(['success' => false,'message' => $errors], 422);
        }
      }


  }

  public function modificarEmpresa(){
    $usuario = User::find(Auth::id());
    $Empresa = Empresa::find($usuario->idEmpresa);
    return view('Usuario.editEmpresa')->with('usuario',$usuario)->with('empresa',$Empresa);
  }


  public function postmodificarEmpresa(Request $request){
    $rules = [
      'nombreEstablecimiento' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
      ];
    $empresa =  Auth::User()->empresa;
    $user =  User::find($empresa->usuario_id);
    if($request->telefono!=$empresa->telefono){
      $rules += ['telefono' => 'required|min:1|max:9999999999|numeric'];
    }
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()){
      return redirect()->route('Auth.usuario.showeditEmpresa')->withErrors($validator)->withInput();
    }else{
      //obtenemos el campo file definido en el formulario
      $file = $request->file('imagenEstablecimiento');
      if($file!=null){// verifica que se haya subido una imagen nueva
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();

        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));
        $user->imagenNegocio = $nombre;
      }


      $empresa->nombreEstablecimiento = $request->nombreEstablecimiento;
      $empresa->telefono = $request->telefono;
      $empresa->save();
      $user->save();
      flash::warning('Los datos de la empresa se modificaron satisfactoriamente')->important();
      return redirect()->route('Auth.usuario.index');
    }
  }

  public function verificarUser(){
    if(Auth::check()){
      return response()->json(['success' => true,'message' => 'Está todavía logueado']);
    }else{
      return response()->json(['success' => false,'message' => 'Ya no está logueado']);
    }
  }

}
