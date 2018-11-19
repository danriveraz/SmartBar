<!doctype html>
<html lang="es">
<head>
  <script>
    if (location.protocol != 'https:'){
     location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    }
  </script>
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
{!!Html::style('assets-home\styles\normalize.css')!!}

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
           <a href="{{ url('/') }}"><img src="{{asset('assets-home/images/logoPrin.png')}}"></a>
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
    <ul class="tabs blue" style="background-color: #f8f8f8">
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
      @if (Session::has('message'))
        {{Session::get('message')}}
      @endif
      <!-- LOGIN -->
      <form autocomplete="on" method="post" action="{{url('Auth/login')}}" class="login-form">
        {{ csrf_field() }}
        <div class="input-container">
          <i class="fa fa-envelope"></i>
          <input type="email" name="emailInicio" id="emailInicio" value="{{Input::old('email')}}" class="input" placeholder="E-mail" required>
        </div>
        <div class="input-container">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" id="login-password" value="" class="input" placeholder="Contraseña" required>
          <i id="show-password" class="fa fa-eye"></i>
        </div>
        <div class="rememberme-container">
          <label class="chekPocket">Recordar
            <input type="checkbox" checked="checked">
            <span class="checkmark"></span>
          </label>
          <a class="forgot-password" href="{{ url('Auth/resetpassword') }}">Olvide mi contraseña?</a>
        </div>
        <input type="submit" name="login" value="Iniciar Sesión" class="button"/>
        <!--a href="#" class="register">Register</a-->
      </form>
      <!-- END LOGIN -->
      <div class="separator"></div>
    <!--<div class="socmed-login">
        <a href="{{url('Auth/Google')}}" class="socmed-btn google-btn">
          <i style="color: white;padding: 0px;" class="fa fa-google"></i>
          <span style="font-weight:400;">Iniciar Sesión con Google</span>
        </a>
      </div>-->
      <div style="text-align: center !important;">
      <h4 style="font-size: 17px;"> Si no tienes cuenta <br> Registrate y se parte de nuesta comunidad</h4>
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
          <form class="login-form" autocomplete="off" role="form" method="POST" enctype="multipart/form-data" action="{{ url('Auth/register') }}" files="true">
        {{ csrf_field() }}
        <div class="text-danger">
           @if (Session::has('message'))
             {{Session::get('message')}}
           @endif
         </div>
         <div class="input-container">
           <i class="fa fa-address-book"></i>
           <select class="select" id="tipo"  name="tipo" value="" required>
             <option value="dueno">Dueño de Negocio</option>
             <!-- ocultado para actualizacion
             <option value="proveedor">Proveedor</option>
             <option value="cliente">Cliente VIP</option>
              ocultado para actualizacion-->
           </select>
         </div>
         <div class="input-container" id="NomNeg" style="display:block;">
           <i class="fa fa-reorder"></i>
           <input type="text" class="input" id="nombreEstablecimiento" name="nombreEstablecimiento" placeholder="Nombre de tu Negocio" value="{{ old('nombreEstablecimiento') }}" required/>
         </div>
         <div class="input-container" id="TipNeg">
           <i class="fa fa-reorder"></i>
           <select class="select" id="TipoNegocio"  name="TipoNegocio" required>
           <option >Tipo De Negocio</option>
           <option value="bar">Bar</option>
           <!--<option value="restaurante">Restaurante</option>
           <option value="barRestaurante">Bar y Restaurante</option>-->
           </select>
         </div>
          <div class="input-container">
            <i class="fa fa-address-card"></i>
            <input type="text" class="input" name="nombrePersona" placeholder="Nombre Propietario" required/>
          </div>
          <div class="input-container">
            <i class="fa fa-venus-mars"></i>
            <select class="select" id="sexo" name="sexo" required="">
              <option value="">Sexo</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="input-container">
            <i class="fa fa-envelope"></i>
            <input type="email" class="input" id="email" name="email" placeholder="Email" requerid/>
          </div>
          <div class="input-container">
            <i class="fa fa-lock"></i>
            <input type="password"  id="login-password1" class="input" name="password" placeholder="Contraseña"/>
            <i id="show-password1" class="fa fa-eye"></i>
          </div>
          <div class="input-container" style="float: left; width:49%">
            <i class="fa fa-map-marker"></i>
            <select class="selectCi" id="idDepto"  name="idDepto" required>
              <option value="">Departamento</option>
              @foreach($departamentos as $departamento)
                  <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="input-container" style="float: left; width:49%">
            <i class="fa fa-map-marker"></i>
            <select class="selectCi" id="idCiudad" name="idCiudad" required>
              <option value="">Ciudad</option>
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
      <div class="separator"></div>
      <div class="socmed-login">
        <a href="{{url('Auth/Google')}}" class="socmed-btn google-btn">
          <i style="color: white;padding: 0px;" class="fa fa-google"></i>
          <span style="font-weight:400;">Registrar con Google</span>
        </a>
      </div>
            </div><!--  fin de login-form-content-->
        </div> <!-- tab-content2-->
          </li>
    <!-- Inicio del Tag #3-->
    <li>
      <input type="radio" name="tabs"/>
      <label class="label1" for="pure-toggle-right">
        <i style="color: white;padding: 0px; margin-top: -1%" class="fa fa-arrow-right"></i>
      </label>
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
           <li><a href="https://www.facebook.com/PocketSmartBar/" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
           <li><a href="https://twitter.com/pocketsmartbar/" target="_blank"><i class="fa fa-twitter fa-2x"></i></a></li>
           <li><a href="https://www.instagram.com/pocketsmartbar/" target="_blank"><i class="fa fa-instagram fa-2x"></i></a></li>
           <li><a href="https://www.youtube.com/channel/UC9MeOjQqxTsqdu6up_ZCiaA?view_as=subscriber" target="_blank"><i class="fa fa-youtube fa-2x" ></i></a></li>
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

<!-- SCRIPT DEPARTAMENTO Y CIUDADES -->
<script>
  $('#idDepto').on('change', function (event) {
    var id = $(this).find('option:selected').val();
    $('#idCiudad').empty();
    $('#idCiudad').append($('<option>', {
          value: "",
          text: 'Elija una opción'
    }));
    JSONCiudades = eval(<?php echo json_encode($ciudades);?>);
    JSONCiudades.forEach(function(currentValue,index,arr) {
      if(currentValue.idDepartamento == id){
        $('#idCiudad').append($('<option>', {
          value: currentValue.id,
          text: currentValue.nombre
        }));
      }
    });
  });
</script>
<!-- FIN SCRIPT DEPARTAMENTO Y CIUDADES -->

<!-- Funcion para validar tipo de usuario y quitar campos q no le corresponde-->
<script>
$(document).ready(function() {
  $('#tipo').change(function(e) {
    if ($(this).val() === "proveedor") {
      document.getElementById( 'TipNeg' ).style.display = 'none';
      document.getElementById( 'NomNeg' ).style.display = 'block';
    }
    else if ($(this).val() === "cliente") {
      document.getElementById( 'TipNeg' ).style.display = 'none';
      document.getElementById( 'NomNeg' ).style.display = 'none';
    }
    else {
      document.getElementById( 'TipNeg' ).style.display = 'block';
    }
  })
});
</script>
</body>
</html>
