<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/icon.png">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
<title>PocketByR</title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="IMPORTANTE LEEER palabras claves para cuando busquen en google IMPORTA" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

    <!-- css bootstrap -->
    <link href="../css/brostrap reg/bootstrap 1.css" rel="stylesheet" >
    <!-- css bootstrap -->
    <link href="../css/bootstrap-social.css" rel="stylesheet">


    <!-- Font Awesome Icons -->
    <link href="../css/font-awesome.css" rel="stylesheet">

	<!-- Custom-Styleheet-Links -->
		<link rel="stylesheet" href="../css/style.css" 		 type="text/css" media="all">
		<link rel="stylesheet" href="../css/animate-custom.css" type="text/css" media="all">
	<!-- //Custom-Styleheet-Links -->

	<!-- Fonts -->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" type="text/css" media="all">
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700" 		  type="text/css" media="all">
	<!-- //Fonts -->

</head>
<!-- //Head -->



<!-- Body -->
<body>

<!-- contenido del formulario -->

            <div class="contec">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text" style="text-align:center">
                        <br><br />
                            <h1 class="color2">Formulario de Registro</h1>
                            <div class="description color1">
                            	<p>
	                            	Ingresa los datos correspodientes en los campos del formulario, ingresa al mundo de PocketByR y este en su bar todo el tiempo, sin estar en el!
	                            	si ya estas registraso da <a href="" target="_blank"><strong class="color2">clik aqui</strong></a>
                            	</p>
                            </div>
                        </div>
                    </div>

				</div>
            </div>
         </div>

	<div class="container w3layouts agileits">
	<!-- baner iconos sociales -->
		<div class="content-left w3layouts agileits">
			<a href="{{url('/')}}">
				<img src="../images/background.jpg" alt="W3layouts Agileits">
			</a>
		<div class="list w3layouts agileits">
			<ul class="w3layouts agileits">
				<li class="w3layouts agileits"><a class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a></li>
					<li class="li2 w3layouts agileits"><a class="btn btn-social-icon btn-instagram"><span class="fa fa-instagram"></span></a></li>
					<li class="w3layouts agileits"><a class="btn btn-social-icon btn-google"><span class="fa fa-google"></span></a></li>
				</ul>
			</div>
		</div>
	<!-- baner iconos sociales -->

		<div class="content-right w3layouts agileits">
			<section>
				<div id="container_demo">
					<a class="hiddenanchor w3layouts agileits" id="tologin"></a>
					<a class="hiddenanchor w3layouts agileits" id="toregister"></a>
					<div id="wrapper">
						<div id="login" class="animate w3layouts agileits form">
							<h2 class="w3layouts agileits">Iniciar Sesión</h2>
              				<form autocomplete="on" method="post" action="{{url('Auth/login')}}">
                			{{csrf_field()}}
                				<div class="text-danger">
					                 @if (Session::has('message'))
									   {{Session::get('message')}}
									 @endif
								 </div>
								<label>E-mail</label>
								<input type="text" name="email" value="{{Input::old('email')}}" required>
								<label>Contraseña</label>
								<input type="password" Name="password" required="">
								<div class="send-button w3layouts agileits">
									<p><a href="#">¿Olvidó su contraseña?</a></p>
										<input type="submit" value="INICIAR SESIÓN">
									<div class="clear"></div>
								</div>
								<p class="change_link w3layouts agileits">
									¿No tienes una cuenta? <a href="{{url('Auth/register')}}" class="to_register">Registrarme</a>
								</p>
								<div class="clear"></div>
							</form>
							<div class="social-icons w3layouts agileits">
								<p>LOGUEAR CON TUS CUENTAS SOCIALES</p>
								<ul>
									<li class="fb w3ls w3layouts agileits"><a href="#"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Facebook</span></a></li>
									<li class="gog w3ls w3layouts agileits"><a href="#"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Google</span></a></li>
									<div class="clear"></div>
								</ul>
							</div>
							<div class="clear"></div>
						</div>

                        <!-- formulario de Registro-->
						<div class="clear">
							<!--CREO ACA VA ALGO DE REGISTRO-->
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="clear"></div>

	</div>

	<div class="footer w3layouts agileits">
		<div class="wrap">
				<p class="copy">© 2017 condiciones de uso y privacidad  <a href="" target="_blank">Derechos Reservados</a> </p>
			</div>
	</div>

</body>
<!-- //Body -->

</html>
