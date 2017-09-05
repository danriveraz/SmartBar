<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\User;
use PocketByR\Empresa;
use PocketByR\Departamento;
use PocketByR\Ciudad;
use Validator;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Mail;
use Auth;

class RegistrarProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['index']);
        $this->middleware('guest')->except(['index']);
        if(Auth::check() && !Auth::User()->esProveedor){
            return redirect('/')->send();
        }
    }  

    public function index(){
        return view("UsuariosProveedor/welcome");
    }

    public function registrarProveedor(){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view("UsuariosProveedor/registrarProveedor")
            ->with('departamentos',$departamentos)
            ->with('ciudades', $ciudades);
    }

    public function postRegistrarProveedor(Request $request){
        $rules = [
            //'nombreEstablecimiento' => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            //'cedula' => 'required|min:1|max:9999999999|numeric',
            'password' => 'required|min:6|max:18',
            //'sexo' => 'required',
            //'telefono' => 'required|min:1|max:9999999999|numeric',
        ];
         
        $validator = Validator::make($request->all(), $rules);
        $departamentos = Departamento::All();
        $ciudades = Ciudad::all();
        if ($validator->fails()){
            return redirect("RegistrarProveedor")
            ->withErrors($validator)
            ->withInput()
            ->with('departamentos',$departamentos)
            ->with('ciudades', $ciudades);
        }
        else{
            $empresa = new Empresa;
            $empresa->nombreEstablecimiento = $request->nombreEstablecimiento;
            $empresa->save();// crea la empresa con el nombre del establecimiento 


            $admin = new User;
            $admin->nombrePersona = $request->nombrePersona;
            $admin->email = $request->email;
            $admin->pais= "Colombia";
            $admin->departamento = $departamentos[($request->idDepto) -1]->nombre;
            $admin->ciudad = $ciudades[($request->idCiudad) -1]->nombre;
            $admin->confirmoEmail = 0;
            $admin->estado = true;
            $admin->imagenPerfil = "perfil.jpg";
            $admin->imagenNegocio = "perfil.jpg";
            $admin->password = bcrypt($request->password);
            $admin->remember_token = str_random(100);
            $admin->confirm_token = str_random(100);
            $admin->esAdmin = false;
            $admin->esCajero = false;
            $admin->esBartender = false;
            $admin->esMesero = false;
            $admin->obsequio = false;
            $admin->esProveedor = true;
            $admin->cedula= $request->email; // coloco el email aquí temporalmente mientras se crea, unas lineas más adelante lo actualizo
            $admin->idEmpresa = $empresa->id; // id de la empresa para saber a quién pertenece
            $admin->username = str_random(100);
            $admin->save();// guarda el usuario registrado 
            
            $empresa->usuario_id = $admin->id;// obtiene el id del usuario que creo la empres apara saber la referencia 
            $empresa->departamento = $departamentos[($request->idDepto) -1]->nombre;
            $empresa->ciudad = $ciudades[($request->idCiudad) -1]->nombre;
            $empresa->save();// guarda los cambios 

            
            // parte del código para generar el username inicial
            $admin->cedula = $admin->id;
            $numeroRepetido = 0; // numero que se agregará al username por si ya hay alguno parecido y poderlo diferenciar
            $auxiliarBool = true;
            $auxiliarUser;
            $auxiliarUsername;
            while ($auxiliarBool) {
                if($numeroRepetido==0){
                    $auxiliarUsername = str_replace(' ','',$request->nombrePersona).'-'.str_replace(' ','',$request->nombreEstablecimiento);
                    $auxiliarUser = User::where('username', $auxiliarUsername)->first();
                }else{
                    $auxiliarUsername = str_replace(' ','',$request->nombrePersona).'-'.str_replace(' ','',$request->nombreEstablecimiento).$numeroRepetido;
                    $auxiliarUser = User::where('username', $auxiliarUsername)->first();
                }
                if($auxiliarUser==null){
                    $auxiliarBool= false;
                }
                $numeroRepetido++;

            }
            $admin->username = $auxiliarUsername;
            $admin->save();
            // guarda el username

            $data = $admin;
            Mail::send('Emails.confirmacion', ['data' => $data], function($mail) use($data){
                $mail->to($data->email)->subject('Confirma tu cuenta de PocketByR');
            });
            
            return redirect("Auth/login")
            ->with("message", "Hemos enviado un enlace de confirmación a su cuenta de correo electrónico");      
        }
    }
}
