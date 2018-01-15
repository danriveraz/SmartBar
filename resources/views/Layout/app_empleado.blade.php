<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>
	<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
	
	<link href="stylesheets\isotope.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\jquery.fancybox.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\fullcalendar.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\wizard.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\morris.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\datepicker.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\timepicker.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\colorpicker.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\bootstrap-switch.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\bootstrap-editable.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\daterange-picker.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\typeahead.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\summernote.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\social-buttons.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css">
	<link href="stylesheets\dropzone.css" media="screen" rel="stylesheet" type="text/css">
	<link href="stylesheets\nestable.css" media="screen" rel="stylesheet" type="text/css">
	<link href="stylesheets\pygments.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\select2.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\datatables.css" media="all" rel="stylesheet" type="text/css">
	<link href="stylesheets\bootstrap.css" media="all" rel="stylesheet" type="text/css">
    {!!Html::style('stylesheets/bootstrap.min.css')!!}
    {!!Html::style('stylesheets/font-awesome.min.css')!!}
    {!!Html::style('stylesheets/hightop-font.css')!!}
    {!!Html::style('stylesheets/style.css')!!}
    {!!Html::style('stylesheets/bootstrap-select.css')!!}

<script>
// ajax para verificar que el usuario esté logueado y así no dejar ver la página

 $(document).ready(function(){
    console.log("ejecuta al cargar");
        $.ajax({
          type: "POST",
          url: '{{url('Auth/verificarUser')}}',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) { //anunciar creado autor
            console.log("sigue logueado");
          }, error: function(xhr,status, response) {
            console.log("ya no está logueado");
            window.history.forward();
          }
    });
});
</script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

<script src="javascripts\raphael.min.js" type="text/javascript"></script>
<script src="javascripts\selectivizr-min.js" type="text/javascript"></script>
<script src="javascripts\jquery.mousewheel.js" type="text/javascript"></script>
<script src="javascripts\jquery.vmap.min.js" type="text/javascript"></script>
<script src="javascripts\jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="javascripts\jquery.vmap.world.js" type="text/javascript"></script>
<script src="javascripts\jquery.dataTables.js" type="text/javascript"></script>
<script src="javascripts\excanvas.min.js" type="text/javascript"></script>
<script src="javascripts\select2.js" type="text/javascript"></script>
<script src="javascripts\bootstrap-editable.min.js" type="text/javascript"></script>
<script src="javascripts\xeditable-demo-mock.js" type="text/javascript"></script>
<script src="javascripts\xeditable-demo.js" type="text/javascript"></script>
<script src="javascripts\address.js" type="text/javascript"></script>
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

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
    <body class="page-header-fixed bg-1 layout-boxed" style="BACKGROUND-COLOR:WHITE">
    <div class="modal-shiftfix">
      <!-- Navegación-->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Notificaciones"><span aria-hidden="true" class="hightop-flag"></span>
                  <div class="sr-only">
                    Mis Notificaciones
                  </div>
                  <p class="counter">
                    4
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Por favor no beber en horas laborales
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Cambio de turno autorizado
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Cobro copa de margarita
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Nueva agenda Organizada
                    </p></a>

                  </li>
                </ul>
              </li>
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="mensajes"><span aria-hidden="true" class="hightop-envelope"></span>
                  <div class="sr-only">
                    Mis Mensajes
                  </div>
                  <p class="counter">
                  2
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <img width="34" height="34" src="images\avatar-male2.png">Llegaste tarde el día de ayer...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="images\avatar-male2.png">llamado de atención por llegar tarde...</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                {{ HTML::image('images/admins/'.Auth::User()->imagenPerfil , 'avatar', array( 'width' => '34', 'height'=>'34')) }} {{Auth::User()->nombrePersona}}<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('Auth/usuario/'.Auth::id().'/edit')}}">
                    <i class="fa fa-user"></i>Perfil</a>
                  </li>
                  <li><a href="#">
                    <i class="fa fa-gear"></i>Configuracion</a>
                  </li>
                  <li><a href="{{url('/Auth/logout')}}">
                    <i class="fa fa-sign-out"></i>Salir</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><div class="logo">
            <a href="{{url('/')}}">{{ HTML::image('images/logo.png') }}</a>
          </div>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              @if(Auth::User()->esMesero)
                <li>
                  <a id="mesero" href="{{url('mesero/')}}">
                  <span aria-hidden="true" class="fa fa-fw fa-group"></span>Mesas</a>
                </li>
              @endif
              @if(Auth::User()->esBartender)
              <li>
              <a id="bartender" href="{{url('bartender/')}}">
                <span aria-hidden="true" class="fa fa-fw fa-glass"></span>Bartender</a>
              </li>
              @endif
              @if(Auth::User()->esCajero)
              <li class="dropdown">
              <a id="cajero" href="{{url('cajero/')}}">
                <span aria-hidden="true" class="fa fa-fw fa-list"></span>Caja</a>
              </li>
              @endif
            
            </ul>
          </div>
        </div>
      </div>
        <!-- fin de la navegación -->
        @yield('content')
    </div>

  </body>

</html>

