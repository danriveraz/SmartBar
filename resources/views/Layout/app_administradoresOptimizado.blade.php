<!DOCTYPE html>
<html>
<head>
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
  {!!Html::style('assetsNew/styles/bootstrap.css')!!} <!-- Es necesario :v -->
  {!!Html::style('assetsNew/styles/font-awesome.min.css')!!}<!-- Desde aqui se cargan los iconos -->
  {!!Html::style('assetsNew/styles/hightop-font.css')!!}<!-- Carga los iconos de notificaciones y mensajes -->
  {!!Html::style('assetsNew/styles/style.css')!!}<!-- Es necesario :v -->

  {!!Html::style('assetsNew\styles/fileinput.css')!!} <!--estilos para que el cuadro de subir archivo  Hector-->
  {!!Html::style('assetsNew\styles/jquery.fancybox.css')!!}<!--css para el modal donde se ve la imagen al cargar Hector--> 
  {!!Html::style('assetsNew\styles/select2.css')!!}<!--css para el select 2 del crear nuevo trabajador  Hector-->
  {!!Html::style('assetsNew\styles/jquery.fileupload-ui.css')!!} <!--css para el cargar imagen del crear nuevo trabajador  Hector-->
  <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script> <!-- Permite que carguen opciones desplegables del menu-->
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script> <!-- se necesita para la funcion onload en cajero -->

  {!!Html::script("assetsNew/scripts/bootstrap.min.js")!!}
  {!!Html::script("assetsNew/scripts/jquery.easy-pie-chart.js")!!}
  {!!Html::script("assetsNew/scripts/jquery.sparkline.min.js")!!}
  {!!Html::script("assetsNew/scripts/jquery.isotope.min.js")!!} <!-- Es para cargar los empleados y que se vean en cuadritos Hector-->
  {!!Html::script("assetsNew/scripts/isotope_extras.js")!!}<!-- Es para cargar los empleados y que se vean en cuadritos Hector -->
  {!!Html::script('assetsNew/scripts/upload/fileinput.js')!!} <!-- para el campo de subir archivo en el slider Hector-->
  {!!Html::script("assetsNew/scripts\jquery.fancybox.pack.js")!!}  <!--modal para ver la imagen cuando se carga Hector-->
  {!!Html::script("assetsNew/scripts\select2.js")!!} <!-- selecto 2 del crear nuevo trabajador Hector-->
  {!!Html::script("assetsNew/scripts\bootstrap-fileupload.js")!!} <!--js para el cargar imagen del crear nuevo trabajador  Hector-->
  {!!Html::script('assetsNew/scripts/main.js')!!}

     




  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix" >
        <!-- Navegación -->
      <div class="navbar navbar-fixed-top scroll-hide">
          <div class="container-fluid top-bar">
            <div class="pull-right">
              <ul class="nav navbar-nav pull-right">
                <li class="dropdown notifications hidden-xs">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span aria-hidden="true" class="hightop-flag">
                  </span>
                    <div class="sr-only">
                      Notifications
                    </div>
                    <p class="counter">
                      4
                    </p>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">
                      <div class="notifications label label-info">
                        New
                      </div>
                      <p>
                        New user added: Jane Smith
                      </p>
                    </a>
                      
                    </li>
                    <li>
                      <a href="#">
                      <div class="notifications label label-info">
                        New
                      </div>
                      <p>
                        Sales targets available
                      </p>
                    </a>
                      
                    </li>
                    <li>
                      <a href="#">
                      <div class="notifications label label-info">
                        New
                      </div>
                      <p>
                        New performance metric added
                      </p>
                    </a>
                      
                    </li>
                    <li>
                      <a href="#">
                      <div class="notifications label label-info">
                        New
                      </div>
                      <p>
                        New growth data available
                      </p>
                    </a>
                      
                    </li>
                  </ul>
                </li>
                <li class="dropdown messages hidden-xs">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span aria-hidden="true" class="hightop-envelope">
                  </span>
                    <div class="sr-only">
                      Messages
                    </div>
                    <p class="counter">
                      3
                    </p>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">
                      <img width="34" height="34" src="{{ asset('images/bar.png')}}">Could we meet today? I wanted...</a>
                    </li>
                    <li>
                      <a href="#">
                      <img width="34" height="34" src="{{ asset('images/bar.png')}}">Important data needs your analysis...</a>
                    </li>
                    <li>
                      <a href="#">
                      <img width="34" height="34" src="{{ asset('images/bar.png')}}">Buy Se7en today, it's a great theme...</a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown user hidden-xs">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  {{ HTML::image('images/admins/'.Auth::User()->imagenPerfil , 'avatar', array( 'width' => '34', 'height'=>'34')) }} {{Auth::User()->nombrePersona}}<b class="caret"></b>
                </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="{{url('Auth/usuario/'.Auth::id().'/edit')}}">
                      <i class="fa fa-user-circle">
                      </i>Mi Perfil</a>
                    </li>
                    <li>
                      <a href="{{url('cajero/historial')}}">
                      <i class="fa fa-file-text-o">
                      </i>Facturación</a> 
                    </li>
                    <li>
                      <a href="login1.htm">
                      <i class="fa fa-question">
                      </i>Ayuda</a>
                    </li>
                    <li>
                      <a href='{{url("/Auth/logout")}}'>
                      <i class="fa fa-sign-out">
                      </i>Cerrar Secion</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
              <button class="navbar-toggle">
          <span class="icon-bar">
        </span>
        <span class="icon-bar">
        </span>
        <span class="icon-bar">
        </span>
      </button>
        <div class="logo">
              <a href="{{url('/')}}">{{ HTML::image('images/logo.png') }}</a>
           </a>
            </div>
          </div>
          
          <div class="container-fluid main-nav clearfix">
            <div class="nav-collapse">
              <ul class="nav">
               <li class="dropdown">  
                <a data-toggle="dropdown" href="">
                  <span aria-hidden="true" class="fa fa-5x fa-reorder">
                  </span>{{Auth::User()->EmpresaActual->nombreEstablecimiento}} <b class="caret">
                  </b>
                </a>
                  <ul class="dropdown-menu">
                    @foreach( Auth::User()->empresas  as $empresa)
                      @if($empresa->nombreEstablecimiento != Auth::User()->EmpresaActual->nombreEstablecimiento)
                      <li>
                          <a onclick="cambiarBar({{$empresa->id}});" valor="">
                            <i class="fa fa-reorder pull-left"></i>{{$empresa->nombreEstablecimiento}}
                          </a>
                      </li>
                      @endif
                    @endforeach
                  </ul>
                </li> 
                
                <li>
                  <a id="miPersonal" href={{url("/Auth/usuario")}}>
                    <span aria-hidden="true" class="fa fa-fw fa-users">
                    </span>Mi Personal</a>
                </li>
                
                <li>
                  <a id="miCarta" href="{{route('producto.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-square">
                    </span>Mi Carta</a>
                </li>
                
                <li>
                  <a id="miInventario" href="{{route('insumo.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-scribd">
                    </span>Mi Inventario</a>
                </li>              

                <li>
                  <a id="informacion" href="{{url('Estadisticas/')}}">
                  <span aria-hidden="true" class="fa fa-fw fa-line-chart">
                  </span>Informacion</a>
                </li>
                
                <li>
                  <a id="smartShop" href="">
                  <span aria-hidden="true" class="fa fa-fw fa-cart-plus ">
                  </span>SmartShop</a>
                </li>
              </ul>
            
            </div>
          </div>
        </div>
        <!-- fin de la navegación -->
        <form action="{{url('/Auth/cambiarBar')}}" name="form" method="get">
          {{csrf_field()}}
            <input name="campo" type="number" id="campo"  value=0 hidden="">
            <input type="text" name="redireccionar" value="" id="redireccionar" hidden="">
        </form>
         
      <div class="">
        @yield('content')
      </div>
    </div>

    <div class="footer">
    </div>
  </body>

  <script type="text/javascript">
    function cambiarBar(valor) {
        $("#campo").val(valor);
        var pathname = window.location.pathname.split("public/");
        $("#redireccionar").val(pathname[1]);
        document.form.submit();
    }
  </script>

</html>
