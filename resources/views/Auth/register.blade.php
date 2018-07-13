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
  <title>Registro - PocketSmartBar</title>
  <link type="image/x-icon" rel="shortcut icon" href="{{asset('assets-home/images/icon.png')}}"/>
<!-- Datos meta Graph -->

<!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<style>





.main-container{display:table;width:100%;height:100%}
.content{display:table-cell;height:100%;background-color:#eff2f7;text-align:right;vertical-align:top;color:#FFF}
@media screen and (max-width:480px){.content{display:block;overflow:auto;text-align:center}}.sidebar{display:table-cell;width:160px;height:100%;padding:70px 80px;background-color:#FFF}
@media screen and (max-width:480px){.sidebar{display:block;width:100%;padding:40px 40px}}

.sidebar-large{
	display:table-cell;
	width:356px;
	height:100%;
	padding:30px 80px;
	background-color:#FFF}

.sidebar-large1{
	display:table-cell;
	width:500px;
	height:100%;
	padding:100px 80px;
	background-color:#FFF}
@media screen and (max-width:480px){
	.sidebar-large{display:block;width:100%;padding:20px 20px}
	.login-form-content{padding: 0px 0px !important;}
	}

.hero-login{height:100%}

@media screen and (max-width:480px){.hero-login{padding:40px 40px}}.intro-title{font-size:18px;margin-bottom:0;color:#2d0031;}

.bg-cover{background-size:cover !important;background-position:center !important;background-repeat:no-repeat !important}


}
	</style>
	{!!Html::style('assets-home\styles\main.css')!!}
	{!!Html::style('assets-home\styles\font-awesome.css')!!}
    <link type="image/x-icon" rel="shortcut icon" href="{{asset('assets-home/images/icon.png')}}"/>
    {!!Html::script("assets-home\scripts\jquery-1.12.4.min.js")!!}
    {!!Html::script("assets-home\scripts\main.js")!!}
    </head>
    <body id="">

    </head>
<div class="main-container">
    <!-- Sidebar Access -->
    <aside class="sidebar-large">
		<!-- registro-->
		<div class="login-form-content">
			<div class="login-form-header">
				<div class="logo">
					<a href="{{ url('/') }}">
						<img src="{{asset('assets-home/images/logoPrin.png')}}"/>
					</a>
				</div>
				<h3>Bienvenido! Tu amigo inseparable te espera </h3>
			</div>
			<form class="login-form" autocomplete="off" role="form" method="POST" enctype="multipart/form-data" action="{{ url('Auth/register') }}" files="true">
        		{{ csrf_field() }}
	        	<div class="text-danger" style="text-align: center;">
	           	@if (Session::has('message'))
	            	{{Session::get('message')}}
	           	@endif
	         	</div>
            <div class="input-container">
              <i class="fa fa-address-book"></i>
              <select class="select" id="tipo"  name="tipo" required>
                <option value="dueño">Dueño de Negocio</option>
                <option value="proveedor">Proveedor</option>
                <option value="cliente">Cliente VIP</option>
              </select>
            </div>
             <div class="input-container" id="NomNeg">
               <i class="fa fa-reorder"></i>
               <input type="text" class="input" name="nombreEstablecimiento" placeholder="Nombre de tu Negocio" required/>
             </div>
             <div class="input-container" id="TipNeg">
               <i class="fa fa-reorder"></i>
               <select class="select" id="TipoNegocio"  name="TipoNegocio" required>
                 <option >Tipo De Negocio</option>
                 <option value="Bar">Bar</option>
                 <option value="restaurante">restaurante</option>
               </select>
             </div>
             <div class="input-container">
               <i class="fa fa-address-card"></i>
               <input type="text" class="input" name="nombrePersona" placeholder="Nombre" required/>
             </div>
             <!--div class="input-container">
               <i class="fa fa-venus-mars"></i>
               <select class="select" id="sexo" name="sexo" required="">
                 <option value="">Sexo</option>
                 <option value="Masculino">Masculino</option>
                 <option value="Femenino">Femenino</option>
                 <option value="Otro">Otro</option>
               </select>
             </div-->
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
			<div class="separator">
					<span class="separator-text">OR</span>
			</div>
			<div class="socmed-login">
				<a href="{{url('Auth/Google')}}" class="socmed-btn google-btn">
					<i class="fa fa-google"></i>
					<span>Iniciar Sesión con Google</span>
				</a>
			</div>
        </div><!--  fin de login-form-content-->
    </aside>
    <!-- Content Slideshow  -->
    <section class="content">
        <div class="hero-login bg-cover"style="background-image: url({{asset('assets-home/images/login-slide-4.jpg')}})">
        </div>
    </section>
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
</div>
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
