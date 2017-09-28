<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/icon.png">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
<title>POCKETSMARTBAR</title>

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

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

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
                            <h1 class="color2">TODO TU NEGOCIO, EN TU BOLSILLO</h1>
                            <div class="description color1">
                            	<p>
	                            	Completa el formulario e ingresa al mundo de SMARTBAR, donde mantienes el control de tu negocio 24/7. <br>
	                            	Si estas registrado <a href="" target="_blank"><strong class="color2">clik aqui</strong></a>
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
			<a href="{{url('/home')}}">
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
							<h2 class="w3layouts agileits">INICIAR SESIÓN</h2>
							<form  action="#" autocomplete="on" method="post">
								<label>E-mail</label>
								<input type="text" Name="Email o SubName" required="">
								<label>Contraseña</label>
								<input type="password" Name="Password" required="">
								<div class="send-button w3layouts agileits">
									<p><a href="#">Recupera tu contraseña</a></p>
									<form>
										<input type="submit" value="INICIAR SESIÓN">
									</form>
									<div class="clear"></div>
								</div>
								
								<div class="clear"></div>
							</form>
							<div class="social-icons w3layouts agileits">
								<p>LOGUEAR CON TUS REDES SOCIALES</p>
								<ul>
									<li class="fb w3ls w3layouts agileits"><a href="{{ url('/Auth/facebook') }}"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Facebook</span></a></li>
									<li class="gog w3ls w3layouts agileits"><a href="#"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Google +</span></a></li>
									<div class="clear"></div>
								</ul>
							</div>
							<div class="clear"></div>
						</div>

                        <!-- formulario de Registro-->

						<div id="register" class="animate w3layouts agileits form">
							<!-- <h2>Registro</h2> -->
							<form  autocomplete="off" role="form" method="POST" enctype="multipart/form-data" action="{{ url('Auth/register') }}" files="true">
							{{ csrf_field() }}
							<div class="text-danger">
				                 @if (Session::has('message'))
								   {{Session::get('message')}}
								 @endif
							 </div>
                                	<label>Empresa</label>
									<input type="text" class="name w3layouts agileits" name="nombreEstablecimiento" value="{{ old('nombreEstablecimiento') }}" >
									<div class="text-danger">{{$errors->first('nombreEstablecimiento')}}</div>
                                <div>
                                    <label>Nombre</label>
									<input type="text" class="usuario w3layouts agileits" name="nombrePersona" placeholder="" value="{{ old('name') }}" ><div class="text-danger">{{$errors->first('name')}}</div>
								</div>	
								
                                	<label>E-mail</label>
									<input type="text" Name="email" value="{{ old('email') }}">
									<div class="text-danger">{{$errors->first('email')}}</div>

									<label>Contraseña</label>
									<input type="password" Name="password">
									<div class="text-danger">{{$errors->first('password')}}</div>
                                <div class="left-w3-agile" id="target">
                                <label>Departamento</label>
								<select id="idDepto" name="idDepto" required>
									<option></option>
									@foreach($departamentos as $departamento)
                                  		<option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                 	@endforeach
                                </select></div>
								<div class="right-agileits">
                                <label>Ciudad</label>
								<select id="idCiudad" name="idCiudad" required> 
									<option></option>  
                                </select>
								</div>
									<div class="send-button w3layouts agileits">

										<input type="submit" value="REGISTRARME">

									</div>
								
								<div class="clear"></div>
							</form>
							<div class="social-icons w3layouts agileits">
								<p>REGISTRATE CON TUS CUENTAS SOCIALES</p>
								<ul>
									<li class="fb w3ls w3layouts agileits"><a href="{{ url('/Auth/facebook') }}"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Facebook</span></a></li>
									<li class="gog w3ls w3layouts agileits"><a href="{{ url('/Auth/google') }}"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Google</span></a></li>
									<div class="clear"></div>
								</ul>
							</div>
						</div>
						<div class="clear"></div>
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
	<script>
		$('#idDepto').on('change', function (event) {
		    var id = $(this).find('option:selected').val();
		    $('#idCiudad').empty();
		    $('#idCiudad').append($('<option>', {
					    value: 0,
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
</body>
<!-- //Body -->

</html>
