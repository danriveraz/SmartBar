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
  <meta property="og:image" content="assets/images/p"><!--poner link de la imagen--!>
  <!-- Datos Twitter Card -->   
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@pocketsmartbar">
  <meta name="twitter:creator" content="@pocketsmartbar" />
<!-- Etiquetas meta -->
  <title>PocketSmartBar</title>
  <link type="image/x-icon" rel="shortcut icon" href="{{asset('assets-home/images/icon.png')}}""/>        
<!-- Datos meta Graph --> 
    
<!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
<!--Fuente Requerida -->
{!!Html::style('assets-home\styles\styles-login-min.css')!!}
</head>
<body>
<div class="main-container">
    <!-- Sidebar Access -->
    <aside class="sidebar-large1">
        <div class="user-access">
            <div class="user-access-header">
                <a href="{{ url('/') }}" class="logo"><img src="{{asset('assets-home/images/logoPrin.png')}}"></a>
                <p class="intro-title colorMorado">¿Olvidaste tu contraseña?</p>
                <p class="intro-summary">Por favor, introduzca su dirección de correo electrónico</p>
            </div>
            <div class="user-access-form">         
                <form  method="post">
                    <div class="input-wrapper">
                        <input type="text" name="email" id="email" value="" class="email" placeholder="E-mail">
                    </div>
                    <input type="submit" name="submit" id="submit" value="enviar" class="enviar">
                </form>
            </div> 
            <div class="colorGris user-access-footer">
                <hr />
                <p class="intro-title colorMorado">Tranquilo</p>
                <p class="intro-summary">Restablecer tu contraseña es muy facil</p>
            </div>
        </div>
    </aside>
    
    
    <!-- Content Slideshow  -->
    <section class="content">
              <div class="hero-login bg-cover" style="background-image: url({{asset('assets-home/images/login-slide-6.jpg')}}")">

        </div>
    </section>
</div>    </body>
</html>
