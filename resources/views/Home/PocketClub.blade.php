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


<!-- PÁGINA ACTUAL -->
<br>
<br>

<!-- PLANES -->
<section class="block" data-name="Plans">
  <div class="block-content text-center">
    <h2>Membresias PocketClub</h2>
    <div class="row plans cards-basic">
      <div class="col plan">
          <h2 class="plan-title">ÚNICA</h2>
          <ul>
              <li>Hasta 7 Empleados</li>
              <li>Asesoria de Lunes a Viernes(✓)</li>
              <li>1 sólo negocio</li>
              <li>Promociones Únicas SmartShop</li>
              <li>Uso del programa por 30 días</li>
              <li>Información segura hasta por 90 días</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>No aplica mes GRATIS</li>
              <li>0% de ahorro</li>
              
          </ul>
          <h3 class="plan-price"> $ 99.900 COP/Mes</h3>
          <p>
            10% descuento en pago trimestral.
          </p>
      </div>
      <div class="col plan bg-gray-white">
        <h2 class="plan-title">ESPECIAL</h2>
          <ul>
              <li>Hasta 20 Empleados</li>
              <li>Asesoria de Lunes a Sábado (✓)</li>
              <li>Hasta 2 negocios</li>
              <li>Promociones Únicas y especiales SmartShop</li>
              <li>Uso del programa por 6 meses</li>
              <li>Información segura hasta por 1 año</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>El mes 6 es GRATIS</li>
              <li>Ahorra hasta $ 100.000 Cop</li>
              
          </ul>
          <h3 class="plan-price">$ 499.500 COP</h3>
          <p>
            10% descuento en pago anual.
          </p>
      </div>
      <div class="col plan">
          <h2 class="plan-title">ÉLITE</h2>
          <ul>
              <li>Empleados infinitos</li>
              <li>Asesoria de 24/7, 365 días al año (✓)</li>
              <li>Hasta 4 Negocios</li>
              <li>Todas las promociones SmartShop</li>
              <li>Uso del programa por 3 años</li>
              <li>Información segura hasta por 5 años</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>El mes 1, 12,24 y 36 son GRATIS</li>
              <li>Ahorra hasta $ 400.000 Cop</li>
          </ul>
          <h3 class="plan-price">$ 2.998.800 COP</h3>
          <p>
            Descuento en membresia de $ 198.000 Cop
          </p>
      </div>
    </div>
    <p><img class="plan-payment" src="assets/images/logos-payment-col.png" alt="Métodos de pago"/></p>
    <p><a class="button large" href="https://app.alegra.com/user/register/country/colombia" target="_blank" rel="alternate">UNIRTE A <strong>POCKETCLUB</strong></a></p>
    <hr>
    <h4 class="text-gris">Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="http://www.alegra.com/fundaciones" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4>
    <hr>
  </div>
</section>


<!-- SOPORTE  -->
<section class="block " data-name="Support">
    <div class="block-content no-pad text-center">
      <h3 class="hide">¡SmartBar te Asesora!</h3>
      <h4 class="margin-tiny text-Morado">Si necesitas ayuda contáctanos en <a class=" text-gris" href="http://pocketsmartbar.com/asesoramos" rel="alternate">www.pocketsmartbar.com/asesoramos</a></h4>
    </div>
</section>


<!-- PREGUNTAS FRECUENTES -->
<section class="block" data-name="Faqs">
    <div class="block-content">
        <h2 class="text-center">Lo que debes saber de nuestras membresias</h2>
        <div class="row cards-basic bg-white">
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Cómo funciona el Demo de 7 días?</h3>
                    <p class="margin-tiny">Durante 30 días podrás utilizar SMARTBAR con todas sus funciones, crear una cuenta solo toma minutos y transcurridos los 30 días debes seleccionar el plan que utilizaras, para conservar tu información y la ayuda de tu compañero inseparable</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Cuándo puedo Cancelar mi Plan?</h3>
                    <p class="margin-tiny">El plan que hayas seleccionado se puede cancelar en cualquier momento, no hay cláusulas de permanencia o contratos a largo plazo, y si pagaste por adelantado, devolveremos tu dinero, pero perderás los derechos a los descuentos. Para cancelar tu plan simplemente escríbenos en cancelaciones@pocketsmartbar.com</p>
                    <hr>
                </div>
            </div>
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Puedo cambiar de Plan en cualquier momento?</h3>
                    <p>Puedes cambiar de Plan cada mes si así lo requieres, simplemente unete al club con una nueva membresia y listo! </p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">Aún tengo preguntas</h3>
                    <p>Consulta nuestra sección de Preguntas Frecuentes o la Ayuda de la aplicación. Si quieres hablar con el equipo SmartBar, chatea con nosotros, llamanos o ingresa aqui...</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- REGISTRO -->
<section class="block" data-name="Register">
    <div class="block-content text-center">
        <h2 class="margin-tiny">Empieza tus <strong>7 dias gratis</strong></h2>
        <h4 class="margin-tiny">Prueba todas las características de tu amigo SMARTBAR y sin limitaciones</h4>
      <p><a class="button large" href="{{ url('Auth/register') }}" rel="alternate"><strong>INGRESA YA!</strong></a></p>
    </div>
</section>


<!-- PIE DE PÁGINA -->
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
