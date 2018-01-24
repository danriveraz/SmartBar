﻿<!DOCTYPE html>
<html>
    <head>

            <!-- End Google Tag Manager -->
        <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro - SmartBar</title> 
        <link type="image/x-icon" rel="shortcut icon" href="../assetsNew/images/icon.png">
        <meta name="description" content="" >
        <link href="" rel="canonical" >                        
        <!-- Estilos y Fuentes -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../assetsNew/styles/normalize.css" type="text/css" />
        <link rel="stylesheet" href="../assetsNew/styles/styles-login-min.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    </head>
    <body id="">
		<div class="main-container">
			<!-- Sidebar Access -->
			<aside class="sidebar-large">
				<div class="user-access">
					<div class="user-access-header">
						<a href="{{url('/home')}}" class="logo"><img src="../assetsNew/images/logo.png"></a>
						<p class="intro-title">Obntén a tu amigo inseparable SmartBar</p>
						<p class="intro-summary">con unos cuantos clicks</p>
					</div>
					<div class="user-access-form">         
						<form autocomplete="off" role="form" method="POST" enctype="multipart/form-data" action="{{ url('Auth/register') }}" files="true">
							{{ csrf_field() }}
							<div class="text-danger">
								 @if (Session::has('message'))
								   {{Session::get('message')}}
								 @endif
							 </div>
							<div class="input-wrapper">
								<input type="text" class="empresa" name="nombreEstablecimiento" value="{{ old('nombreEstablecimiento') }}" placeholder="Nombre Negocio" required>
							</div>
							<div class="input-wrapper">
								<select id="tipo"  name="tipo" required>
									<option value="dueño">Dueño de Negocio</option>
									<option value="proveedor">Proveedor</option>
									<option value="cliente">Cliente</option>
								</select>
							</div>                   
							<div class="input-wrapper">
								<input type="text" value="{{ old('name') }}" class="nombre" name="nombrePersona" required placeholder="Nombre" required>
							</div>
							<div class="input-wrapper">
								<select id="sexo"  name="sexo" required>
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
									<option value="Otro">Otro</option>
								</select>
							</div>
							<div class="input-wrapper">
								<input type="text" name="email" id="email" value="{{ old('email') }}" class="email" placeholder="E-mail" required>
							</div>
							<div class="input-wrapper">
								<input type="password" name="password" id="password" value="" class="clave" placeholder="Contraseña" required>
							</div>
							<div class="input-wrapper" style="float: left; width:49%">
								<select id="idDepto"  name="idDepto" required>
									@foreach($departamentos as $departamento)
	                                  	<option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
	                                @endforeach
								</select>
							</div>
							<div class="input-wrapper" style="float: right; width:49%">
								<select id="idCiudad" name="idCiudad" required>
									<option></option>
								</select>
							</div>
							<div class="input-wrapper" style="display: none;">
								<input type="text" name="coupon" id="coupon" value="" class="coupon" placeholder="Código promocional" disabled="disabled">        <span class="close">&times;</span>
							</div>
								
							<input type="submit" name="submit" id="submit" value="CREAR CUENTA" class="enviar">    
							<div class="terms">
								Al crear tu cuenta aceptas nuestros
								<a href="" target="_blank">Términos, Condiciones</a> y 
								<a href="" target="_blank">Política de Tratamiento de Datos</a>.
							</div>
							<div class="input-wrapper share-data" style="display: none;">
								<div>
									<input type="hidden" name="canShareData" value="no"><input type="checkbox" name="canShareData" id="canShareData" value="yes" style="display: none;">            
									<div style="display: inline-block; width: 8%;">
										<img id="checkbox-image">
									</div>
									<div style="display: inline-block; width: 90%; text-align: left;">
										<label style="font-size: 12px;" for="canShareData" id="canShareData-label">Compartir información con Bancolombia para recibir ofertas personalizadas de productos y servicios.</label>
									</div>
								</div>
							</div>                
						</form>
					</div> 
				</div>
			</aside>
			<!-- Content Slideshow  -->
			<section class="content">
				<div class="hero-login bg-cover" style="background-image: url('../assetsNew/images/login-slide-5.jpg');">
		  
					<p class="quote">
						Cada semana tenemos nuevas características<br>
						<small>Síguenos en nuestras redes sociales</small><br> 
						<a title="Twitter" class="button-circle" href="https://twitter.com" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
								<path fill="#00B19D" d="M35,17.9949748 C34.2270821,18.3335138 33.3977523,18.563107 32.5263881,18.6656082 C33.4161102,18.1389582 34.0971701,17.3036174 34.4199598,16.3113025 C33.58538,16.7990143 32.6641579,17.1531556 31.6825779,17.3451334 C30.8965521,16.516271 29.7785062,16 28.5384061,16 C26.1592944,16 24.2302765,17.9067872 24.2302765,20.2571923 C24.2302765,20.5905417 24.2683305,20.9161238 24.3418306,21.2274602 C20.762011,21.0497281 17.5876774,19.3543879 15.4631396,16.7782562 C15.0917616,17.4060847 14.8804916,18.1376354 14.8804916,18.9185372 C14.8804916,20.3959861 15.6416056,21.6996035 16.7964016,22.4622912 C16.0903956,22.4389554 15.4263896,22.2469776 14.8450798,21.9278739 L14.8450798,21.9810578 C14.8450798,24.0434962 16.3305577,25.764784 18.3002374,26.1565408 C17.9393594,26.2525297 17.5588195,26.3057137 17.1651375,26.3057137 C16.8869557,26.3057137 16.6179357,26.2784772 16.3541656,26.2265822 C16.9026714,27.9193446 18.4931495,29.1503089 20.3775594,29.1840577 C18.9038855,30.3255454 17.0457256,31.0039461 15.0274919,31.0039461 C14.679756,31.0039461 14.3372358,30.983188 14,30.9455726 C15.9067139,32.1558128 18.1703598,32.8614499 20.6032755,32.8614499 C28.5279747,32.8614499 32.8597465,26.3731772 32.8597465,20.7462268 L32.8453004,20.1949521 C33.6916841,19.5982268 34.4239059,18.8484959 35,17.9949748 Z"/>
							</svg>
						</a>
						<a title="Facebook" class="button-circle" href="https://www.facebook.com" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
								<path fill="#00B19D" d="M25.4913914,33.257811 L25.4913914,24.4740625 L28.4385481,24.4740625 L28.8807085,21.0498641 L25.4913914,21.0498641 L25.4913914,18.8640127 C25.4913914,17.8729378 25.7654762,17.1975322 27.1882844,17.1975322 L29,17.1967874 L29,14.1340632 C28.6866893,14.0933477 27.6112042,14 26.3594508,14 C23.7455902,14 21.9560943,15.5954766 21.9560943,18.5248824 L21.9560943,21.0498641 L19,21.0498641 L19,24.4740625 L21.9560943,24.4740625 L21.9560943,33.257811 L25.4913914,33.257811 Z"/>
							</svg>
						</a>          
						<a title="Instagram" class="button-circle" href="https://www.instagram.com" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
								<g fill="#00B19D" transform="translate(14 14)">
									<path d="M14.4007059,0 L5.48870588,0 C2.46223529,0 0,2.46235294 0,5.48882353 L0,14.4008235 C0,17.4274118 2.46223529,19.8896471 5.48870588,19.8896471 L14.4007059,19.8896471 C17.4274118,19.8896471 19.8896471,17.4272941 19.8896471,14.4008235 L19.8896471,5.48882353 C19.8897647,2.46235294 17.4274118,0 14.4007059,0 Z M18.1250588,14.4008235 C18.1250588,16.4543529 16.4543529,18.1249412 14.4008235,18.1249412 L5.48870588,18.1249412 C3.43529412,18.1250588 1.76470588,16.4543529 1.76470588,14.4008235 L1.76470588,5.48882353 C1.76470588,3.43541176 3.43529412,1.76470588 5.48870588,1.76470588 L14.4007059,1.76470588 C16.4542353,1.76470588 18.1249412,3.43541176 18.1249412,5.48882353 L18.1249412,14.4008235 L18.1250588,14.4008235 Z"/>
									<path d="M9.94482353 4.82C7.11882353 4.82 4.81976471 7.11905882 4.81976471 9.94505882 4.81976471 12.7709412 7.11882353 15.0698824 9.94482353 15.0698824 12.7708235 15.0698824 15.0698824 12.7709412 15.0698824 9.94505882 15.0698824 7.11905882 12.7708235 4.82 9.94482353 4.82zM9.94482353 13.3050588C8.092 13.3050588 6.58447059 11.7977647 6.58447059 9.94494118 6.58447059 8.092 8.09188235 6.58458824 9.94482353 6.58458824 11.7977647 6.58458824 13.3051765 8.092 13.3051765 9.94494118 13.3051765 11.7977647 11.7976471 13.3050588 9.94482353 13.3050588zM15.2848235 3.32364706C14.9448235 3.32364706 14.6108235 3.46129412 14.3707059 3.70247059 14.1294118 3.94247059 13.9907059 4.27658824 13.9907059 4.61776471 13.9907059 4.95788235 14.1295294 5.29188235 14.3707059 5.53305882 14.6107059 5.77305882 14.9448235 5.91188235 15.2848235 5.91188235 15.626 5.91188235 15.9589412 5.77305882 16.2001176 5.53305882 16.4412941 5.29188235 16.5789412 4.95776471 16.5789412 4.61776471 16.5789412 4.27658824 16.4412941 3.94247059 16.2001176 3.70247059 15.9601176 3.46129412 15.626 3.32364706 15.2848235 3.32364706z"/>
								</g>
							</svg>
						</a>    
					</p>                                                  
				</div>
			</section>
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
</html>
