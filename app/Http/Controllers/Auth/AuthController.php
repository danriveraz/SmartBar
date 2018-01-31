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

    public function resetpassword(){
        return view("Auth/resetpassword");
    }

    public function postRegister(Request $request){

        $rules = [
            //'nombreEstablecimiento' => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'nombrePersona' => 'required|min:3|max:40|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            //'cedula' => 'required|min:1|max:9999999999|numeric',
            'password' => 'required|min:6|max:18',
            'sexo' => 'required',
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
            $empresa->save();// crea la empresa con el nombre del establecimiento


            $admin = new User;
            $admin->nombrePersona = $request->nombrePersona;
            $admin->email = $request->email;
            $admin->pais= "Colombia";
            $admin->departamento = Departamento::find($request->idDepto)->nombre;
            $admin->ciudad = Ciudad::find($request->idCiudad)->nombre;
            $admin->confirmoEmail = 0;
            $admin->estado = true;
            $admin->sexo = $request->sexo;
            if($request->sexo == "Femenino"){
                $admin->imagenPerfil = "perfil.jpg";
                $admin->imagenNegocio = "perfil.jpg";
            }else{
                $admin->imagenPerfil = "perfilhombre.png";
                $admin->imagenNegocio = "perfilhombre.png";
            }
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

            $categoria1 = new Categoria;
            $categoria1->nombre = "Cervezas";
            $categoria1->idEmpresa = $empresa->id;
            $categoria1->imagen = "cervezas.png";
            $categoria1->save();

            $categoria2 = new Categoria;
            $categoria2->nombre = "Bebidas";
            $categoria2->idEmpresa = $empresa->id;
            $categoria2->imagen = "bebidas.png";
            $categoria2->save();

            $categoria3 = new Categoria;
            $categoria3->nombre = "Carnes";
            $categoria3->idEmpresa = $empresa->id;
            $categoria3->imagen = "carnes.png";
            $categoria3->save();

            $categoria4 = new Categoria;
            $categoria4->nombre = "Desgranados";
            $categoria4->idEmpresa = $empresa->id;
            $categoria4->imagen = "desgranados.png";
            $categoria4->save();

            $categoria5 = new Categoria;
            $categoria5->nombre = "Hamburguesas";
            $categoria5->idEmpresa = $empresa->id;
            $categoria5->imagen = "hamburguesa.png";
            $categoria5->save();

            $categoria6 = new Categoria;
            $categoria6->nombre = "Hot Dogs";
            $categoria6->idEmpresa = $empresa->id;
            $categoria6->imagen = "perros.png";
            $categoria6->save();

            $categoria7 = new Categoria;
            $categoria7->nombre = "Sandwich";
            $categoria7->idEmpresa = $empresa->id;
            $categoria7->imagen = "sandwich.png";
            $categoria7->save();

            $categoria8 = new Categoria;
            $categoria8->nombre = "Entradas";
            $categoria8->idEmpresa = $empresa->id;
            $categoria8->imagen = "entradas.png";
            $categoria8->save();

            $categoria9 = new Categoria;
            $categoria9->nombre = "Licores";
            $categoria9->idEmpresa = $empresa->id;
            $categoria9->imagen = "licores.png";
            $categoria9->save();

            $categoria10 = new Categoria;
            $categoria10->nombre = "Cocteles";
            $categoria10->idEmpresa = $empresa->id;
            $categoria10->imagen = "cocteles.png";
            $categoria10->save();

            $categoria11 = new Categoria;
            $categoria11->nombre = "Shots";
            $categoria11->idEmpresa = $empresa->id;
            $categoria11->imagen = "shots.png";
            $categoria11->save();

            $categoria12 = new Categoria;
            $categoria12->nombre = "Pizzas";
            $categoria12->idEmpresa = $empresa->id;
            $categoria12->imagen = "pizza.png";
            $categoria12->save();

            $categoria13 = new Categoria;
            $categoria13->nombre = "Pastas";
            $categoria13->idEmpresa = $empresa->id;
            $categoria13->imagen = "pastas.png";
            $categoria13->save();

            $categoria14 = new Categoria;
            $categoria14->nombre = "Mariscos";
            $categoria14->idEmpresa = $empresa->id;
            $categoria14->imagen = "mariscos.png";
            $categoria14->save();

            $categoria15 = new Categoria;
            $categoria15->nombre = "Adiciones";
            $categoria15->idEmpresa = $empresa->id;
            $categoria15->imagen = "adiciones.png";
            $categoria15->save();

            $categoria16 = new Categoria;
            $categoria16->nombre = "Especiales";
            $categoria16->idEmpresa = $empresa->id;
            $categoria16->imagen = "especiales.png";
            $categoria16->save();

            $categoria17 = new Categoria;
            $categoria17->nombre = "Postres";
            $categoria17->idEmpresa = $empresa->id;
            $categoria17->imagen = "postres.png";
            $categoria17->save();

            $categoria18 = new Categoria;
            $categoria18->nombre = "Otros";
            $categoria18->idEmpresa = $empresa->id;
            $categoria18->imagen = "otros.png";
            $categoria18->save();

            $proveedor = new Proveedor;
            $proveedor->nombre = "Desconocido";
            $proveedor->idEmpresa = $empresa->id;
            $proveedor->save();

            $insumo1 = new Insumo;
            $insumo1->idProveedor = $proveedor->id;
            $insumo1->nombre = "Brandy";
            $insumo1->medida = 0;
            $insumo1->idEmpresa = $empresa->id;
            $insumo1->save();

            $insumo2 = new Insumo;
            $insumo2->idProveedor = $proveedor->id;
            $insumo2->nombre = "Crema de Cacao";
            $insumo2->medida = 0;
            $insumo2->idEmpresa = $empresa->id;
            $insumo2->save();

            $insumo3 = new Insumo;
            $insumo3->idProveedor = $proveedor->id;
            $insumo3->nombre = "Nata líquida";
            $insumo3->medida = 0;
            $insumo3->idEmpresa = $empresa->id;
            $insumo3->save();

            $insumo4 = new Insumo;
            $insumo4->idProveedor = $proveedor->id;
            $insumo4->nombre = "Licor de café (Kahlua)";
            $insumo4->medida = 0;
            $insumo4->idEmpresa = $empresa->id;
            $insumo4->save();

            $insumo5 = new Insumo;
            $insumo5->idProveedor = $proveedor->id;
            $insumo5->nombre = "Crema de Whiskey";
            $insumo5->medida = 0;
            $insumo5->idEmpresa = $empresa->id;
            $insumo5->save();

            $insumo6 = new Insumo;
            $insumo6->idProveedor = $proveedor->id;
            $insumo6->nombre = "Grand Marnier";
            $insumo6->medida = 0;
            $insumo6->idEmpresa = $empresa->id;
            $insumo6->save();

            $insumo7 = new Insumo;
            $insumo7->idProveedor = $proveedor->id;
            $insumo7->nombre = "Ron blanco Bacardi";
            $insumo7->medida = 0;
            $insumo7->idEmpresa = $empresa->id;
            $insumo7->save();

            $insumo8 = new Insumo;
            $insumo8->idProveedor = $proveedor->id;
            $insumo8->nombre = "Jugo de lima";
            $insumo8->medida = 0;
            $insumo8->idEmpresa = $empresa->id;
            $insumo8->save();

            $insumo9 = new Insumo;
            $insumo9->idProveedor = $proveedor->id;
            $insumo9->nombre = "Granadina";
            $insumo9->medida = 0;
            $insumo9->idEmpresa = $empresa->id;
            $insumo9->save();

            $insumo10 = new Insumo;
            $insumo10->idProveedor = $proveedor->id;
            $insumo10->nombre = "Ron blanco";
            $insumo10->medida = 0;
            $insumo10->idEmpresa = $empresa->id;
            $insumo10->save();

            $insumo11 = new Insumo;
            $insumo11->idProveedor = $proveedor->id;
            $insumo11->nombre = "Coñac";
            $insumo11->medida = 0;
            $insumo11->idEmpresa = $empresa->id;
            $insumo11->save();

            $insumo12 = new Insumo;
            $insumo12->idProveedor = $proveedor->id;
            $insumo12->nombre = "Triple seco";
            $insumo12->medida = 0;
            $insumo12->idEmpresa = $empresa->id;
            $insumo12->save();

            $insumo13 = new Insumo;
            $insumo13->idProveedor = $proveedor->id;
            $insumo13->nombre = "Zumo de limón";
            $insumo13->medida = 0;
            $insumo13->idEmpresa = $empresa->id;
            $insumo13->save();

            $insumo14 = new Insumo;
            $insumo14->idProveedor = $proveedor->id;
            $insumo14->nombre = "Vodka";
            $insumo14->medida = 0;
            $insumo14->idEmpresa = $empresa->id;
            $insumo14->save();

            $insumo15 = new Insumo;
            $insumo15->idProveedor = $proveedor->id;
            $insumo15->nombre = "Cachaça";
            $insumo15->medida = 0;
            $insumo15->idEmpresa = $empresa->id;
            $insumo15->save();

            $insumo16 = new Insumo;
            $insumo16->idProveedor = $proveedor->id;
            $insumo16->nombre = "Old Tom Gin";
            $insumo16->medida = 0;
            $insumo16->idEmpresa = $empresa->id;
            $insumo16->save();

            $insumo17 = new Insumo;
            $insumo17->idProveedor = $proveedor->id;
            $insumo17->nombre = "Maraschino";
            $insumo17->medida = 0;
            $insumo17->idEmpresa = $empresa->id;
            $insumo17->save();

            $insumo18 = new Insumo;
            $insumo18->idProveedor = $proveedor->id;
            $insumo18->nombre = "Amargo naranja";
            $insumo18->medida = 0;
            $insumo18->idEmpresa = $empresa->id;
            $insumo18->save();

            $insumo19 = new Insumo;
            $insumo19->idProveedor = $proveedor->id;
            $insumo19->nombre = "Jugo de limón";
            $insumo19->medida = 0;
            $insumo19->idEmpresa = $empresa->id;
            $insumo19->save();

            $insumo20 = new Insumo;
            $insumo20->idProveedor = $proveedor->id;
            $insumo20->nombre = "Champage frío";
            $insumo20->medida = 0;
            $insumo20->idEmpresa = $empresa->id;
            $insumo20->save();

            $insumo21 = new Insumo;
            $insumo21->idProveedor = $proveedor->id;
            $insumo21->nombre = "Coñac";
            $insumo21->medida = 0;
            $insumo21->idEmpresa = $empresa->id;
            $insumo21->save();

            $insumo22 = new Insumo;
            $insumo22->idProveedor = $proveedor->id;
            $insumo22->nombre = "Vodka limón";
            $insumo22->medida = 0;
            $insumo22->idEmpresa = $empresa->id;
            $insumo22->save();

            $insumo23 = new Insumo;
            $insumo23->idProveedor = $proveedor->id;
            $insumo23->nombre = "Cointreau";
            $insumo23->medida = 0;
            $insumo23->idEmpresa = $empresa->id;
            $insumo23->save();

            $insumo24 = new Insumo;
            $insumo24->idProveedor = $proveedor->id;
            $insumo24->nombre = "Jugo de lima";
            $insumo24->medida = 0;
            $insumo24->idEmpresa = $empresa->id;
            $insumo24->save();

            $insumo25 = new Insumo;
            $insumo25->idProveedor = $proveedor->id;
            $insumo25->nombre = "Zumo de arándano";
            $insumo25->medida = 0;
            $insumo25->idEmpresa = $empresa->id;
            $insumo25->save();

            $insumo26 = new Insumo;
            $insumo26->idProveedor = $proveedor->id;
            $insumo26->nombre = "Ron blanco";
            $insumo26->medida = 0;
            $insumo26->idEmpresa = $empresa->id;
            $insumo26->save();

            $insumo27 = new Insumo;
            $insumo27->idProveedor = $proveedor->id;
            $insumo27->nombre = "Cola";
            $insumo27->medida = 0;
            $insumo27->idEmpresa = $empresa->id;
            $insumo27->save();

            $insumo28 = new Insumo;
            $insumo28->idProveedor = $proveedor->id;
            $insumo28->nombre = "Zumo de lima";
            $insumo28->medida = 0;
            $insumo28->idEmpresa = $empresa->id;
            $insumo28->save();

            $insumo29 = new Insumo;
            $insumo29->idProveedor = $proveedor->id;
            $insumo29->nombre = "Jarabe de frutas (fresa, plátano, piña, etc.)";
            $insumo29->medida = 0;
            $insumo29->idEmpresa = $empresa->id;
            $insumo29->save();

            $insumo30 = new Insumo;
            $insumo30->idProveedor = $proveedor->id;
            $insumo30->nombre = "Ginebra";
            $insumo30->medida = 0;
            $insumo30->idEmpresa = $empresa->id;
            $insumo30->save();

            $insumo31 = new Insumo;
            $insumo31->idProveedor = $proveedor->id;
            $insumo31->nombre = "Vermut seco";
            $insumo31->medida = 0;
            $insumo31->idEmpresa = $empresa->id;
            $insumo31->save();

            $insumo32 = new Insumo;
            $insumo32->idProveedor = $proveedor->id;
            $insumo32->nombre = "Tónica";
            $insumo32->medida = 0;
            $insumo32->idEmpresa = $empresa->id;
            $insumo32->save();

            $insumo33 = new Insumo;
            $insumo33->idProveedor = $proveedor->id;
            $insumo33->nombre = "Scotch Whiskey";
            $insumo33->medida = 0;
            $insumo33->idEmpresa = $empresa->id;
            $insumo33->save();

            $insumo34 = new Insumo;
            $insumo34->idProveedor = $proveedor->id;
            $insumo34->nombre = "Amaretto";
            $insumo34->medida = 0;
            $insumo34->idEmpresa = $empresa->id;
            $insumo34->save();

            $insumo35 = new Insumo;
            $insumo35->idProveedor = $proveedor->id;
            $insumo35->nombre = "Créme de Cacao blanca";
            $insumo35->medida = 0;
            $insumo35->idEmpresa = $empresa->id;
            $insumo35->save();

            $insumo36 = new Insumo;
            $insumo36->idProveedor = $proveedor->id;
            $insumo36->nombre = "Créme de Menthe";
            $insumo36->medida = 0;
            $insumo36->idEmpresa = $empresa->id;
            $insumo36->save();

            $insumo37 = new Insumo;
            $insumo37->idProveedor = $proveedor->id;
            $insumo37->nombre = "Nata";
            $insumo37->medida = 0;
            $insumo37->idEmpresa = $empresa->id;
            $insumo37->save();

            $insumo38 = new Insumo;
            $insumo38->idProveedor = $proveedor->id;
            $insumo38->nombre = "Galliano";
            $insumo38->medida = 0;
            $insumo38->idEmpresa = $empresa->id;
            $insumo38->save();

            $insumo39 = new Insumo;
            $insumo39->idProveedor = $proveedor->id;
            $insumo39->nombre = "Zumo de naranja";
            $insumo39->medida = 0;
            $insumo39->idEmpresa = $empresa->id;
            $insumo39->save();

            $insumo40 = new Insumo;
            $insumo40->idProveedor = $proveedor->id;
            $insumo40->nombre = "Sirope";
            $insumo40->medida = 0;
            $insumo40->idEmpresa = $empresa->id;
            $insumo40->save();

            $insumo41 = new Insumo;
            $insumo41->idProveedor = $proveedor->id;
            $insumo41->nombre = "Soda";
            $insumo41->medida = 0;
            $insumo41->idEmpresa = $empresa->id;
            $insumo41->save();

            $insumo42 = new Insumo;
            $insumo42->idProveedor = $proveedor->id;
            $insumo42->nombre = "Tequila";
            $insumo42->medida = 0;
            $insumo42->idEmpresa = $empresa->id;
            $insumo42->save();

            $insumo43 = new Insumo;
            $insumo43->idProveedor = $proveedor->id;
            $insumo43->nombre = "Ron oscuro añejo";
            $insumo43->medida = 0;
            $insumo43->idEmpresa = $empresa->id;
            $insumo43->save();

            $insumo44 = new Insumo;
            $insumo44->idProveedor = $proveedor->id;
            $insumo44->nombre = "Curacao de naranja";
            $insumo44->medida = 0;
            $insumo44->idEmpresa = $empresa->id;
            $insumo44->save();

            $insumo45 = new Insumo;
            $insumo45->idProveedor = $proveedor->id;
            $insumo45->nombre = "Whiskey";
            $insumo45->medida = 0;
            $insumo45->idEmpresa = $empresa->id;
            $insumo45->save();

            $insumo46 = new Insumo;
            $insumo46->idProveedor = $proveedor->id;
            $insumo46->nombre = "Vermut Rojo";
            $insumo46->medida = 0;
            $insumo46->idEmpresa = $empresa->id;
            $insumo46->save();

            $insumo47 = new Insumo;
            $insumo47->idProveedor = $proveedor->id;
            $insumo47->nombre = "Menta";
            $insumo47->medida = 1;
            $insumo47->idEmpresa = $empresa->id;
            $insumo47->save();

            $insumo48 = new Insumo;
            $insumo48->idProveedor = $proveedor->id;
            $insumo48->nombre = "Campari";
            $insumo48->medida = 0;
            $insumo48->idEmpresa = $empresa->id;
            $insumo48->save();

            $insumo49 = new Insumo;
            $insumo49->idProveedor = $proveedor->id;
            $insumo49->nombre = "Jugo de naranja";
            $insumo49->medida = 0;
            $insumo49->idEmpresa = $empresa->id;
            $insumo49->save();

            $insumo50 = new Insumo;
            $insumo50->idProveedor = $proveedor->id;
            $insumo50->nombre = "Jugo de piña";
            $insumo50->medida = 0;
            $insumo50->idEmpresa = $empresa->id;
            $insumo50->save();

            $insumo51 = new Insumo;
            $insumo51->idProveedor = $proveedor->id;
            $insumo51->nombre = "Leche de coco";
            $insumo51->medida = 0;
            $insumo51->idEmpresa = $empresa->id;
            $insumo51->save();

            $insumo52 = new Insumo;
            $insumo52->idProveedor = $proveedor->id;
            $insumo52->nombre = "Drambuie";
            $insumo52->medida = 0;
            $insumo52->idEmpresa = $empresa->id;
            $insumo52->save();

            $insumo53 = new Insumo;
            $insumo53->idProveedor = $proveedor->id;
            $insumo53->nombre = "Aguardiente de melocotón";
            $insumo53->medida = 0;
            $insumo53->idEmpresa = $empresa->id;
            $insumo53->save();

            $insumo54 = new Insumo;
            $insumo54->idProveedor = $proveedor->id;
            $insumo54->nombre = "Jugo de arándanos";
            $insumo54->medida = 0;
            $insumo54->idEmpresa = $empresa->id;
            $insumo54->save();

            $insumo55 = new Insumo;
            $insumo55->idProveedor = $proveedor->id;
            $insumo55->nombre = "Ron";
            $insumo55->medida = 0;
            $insumo55->idEmpresa = $empresa->id;
            $insumo55->save();

            $insumo56 = new Insumo;
            $insumo56->idProveedor = $proveedor->id;
            $insumo56->nombre = "Curacao azul";
            $insumo56->medida = 0;
            $insumo56->idEmpresa = $empresa->id;
            $insumo56->save();

            $insumo57 = new Insumo;
            $insumo57->idProveedor = $proveedor->id;
            $insumo57->nombre = "Crema de coco";
            $insumo57->medida = 0;
            $insumo57->idEmpresa = $empresa->id;
            $insumo57->save();

            $producto1 = new Producto;
            $producto1->nombre = "Alexander";
            $producto1->descripcion = "Cóctel digestivo por las propiedades digestivas del coñac o brandy";
            $producto1->receta = "Verter el hielo, el Brandy, la crema de cacao y la nata liquida en la coctelera y agitar muy bien, colar en la copa, decorar con una fresa y espolvorear canela o una pizca de nuez moscada.";
            $producto1->idCategoria = $categoria18->id;
            $producto1->idEmpresa = $empresa->id;
            $producto1->save();

            $producto2 = new Producto;
            $producto2->nombre = "B52";
            $producto2->descripcion = "Es un cóctel más bien digestivo";
            $producto2->receta = "Las capas se forman por densidad y orden con los ingredientes Kahlua, seguido de Bailey’s y en la superficie con Grand Marnier. Después se flambea el Grand Marnier de la superficie y se sirve con la llama aún encendida, para  una mejor dicion de los colores se puede aplicar con una cuchara, para suavizar la aplicación. Puede tomarse con pitillo, tomando un poco de cada sabor.";
            $producto2->idCategoria = $categoria18->id;
            $producto2->idEmpresa = $empresa->id;
            $producto2->save();

            $producto3 = new Producto;
            $producto3->nombre = "Bacardi Red";
            $producto3->descripcion = "Cóctel de aperitivo";
            $producto3->receta = "Verter todos los ingredientes en la coctelera y agitar muy bien, colar en la copa, decorar con una rodaja de limón y una fresa atravesadas por un palillo de plástico o rodear la copa con sal y decorar con una fresa o cereza.";
            $producto3->idCategoria = $categoria18->id;
            $producto3->idEmpresa = $empresa->id;
            $producto3->save();

            $producto4 = new Producto;
            $producto4->nombre = "Between the Sheets";
            $producto4->descripcion = "Cóctel para tomar durante todo el día.";
            $producto4->receta = "Verter todos los ingredientes en la coctelera con hielos, agitar y colar en un vaso frío de coctel.";
            $producto4->idCategoria = $categoria18->id;
            $producto4->idEmpresa = $empresa->id;
            $producto4->save();

            $producto5 = new Producto;
            $producto5->nombre = "Black Russian/White Russian";
            $producto5->descripcion = "Cóctel digestivo";
            $producto5->receta = "Echar los ingredientes en un vaso ancho con hielos, y revolver suavemente. Para hacer el White Russian, hacer flotar nata fresca por la superficie y revolver.";
            $producto5->idCategoria = $categoria18->id;
            $producto5->idEmpresa = $empresa->id;
            $producto5->save();

            $producto6 = new Producto;
            $producto6->nombre = "Caipirinha/Caipiroska";
            $producto6->descripcion = "Destinado para beber a cualquier hora del día";
            $producto6->receta = "Poner lima y azúcar en un vaso ancho y mezclarlo, llenar el vaso con hielo y Cachaça, si queremos una Caipiroska, cambiamos la Cachaca por Vodka.";
            $producto6->idCategoria = $categoria18->id;
            $producto6->idEmpresa = $empresa->id;
            $producto6->save();

            $producto7 = new Producto;
            $producto7->nombre = "Casino";
            $producto7->descripcion = "Cóctel para disfrutar a cualquier hora del día";
            $producto7->receta = "Mezclar todos los ingredientes en una coctelera con hielos, agitar bien, colar en un vaso de coctel frío y decorar con una cereza y rodear la copa con sal.";
            $producto7->idCategoria = $categoria18->id;
            $producto7->idEmpresa = $empresa->id;
            $producto7->save();

            $producto8 = new Producto;
            $producto8->nombre = "Champagne Cooler";
            $producto8->descripcion = "Es un cóctel espumoso";
            $producto8->receta = "Añadir una pizca de amargo Angostura en el terrón de azúcar o sirope y servirlo en copa de champagne. Añadir coñac seguido de champagne frío. Decorar con una rodaja de naranja y añadir una cereza al fondo de la copa.";
            $producto8->idCategoria = $categoria18->id;
            $producto8->idEmpresa = $empresa->id;
            $producto8->save();

            $producto9 = new Producto;
            $producto9->nombre = "Cosmopolitan";
            $producto9->descripcion = "Para cualquier hora del día";
            $producto9->receta = "Agitar todos los elementos con hielo en una coctelera. Servir en un vaso largo de coctel. Decorar con una rodaja de limón y una cereza.";
            $producto9->idCategoria = $categoria18->id;
            $producto9->idEmpresa = $empresa->id;
            $producto9->save();

            $producto10 = new Producto;
            $producto10->nombre = "Cubalibre";
            $producto10->receta = "Mezclar todos los ingredientes en un vaso largo lleno de hielo y decorar con una porción de limón.";
            $producto10->idCategoria = $categoria18->id;
            $producto10->idEmpresa = $empresa->id;
            $producto10->save();

            $producto11 = new Producto;
            $producto11->nombre = "Daiquiri";
            $producto11->descripcion = "Cóctel de aperitivo";
            $producto11->receta = "Licuar todos los ingredientes junto con el hielo, revolver y colar en un vaso de coctel.";
            $producto11->idCategoria = $categoria18->id;
            $producto11->idEmpresa = $empresa->id;
            $producto11->save();

            $producto12 = new Producto;
            $producto12->nombre = "Dry Martini sucio";
            $producto12->descripcion = "Cóctel digestivo";
            $producto12->receta = "Echar todos los ingredientes en un vaso mezclador con hielos, remover bien y colar en un vaso frío de Martini. Exprimir el aceite de la corteza de limón en la bebida y decorar con aceitunas, Recomendación: poner siempre aceitunas impares, una, tres o cinco. Para hacer un Dry Martini limpio, bañar la copa con vermut y eliminarlo, agregar el ginebra.";
            $producto12->idCategoria = $categoria18->id;
            $producto12->idEmpresa = $empresa->id;
            $producto12->save();

            $producto13 = new Producto;
            $producto13->nombre = "Gin & Tonic";
            $producto13->descripcion = "Cóctel de aperitivo";
            $producto13->receta = "Echar directamente la ginebra y la tónica en un vaso ancho o en una copa de balón con hielo y una porción/rodaja de limón.";
            $producto13->idCategoria = $categoria18->id;
            $producto13->idEmpresa = $empresa->id;
            $producto13->save();

            $producto14 = new Producto;
            $producto14->nombre = "God Father/God Mother";
            $producto14->descripcion = "Cóctel digestivo";
            $producto14->receta = "Verter directamente todos los ingredientes en un vaso ancho lleno de hielos y remover suavemente. Con vodka en vez de whisky, se llama God Mother.";
            $producto14->idCategoria = $categoria18->id;
            $producto14->idEmpresa = $empresa->id;
            $producto14->save();

            $producto15 = new Producto;
            $producto15->nombre = "Grasshopper";
            $producto15->descripcion = "Cóctel digestivo";
            $producto15->receta = "Verter todos los ingredientes en una coctelera con hielo. Agitar rápidamente durante unos segundos. Colar en un vaso de coctel frío.";
            $producto15->idCategoria = $categoria18->id;
            $producto15->idEmpresa = $empresa->id;
            $producto15->save();

            $producto16 = new Producto;
            $producto16->nombre = "Harvey Wallbanger";
            $producto16->descripcion = "Cóctel para cualquier hora del día";
            $producto16->receta = "Echar vodka y zumo de naranja en un vaso largo lleno de hielo. Remover suavemente y boyar el Galliano en la superficie. Decorar con rodajas de naranja y cereza.";
            $producto16->idCategoria = $categoria18->id;
            $producto16->idEmpresa = $empresa->id;
            $producto16->save();

            $producto17 = new Producto;
            $producto17->nombre = "John Collins/Tom Collins";
            $producto17->receta = "Verter todos los componentes directamente en un vaso largo lleno de hielo y remover. Decorar con una rodaja de limón y una cereza. Añadir finalmente un toque de amargo de Angostura. Si queremos variarlo al Tom Collins, debemos usar Old Tom Gin.";
            $producto17->idCategoria = $categoria18->id;
            $producto17->idEmpresa = $empresa->id;
            $producto17->save();

            $producto18 = new Producto;
            $producto18->nombre = "Long Island Ice Tea";
            $producto18->receta = "Añadir todos los ingredientes en un vaso largo lleno de hielo, revolver y decorar con rodaja de limón. Adicionar un toque de té o coca cola";
            $producto18->idCategoria = $categoria18->id;
            $producto18->idEmpresa = $empresa->id;
            $producto18->save();

            $producto19 = new Producto;
            $producto19->nombre = "Mai-Tai";
            $producto19->receta = "Agitar en un vaso largo, y decorar con una porción de piña, hojas de menta o piel de lima. Servir con pitillo y mezclador. Se puede reemplazar el Curacao de naranja por Cointreau.";
            $producto19->idCategoria = $categoria18->id;
            $producto19->idEmpresa = $empresa->id;
            $producto19->save();

            $producto20 = new Producto;
            $producto20->nombre = "Manhattan";
            $producto20->descripcion = "Coctel de aperitivo por su amargo que abre el apetito";
            $producto20->receta = "Echar todos los ingredientes en un mezclador con hielos, agregando un toque de amargo de Angostura y remover bien. Colarlo en un vaso de coctel enfriado y decorarlo con cereza.";
            $producto20->idCategoria = $categoria18->id;
            $producto20->idEmpresa = $empresa->id;
            $producto20->save();

            $producto21 = new Producto;
            $producto21->nombre = "Margarita";
            $producto21->descripcion = "Para beber a cualquier hora del día";
            $producto21->receta = "Echar todos los ingredientes en una coctelera con hielo, agitarlo bien y colarlo en un vaso de coctel bordeado con sal. Jugo de limón recién exprimido.";
            $producto21->idCategoria = $categoria18->id;
            $producto21->idEmpresa = $empresa->id;
            $producto21->save();

            $producto22 = new Producto;
            $producto22->nombre = "Mint Julep";
            $producto22->receta = "En un vaso largo machacar o macerar suavemente las hojas de menta, una cucharilla de azúcar en polvo con dos cucharillas de soda o de agua con gas. Llenar el vaso con hielo picado, añadir el whisky y revolver hasta que el vaso se congele. Decorar con una hoja de menta y rodaja de limón.";
            $producto22->idCategoria = $categoria18->id;
            $producto22->idEmpresa = $empresa->id;
            $producto22->save();

            $producto23 = new Producto;
            $producto23->nombre = "Mojito";
            $producto23->receta = "Machacar las ramas de menta o hierbabuena con dos cucharillas azúcar y jugo de lima. Añadir un chorro de soda, agua con gas o ginger y llenar el vaso con hielo molido. Echar ron y llenarlo con la soda, agua con gas o ginger de nuevo. Decorar con hojas de menta y una rodaja de limón, servir con pitillo.";
            $producto23->idCategoria = $categoria18->id;
            $producto23->idEmpresa = $empresa->id;
            $producto23->save();

            $producto24 = new Producto;
            $producto24->nombre = "Negrori";
            $producto24->descripcion = "Coctel de aperitivo debido a que el amargo del Campari abre el apetito";
            $producto24->receta = "Echar todos los ingredientes en un vaso ancho lleno de hielo y remover suavemente. Adornar con media rodaja de naranja.";
            $producto24->idCategoria = $categoria18->id;
            $producto24->idEmpresa = $empresa->id;
            $producto24->save();

            $producto25 = new Producto;
            $producto25->nombre = "Old Fashioned";
            $producto25->descripcion = "Coctel de aperitivo por su amargo Angostura";
            $producto25->receta = "Poner un terrón de azúcar en un vaso ancho y empaparlo de amargo (dos pizcas), añadir soda y remover hasta disolverlo. Llenar el vaso con hielo y añadir whisky. Decorar con una rodaja de naranja y una cereza.";
            $producto25->idCategoria = $categoria18->id;
            $producto25->idEmpresa = $empresa->id;
            $producto25->save();

            $producto26 = new Producto;
            $producto26->nombre = "Paradise";
            $producto26->descripcion = "Para tomar a cualquier hora";
            $producto26->receta = "Verter todos los ingredientes en una coctelera llena de hielo, agitar y colar en vaso de frío de coctel.";
            $producto26->idCategoria = $categoria18->id;
            $producto26->idEmpresa = $empresa->id;
            $producto26->save();

            $producto27 = new Producto;
            $producto27->nombre = "Piña Colada";
            $producto27->receta = "Mezclar todos los ingredientes con hielo en una licuadora, echar en una copa grande, en un vaso tipo Hurricane o en una piña, y servir con pajita. Se suele adornar con una rodaja de piña y con una cereza de coctel.";
            $producto27->idCategoria = $categoria18->id;
            $producto27->idEmpresa = $empresa->id;
            $producto27->save();

            $producto28 = new Producto;
            $producto28->nombre = "Rusty Nail";
            $producto28->descripcion = "Cóctel digestivo";
            $producto28->receta = "Mezclar todo en un vaso ancho lleno de hielo. Remover suavemente y decorar con corteza de limón.";
            $producto28->idCategoria = $categoria18->id;
            $producto28->idEmpresa = $empresa->id;
            $producto28->save();

            $producto29 = new Producto;
            $producto29->nombre = "Screw Driver/Bulldog";
            $producto29->descripcion = "Para cualquier hora del día";
            $producto29->receta = "Echar todos los ingredientes en un vaso largo lleno de hielo. Remover suavemente y decorarlo con una rodaja de naranja. Si en vez de vodka lleva ginebra (preferiblemente Bulldog, se le llama así).";
            $producto29->idCategoria = $categoria18->id;
            $producto29->idEmpresa = $empresa->id;
            $producto29->save();

            $producto30 = new Producto;
            $producto30->nombre = "Sex on the Beach";
            $producto30->receta = "Verter todos los ingredientes en un vaso largo lleno de hielo. Decorar con una rodaja de naranja y una cereza.";
            $producto30->idCategoria = $categoria18->id;
            $producto30->idEmpresa = $empresa->id;
            $producto30->save();

            $producto31 = new Producto;
            $producto31->nombre = "Stinger";
            $producto31->descripcion = "Cóctel digestivo";
            $producto31->receta = "Echar todos los ingredientes en un mezclador con hielo y remover. Verter en un vaso de coctel. El coñac puede ser reemplazado por brandy.";
            $producto31->idCategoria = $categoria18->id;
            $producto31->idEmpresa = $empresa->id;
            $producto31->save();

            $producto32 = new Producto;
            $producto32->nombre = "Tequila Sunrise";
            $producto32->receta = "Echar tequila y zumo de naranja directamente en un vaso largo con hielos y rociar un poco de granadina sin remover para crear un efecto cromático. Decorar con una rodaja de naranja y una cereza.";
            $producto32->idCategoria = $categoria18->id;
            $producto32->idEmpresa = $empresa->id;
            $producto32->save();

            $producto33 = new Producto;
            $producto33->nombre = "Whiskey Sour";
            $producto33->descripcion = "Coctel para beber antes de cenar";
            $producto33->receta = "Echar todos los ingredientes en una coctelera con hielos, agitar bien y colar en vaso de coctel. Si se sirve “On the rocks”, colar los ingredientes en un vaso ancho lleno de hielo. Decorar con media rodaja de naranja y una cereza.";
            $producto33->idCategoria = $categoria18->id;
            $producto33->idEmpresa = $empresa->id;
            $producto33->save();

            $producto34 = new Producto;
            $producto34->nombre = "Blue Hawaii";
            $producto34->receta = "Se mezclan todos los ingredientes en una coctelera con hielo y se agitan bien durante 8 segundos. Adornar la copa con uno naranja o piña y cereza.";
            $producto34->idCategoria = $categoria18->id;
            $producto34->idEmpresa = $empresa->id;
            $producto34->save();

            $producto35 = new Producto;
            $producto35->nombre = "Coco Loco";
            $producto35->receta = "En una batidora mezclamos el tequila, el vodka, el ron, el zumo de limón y la crema de coco. Añadimos el resultado a una copa con el hielo picado y lo decoramos con una cáscara de limón cortada en espiral, puede servirse en una piña, en coco o en copa de coctel.";
            $producto35->idCategoria = $categoria18->id;
            $producto35->idEmpresa = $empresa->id;
            $producto35->save();

            $contiene1 = new Contiene;
            $contiene1->idProducto = $producto1->id;
            $contiene1->idInsumo = $insumo1->id;
            $contiene1->cantidad = 1;
            $contiene1->idEmpresa = $empresa->id;
            $contiene1->save();

            $contiene2 = new Contiene;
            $contiene2->idProducto = $producto1->id;
            $contiene2->idInsumo = $insumo2->id;
            $contiene2->cantidad = 1;
            $contiene2->idEmpresa = $empresa->id;
            $contiene2->save();

            $contiene3 = new Contiene;
            $contiene3->idProducto = $producto1->id;
            $contiene3->idInsumo = $insumo3->id;
            $contiene3->cantidad = 2;
            $contiene3->idEmpresa = $empresa->id;
            $contiene3->save();

            $contiene4 = new Contiene;
            $contiene4->idProducto = $producto2->id;
            $contiene4->idInsumo = $insumo4->id;
            $contiene4->cantidad = 0.68;
            $contiene4->idEmpresa = $empresa->id;
            $contiene4->save();

            $contiene5 = new Contiene;
            $contiene5->idProducto = $producto2->id;
            $contiene5->idInsumo = $insumo5->id;
            $contiene5->cantidad = 0.68;
            $contiene5->idEmpresa = $empresa->id;
            $contiene5->save();

            $contiene6 = new Contiene;
            $contiene6->idProducto = $producto2->id;
            $contiene6->idInsumo = $insumo6->id;
            $contiene6->cantidad = 0.68;
            $contiene6->idEmpresa = $empresa->id;
            $contiene6->save();

            $contiene7 = new Contiene;
            $contiene7->idProducto = $producto3->id;
            $contiene7->idInsumo = $insumo7->id;
            $contiene7->cantidad = 1.5;
            $contiene7->idEmpresa = $empresa->id;
            $contiene7->save();

            $contiene8 = new Contiene;
            $contiene8->idProducto = $producto3->id;
            $contiene8->idInsumo = $insumo8->id;
            $contiene8->cantidad = 0.68;
            $contiene8->idEmpresa = $empresa->id;
            $contiene8->save();

            $contiene9 = new Contiene;
            $contiene9->idProducto = $producto3->id;
            $contiene9->idInsumo = $insumo9->id;
            $contiene9->cantidad = 0.34;
            $contiene9->idEmpresa = $empresa->id;
            $contiene9->save();

            $contiene10 = new Contiene;
            $contiene10->idProducto = $producto4->id;
            $contiene10->idInsumo = $insumo10->id;
            $contiene10->cantidad = 0.34;
            $contiene10->idEmpresa = $empresa->id;
            $contiene10->save();

            $contiene11 = new Contiene;
            $contiene11->idProducto = $producto4->id;
            $contiene11->idInsumo = $insumo11->id;
            $contiene11->cantidad = 0.34;
            $contiene11->idEmpresa = $empresa->id;
            $contiene11->save();

            $contiene12 = new Contiene;
            $contiene12->idProducto = $producto4->id;
            $contiene12->idInsumo = $insumo12->id;
            $contiene12->cantidad = 0.34;
            $contiene12->idEmpresa = $empresa->id;
            $contiene12->save();

            $contiene13 = new Contiene;
            $contiene13->idProducto = $producto4->id;
            $contiene13->idInsumo = $insumo13->id;
            $contiene13->cantidad = 0.34;
            $contiene13->idEmpresa = $empresa->id;
            $contiene13->save();

            $contiene14 = new Contiene;
            $contiene14->idProducto = $producto5->id;
            $contiene14->idInsumo = $insumo14->id;
            $contiene14->cantidad = 1.7;
            $contiene14->idEmpresa = $empresa->id;
            $contiene14->save();

            $contiene15 = new Contiene;
            $contiene15->idProducto = $producto5->id;
            $contiene15->idInsumo = $insumo4->id;
            $contiene15->cantidad = 0.68;
            $contiene15->idEmpresa = $empresa->id;
            $contiene15->save();

            $contiene16 = new Contiene;
            $contiene16->idProducto = $producto6->id;
            $contiene16->idInsumo = $insumo15->id;
            $contiene16->cantidad = 1.7;
            $contiene16->idEmpresa = $empresa->id;
            $contiene16->save();

            $contiene17 = new Contiene;
            $contiene17->idProducto = $producto7->id;
            $contiene17->idInsumo = $insumo16->id;
            $contiene17->cantidad = 1.35;
            $contiene17->idEmpresa = $empresa->id;
            $contiene17->save();

            $contiene18 = new Contiene;
            $contiene18->idProducto = $producto7->id;
            $contiene18->idInsumo = $insumo17->id;
            $contiene18->cantidad = 0.38;
            $contiene18->idEmpresa = $empresa->id;
            $contiene18->save();

            $contiene19 = new Contiene;
            $contiene19->idProducto = $producto7->id;
            $contiene19->idInsumo = $insumo18->id;
            $contiene19->cantidad = 0.38;
            $contiene19->idEmpresa = $empresa->id;
            $contiene19->save();

            $contiene20 = new Contiene;
            $contiene20->idProducto = $producto7->id;
            $contiene20->idInsumo = $insumo19->id;
            $contiene20->cantidad = 0.38;
            $contiene20->idEmpresa = $empresa->id;
            $contiene20->save();

            $contiene21 = new Contiene;
            $contiene21->idProducto = $producto8->id;
            $contiene21->idInsumo = $insumo20->id;
            $contiene21->cantidad = 3;
            $contiene21->idEmpresa = $empresa->id;
            $contiene21->save();

            $contiene22 = new Contiene;
            $contiene22->idProducto = $producto8->id;
            $contiene22->idInsumo = $insumo21->id;
            $contiene22->cantidad = 0.38;
            $contiene22->idEmpresa = $empresa->id;
            $contiene22->save();

            $contiene23 = new Contiene;
            $contiene23->idProducto = $producto9->id;
            $contiene23->idInsumo = $insumo22->id;
            $contiene23->cantidad = 1.35;
            $contiene23->idEmpresa = $empresa->id;
            $contiene23->save();

            $contiene24 = new Contiene;
            $contiene24->idProducto = $producto9->id;
            $contiene24->idInsumo = $insumo23->id;
            $contiene24->cantidad = 0.5;
            $contiene24->idEmpresa = $empresa->id;
            $contiene24->save();

            $contiene25 = new Contiene;
            $contiene25->idProducto = $producto9->id;
            $contiene25->idInsumo = $insumo24->id;
            $contiene25->cantidad = 0.5;
            $contiene25->idEmpresa = $empresa->id;
            $contiene25->save();

            $contiene26 = new Contiene;
            $contiene26->idProducto = $producto9->id;
            $contiene26->idInsumo = $insumo25->id;
            $contiene26->cantidad = 1;
            $contiene26->idEmpresa = $empresa->id;
            $contiene26->save();

            $contiene27 = new Contiene;
            $contiene27->idProducto = $producto10->id;
            $contiene27->idInsumo = $insumo26->id;
            $contiene27->cantidad = 1.7;
            $contiene27->idEmpresa = $empresa->id;
            $contiene27->save();

            $contiene28 = new Contiene;
            $contiene28->idProducto = $producto10->id;
            $contiene28->idInsumo = $insumo27->id;
            $contiene28->cantidad = 4;
            $contiene28->idEmpresa = $empresa->id;
            $contiene28->save();

            $contiene29 = new Contiene;
            $contiene29->idProducto = $producto10->id;
            $contiene29->idInsumo = $insumo28->id;
            $contiene29->cantidad = 0.38;
            $contiene29->idEmpresa = $empresa->id;
            $contiene29->save();

            $contiene30 = new Contiene;
            $contiene30->idProducto = $producto11->id;
            $contiene30->idInsumo = $insumo26->id;
            $contiene30->cantidad = 1.5;
            $contiene30->idEmpresa = $empresa->id;
            $contiene30->save();

            $contiene31 = new Contiene;
            $contiene31->idProducto = $producto11->id;
            $contiene31->idInsumo = $insumo24->id;
            $contiene31->cantidad = 0.8;
            $contiene31->idEmpresa = $empresa->id;
            $contiene31->save();

            $contiene32 = new Contiene;
            $contiene32->idProducto = $producto11->id;
            $contiene32->idInsumo = $insumo29->id;
            $contiene32->cantidad = 0.5;
            $contiene32->idEmpresa = $empresa->id;
            $contiene32->save();

            $contiene33 = new Contiene;
            $contiene33->idProducto = $producto12->id;
            $contiene33->idInsumo = $insumo30->id;
            $contiene33->cantidad = 2;
            $contiene33->idEmpresa = $empresa->id;
            $contiene33->save();

            $contiene34 = new Contiene;
            $contiene34->idProducto = $producto12->id;
            $contiene34->idInsumo = $insumo31->id;
            $contiene34->cantidad = 0.38;
            $contiene34->idEmpresa = $empresa->id;
            $contiene34->save();

            $contiene35 = new Contiene;
            $contiene35->idProducto = $producto13->id;
            $contiene35->idInsumo = $insumo30->id;
            $contiene35->cantidad = 1.5;
            $contiene35->idEmpresa = $empresa->id;
            $contiene35->save();

            $contiene36 = new Contiene;
            $contiene36->idProducto = $producto13->id;
            $contiene36->idInsumo = $insumo32->id;
            $contiene36->cantidad = 4.5;
            $contiene36->idEmpresa = $empresa->id;
            $contiene36->save();

            $contiene37 = new Contiene;
            $contiene37->idProducto = $producto14->id;
            $contiene37->idInsumo = $insumo33->id;
            $contiene37->cantidad = 1.2;
            $contiene37->idEmpresa = $empresa->id;
            $contiene37->save();

            $contiene38 = new Contiene;
            $contiene38->idProducto = $producto14->id;
            $contiene38->idInsumo = $insumo34->id;
            $contiene38->cantidad = 1.2;
            $contiene38->idEmpresa = $empresa->id;
            $contiene38->save();

            $contiene39 = new Contiene;
            $contiene39->idProducto = $producto15->id;
            $contiene39->idInsumo = $insumo35->id;
            $contiene39->cantidad = 1;
            $contiene39->idEmpresa = $empresa->id;
            $contiene39->save();

            $contiene40 = new Contiene;
            $contiene40->idProducto = $producto15->id;
            $contiene40->idInsumo = $insumo36->id;
            $contiene40->cantidad = 1;
            $contiene40->idEmpresa = $empresa->id;
            $contiene40->save();

            $contiene41 = new Contiene;
            $contiene41->idProducto = $producto15->id;
            $contiene41->idInsumo = $insumo37->id;
            $contiene41->cantidad = 1;
            $contiene41->idEmpresa = $empresa->id;
            $contiene41->save();

            $contiene42 = new Contiene;
            $contiene42->idProducto = $producto16->id;
            $contiene42->idInsumo = $insumo14->id;
            $contiene42->cantidad = 1.5;
            $contiene42->idEmpresa = $empresa->id;
            $contiene42->save();

            $contiene43 = new Contiene;
            $contiene43->idProducto = $producto16->id;
            $contiene43->idInsumo = $insumo38->id;
            $contiene43->cantidad = 0.5;
            $contiene43->idEmpresa = $empresa->id;
            $contiene43->save();

            $contiene44 = new Contiene;
            $contiene44->idProducto = $producto16->id;
            $contiene44->idInsumo = $insumo39->id;
            $contiene44->cantidad = 3;
            $contiene44->idEmpresa = $empresa->id;
            $contiene44->save();

            $contiene45 = new Contiene;
            $contiene45->idProducto = $producto17->id;
            $contiene45->idInsumo = $insumo30->id;
            $contiene45->cantidad = 1.5;
            $contiene45->idEmpresa = $empresa->id;
            $contiene45->save();

            $contiene46 = new Contiene;
            $contiene46->idProducto = $producto17->id;
            $contiene46->idInsumo = $insumo13->id;
            $contiene46->cantidad = 1;
            $contiene46->idEmpresa = $empresa->id;
            $contiene46->save();

            $contiene47 = new Contiene;
            $contiene47->idProducto = $producto17->id;
            $contiene47->idInsumo = $insumo40->id;
            $contiene47->cantidad = 0.5;
            $contiene47->idEmpresa = $empresa->id;
            $contiene47->save();

            $contiene48 = new Contiene;
            $contiene48->idProducto = $producto17->id;
            $contiene48->idInsumo = $insumo41->id;
            $contiene48->cantidad = 2;
            $contiene48->idEmpresa = $empresa->id;
            $contiene48->save();

            $contiene49 = new Contiene;
            $contiene49->idProducto = $producto18->id;
            $contiene49->idInsumo = $insumo42->id;
            $contiene49->cantidad = 0.5;
            $contiene49->idEmpresa = $empresa->id;
            $contiene49->save();

            $contiene50 = new Contiene;
            $contiene50->idProducto = $producto18->id;
            $contiene50->idInsumo = $insumo14->id;
            $contiene50->cantidad = 0.5;
            $contiene50->idEmpresa = $empresa->id;
            $contiene50->save();

            $contiene51 = new Contiene;
            $contiene51->idProducto = $producto18->id;
            $contiene51->idInsumo = $insumo10->id;
            $contiene51->cantidad = 0.5;
            $contiene51->idEmpresa = $empresa->id;
            $contiene51->save();

            $contiene52 = new Contiene;
            $contiene52->idProducto = $producto18->id;
            $contiene52->idInsumo = $insumo12->id;
            $contiene52->cantidad = 0.5;
            $contiene52->idEmpresa = $empresa->id;
            $contiene52->save();

            $contiene53 = new Contiene;
            $contiene53->idProducto = $producto18->id;
            $contiene53->idInsumo = $insumo30->id;
            $contiene53->cantidad = 0.5;
            $contiene53->idEmpresa = $empresa->id;
            $contiene53->save();

            $contiene54 = new Contiene;
            $contiene54->idProducto = $producto18->id;
            $contiene54->idInsumo = $insumo13->id;
            $contiene54->cantidad = 0.8;
            $contiene54->idEmpresa = $empresa->id;
            $contiene54->save();

            $contiene55 = new Contiene;
            $contiene55->idProducto = $producto18->id;
            $contiene55->idInsumo = $insumo40->id;
            $contiene55->cantidad = 1;
            $contiene55->idEmpresa = $empresa->id;
            $contiene55->save();

            $contiene56 = new Contiene;
            $contiene56->idProducto = $producto19->id;
            $contiene56->idInsumo = $insumo10->id;
            $contiene56->cantidad = 1.35;
            $contiene56->idEmpresa = $empresa->id;
            $contiene56->save();

            $contiene57 = new Contiene;
            $contiene57->idProducto = $producto19->id;
            $contiene57->idInsumo = $insumo43->id;
            $contiene57->cantidad = 0.6;
            $contiene57->idEmpresa = $empresa->id;
            $contiene57->save();

            $contiene58 = new Contiene;
            $contiene58->idProducto = $producto19->id;
            $contiene58->idInsumo = $insumo44->id;
            $contiene58->cantidad = 0.5;
            $contiene58->idEmpresa = $empresa->id;
            $contiene58->save();

            $contiene59 = new Contiene;
            $contiene59->idProducto = $producto19->id;
            $contiene59->idInsumo = $insumo40->id;
            $contiene59->cantidad = 0.5;
            $contiene59->idEmpresa = $empresa->id;
            $contiene59->save();

            $contiene60 = new Contiene;
            $contiene60->idProducto = $producto19->id;
            $contiene60->idInsumo = $insumo8->id;
            $contiene60->cantidad = 0.17;
            $contiene60->idEmpresa = $empresa->id;
            $contiene60->save();

            $contiene61 = new Contiene;
            $contiene61->idProducto = $producto19->id;
            $contiene61->idInsumo = $insumo9->id;
            $contiene61->cantidad = 17;
            $contiene61->idEmpresa = $empresa->id;
            $contiene61->save();

            $contiene62 = new Contiene;
            $contiene62->idProducto = $producto20->id;
            $contiene62->idInsumo = $insumo45->id;
            $contiene62->cantidad = 1.7;
            $contiene62->idEmpresa = $empresa->id;
            $contiene62->save();

            $contiene63 = new Contiene;
            $contiene63->idProducto = $producto20->id;
            $contiene63->idInsumo = $insumo46->id;
            $contiene63->cantidad = 0.6;
            $contiene63->idEmpresa = $empresa->id;
            $contiene63->save();

            $contiene64 = new Contiene;
            $contiene64->idProducto = $producto21->id;
            $contiene64->idInsumo = $insumo42->id;
            $contiene64->cantidad = 1.2;
            $contiene64->idEmpresa = $empresa->id;
            $contiene64->save();

            $contiene65 = new Contiene;
            $contiene65->idProducto = $producto21->id;
            $contiene65->idInsumo = $insumo23->id;
            $contiene65->cantidad = 0.6;
            $contiene65->idEmpresa = $empresa->id;
            $contiene65->save();

            $contiene66 = new Contiene;
            $contiene66->idProducto = $producto21->id;
            $contiene66->idInsumo = $insumo8->id;
            $contiene66->cantidad = 0.5;
            $contiene66->idEmpresa = $empresa->id;
            $contiene66->save();

            $contiene67 = new Contiene;
            $contiene67->idProducto = $producto22->id;
            $contiene67->idInsumo = $insumo45->id;
            $contiene67->cantidad = 2;
            $contiene67->idEmpresa = $empresa->id;
            $contiene67->save();

            $contiene68 = new Contiene;
            $contiene68->idProducto = $producto22->id;
            $contiene68->idInsumo = $insumo47->id;
            $contiene68->cantidad = 4;
            $contiene68->idEmpresa = $empresa->id;
            $contiene68->save();

            $contiene69 = new Contiene;
            $contiene69->idProducto = $producto23->id;
            $contiene69->idInsumo = $insumo26->id;
            $contiene69->cantidad = 1.35;
            $contiene69->idEmpresa = $empresa->id;
            $contiene69->save();

            $contiene70 = new Contiene;
            $contiene70->idProducto = $producto23->id;
            $contiene70->idInsumo = $insumo28->id;
            $contiene70->cantidad = 1;
            $contiene70->idEmpresa = $empresa->id;
            $contiene70->save();

            $contiene71 = new Contiene;
            $contiene71->idProducto = $producto23->id;
            $contiene71->idInsumo = $insumo47->id;
            $contiene71->cantidad = 2;
            $contiene71->idEmpresa = $empresa->id;
            $contiene71->save();

            $contiene72 = new Contiene;
            $contiene72->idProducto = $producto24->id;
            $contiene72->idInsumo = $insumo30->id;
            $contiene72->cantidad = 1;
            $contiene72->idEmpresa = $empresa->id;
            $contiene72->save();

            $contiene73 = new Contiene;
            $contiene73->idProducto = $producto24->id;
            $contiene73->idInsumo = $insumo48->id;
            $contiene73->cantidad = 1;
            $contiene73->idEmpresa = $empresa->id;
            $contiene73->save();

            $contiene74 = new Contiene;
            $contiene74->idProducto = $producto24->id;
            $contiene74->idInsumo = $insumo46->id;
            $contiene74->cantidad = 1;
            $contiene74->idEmpresa = $empresa->id;
            $contiene74->save();

            $contiene75 = new Contiene;
            $contiene75->idProducto = $producto25->id;
            $contiene75->idInsumo = $insumo45->id;
            $contiene75->cantidad = 1.5;
            $contiene75->idEmpresa = $empresa->id;
            $contiene75->save();

            $contiene76 = new Contiene;
            $contiene76->idProducto = $producto26->id;
            $contiene76->idInsumo = $insumo30->id;
            $contiene76->cantidad = 1.2;
            $contiene76->idEmpresa = $empresa->id;
            $contiene76->save();

            $contiene77 = new Contiene;
            $contiene77->idProducto = $producto26->id;
            $contiene77->idInsumo = $insumo1->id;
            $contiene77->cantidad = 0.6;
            $contiene77->idEmpresa = $empresa->id;
            $contiene77->save();

            $contiene78 = new Contiene;
            $contiene78->idProducto = $producto26->id;
            $contiene78->idInsumo = $insumo49->id;
            $contiene78->cantidad = 0.5;
            $contiene78->idEmpresa = $empresa->id;
            $contiene78->save();

            $contiene79 = new Contiene;
            $contiene79->idProducto = $producto27->id;
            $contiene79->idInsumo = $insumo50->id;
            $contiene79->cantidad = 1;
            $contiene79->idEmpresa = $empresa->id;
            $contiene79->save();

            $contiene80 = new Contiene;
            $contiene80->idProducto = $producto27->id;
            $contiene80->idInsumo = $insumo51->id;
            $contiene80->cantidad = 3;
            $contiene80->idEmpresa = $empresa->id;
            $contiene80->save();

            $contiene81 = new Contiene;
            $contiene81->idProducto = $producto27->id;
            $contiene81->idInsumo = $insumo10->id;
            $contiene81->cantidad = 1;
            $contiene81->idEmpresa = $empresa->id;
            $contiene81->save();

            $contiene82 = new Contiene;
            $contiene82->idProducto = $producto28->id;
            $contiene82->idInsumo = $insumo45->id;
            $contiene82->cantidad = 1.5;
            $contiene82->idEmpresa = $empresa->id;
            $contiene82->save();

            $contiene83 = new Contiene;
            $contiene83->idProducto = $producto28->id;
            $contiene83->idInsumo = $insumo52->id;
            $contiene83->cantidad = 0.8;
            $contiene83->idEmpresa = $empresa->id;
            $contiene83->save();

            $contiene84 = new Contiene;
            $contiene84->idProducto = $producto29->id;
            $contiene84->idInsumo = $insumo14->id;
            $contiene84->cantidad = 1.7;
            $contiene84->idEmpresa = $empresa->id;
            $contiene84->save();

            $contiene85 = new Contiene;
            $contiene85->idProducto = $producto29->id;
            $contiene85->idInsumo = $insumo39->id;
            $contiene85->cantidad = 3.4;
            $contiene85->idEmpresa = $empresa->id;
            $contiene85->save();

            $contiene86 = new Contiene;
            $contiene86->idProducto = $producto30->id;
            $contiene86->idInsumo = $insumo14->id;
            $contiene86->cantidad = 1.35;
            $contiene86->idEmpresa = $empresa->id;
            $contiene86->save();

            $contiene87 = new Contiene;
            $contiene87->idProducto = $producto30->id;
            $contiene87->idInsumo = $insumo53->id;
            $contiene87->cantidad = 0.6;
            $contiene87->idEmpresa = $empresa->id;
            $contiene87->save();

            $contiene88 = new Contiene;
            $contiene88->idProducto = $producto30->id;
            $contiene88->idInsumo = $insumo54->id;
            $contiene88->cantidad = 1.35;
            $contiene88->idEmpresa = $empresa->id;
            $contiene88->save();

            $contiene89 = new Contiene;
            $contiene89->idProducto = $producto30->id;
            $contiene89->idInsumo = $insumo49->id;
            $contiene89->cantidad = 1.35;
            $contiene89->idEmpresa = $empresa->id;
            $contiene89->save();

            $contiene90 = new Contiene;
            $contiene90->idProducto = $producto31->id;
            $contiene90->idInsumo = $insumo11->id;
            $contiene90->cantidad = 1.7;
            $contiene90->idEmpresa = $empresa->id;
            $contiene90->save();

            $contiene91 = new Contiene;
            $contiene91->idProducto = $producto31->id;
            $contiene91->idInsumo = $insumo36->id;
            $contiene91->cantidad = 0.6;
            $contiene91->idEmpresa = $empresa->id;
            $contiene91->save();

            $contiene92 = new Contiene;
            $contiene92->idProducto = $producto32->id;
            $contiene92->idInsumo = $insumo42->id;
            $contiene92->cantidad = 1.5;
            $contiene92->idEmpresa = $empresa->id;
            $contiene92->save();

            $contiene93 = new Contiene;
            $contiene93->idProducto = $producto32->id;
            $contiene93->idInsumo = $insumo49->id;
            $contiene93->cantidad = 3;
            $contiene93->idEmpresa = $empresa->id;
            $contiene93->save();

            $contiene94 = new Contiene;
            $contiene94->idProducto = $producto32->id;
            $contiene94->idInsumo = $insumo9->id;
            $contiene94->cantidad = 0.5;
            $contiene94->idEmpresa = $empresa->id;
            $contiene94->save();

            $contiene95 = new Contiene;
            $contiene95->idProducto = $producto33->id;
            $contiene95->idInsumo = $insumo45->id;
            $contiene95->cantidad = 1.5;
            $contiene95->idEmpresa = $empresa->id;
            $contiene95->save();

            $contiene96 = new Contiene;
            $contiene96->idProducto = $producto33->id;
            $contiene96->idInsumo = $insumo19->id;
            $contiene96->cantidad = 1;
            $contiene96->idEmpresa = $empresa->id;
            $contiene96->save();

            $contiene97 = new Contiene;
            $contiene97->idProducto = $producto33->id;
            $contiene97->idInsumo = $insumo40->id;
            $contiene97->cantidad = 0.5;
            $contiene97->idEmpresa = $empresa->id;
            $contiene97->save();

            $contiene98 = new Contiene;
            $contiene98->idProducto = $producto34->id;
            $contiene98->idInsumo = $insumo55->id;
            $contiene98->cantidad = 2;
            $contiene98->idEmpresa = $empresa->id;
            $contiene98->save();

            $contiene99 = new Contiene;
            $contiene99->idProducto = $producto34->id;
            $contiene99->idInsumo = $insumo56->id;
            $contiene99->cantidad = 1;
            $contiene99->idEmpresa = $empresa->id;
            $contiene99->save();

            $contiene100 = new Contiene;
            $contiene100->idProducto = $producto34->id;
            $contiene100->idInsumo = $insumo49->id;
            $contiene100->cantidad = 1;
            $contiene100->idEmpresa = $empresa->id;
            $contiene100->save();

            $contiene101 = new Contiene;
            $contiene101->idProducto = $producto34->id;
            $contiene101->idInsumo = $insumo50->id;
            $contiene101->cantidad = 2;
            $contiene101->idEmpresa = $empresa->id;
            $contiene101->save();

            $contiene102 = new Contiene;
            $contiene102->idProducto = $producto35->id;
            $contiene102->idInsumo = $insumo14->id;
            $contiene102->cantidad = 4;
            $contiene102->idEmpresa = $empresa->id;
            $contiene102->save();

            $contiene103 = new Contiene;
            $contiene103->idProducto = $producto35->id;
            $contiene103->idInsumo = $insumo42->id;
            $contiene103->cantidad = 0.6;
            $contiene103->idEmpresa = $empresa->id;
            $contiene103->save();

            $contiene104 = new Contiene;
            $contiene104->idProducto = $producto35->id;
            $contiene104->idInsumo = $insumo10->id;
            $contiene104->cantidad = 0.6;
            $contiene104->idEmpresa = $empresa->id;
            $contiene104->save();

            $contiene105 = new Contiene;
            $contiene105->idProducto = $producto35->id;
            $contiene105->idInsumo = $insumo19->id;
            $contiene105->cantidad = 1.7;
            $contiene105->idEmpresa = $empresa->id;
            $contiene105->save();

            $contiene106 = new Contiene;
            $contiene106->idProducto = $producto35->id;
            $contiene106->idInsumo = $insumo57->id;
            $contiene106->cantidad = 0.8;
            $contiene106->idEmpresa = $empresa->id;
            $contiene106->save();

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
                    'email' => $request->email,
                    'password' => $request->password,
                    'confirmoEmail' => 1,
                    'estado' => true
                ]
                , $request->has('remember')
                )){
            Auth::User()->inicioSesion();// función que se llama para que guarde un nuevo registro en la tabla de registro de inicio y cierre de sesión
            return redirect()->intended($this->redirectPath());
        }if (Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                    'confirmoEmail' => 0
                ], $request->has('remember'))){
            return $this->volverLogin('Por favor activa tu cuenta primero');
        }
        if(Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                    'estado' => false
                ], $request->has('remember'))){
            return $this->volverLogin('Ha sido desactivado, por favor contacte con el administrador');
        }else{
            $rules = [
                'email' => 'email',
                'password' => 'required',
            ];
            $messages = [
                'email.required' => 'El campo Email es requerido',
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
