<!DOCTYPE html>
<html>
  <head>
	<title>
	  Pocket SmartBar
	</title>
	<link rel="shortcut icon" href={{ asset('images/icon.png') }}>
	<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
	{!!Html::style('stylesheets\bootstrap.css')!!}
	{!!Html::style('stylesheets/font-awesome.min.css')!!}
	{!!Html::style('stylesheets/hightop-font.css')!!}
	{!!Html::style('stylesheets/bootstrap-select.css')!!}
	{!!Html::style('stylesheets\select2.css')!!}
	{!!Html::style('stylesheets\isotope.css')!!}
	{!!Html::style('stylesheets\jquery.fancybox.css')!!}
	{!!Html::style('stylesheets\fullcalendar.css')!!}
	{!!Html::style('stylesheets\wizard.css')!!}
	{!!Html::style('stylesheets\morris.css')!!}
	{!!Html::style('stylesheets\datatables.css')!!}
	{!!Html::style('stylesheets\datepicker.css')!!}
	{!!Html::style('stylesheets\timepicker.css')!!}
	{!!Html::style('stylesheets\colorpicker.css')!!}
	{!!Html::style('stylesheets\bootstrap-switch.css')!!}
	{!!Html::style('stylesheets\bootstrap-editable.css')!!}
	{!!Html::style('stylesheets\daterange-picker.css')!!}
	{!!Html::style('stylesheets\typeahead.css')!!}
	{!!Html::style('stylesheets\summernote.css')!!}
	{!!Html::style('stylesheets\ladda-themeless.min.css')!!}
	{!!Html::style('stylesheets\social-buttons.css')!!}
	{!!Html::style('stylesheets\jquery.fileupload-ui.css')!!}
	{!!Html::style('stylesheets\dropzone.css')!!}
	{!!Html::style('stylesheets\nestable.css')!!}
	{!!Html::style('stylesheets\pygments.css')!!}
	{!!Html::style('stylesheets/style.css')!!}
	<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

	{!!Html::script("javascripts\bootstrap.min.js")!!}
	{!!Html::script("javascripts/bootstrap-select.js")!!}
	{!!Html::script("javascripts\jquery.bootstrap.wizard.js")!!}
	{!!Html::script("javascripts/fullcalendar.min.js")!!}
	{!!Html::script("javascripts\gcal.js")!!}
	{!!Html::script("javascripts\jquery.dataTables.min.js")!!}
	{!!Html::script("javascripts\datatable-editable.js")!!}
	{!!Html::script("javascripts\jquery.easy-pie-chart.js")!!}
	{!!Html::script("javascripts\jquery.isotope.min.js")!!}
	{!!Html::script("javascripts\isotope_extras.js")!!}
	{!!Html::script("javascripts\modernizr.custom.js")!!}
	{!!Html::script("javascripts\jquery.fancybox.pack.js")!!}
	{!!Html::script("javascripts\select2.js")!!}
	{!!Html::script("javascripts\styleswitcher.js")!!}
	{!!Html::script("javascripts\wysiwyg.js")!!}
	{!!Html::script("javascripts/typeahead.js")!!}
	{!!Html::script("javascripts\summernote.min.js")!!}
	{!!Html::script("javascripts\jquery.inputmask.min.js")!!}
	{!!Html::script("javascripts\jquery.validate.js")!!}
	{!!Html::script("javascripts\bootstrap-fileupload.js")!!}
	{!!Html::script("javascripts\bootstrap-datepicker.js")!!}
	{!!Html::script("javascripts\bootstrap-timepicker.js")!!}
	{!!Html::script("javascripts\bootstrap-colorpicker.js")!!}
	{!!Html::script("javascripts\bootstrap-switch.min.js")!!}
	{!!Html::script("javascripts/typeahead.js")!!}
	{!!Html::script("javascripts\spin.min.js")!!}
	{!!Html::script("javascripts\ladda.min.js")!!}
	{!!Html::script("javascripts\moment.js")!!}
	{!!Html::script("javascripts\mockjax.js")!!}
	{!!Html::script("javascripts\daterange-picker.js")!!}
	{!!Html::script("javascripts\date.js")!!}
	{!!Html::script("javascripts\morris.min.js")!!}
	{!!Html::script("javascripts\skycons.js")!!}
	{!!Html::script("javascripts/fitvids.js")!!}
	{!!Html::script("javascripts\jquery.sparkline.min.js")!!}
	{!!Html::script("javascripts\dropzone.js")!!}
	{!!Html::script("javascripts\jquery.nestable.js")!!}
	{!!Html::script('javascripts\main.js')!!}
	{!!Html::script('javascripts\respond.js')!!}
	{!!Html::script('javascripts\raphael.min.js')!!}
	{!!Html::script('javascripts\selectivizr-min.js')!!}
	{!!Html::script('javascripts\jquery.mousewheel.js')!!}
	{!!Html::script('javascripts\jquery.vmap.min.js')!!}
	{!!Html::script('javascripts\jquery.vmap.sampledata.js')!!}
	{!!Html::script('javascripts\jquery.vmap.world.js')!!}
	{!!Html::script('javascripts\excanvas.min.js')!!}
	{!!Html::script('javascripts\bootstrap-editable.min.js')!!}
	{!!Html::script('javascripts\xeditable-demo-mock.js')!!}
	{!!Html::script('javascripts\xeditable-demo.js')!!}
	{!!Html::script('javascripts\address.js')!!}
	{!!Html::script('croppie/croppie.js')!!}
	{!!Html::script('croppie/upload.js')!!}
	{!!Html::script('javascripts/upload/plugins/sortable.js')!!}
	{!!Html::script('javascripts/upload/fileinput.js')!!}
	{!!Html::script('javascripts/upload/locales/fr.js')!!}
	{!!Html::script('javascripts/upload/locales/es.js')!!}
	{!!Html::script('javascripts/upload/theme.js')!!}
	{!!Html::style('croppie/croppie.css')!!}
	{!!Html::style('stylesheets/upload/fileinput.css')!!}
	{!!Html::style('stylesheets/upload/theme.css')!!}

	<!-- ascrip y css de menu -->

	{!!Html::style('stylesheets/menu/bootstrap-submenu.css')!!}
	{!!Html::script('javascripts/menu/bootstrap-submenu.min.js')!!}
	<!-- ascrip y css de menu -->
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="login2">
    <!-- Login Screen -->
    <div class="login-wrapper">
    <h1>
      <div class="col-lg-12" style="background-color:#2d0031">
           <a href=""><img src="images/logo2.png"></a>
      </div>
    </h1>
      <form action="index.html">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span><input class="form-control" placeholder="Username o Email" type="text">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" placeholder="Contraseña" type="text">
          </div>
        </div>
        <a class="pull-right pocketMorado" href="#">Olvidaste tu contraseña</a>
        <div class="text-left">
          <label class="checkbox"><input type="checkbox"><span>Mantener Conectado</span></label>
        </div>
        <input class="btn btn-lg btn-primaryp btn-block" type="submit" value="Log in">
        
        <div class="social-login clearfix">
        <button class="btn btn-facebook"><i class="fa fa-facebook"></i>iniciar con Facebook</button>
		<button class="btn btn-google-plus"><i class="fa fa-google-plus"></i>iniciar con Google Plus</button>        </div>
      </form>
      <p>
        ¿Aún no tienes una cuenta?
      </p>
      <a class="btn btn-default-outline btn-block" href="signup2.htm">Regístrese ahora</a>
    </div>
    <!-- End Login Screen -->
  </body>
