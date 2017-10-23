<?php
namespace PocketByR\Http\Controllers\Auth;

use PocketByR\User;
use PocketByR\Empresa;
use PocketByR\Departamento;
use PocketByR\Ciudad;
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
use Socialite;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | Authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/WelcomeAdmin';
    
    protected function redirectTo()
    {   
        if(Auth::User()->esAdmin){
            return '/WelcomeAdmin';
        }elseif(Auth::User()->esProveedor){
            return '/WelcomeProveedor';
        }else{
            return '/WelcomeTrabajador';
        }
    }
    /**
     * Create a new Authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['getLogout','profile','updateProfile' , 'editProfile']]);
    }
    
    public function getRegister(Request $request){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view("Auth/register")->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }

    public function postRegister(Request $request){

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
            return redirect("Auth/register")
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
            $admin->departamento = Departamento::find($request->idDepto)->nombre;
            $admin->ciudad = Ciudad::find($request->idCiudad)->nombre;
            $admin->confirmoEmail = 0;
            $admin->estado = true;
            $admin->imagenPerfil = "perfil.jpg";
            $admin->imagenNegocio = "perfil.jpg";
            $admin->password = bcrypt($request->password);
            $admin->remember_token = str_random(100);
            $admin->confirm_token = str_random(100);
            $admin->esAdmin = true;
            $admin->esCajero = true;
            $admin->esBartender = true;
            $admin->esMesero = true;
            $admin->obsequio = true;
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

     public function confirmRegister($email, $confirm_token){
        $user = new User;
        $the_user = $user->select()->where('email', '=', $email)
        ->where('confirm_token', '=', $confirm_token)->get();
        if (count($the_user) > 0){
           $confirmoEmail = 1;
           $confirm_token = str_random(100);
           $user->where('email', '=', $email)
           ->update(['confirmoEmail' => $confirmoEmail, 'confirm_token' => $confirm_token]);
           
           return redirect('Auth/login')
           ->with('message', 'Bienvenido ' . $the_user[0]['nombrePersona'] . ' ya puede iniciar sesión');
        }else{
           return redirect('');
        }
    }

    public function postLogin(Request $request){

        if (Auth::attempt(
                [
                    'username' => $request->username,
                    'password' => $request->password,
                    'confirmoEmail' => 1,
                    'estado' => true
                ]
                , $request->has('remember')
                )){
            Auth::User()->inicioSesion();// función que se llama para que guarde un nuevo registro en la tabla de registro de inicio y cierre de sesión
            return redirect()->intended($this->redirectPath());
        }if (Auth::attempt([
                    'username' => $request->username,
                    'password' => $request->password,
                    'confirmoEmail' => 0
                ], $request->has('remember'))){            
            return $this->volverLogin('Por favor activa tu cuenta primero');
        }
        if(Auth::attempt([
                    'username' => $request->username,
                    'password' => $request->password,
                    'estado' => false
                ], $request->has('remember'))){
            return $this->volverLogin('Ha sido desactivado, por favor contacte con el administrador');
        }else{
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];
            $messages = [
                'username.required' => 'El campo Username es requerido',
                'password.required' => 'El campo password es requerido',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            
            return redirect('Auth/login')
            ->withErrors($validator)
            ->withInput()
            ->with('message', 'Error al iniciar sesión');
        }
    }

    public function volverLogin($mensaje){
        Auth::guard($this->getGuard())->logout();
        flash::warning($mensaje)->important();
        return redirect('/');
    }

    public function profile(){
        return View('Auth.profile');
    }

    public function editProfile(){
        return View('Auth.editProfile');
    }

    public function updateProfile(Request $request){
        $rules = [
            //'nombreEstablecimiento' => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'pais'=> 'required',
            'departamento'=> 'required',
            'ciudad'=> 'required',
            'fechaNacimiento' => 'required',
            'metodoPago' => 'required',
            'sexo' => 'required',
            'tipoRegimen'=> 'required',
            'telefono' => 'required|min:1|max:9999999999|numeric',
            'baroRestaurante' =>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()){
            return redirect("Auth/editProfile")
            ->withErrors($validator)
            ->withInput();
        }
        else{
            $admin =  Auth::user();
            //$admin->nombreEstablecimiento = $request->nombreEstablecimiento;
            $admin->nombrePersona = $request->nombrePersona;
            $admin->pais = $request->pais;
            $admin->departamento = $request->departamento;
            $admin->ciudad = $request->ciudad;
            $admin->fechaNacimiento = $request->fechaNacimiento;
            $admin->metodoPago = $request->metodoPago;
            $admin->sexo = $request->sexo;
            $admin->tipoRegimen = $request->tipoRegimen;
            $admin->telefono = $request->telefono;
            $admin->baroRestaurante = $request->baroRestaurante;
            $path = public_path() . '/images/admins/';
            if($request->file('imagenPerfil'))
            {
                $imagenPerfil = $request->file('imagenPerfil');
                $perfilNombre = 'perfilAdmin_' . time() . '.' . $imagenPerfil->getClientOriginalExtension();
                $imagenPerfil->move($path, $perfilNombre);
                $admin->imagenPerfil = $perfilNombre;
            }
            if($request->file('imagenNegocio'))
            {
                $imagenNegocio=$request->file('imagenNegocio');
                $perfilNegocio = 'perfilNegocio_' . time() . '.' . $imagenNegocio->getClientOriginalExtension();
                $imagenNegocio->move($path, $perfilNegocio);
                $admin->imagenNegocio = $perfilNegocio;
            }
            $admin->save();
            return redirect("Auth/profile")
            ->with("message", "Perfil actualizado correctamente");
        }
    }


    // login con redes sociales

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        Auth::User()->inicioSesion();// función que se llama para que guarde un nuevo registro en la tabla de registro de inicio y cierre de sesión
        //var_dump($user['gender']);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->getId())->first();
        if ($authUser) {
            return $authUser;
        }

        $empresa = new Empresa;
        $empresa->nombreEstablecimiento = '';
        $empresa->save();// crea la empresa con el nombre del establecimiento 


        $admin = new User;
        $admin->nombrePersona = $user->name;
        $admin->email = $user->email;
        $admin->pais= "Colombia";
        $admin->departamento = '';
        $admin->ciudad = '';
        $admin->confirmoEmail = 1;
        $admin->estado = true;
        $admin->imagenPerfil = "perfil.jpg";
        $admin->imagenNegocio = "perfil.jpg";
        $admin->password = bcrypt(str_random(8));
        $admin->remember_token = str_random(100);
        $admin->confirm_token = str_random(100);
        $admin->esAdmin = true;
        $admin->esCajero = true;
        $admin->esBartender = true;
        $admin->esMesero = true;
        $admin->obsequio = true;
        $admin->cedula= ''; 
        $admin->idEmpresa = $empresa->id; // id de la empresa para saber a quién pertenece
        $admin->username = str_random(100);
        $admin->save();// guarda el usuario registrado 
        
        $empresa->usuario_id = $admin->id;// obtiene el id del usuario que creo la empres apara saber la referencia 
        $empresa->save();// guarda los cambios 

        
        // parte del código para generar el username inicial
        $numeroRepetido = 0; // numero que se agregará al username por si ya hay alguno parecido y poderlo diferenciar
        $auxiliarBool = true;
        $auxiliarUser;
        $auxiliarUsername;
        while ($auxiliarBool) {
            if($numeroRepetido==0){
                $auxiliarUsername = str_replace(' ','',$user->name);
                $auxiliarUser = User::where('username', $auxiliarUsername)->first();
            }else{
                $auxiliarUsername = str_replace(' ','',$user->name).'-'.$numeroRepetido;
                $auxiliarUser = User::where('username', $auxiliarUsername)->first();
            }
            if($auxiliarUser==null){
                $auxiliarBool= false;
            }
            $numeroRepetido++;

        }
        $admin->username = $auxiliarUsername;
        $admin->provider = $provider;
        $admin->provider_id = $user->getId();
        //$admin->sexo = $user->gender;
        $admin->save();


        return $admin;
    }

}
