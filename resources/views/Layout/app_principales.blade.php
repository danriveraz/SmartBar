<!doctype html>
<html lang="es">
<head>
<!-- Etiquetas meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="HTML5"> 
  <meta name="application-name" content="PocketSmartbar"/>
  <meta name="author" content="Pocket Company S.A.S"/>
  <meta name="description" content="Aplicativo inteligente online, escencial en Bares, Discotecas y/o Restaurantes, que facilita enormemente el trabajo  de administradores, empleados, proveedores y clientes de estos." />
  <meta name="generator" content="Html5 Css Javascrip" />
  <meta name="keywords" content="Compañero inseparable, sistema inteligente de manejo de negocios, bares, restaurantes, discotecas, licores, comidas, cocteles, información almacenada en la nube, sistema pos, sitema pos para restaurantes, software para restaurante, software POS para restaurante, sistema de punto de ventas, sistema de facturación, software de inventario, software para punto de ventas, software POS, sistema POS, Colombia, POS online" />
  <meta name="encoding" charset="utf-8" />    
<!-- Datos Open Graph -->
  <meta property="og:title" content="PocketSmartbar" />
  <meta property="og:type" content="WebSite" />
  <meta property="og:url" content="http://www.pocketsmartbar.com" />
  <meta property="og:description" content="Aplicativo inteligente online, escencial en Bares, Discotecas y/o Restaurantes, que facilita enormemente el trabajo  de administradores, empleados, proveedores y clientes de estos.">
  <meta property="og:site_name" content="PocketSmartBar">
  <meta property="og:image" content="assets-home/images/p"><!--poner link de la imagen--!>
  <!-- Datos Twitter Card --> 
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@pocketsmartbar">
  <meta name="twitter:creator" content="@pocketsmartbar" />
<!-- Etiquetas meta -->
  <title>PocketSmartBar</title>
  <link type="image/x-icon" rel="shortcut icon" href="assets-home/images/icon.png"/>        
<!-- Datos meta Graph --> 
  
<!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
<!--Fuente Requerida -->
{!!Html::style('assets-home\styles\pocketStyle.css')!!}
{!!Html::style('assets-home\styles\style-Contact.css')!!}
{!!Html::style('assets-home\styles\custom-Pocket.css')!!}
<!-- GRT Youtube Plugin para video CSS -->
{!!Html::style('assets-home\styles\video\grt-youtube-popup.css')!!}
<!-- Font Awsome
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<!-- style para login -->
{!!Html::style('assets-home\styles\main.css')!!}<!--style para login-->
{!!Html::style('assets-home\styles\font-awesome.css')!!}<!-- Iconos Ex -->    
<!--javascript para campo de contraseña/-->
{!!Html::script("assets-home\scripts\jquery-1.12.4.min.js")!!}
{!!Html::script("assets-home\scripts\main.js")!!}
<!--style para desplege lateral-->
{!!Html::style('assets-home\styles\pure-drawer.css')!!}
  
  </head>
<body>
<!--INICIO DE TAB-->  
<div class="pure-container" data-effect="pure-effect-slide">  
   <input type="checkbox" id="pure-toggle-right" class="pure-toggle" data-toggle="right"/>  
<header class="block no-pad" data-name="Topbar" id="topbar-main">
  <div id="" class="topbar fixed bg-solid">
      <div class="topbar-content is-centered">
        <div class="topbar-section">
          <div id="nav-toggle" class="nav-toggle">
            <a>&#9776;</a>
          </div>
          <div class="logo">
           <a href="{{ url('/') }}"><img width="240" height="50" src="{{asset('assets-home/images/logoPrin.png')}}"></a>
          </div>
        </div>
        <div class="topbar-section">
    <nav id="nav-main" class="nav">
            <a class="nav-item " href="{{ url('AmigoInseparable') }}">¿Por qué somos tu amigo inseparable?</a>
            <a class="nav-item " href="{{ url('PocketClub') }}">PocketClub</a>
            <div id="nav-toggle-close" class="nav-toggle-close">
              <a>X</a>
            </div>
          </nav>
          <div class="nav-access">
            <label class="" for="pure-toggle-right" data-toggle-label="right">
              <a class="nav-access-item button outline rounded-mediun">
          <input type="checkbox" id="pure-toggle-right" class="pure-toggle" data-toggle="right"/>     
        <span class="">INGRESAR</span>
        </a>
      </label> 
          </div>
        </div>
      </div>
  </div>
