<!DOCTYPE html>
<html>
<head>
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
<link href="stylesheets\bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\font-awesome.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\hightop-font.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\isotope.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\jquery.fancybox.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\fullcalendar.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\wizard.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\select2.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\morris.css" media="all" rel="stylesheet" type="text/css">
    <link href="stylesheets\datatables.css" media="all" rel="stylesheet" type="text/css">
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
    <link href="stylesheets\style.css" media="all" rel="stylesheet" type="text/css">
 
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap.min.js" type="text/javascript"></script>
    <script src="javascripts\raphael.min.js" type="text/javascript"></script>
    <script src="javascripts\selectivizr-min.js" type="text/javascript"></script>
    <script src="javascripts\jquery.mousewheel.js" type="text/javascript"></script>
    <script src="javascripts\jquery.vmap.min.js" type="text/javascript"></script>
    <script src="javascripts\jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="javascripts\jquery.vmap.world.js" type="text/javascript"></script>
    <script src="javascripts\jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script src="javascripts\fullcalendar.min.js" type="text/javascript"></script>
    <script src="javascripts\gcal.js" type="text/javascript"></script>
    <script src="javascripts\jquery.dataTables.js" type="text/javascript"></script>
    <script src="javascripts\datatable-editable.js" type="text/javascript"></script>
    <script src="javascripts\jquery.easy-pie-chart.js" type="text/javascript"></script>
    <script src="javascripts\excanvas.min.js" type="text/javascript"></script>
    <script src="javascripts\jquery.isotope.min.js" type="text/javascript"></script>
    <script src="javascripts\isotope_extras.js" type="text/javascript"></script>
    <script src="javascripts\modernizr.custom.js" type="text/javascript"></script>
    <script src="javascripts\jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="javascripts\select2.js" type="text/javascript"></script>
    <script src="javascripts\styleswitcher.js" type="text/javascript"></script>
    <script src="javascripts\wysiwyg.js" type="text/javascript"></script>
    <script src="javascripts\typeahead.js" type="text/javascript"></script>
    <script src="javascripts\summernote.min.js" type="text/javascript"></script>
    <script src="javascripts\jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="javascripts\jquery.validate.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap-fileupload.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="javascripts\typeahead.js" type="text/javascript"></script>
    <script src="javascripts\spin.min.js" type="text/javascript"></script>
    <script src="javascripts\ladda.min.js" type="text/javascript"></script>
    <script src="javascripts\moment.js" type="text/javascript"></script>
    <script src="javascripts\mockjax.js" type="text/javascript"></script>
    <script src="javascripts\bootstrap-editable.min.js" type="text/javascript"></script>
    <script src="javascripts\xeditable-demo-mock.js" type="text/javascript"></script>
    <script src="javascripts\xeditable-demo.js" type="text/javascript"></script>
    <script src="javascripts\address.js" type="text/javascript"></script>
    <script src="javascripts\daterange-picker.js" type="text/javascript"></script>
    <script src="javascripts\date.js" type="text/javascript"></script>
    <script src="javascripts\morris.min.js" type="text/javascript"></script>
    <script src="javascripts\skycons.js" type="text/javascript"></script>
    <script src="javascripts\fitvids.js" type="text/javascript"></script>
    <script src="javascripts\jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="javascripts\dropzone.js" type="text/javascript"></script>
    <script src="javascripts\jquery.nestable.js" type="text/javascript"></script>
    <script src="javascripts\main.js" type="text/javascript"></script>
    <script src="javascripts\respond.js" type="text/javascript"></script>


    <link href="assetsNew/styles/semantic.min.css" rel="stylesheet" type="text/css">
    <script src="assetsNew/scripts/jquery-2.1.3.min.js"></script>
    <script src="assetsNew/scripts/semantic.min.js"></script>
    <script src="assetsNew/scripts/semantic.editableRecord.js"></script>
    <script src="assetsNew/scripts/example.js"></script>
    
    
<style type="text/css">
  .avatar {
      border-radius: 50%;
  }
  .widget-content{
    width: 100%;
    margin-top: 15px;
  }
  #inicio{
    border-bottom: solid 2px rgba(210, 215, 217, 0.75);
  }
  .semanas{
    padding-right: 10px;
  }
</style>

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
                  <a data-target="{{url('Mensajes')}}" class="dropdown-toggle" href="{{url('Mensajes')}}">
                    <span aria-hidden="true" class="hightop-envelope">
                  </span>
                    <div class="sr-only">
                      Messages
                    </div>
                    <p class="counter">
                      <?php
                        $cont=0;
                        foreach(Auth::User()->mensajes as $mensaje){
                          if($mensaje->id_receptor == Auth::user()->id && $mensaje->estado==0){
                            $cont++;
                          }
                        }
                        echo $cont.'</span>';
                      ?>

                    </p>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">
                      <img width="34" height="34" src="../../../images\avatar-male2.png">Could we meet today? I wanted...</a>
                    </li>
                    <li>
                      <a href="#">
                      <img width="34" height="34" src="../../../images\avatar-female.png">Important data needs your analysis...</a>
                    </li>
                    <li>
                      <a href="#">
                      <img width="34" height="34" src="../../../images\avatar-male2.png">Buy Se7en today, it's a great theme...</a>
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
                  <a id="miPersonal" href={{url("/agenda")}}>
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
