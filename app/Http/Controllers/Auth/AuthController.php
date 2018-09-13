<?php
namespace PocketByR\Http\Controllers\Auth;

use PocketByR\User;
use PocketByR\Empresa;
use PocketByR\Categoria;
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
use PocketByR\Proveedor;
use PocketByR\Insumo;
use PocketByR\Producto;
use PocketByR\Contiene;


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
        $this->middleware($this->guestMiddleware(), ['except' => ['getLogout','profile','updateProfile' , 'editProfile','cambiarBar']]);
    }

    public function getRegister(Request $request){
        $departamentos = Departamento::all();
        $ciudades = Ciudad::all();
        return view("Auth/register")->with('departamentos',$departamentos)
                ->with('ciudades', $ciudades);
    }

    public function cambiarBar(Request $request){
        $usuario  = Auth::User();
        $usuario->empresaActual = $request->campo;
        $usuario->save();
        return redirect($request->redireccionar);
    }

    public function getResetpassword(){
        return view("Auth/resetPassword");
    }

     public function resetpassword(){
        return view("Auth/resetPassword");
    }

    public function postRegister(Request $request){
        $rules = [
            //'nombreEstablecimiento' => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            //'cedula' => 'required|min:1|max:9999999999|numeric',
            'password' => 'required|min:6|max:18',
            //'TipoNegocio' => 'required',
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
            $empresa->imagenPerfilNegocio = "bar.png";
            $empresa->tipoRegimen = "simplificado";
            $empresa->baroRestaurante = $request->TipoNegocio;
            $empresa->contadorFactura = 1;
            $empresa->iva = 19;
            $empresa->save();// crea la empresa con el nombre del establecimiento


            $admin = new User;
            $admin->nombrePersona = $request->nombrePersona;
            $admin->email = $request->email;
            $admin->pais= "Colombia";
            $admin->departamento = Departamento::find($request->idDepto)->nombre;
            $admin->ciudad = Ciudad::find($request->idCiudad)->nombre;
            $admin->confirmoEmail = 0;
            $admin->estado = true;

            $admin->imagenPerfil = "perfilhombre.png";
            $admin->imagenNegocio = "perfilhombre.png";
            
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
            $admin->empresaActual =  $empresa->id;
            $admin->estadoTut = 13;
            $admin->save();// guarda el usuario registrado

            $empresa->usuario_id = $admin->id;// obtiene el id del usuario que creo la empres apara saber la referencia
            $empresa->departamento = $departamentos[($request->idDepto) -1]->nombre;
            $empresa->ciudad = $ciudades[($request->idCiudad) -1]->nombre;
            $empresa->notas = "Felicidad es saber que cuentas con un compañero inseparable como SMARTBAR.";
            $empresa->save();// guarda los cambios

            //Inicio carga predeterminada

            //CATEGORIAS GENERALES
            $categoria1 = new Categoria;
            $categoria1->nombre = "Bebidas";
            $categoria1->idEmpresa = $empresa->id;
            $categoria1->imagen = "bebidas.png";
            $categoria1->save();

            $categoria2 = new Categoria;
            $categoria2->nombre = "Postres";
            $categoria2->idEmpresa = $empresa->id;
            $categoria2->imagen = "postres.png";
            $categoria2->save();

            $categoria3 = new Categoria;
            $categoria3->nombre = "Adiciones";
            $categoria3->idEmpresa = $empresa->id;
            $categoria3->imagen = "adiciones.png";
            $categoria3->save();

            $categoria4 = new Categoria;
            $categoria4->nombre = "Especiales";
            $categoria4->idEmpresa = $empresa->id;
            $categoria4->imagen = "especiales.png";
            $categoria4->save();

            $categoria5 = new Categoria;
            $categoria5->nombre = "Otros";
            $categoria5->idEmpresa = $empresa->id;
            $categoria5->imagen = "otros.png";
            $categoria5->save();

            //PROVEEDOR GENERAL
            $proveedor = new Proveedor;
            $proveedor->nombre = "Desconocido";
            $proveedor->idEmpresa = $empresa->id;
            $proveedor->save();

            if($empresa->baroRestaurante == "bar"){
                //CATEGORIAS BAR
                $categoria6 = new Categoria;
                $categoria6->nombre = "Cervezas";
                $categoria6->idEmpresa = $empresa->id;
                $categoria6->imagen = "cervezas.png";
                $categoria6->save();

                $categoria7 = new Categoria;
                $categoria7->nombre = "Licores";
                $categoria7->idEmpresa = $empresa->id;
                $categoria7->imagen = "licores.png";
                $categoria7->save();

                $categoria8 = new Categoria;
                $categoria8->nombre = "Cocteles";
                $categoria8->idEmpresa = $empresa->id;
                $categoria8->imagen = "cocteles.png";
                $categoria8->save();

                $categoria9 = new Categoria;
                $categoria9->nombre = "Shots";
                $categoria9->idEmpresa = $empresa->id;
                $categoria9->imagen = "shots.png";
                $categoria9->save();

                $categoria10 = new Categoria;
                $categoria10->nombre = "Sin licor";
                $categoria10->idEmpresa = $empresa->id;
                $categoria10->imagen = "sinLicor.png";
                $categoria10->save();
            }elseif ($empresa->baroRestaurante == "restaurante") {
                $categoria11 = new Categoria;
                $categoria11->nombre = "Carnes";
                $categoria11->idEmpresa = $empresa->id;
                $categoria11->imagen = "carnes.png";
                $categoria11->save();

                $categoria12 = new Categoria;
                $categoria12->nombre = "Hamburguesas";
                $categoria12->idEmpresa = $empresa->id;
                $categoria12->imagen = "hamburguesas.png";
                $categoria12->save();

                $categoria13 = new Categoria;
                $categoria13->nombre = "Perros";
                $categoria13->idEmpresa = $empresa->id;
                $categoria13->imagen = "perros.png";
                $categoria13->save();

                $categoria14 = new Categoria;
                $categoria14->nombre = "Sandwiches";
                $categoria14->idEmpresa = $empresa->id;
                $categoria14->imagen = "sandwiches.png";
                $categoria14->save();

                $categoria15 = new Categoria;
                $categoria15->nombre = "Pizzas";
                $categoria15->idEmpresa = $empresa->id;
                $categoria15->imagen = "pizzas.png";
                $categoria15->save();

                $categoria16 = new Categoria;
                $categoria16->nombre = "Mariscos";
                $categoria16->idEmpresa = $empresa->id;
                $categoria16->imagen = "mariscos.png";
                $categoria16->save();

                $categoria17 = new Categoria;
                $categoria17->nombre = "Pastas";
                $categoria17->idEmpresa = $empresa->id;
                $categoria17->imagen = "pastas.png";
                $categoria17->save();

                $categoria18 = new Categoria;
                $categoria18->nombre = "Desgranados";
                $categoria18->idEmpresa = $empresa->id;
                $categoria18->imagen = "desgranados.png";
                $categoria18->save();
            }elseif ($empresa->baroRestaurante == "barRestaurante") {
                //CATEGORIAS BAR
                $categoria6 = new Categoria;
                $categoria6->nombre = "Cervezas";
                $categoria6->idEmpresa = $empresa->id;
                $categoria6->imagen = "cervezas.png";
                $categoria6->save();

                $categoria7 = new Categoria;
                $categoria7->nombre = "Licores";
                $categoria7->idEmpresa = $empresa->id;
                $categoria7->imagen = "licores.png";
                $categoria7->save();

                $categoria8 = new Categoria;
                $categoria8->nombre = "Cocteles";
                $categoria8->idEmpresa = $empresa->id;
                $categoria8->imagen = "cocteles.png";
                $categoria8->save();

                $categoria9 = new Categoria;
                $categoria9->nombre = "Shots";
                $categoria9->idEmpresa = $empresa->id;
                $categoria9->imagen = "shots.png";
                $categoria9->save();

                $categoria10 = new Categoria;
                $categoria10->nombre = "Sin licor";
                $categoria10->idEmpresa = $empresa->id;
                $categoria10->imagen = "sinLicor.png";
                $categoria10->save();

$categoria11 = new Categoria;
                $categoria11->nombre = "Carnes";
                $categoria11->idEmpresa = $empresa->id;
                $categoria11->imagen = "carnes.png";
                $categoria11->save();

                $categoria12 = new Categoria;
                $categoria12->nombre = "Hamburguesas";
                $categoria12->idEmpresa = $empresa->id;
                $categoria12->imagen = "hamburguesas.png";
                $categoria12->save();

                $categoria13 = new Categoria;
                $categoria13->nombre = "Perros";
                $categoria13->idEmpresa = $empresa->id;
                $categoria13->imagen = "perros.png";
                $categoria13->save();

                $categoria14 = new Categoria;
                $categoria14->nombre = "Sandwiches";
                $categoria14->idEmpresa = $empresa->id;
                $categoria14->imagen = "sandwiches.png";
                $categoria14->save();

                $categoria15 = new Categoria;
                $categoria15->nombre = "Pizzas";
                $categoria15->idEmpresa = $empresa->id;
                $categoria15->imagen = "pizzas.png";
                $categoria15->save();

                $categoria16 = new Categoria;
                $categoria16->nombre = "Mariscos";
                $categoria16->idEmpresa = $empresa->id;
                $categoria16->imagen = "mariscos.png";
                $categoria16->save();

                $categoria17 = new Categoria;
                $categoria17->nombre = "Pastas";
                $categoria17->idEmpresa = $empresa->id;
                $categoria17->imagen = "pastas.png";
                $categoria17->save();

                $categoria18 = new Categoria;
                $categoria18->nombre = "Desgranados";
                $categoria18->idEmpresa = $empresa->id;
                $categoria18->imagen = "desgranados.png";
                $categoria18->save();                
            }


            // parte del código para generar el username inicial
            $admin->cedula = $admin->id;

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

           /*return redirect('Auth/login')
           ->with('message', 'Bienvenido ' . $the_user[0]['nombrePersona'] . ' ya puede iniciar sesión');*/
           //dd($the_user);
            Auth::login($the_user[0], true);
            Auth::User()->inicioSesion();
            return redirect()->intended($this->redirectPath());
        }else{
           return redirect('');
        }
    }

    public function postLogin(Request $request){

        if (Auth::attempt(
                [
                    'email' => $request->emailInicio,
                    'password' => $request->password,
                    'confirmoEmail' => 1,
                    'estado' => true
                ]
                , $request->has('remember')
                )){
            Auth::User()->inicioSesion();// función que se llama para que guarde un nuevo registro en la tabla de registro de inicio y cierre de sesión
            return redirect()->intended($this->redirectPath());
        }if (Auth::attempt([
                    'email' => $request->emailInicio,
                    'password' => $request->password,
                    'confirmoEmail' => 0
                ], $request->has('remember'))){
            return $this->volverLogin('Por favor activa tu cuenta primero');
        }
        if(Auth::attempt([
                    'email' => $request->emailInicio,
                    'password' => $request->password,
                    'estado' => false
                ], $request->has('remember'))){
            return $this->volverLogin('Ha sido desactivado, por favor contacte con el administrador');
        }else{
            $rules = [
                'emailInicio' => 'email',
                'password' => 'required',
            ];
            $messages = [
                'emailInicio.required' => 'El campo Email es requerido',
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
        if($authUser == null){
            return redirect("/")
            ->with("message", "El correo electrónico ya se encuentra asociado a una cuenta");
        }
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
        $the_user = User::where('email', '=', $user->email)->first();
        if ($the_user == null){
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
            $admin->idEmpresa = $empresa->id;
            $admin->empresaActual =  $empresa->id;// id de la empresa para saber a quién pertenece
            $admin->save();// guarda el usuario registrado

            $empresa->usuario_id = $admin->id;// obtiene el id del usuario que creo la empres apara saber la referencia
            $empresa->save();// guarda los cambios

            $admin->provider = $provider;
            $admin->provider_id = $user->getId();
            //$admin->sexo = $user->gender;
            $admin->save();


            return $admin;
        }
        else{
            return null;
        }
    }
}