</html>



































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
	                            	</strong></a>
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
							<h2 class="w3layouts agileits">INICIA SESIÓN</h2>
              				<form autocomplete="on" method="post" action="{{url('Auth/login')}}">
                			{{csrf_field()}}
                				<div class="text-danger">
					                 @if (Session::has('message'))
									   {{Session::get('message')}}
									 @endif
								 </div>
								<label>E-mail</label>
								<input type="text" name="username" value="{{Input::old('username')}}" required>
								<label>Contraseña</label>
								<input type="password" Name="password" required="">
								<div class="send-button w3layouts agileits">
									<p><a href="#">Recupera tu contraseña</a></p>
										<input type="submit" value="INICIAR SESIÓN">
									<div class="clear"></div>
								</div>
								<p class="change_link w3layouts agileits">
									¿NO ERES SMARTBAR? <a href="{{url('Auth/register')}}" class="to_register">Registrate</a>
								</p>
								<div class="clear"></div>
							</form>
							<div class="social-icons w3layouts agileits">
								<p>LOGUEAR CON REDES SOCIALES</p>
								<ul>
									<li class="fb w3ls w3layouts agileits"><a href="{{ url('/Auth/facebook') }}"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Facebook</span></a></li>
									<li class="gog w3ls w3layouts agileits"><a href="#"><span class="icons w3layouts agileits"></span><span class="text w3layouts agileits">Google +</span></a></li>
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
				<p class="copy">© 2017 condiciones de uso y privacidad  <a href="" target="_blank">Todos Derechos Reservados</a> </p>
			</div>
	</div>

</body>

