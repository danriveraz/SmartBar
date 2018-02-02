<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="HTML5">
  <meta name="application-name" content="SMARTBAR" />
  <meta name="author" content="Pocket Company" />
  <meta name="description" content="Aplicativo inteligente online, escencial en Bares, Discotecas y/o Restaurantes, que facilita enormemente el trabajo  de administradores, empleados, proveedores y clientes de estos." />
  <meta name="generator" content="Laravel 5.2" />
  <meta name="keywords" content="Compañero inseparable, sistema inteligente de manejo de negocios, bares, restaurantes, discotecas, licores, comidas y cocteles, información almacenada en la nube, datos del negocio en tiempo real" />
  <meta name="encoding" charset="utf-8" />

  <title>SMARTBAR</title>
        <link type="image/x-icon" rel="shortcut icon" href="assetsNew/images/icon.png">

        
  
  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab%7CRoboto:300,400" rel="stylesheet">     
  <link href="assetsNew/styles/stylePocket.css" rel="stylesheet">

  <link href="assetsNew/styles/custom.css" rel="stylesheet"> 
  <!-- Etiquetas de idioma y ubicación -->
</head>
<body>


<!-- MENU PRINCIPAL -->
<header class="block no-pad" data-name="Topbar">
  <div id="" class="topbar fixed bg-solid">
      <div class="topbar-content is-centered">
        <div class="topbar-section">
          <div id="nav-toggle" class="nav-toggle">
            <a>&#9776;</a>
          </div>
          <div class="logo">
           <a href="{{url('/home')}}"><img width="240" height="50" src="assetsNew/images/logoPrin.png"></a>

          </div>
        </div>
        <div class="topbar-section">
		<nav id="nav-main" class="nav">
            <a class="nav-item " href="{{ url('AmigoInseparable') }}">¿Por que somos tu amigo inseparable?</a>
            <a class="nav-item " href="{{ url('PocketClub') }}">PocketClub</a>
            <div id="nav-toggle-close" class="nav-toggle-close">
              <a>X</a>
            </div>
          </nav>
          <div class="nav-access">
            <a class="nav-access-item button outline rounded" href="{{ url('Auth/login') }}">INGRESAR</a>
          </div>
        </div>
      </div>
  </div>
</header>

      <div class="">
        @yield('content')
      </div>

<!-- Menu -->
<footer class="block bg-gray-white" data-name="Footer">
    <div class="block-content footer-nav">
      <div class="row">
        <div class="col">
            <h3>Siguenos En:</h3>
            <ul>
              <li><a href="" target="_blank">Facebook</a></li>
              <li><a href="" target="_blank">Twitter</a></li>
              <li><a href="" target="_blank">YouTube</a></li>
              <li><a href="" target="_blank">Instagram</a></li>
            </ul>
        </div>
        <div class="col">
            <h3>Plataformas</h3>
            <ul>
              <li><a href="index.html">Colombia</a></li>
              <li><a href="index.html">Ecuador (Próximamente)</a></li>
            </ul>
        </div>
        <div class="col">
            <h3>Soporte</h3>
            <ul>
              <li><a href="{{ url('contactos') }}">Contáctanos</a></li>
              <li><a href="{{ url('preguntasFrecuentes') }}">Preguntas Frecuentes</a></li>
              <li><a href="{{ url('politicas') }}">Politicas de Privacidad</a></li>
            </ul>
        </div>
        <div class="col">
            <h3>SmartBar</h3>
            <ul>
              <li><a href="" target="_blank">Cliente VIP</a></li>
              <li><a href="" target="_blank">Trabaja con nosotros</a></li>
              <li><a href="" target="_blank">SmartShop</a></li>
            
            </ul>
        </div>
      </div>
    </div>
</footer>

<!-- Copyright -->
<div class="block bg-gris-Cla">
  <div class="pocketPadin block-content text-center ">
      <p>COPYRIGHT © 2017 Pocket Company S.A.S</p>
  </div>
</div>



<!-- SCRIPTS 
<script src="assets/scripts/classList.min.js" type="text/javascript" async></script>
<script src="assets/scripts/chat.js" type="text/javascript" async></script>
<script src="assets/scripts/setRefererCookie.js" type="text/javascript" async></script>-->
<script src="assetsNew/scripts/smile.js" type="text/javascript" async></script>

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