</header>
<!-- Fin Menu Principal -->

<!-- inicio de contenigo de login-->
    <nav class="pure-drawer" data-position="right" style="overflow: auto">
    <section class="tabblue"> 
    <ul class="tabs blue">
    <!-- Inicio del Tag #1-->
          <li>
            <input type="radio" name="tabs blue" id="tab1" checked />
            <label class="label" for="tab1">Iniciar Sesión</label>
            <div id="tab-content1" class="tab-content">              
    <div class="login-form-content">
      <div class="login-form-header">
        <div class="logo">
          <img src="{{asset('assets-home/images/logoPrin.png')}}"/>
        </div>
        <h3>Bienvenido! Tu amigo inseparable te espera </h3>
      </div>
      <form method="post" action="" class="login-form">
        <div class="input-container">
          <i class="fa fa-envelope"></i>
          <input type="email" class="input" name="email" placeholder="Email"/>
        </div>
        <div class="input-container">
          <i class="fa fa-lock"></i>
          <input type="password"  id="login-password" class="input" name="password" placeholder="Contraseña"/>
          <i id="show-password" class="fa fa-eye"></i>
        </div>
        <div class="rememberme-container">
          <input type="checkbox" name="rememberme" id="rememberme"/>
          <label for="rememberme" class="rememberme"><span>Recuérdame</span></label>
          <a class="forgot-password" href="{{ url('Auth/resetpassword') }}">Se te olvidó tu contraseña?</a>
        </div>
        <input type="submit" name="login" value="Iniciar Sesión" class="button"/>
        <!--a href="#" class="register">Register</a-->
      </form>
      <div class="separator">
          <span class="separator-text">OR</span>
      </div>
      <div class="socmed-login">
        <a href="#g-plus" class="socmed-btn google-btn">
          <i style="color: white;padding: 0px;" class="fa fa-google"></i>
          <span>Iniciar Sesión con Google</span>
        </a>
      </div>
    </div>        
            </div>
          </li>
    <!-- Inicio del Tag #2-->
          <li>
            <input type="radio" name="tabs blue" id="tab2" />
            <label class="label" for="tab2">Registro</label>
            <div id="tab-content2" class="tab-content">
        <!-- registro-->
        <div class="login-form-content">
          <div class="login-form-header">
            <div class="logo">
              <img src="{{asset('assets-home/images/logoPrin.png')}}"/>
            </div>
            <h3>Bienvenido! Tu amigo inseparable te espera </h3>            
          </div>
        <form method="post" action="" class="login-form">
        <div class="input-container">
          <i class="fa fa-reorder"></i>
          <input type="text" class="input" name="negocio" placeholder="Nombre de tu Negocio"/>
        </div>
        <div class="input-container">
          <i class="fa fa-address-card"></i>
          <input type="text" class="input" name="nombre" placeholder="Nombre"/>
        </div>
        <div class="input-container">
          <i class="fa fa-venus-mars"></i>          
        <select class="select" id="sexo" name="sexo" required="">
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
          <option value="Otro">Otro</option>
        </select>
        </div>
        <div class="input-container">
          <i class="fa fa-envelope"></i>
          <input type="email" class="input" name="email" placeholder="Email" requerid/>
        </div>
        <div class="input-container">
          <i class="fa fa-lock"></i>
          <input type="password"  id="login-password1" class="input" name="password" placeholder="Contraseña"/>
          <i id="show-password1" class="fa fa-eye"></i>
        </div>
        <div class="input-container" style="float: left; width:49%">
          <i class="fa fa-map-marker"></i>          
        <select class="selectCi" id="departamento" name="departamento" required="">
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
          <option value="Otro">Otro</option>
        </select>
        </div>
        <div class="input-container" style="float: left; width:49%">
          <i class="fa fa-map-marker"></i>          
        <select class="selectCi" id="ciudad" name="ciudad" required="">
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
          <option value="Otro">Otro</option>
        </select>
        </div>      
        <input type="submit" name="login" value="Registrarme" class="button"/>
        <!--a href="#" class="register">Register</a-->          
      </form>
      <div class="terms">
        Al crear tu cuenta aceptas nuestros
        <a class="pocketColor" href="" target="_blank">Términos, Condiciones</a> y 
        <a class="pocketColor"href="" target="_blank">Política de Tratamiento de Datos</a>.
      </div>
      <div class="separator">
          <span class="separator-text">O</span>
      </div>
      <div class="socmed-login">
        <a href="#g-plus" class="socmed-btn google-btn">
          <i style="color: white;padding: 0px;" class="fa fa-google"></i>
          <span>Registrar con Google</span>
        </a>
      </div>
            </div><!--  fin de login-form-content-->
        </div> <!-- tab-content2-->
          </li>
    <!-- Inicio del Tag #3-->
    <li>
            <input type="radio" name="tabs"/>
            <label class="label1" for="pure-toggle-right"><i style="color: white;padding: 0px;" class="fa fa-window-close"></i></label>
    </li>     
  </ul>
  </section>      
  </nav>  
