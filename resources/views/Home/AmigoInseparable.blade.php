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
            <a class="nav-item " href="caracteristicas">¿Por que somos tu amigo inseparable?</a>
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


<!-- PÁGINA ACTUAL -->


<!-- CONTACTO (ENCABEZADO) -->
<section class="block bg-green gap-top-contact" data-name="ContactHead">
    <div class="block-content no-pad">
        <div class="head-small ">        
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        <div class="hide-mobile">
          <img class="head-small-icon" src="assetsNew/images/head-character.png" alt="¿Tienes dudas?" title="Soporte">
          <div class="head-small-text">
            <h3 class="serif margin-tiny">SMARTBAR NO PUEDE FALTAR EN TU NEGOCIO</h3>
            <p class="serif margin-tiny">Como tu amigo inseparable, siempre estoy presente para hacer la vida de tus empleados, proveedores y clientes mucho más fácil, por ende <span class="bold">ESTAR EN TU NEGOCIO</span>, es lo mejor para todos!</p>
          </div>
          </div>
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        </div>
    </div>
</section>


<!-- Preguntas frecuentes pocket-->

<!-- PREGUNTAS FRECUENTES -->
<section class="block" data-name="Faqs">
    <div class="block-content">
        <h2 class="text-center">Un Compañero Inseparable</h2>
        <div class="row cards-basic bg-white">
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">Te ayudo a crear un Sistema de Negocio</h3>
                    <p class="margin-tiny">Cuando emprendes un nuevo negocio siempre tienes la mentalidad, de llegar a un punto en el cual trabajes menos y ganes más dinero, pero para lograr esto, debes crear en tu negocio un sistema, que haga que todo funcione sin que tu estes presente <a href="http://www.pocketSmartbar.com">SmartBar</a>, ayuda a que esta meta, se haga realidad!  </p>
                    <p class="margin-tiny">Soy el encargado de hacerte la vida, más fácil.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Qué debo tener en cuenta antes de empezar?</h3>
                    <p class="margin-tiny">Para utilizar SmartBar simplemente debes registrarte en el sistema, al ingresar encontrarás todas las ayudas necesarias para empezar a elaborar facturas, registrar los gastos, llevar tu inventario, registrar empleados, productos a tu inventario, a tu carta y muchas funciones más. Es muy fácil, la mejor forma de averiguarlo es probarlo, puedes crear tu cuenta <a href="">acá</a></p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Quiénes pueden utilizar SmartBar?</h3>
                    <p class="margin-tiny"><strong>PocketSamrtBar</strong> está diseñado para que todas las personas que son dueños, empleados o clientes de un negocio tipo bar o restaurante, se vean beneficiados con el uso de smartbar, ya que ayudará a todos los usuarios a obtener una mejor esperiencia en el servicio. </p>
                    <p class="margin-tiny">Puedes hacer con Smartbar divertido lo que antes era aburrido y además de esto, Smartbar, te ayudará a llevar el control, haciendo cosas por si solo, contando unicamente con tu aprobación.<a href="">acá</a> o <a href="">crea una cuenta</a>  GRATIS </p>
                    <hr>
                </div>
                                
            </div>
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Está segura mi información con mi amigo inseparable SmartBar?</h3>
                    <p>Claro que sí, la información que registres solo será visible para ti y los usuarios autorizados con los correspondientes permisos. La información almacenada en pocketsmartbar se aloja en servidores de Amazon Web Services, una de las mejores plataformas a nivel mundial que realiza copias de seguridad automáticas y es utilizada por empresas como Dropbox, Twitter, La Nasa, Ferrari y muchos más. Tu información está en las mejores manos, Puedes estar tranquilo y ocuparte de hacer crecer tu empresa, de cuidar tu información se encarga tu amigo inseparable SmartBar.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">Si tengo dudas con el uso de mi amigo inseparable Smartbar, ¿quién me ayuda?</h3>
                    <p class="margin-tiny">Nuestro Equipo de Soporte siempre está dispuesto para ayudarte hasta con el mínimo problema, tenemos 5 estrellas de calificación y los usuarios son nuestra prioridad, pruébalo tu mismo <a href="">acá</a>  </p>
                    <p class="margin-tiny">Conoce cómo contactarnos <a href="">aquí</a>.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">Si tengo dudas con el uso de mi amigo inseparable Smartbar, ¿quién me ayuda?</h3>
                    <p class="margin-tiny">Nuestro Equipo de Soporte siempre está dispuesto para ayudarte hasta con el mínimo problema, tenemos 5 estrellas de calificación y los usuarios son nuestra prioridad, pruébalo tu mismo <a href="">acá</a>  </p>
                    <p class="margin-tiny">Conoce cómo contactarnos <a href="">aquí</a>.</p>
                    <hr>
                </div>
                </div>
                
                
            </div>
        </div>
    </div>
</section>

<!-- finde de preguntas frecuentes pocket-->


<!-- REGISTRO -->
<section class="block" data-name="Register">
    <div class="block-content text-center">
        <h2 class="margin-tiny">Empieza tus <strong>7 Dias gratis</strong></h2>
        <h4 class="margin-tiny">Prueba todas las características de SmartBar sin limitaciones</h4>
      <p><a class="button large" href="{{ url('Auth/register') }}" rel="alternate"><strong>INGRESA YA!</strong></a></p>
    </div>
</section>


<!-- PIE DE PÁGINA -->

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
              <li><a href="">Contáctanos</a></li>
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
      <p>COPYRIGHT © 2017 Pocket Company S.A.</p>
  </div>
</div>

<!-- SCRIPTS 
<script src="assets/scripts/classList.min.js" type="text/javascript" async></script>
<script src="assets/scripts/chat.js" type="text/javascript" async></script>
<script src="assets/scripts/setRefererCookie.js" type="text/javascript" async></script>-->
<script src="assets/scripts/smile.js" type="text/javascript" async></script>

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

</body>

</html>
