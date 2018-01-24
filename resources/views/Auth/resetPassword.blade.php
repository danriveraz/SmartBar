<!DOCTYPE html>
<html>
    <head>

            <!-- End Google Tag Manager -->
        <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login - SmartBar</title>        
        <!-- Estilos y Fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../assetsNew/styles/normalize.css" type="text/css" />
        <link rel="stylesheet" href="../assetsNew/styles/styles-login-min.css" type="text/css" />
        <link type="image/x-icon" rel="shortcut icon" href="../assetsNew/images/icon.png"/>
    </head>
    <body id="">

    </head>
<div class="main-container">
    <!-- Sidebar Access -->
    <aside class="sidebar-large1">
        <div class="user-access">
            <div class="user-access-header">
                <a href="#" class="logo"><img src="../assetsNew/images/logo.png"></a>
                <p class="intro-title colorMorado">¿Olvidaste tu contraseña?</p>
                <p class="intro-summary">Por favor, introduzca su dirección de correo electrónico</p>
            </div>
            <div class="user-access-form">         
                <form  autocomplete="on" method="post" action="{{url('/password/reset')}}">
                    {{ csrf_field() }}
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
        <div class="hero-login bg-cover" style="background-image: url('../assetsNew/images/login-slide-6.jpg');">  
                           
        </div>
    </section>
</div>    </body>
</html>
