<!DOCTYPE html>
<html>
  <head>
    <title>
      Pocket SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>

    {!!Html::style('stylesheets/bootstrap.min.css')!!}
    {!!Html::style('stylesheets/font-awesome.min.css')!!}
    {!!Html::style('stylesheets/hightop-font.css')!!}
    {!!Html::style('stylesheets/style.css')!!}
    {!!Html::style('stylesheets/bootstrap-select.css')!!}
    {!!Html::style('stylesheets\select2.css')!!}

	   <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    
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

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed bg-1 layout-boxed">
    <div class="modal-shiftfix">
      <!-- Navegación -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Notificaciones"><span aria-hidden="true" class="hightop-flag"></span>
                  <div class="sr-only">
                    Notificaciones
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
                      Nuevo empleado añadido Álvaro
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Poco Vodka en el inventario
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Las ventas superan el promedio semanal
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    <p>
                      Falta agendar empleados
                    </p></a>

                  </li>
                </ul>
              </li>
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="mensajes"><span aria-hidden="true" class="hightop-envelope"></span>
                  <div class="sr-only">
                    Mensajes
                  </div>
                  <p class="counter">
                    3
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <img width="34" height="34" src="../images\avatar-male2.png">Podriá entrar 30 minutos tarde?...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="../images\avatar-female.png">me encuentro incapacitado...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="../images\avatar-male2.png">Podría cambiar mi turno con otro empleado</a>
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
                  <li><a href='{{url("/Auth/logout")}}'>
                    <i class="fa fa-sign-out"></i>Cerrar Sesión</a>
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
              <li>
                <a href={{url("/Auth/usuario")}} class="current">
                <span aria-hidden="true" class="fa fa-fw fa-group"></span>Personal</a>
              </li>
              <li><a href="{{route('producto.index')}}" >
                <span aria-hidden="true" class="fa fa-fw fa-glass"></span>Productos</a>
              </li>
              <li><a href="{{route('insumo.index')}}">
                <span aria-hidden="true" class="fa fa-fw fa-list"></span>Inventario</a>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="fa fa-fw fa-usd"></span>Caja</a>
              </li>
              <li><a href="{{route('proveedor.index')}}">
                <span aria-hidden="true" class="fa fa-fw fa-truck"></span>Proveedores</a>
              </li>
              <li><a href="charts.htm">
                <span aria-hidden="true" class="fa fa-fw fa-bar-chart-o"></span>Estadisticas</a>
              </li>
              <li class="dropdown">
              <a href="{{route('mesas.index')}}">
                <span aria-hidden="true" class="fa fa-fw fa-hospital-o"></span>Mesas</a>
              </li>
              <li class="dropdown">
              <a href="{{url('/Auth/logout')}}">
                <span aria-hidden="true" class="fa fa-fw fa-sign-out"></span>Salir</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- fin de la navegación -->


    </div>
    <div class="">
      @yield('content')
    </div>
    
  </body>

</html>