<!-- fin de contenido de login--> 

<!-- FIN LAYOUT -->
      <div class="">
        @yield('content')
      </div>

<!-- Menu -->
<!--CONTINUACIÓN LAYOUT -->   
 <footer>
   <div>        
     <div class="pocketPadin block-content text-center">
        <ul class="list-inline">                                 
           <li><a href="#"><i class="fa fa-facebook fa-2x"></i></a></li>                                   
           <li><a href="#"><i class="fa fa-twitter fa-2x"></i></a></li>                                  
           <li><a href="#"><i class="fa fa-instagram fa-2x"></i></a></li>                                   
           <li><a href="#"><i class="fa fa-youtube fa-2x"></i></a></li>                                   
           <li><a href="#"><i class="fa fa-google-play fa-2x"></i></a></li>                                
         </ul>
      </div>                 
      <div class="pocketPadin block-content text-center">   
         <ul class="menu list-inline">                               
          <li><a href="#">Cliente VIP</a></li>                                   
          <li><a href="#">SmartShop</a></li>
          <li><a href="{{ url('preguntasFrecuentes') }}">Preguntas Frecuentes</a></li>                                   
          <li><a href="{{ url('politicas') }}">Politicas Privacidad</a></li>
          <li><a href="{{ url('contactos') }}">Contáctos</a></li>             
         </ul>
       </div>          
    </div> 
</footer> 
<!-- Copyright PocketSmartBar -->
<div class="block bg-pocket">
  <div class="pocketPadin block-content text-center" >
      <p style="color: white; font-weight: 400;">COPYRIGHT © 2018 Pocket Company S.A.S</p>
  </div>
</div>  
  
</div><!--pure-container-->
<!-- SCRIPTS video pocket-->  
<!--Jquery-->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- GRT Youtube Popup-->
  <script src="assets-home/scripts/video/grt-youtube-popup.js"></script> 
<!-- Initialize GRT Youtube Popup plugin -->
  <script>
    // Demo video 1
    $(".youtube-link").grtyoutube({
      autoPlay:true,
      theme: "dark"
    });
  </script>
<!-- SCRIPTS header-->
<script src="assets-home/scripts/pocket.js" type="text/javascript" async></script>
<script>
    // Topbar background
    window.onscroll = function() {
      var topBar = document.getElementById('topbar-main');

      if ( window.pageYOffset >= 50 ) {
          topBar.classList.add("bg-solid");
      } else {
          topBar.classList.remove("bg-solid");
      }
    };  

</script>
  
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '15d63f5166d34952519b49507e22c761deb5e5b2';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script> 
  
</body>
</html>
