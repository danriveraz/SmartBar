<?php

namespace PocketByR\Http\Controllers\Auth;

use PocketByR\User;
use Validator;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use Auth;
use Illuminate\Http\Request;
use Session;
use Input;
use Redirect;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    public function postRegister(Request $request){
        $rules = [
            'name' => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];
         $messages = [
            'name.required' => 'El campo es requerido',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 20',
            'name.regex' => 'Sólo se aceptan letras',
            'email.required' => 'El campo es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
        ];
         $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()){
            return redirect("auth/register")
            ->withErrors($validator)
            ->withInput();
        }
        else{
            $admin = new User;
            $admin->nombreEstablecimiento = $request->nombreEstablecimiento;
            $admin->nombrePersona = $request->name;
            $admin->sexo = $request->sexo;
            $admin->email = $request->email;
            $admin->telefono = $request->telefono;
            $admin->cedula = $request->cedula;
            $admin->password = bcrypt($request->password);
            $admin->remember_token = str_random(100);
            $admin->confirm_token = str_random(100);
            $admin->save();
            
            return redirect("auth/register")
            ->with("message", "Hemos enviado un enlace de confirmación a su cuenta de correo electrónico");
        }
    }

     public function confirmRegister($email, $confirm_token){
        $user = new User;
        $the_user = $user->select()->where('email', '=', $email)
        ->where('confirm_token', '=', $confirm_token)->get();
        if (count($the_user) > 0){
           $confirmoEmail = 1;
           $confirm_token = str_random(100);
           $user->where('email', '=', $email)
           ->update(['confirmoEmail' => $confirmoEmail, 'confirm_token' => $confirm_token]);
           return redirect('auth/register')
           ->with('message', 'Enhorabuena ' . $the_user[0]['nombrePersona'] . ' ya puede iniciar sesión');
        }else{
           return redirect('welcome');
        }
    }

    public function postLogin(Request $request){
        
        if (Auth::attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password,
                    'confirmoEmail' => 1
                ]
                , $request->has('remember')
                )){
            return redirect()->intended($this->redirectPath());
        }
        else{
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            
            $messages = [
                'email.required' => 'El campo email es requerido',
                'email.email' => 'El formato de email es incorrecto',
                'password.required' => 'El campo password es requerido',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            
            return redirect('auth/login')
            ->withErrors($validator)
            ->withInput()
            ->with('message', 'Error al iniciar sesión');
        }
    }
}
