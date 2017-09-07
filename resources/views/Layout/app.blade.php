  <!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      Pocket SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">

    {!!Html::style('stylesheets/bootstrap.min.css')!!}
    {!!Html::style('stylesheets/font-awesome.min.css')!!}
    {!!Html::style('stylesheets/hightop-font.css')!!}
    {!!Html::style('stylesheets/style.css')!!}
    {!!Html::style('stylesheets/bootstrap-select.css')!!}
    {!!Html::style('stylesheets\select2.css')!!}

    {!!Html::style('stylesheets\bootstrap.css')!!}
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

    {!!Html::style('stylesheets\color\green.css')!!}
    {!!Html::style('stylesheets\color\orange.css')!!}
    {!!Html::style('stylesheets\color\magenta.css')!!}
    {!!Html::style('stylesheets\color\gray.css')!!}








     <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>


<script>
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

<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix" >
      <!-- Navegación -->
      <div class="navbar navbar-fixed-top scroll-hide" >
        <div class="container-fluid top-bar" >
          <div class="pull-right ">
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
                <ul class="dropdown-menu" >
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
                  <li><a href="{{url('Auth/modificarEmpresa')}}">
                    <i class="fa fa-gear"></i>Ajustes</a>
                  </li>
                   <li>
                    <a data-toggle="modal" href="#tutModal" id="tutorial">
                    <i class="fa fa-question"></i>Ayuda</a>
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
        <div class="container-fluid main-nav clearfix" >
          <div class="nav-collapse" >
            <ul class="nav">
             <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span> {{Auth::User()->empresa->nombreEstablecimiento}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a id="usuario" nombre="barraNavegacion" href={{url("/Auth/usuario")}}>
                    <span aria-hidden="true" class="fa fa-fw fa-group fa-2x"></span>  Personal</a>
                  </li>
                  <li><a id="productos" nombre="barraNavegacion" href="{{route('producto.index')}}" >
                    <span aria-hidden="true" class="fa fa-fw fa-glass fa-2x"></span>   Productos</a>
                  </li>
                  <li><a id="insumos" nombre="barraNavegacion" href="{{route('insumo.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-list fa-2x"></span>   Inventario</a>
                  </li>
                  <li><a id="proveedor" nombre="barraNavegacion" href="{{route('proveedor.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-truck fa-2x"></span>  Proveedores</a>
                  </li>
                  <li class="dropdown">
                    <a id="mesas" nombre="barraNavegacion" href="{{route('mesas.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-hospital-o fa-2x"></span>  Mesas</a>
                  </li>
                </ul>
              </li>              
              <li class="dropdown">
                <a id="cajero" nombre="barraNavegacion" href="{{url('cajero/')}}">
                <span aria-hidden="true" class="fa fa-fw fa-usd"></span>Caja</a>
              </li>
             
              <li class="dropdown">
              <a id="Estadisticas" nombre="barraNavegacion" href="{{url('Estadisticas/')}}">
                <span aria-hidden="true" class="fa fa-fw fa-bar-chart-o"></span>Estadisticas</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- fin de la navegación -->

  <div class="modal fade" id="tutModal" role="dialog" >
    <div class="modal-dialog modal-lg" style="min-width: 800px;">
      <div class="modal-content" >
        <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;
          </button>
          <h4 class="modal-title">
            Aca va el tutorial
           </h4>
          </div>
          <div class="modal-body">
            <div class="" >
              <div class="widget-content">
                <div class="form-group">
                   <!-- Add this css File in head tag-->
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
                  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
                  <!--  
                  If you want to change #bootstrap-touch-slider id then you have to change Carousel-indicators and Carousel-Control  #bootstrap-touch-slider slide as well
                  Slide effect: slide, fade
                  Text Align: slide_style_center, slide_style_left, slide_style_right
                  Add Text Animation: https://daneden.github.io/animate.css/
                  -->
                <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>     
                        <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
                        <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
                        <li data-target="#bootstrap-touch-slider" data-slide-to="3"></li>
                        <li data-target="#bootstrap-touch-slider" data-slide-to="4"></li>
                        <li data-target="#bootstrap-touch-slider" data-slide-to="5"></li>
                    </ol>
                  <!-- Wrapper For Slides -->
                  <div class="carousel-inner" role="listbox">

                    <!-- First Slide -->
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Proveedores</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('proveedor.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <!-- End of Slide -->
                    <!-- Second Slide -->
                    <div class="item">
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Categorías</h1>
                          <p data-animation="animated fadeInLeft"></p>
                          <a href="{{route('categoria.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <!-- End of Slide -->
                    <!-- Third Slide -->
                    <div class="item">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Inventario</h1>
                          <p data-animation="animated fadeInLeft"></p>
                          <a href="{{route('insumo.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <!-- End of Slide -->
                    <div class="item">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Productos</h1>
                          <p data-animation="animated fadeInLeft"></p>
                          <a href="{{route('producto.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <div class="item">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Usuarios</h1>
                          <p data-animation="animated fadeInLeft"></p>
                          <a href="{{url('/Auth/usuario')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <div class="item">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Mesas</h1>
                          <p data-animation="animated fadeInLeft"></p>
                          <a href="{{url('/mesas')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>

                    </div><!-- End of Wrapper For Slides -->

                    <!-- Left Control -->
                    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                        <span class="fa fa-angle-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <!-- Right Control -->
                    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                        <span class="fa fa-angle-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                  </div> <!-- End  bootstrap-touch-slider Slider -->        
                </div>
              </div>
            </div>
            </div>
          </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>

  
    <div class="">
      @yield('content')
    </div>
</div>

    <div class="footer">
    <div class="container">
        <p class="text-muted"> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;© 2017 condiciones de uso y privacidad <br> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<a href="" target="_blank">Derechos Reservados</a> </p>
      </div>
  </div>
  </body>


<style type="text/css">
  
  .bs-slider{
      overflow: hidden;
      max-height: 700px;
      position: relative;
      background: #000000;
  }
  .bs-slider:hover {
      cursor: -moz-grab;
      cursor: -webkit-grab;
  }
  .bs-slider:active {
      cursor: -moz-grabbing;
      cursor: -webkit-grabbing;
  }
  .bs-slider .bs-slider-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.40);
  }
  .bs-slider > .carousel-inner > .item > img,
  .bs-slider > .carousel-inner > .item > a > img {
      margin: auto;
      width: 100% !important;
  }

  /********************
  *****Slide effect
  **********************/

  .fade {
      opacity: 1;
  }
  .fade .item {
      top: 0;
      z-index: 1;
      opacity: 0;
      width: 100%;
      position: absolute;
      left: 0 !important;
      display: block !important;
      -webkit-transition: opacity ease-in-out 1s;
      -moz-transition: opacity ease-in-out 1s;
      -ms-transition: opacity ease-in-out 1s;
      -o-transition: opacity ease-in-out 1s;
      transition: opacity ease-in-out 1s;
  }
  .fade .item:first-child {
      top: auto;
      position: relative;
  }
  .fade .item.active {
      opacity: 1;
      z-index: 2;
      -webkit-transition: opacity ease-in-out 1s;
      -moz-transition: opacity ease-in-out 1s;
      -ms-transition: opacity ease-in-out 1s;
      -o-transition: opacity ease-in-out 1s;
      transition: opacity ease-in-out 1s;
  }

  /*---------- LEFT/RIGHT ROUND CONTROL ----------*/
  .control-round .carousel-control {
      top: 47%;
      opacity: 0;
      width: 45px;
      height: 45px;
      z-index: 100;
      color: #ffffff;
      display: block;
      font-size: 24px;
      cursor: pointer;
      overflow: hidden;
      line-height: 43px;
      text-shadow: none;
      position: absolute;
      font-weight: normal;
      background: transparent;
      -webkit-border-radius: 100px;
      border-radius: 100px;
  }
  .control-round:hover .carousel-control{
      opacity: 1;
  }
  .control-round .carousel-control.left {
      left: 1%;
  }
  .control-round .carousel-control.right {
      right: 1%;
  }
  .control-round .carousel-control.left:hover,
  .control-round .carousel-control.right:hover{
      color: #fdfdfd;
      background: rgba(0, 0, 0, 0.5);
      border: 0px transparent;
  }
  .control-round .carousel-control.left>span:nth-child(1){
      left: 45%;
  }
  .control-round .carousel-control.right>span:nth-child(1){
      right: 45%;
  }

  /*---------- INDICATORS CONTROL ----------*/
  .indicators-line > .carousel-indicators{
      right: 40%;
      bottom: 3%;
      left: auto;
      width: 90%;
      height: 20px;
      font-size: 0;
      overflow-x: auto;
      text-align: right;
      overflow-y: hidden;
      padding-left: 10px;
      padding-right: 10px;
      padding-top: 1px;
      white-space: nowrap;
  }
  .indicators-line > .carousel-indicators li{
      padding: 0;
      width: 15px;
      height: 15px;
      border: 1px solid rgb(158, 158, 158);
      text-indent: 0;
      overflow: hidden;
      text-align: left;
      position: relative;
      letter-spacing: 1px;
      background: rgb(158, 158, 158);
      -webkit-font-smoothing: antialiased;
      -webkit-border-radius: 50%;
      border-radius: 50%;
      margin-right: 5px;
      -webkit-transition: all 0.5s cubic-bezier(0.22,0.81,0.01,0.99);
      transition: all 0.5s cubic-bezier(0.22,0.81,0.01,0.99);
      z-index: 10;
      cursor:pointer;
  }
  .indicators-line > .carousel-indicators li:last-child{
      margin-right: 0;
  }
  .indicators-line > .carousel-indicators .active{
      margin: 1px 5px 1px 1px;
      box-shadow: 0 0 0 2px #fff;
      background-color: transparent;
      position: relative;
      -webkit-transition: box-shadow 0.3s ease;
      -moz-transition: box-shadow 0.3s ease;
      -o-transition: box-shadow 0.3s ease;
      transition: box-shadow 0.3s ease;
      -webkit-transition: background-color 0.3s ease;
      -moz-transition: background-color 0.3s ease;
      -o-transition: background-color 0.3s ease;
      transition: background-color 0.3s ease;

  }
  .indicators-line > .carousel-indicators .active:before{
      transform: scale(0.5);
      background-color: #fff;
      content:"";
      position: absolute;
      left:-1px;
      top:-1px;
      width:15px;
      height: 15px;
      border-radius: 50%;
      -webkit-transition: background-color 0.3s ease;
      -moz-transition: background-color 0.3s ease;
      -o-transition: background-color 0.3s ease;
      transition: background-color 0.3s ease;
  }

  /*---------- SLIDE CAPTION ----------*/
  .slide_style_left {
      text-align: left !important;
  }
  .slide_style_right {
      text-align: right !important;
  }
  .slide_style_center {
      text-align: center !important;
  }

  .slide-text {
      left: 0;
      top: 25%;
      right: 0;
      margin: auto;
      padding: 10px;
      position: absolute;
      text-align: left;
      padding: 10px 85px;
      
  }

  .slide-text > h1 {
      
      padding: 0;
      color: #ffffff;
      font-size: 70px;
      font-style: normal;
      line-height: 84px;
      margin-bottom: 30px;
      letter-spacing: 1px;
      display: inline-block;
      -webkit-animation-delay: 0.7s;
      animation-delay: 0.7s;
  }
  .slide-text > p {
      padding: 0;
      color: #ffffff;
      font-size: 20px;
      line-height: 24px;
      font-weight: 300;
      margin-bottom: 40px;
      letter-spacing: 1px;
      -webkit-animation-delay: 1.1s;
      animation-delay: 1.1s;
  }
  .slide-text > a.btn-default{
      color: #000;
      font-weight: 400;
      font-size: 13px;
      line-height: 15px;
      margin-right: 10px;
      text-align: center;
      padding: 17px 30px;
      white-space: nowrap;
      letter-spacing: 1px;
      display: inline-block;
      border: none;
      text-transform: uppercase;
      -webkit-animation-delay: 2s;
      animation-delay: 2s;
      -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
      transition: background 0.3s ease-in-out, color 0.3s ease-in-out;

  }
  .slide-text > a.btn-primary{
      color: #ffffff;
      cursor: pointer;
      font-weight: 400;
      font-size: 13px;
      line-height: 15px;
      margin-left: 10px;
      text-align: center;
      padding: 17px 30px;
      white-space: nowrap;
      letter-spacing: 1px;
      background: #00bfff;
      display: inline-block;
      text-decoration: none;
      text-transform: uppercase;
      border: none;
      -webkit-animation-delay: 2s;
      animation-delay: 2s;
      -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
      transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
  }
  .slide-text > a:hover,
  .slide-text > a:active {
      color: #ffffff;
      background: #222222;
      -webkit-transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
      transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
  }

  /*------------------------------------------------------*/
  /* RESPONSIVE
  /*------------------------------------------------------*/

  @media (max-width: 991px) {
      .slide-text h1 {
          font-size: 40px;
          line-height: 50px;
          margin-bottom: 20px;
      }
      .slide-text > p {

          font-size: 18px;
      }
  }


  /*---------- MEDIA 480px ----------*/
  @media  (max-width: 768px) {
      .slide-text {
          padding: 10px 50px;
      }
      .slide-text h1 {
          font-size: 30px;
          line-height: 40px;
          margin-bottom: 10px;
      }
      .slide-text > p {
          font-size: 14px;
          line-height: 20px;
          margin-bottom: 20px;
      }
      .control-round .carousel-control{
          display: none;
      }

  }
  @media  (max-width: 480px) {
      .slide-text {
          padding: 10px 30px;
      }
      .slide-text h1 {
          font-size: 20px;
          line-height: 25px;
          margin-bottom: 5px;
      }
      .slide-text > p {
          font-size: 12px;
          line-height: 18px;
          margin-bottom: 10px;
      }
      .slide-text > a.btn-default, 
      .slide-text > a.btn-primary {
          font-size: 10px;
          line-height: 10px;
          margin-right: 10px;
          text-align: center;
          padding: 10px 15px;
      }
      .indicators-line > .carousel-indicators{
          display: none;
      }

  }
</style>
<script type="text/javascript">
  /*Bootstrap Carousel Touch Slider.

http://bootstrapthemes.co

Credits: Bootstrap, jQuery, TouchSwipe, Animate.css, FontAwesome

 */


(function(a){if(typeof define==="function"&&define.amd&&define.amd.jQuery){define(["jquery"],a)}else{if(typeof module!=="undefined"&&module.exports){a(require("jquery"))}else{a(jQuery)}}}(function(f){var y="1.6.15",p="left",o="right",e="up",x="down",c="in",A="out",m="none",s="auto",l="swipe",t="pinch",B="tap",j="doubletap",b="longtap",z="hold",E="horizontal",u="vertical",i="all",r=10,g="start",k="move",h="end",q="cancel",a="ontouchstart" in window,v=window.navigator.msPointerEnabled&&!window.navigator.pointerEnabled&&!a,d=(window.navigator.pointerEnabled||window.navigator.msPointerEnabled)&&!a,C="TouchSwipe";var n={fingers:1,threshold:75,cancelThreshold:null,pinchThreshold:20,maxTimeThreshold:null,fingerReleaseThreshold:250,longTapThreshold:500,doubleTapThreshold:200,swipe:null,swipeLeft:null,swipeRight:null,swipeUp:null,swipeDown:null,swipeStatus:null,pinchIn:null,pinchOut:null,pinchStatus:null,click:null,tap:null,doubleTap:null,longTap:null,hold:null,triggerOnTouchEnd:true,triggerOnTouchLeave:false,allowPageScroll:"auto",fallbackToMouseEvents:true,excludedElements:"label, button, input, select, textarea, a, .noSwipe",preventDefaultEvents:true};f.fn.swipe=function(H){var G=f(this),F=G.data(C);if(F&&typeof H==="string"){if(F[H]){return F[H].apply(this,Array.prototype.slice.call(arguments,1))}else{f.error("Method "+H+" does not exist on jQuery.swipe")}}else{if(F&&typeof H==="object"){F.option.apply(this,arguments)}else{if(!F&&(typeof H==="object"||!H)){return w.apply(this,arguments)}}}return G};f.fn.swipe.version=y;f.fn.swipe.defaults=n;f.fn.swipe.phases={PHASE_START:g,PHASE_MOVE:k,PHASE_END:h,PHASE_CANCEL:q};f.fn.swipe.directions={LEFT:p,RIGHT:o,UP:e,DOWN:x,IN:c,OUT:A};f.fn.swipe.pageScroll={NONE:m,HORIZONTAL:E,VERTICAL:u,AUTO:s};f.fn.swipe.fingers={ONE:1,TWO:2,THREE:3,FOUR:4,FIVE:5,ALL:i};function w(F){if(F&&(F.allowPageScroll===undefined&&(F.swipe!==undefined||F.swipeStatus!==undefined))){F.allowPageScroll=m}if(F.click!==undefined&&F.tap===undefined){F.tap=F.click}if(!F){F={}}F=f.extend({},f.fn.swipe.defaults,F);return this.each(function(){var H=f(this);var G=H.data(C);if(!G){G=new D(this,F);H.data(C,G)}})}function D(a5,au){var au=f.extend({},au);var az=(a||d||!au.fallbackToMouseEvents),K=az?(d?(v?"MSPointerDown":"pointerdown"):"touchstart"):"mousedown",ax=az?(d?(v?"MSPointerMove":"pointermove"):"touchmove"):"mousemove",V=az?(d?(v?"MSPointerUp":"pointerup"):"touchend"):"mouseup",T=az?(d?"mouseleave":null):"mouseleave",aD=(d?(v?"MSPointerCancel":"pointercancel"):"touchcancel");var ag=0,aP=null,a2=null,ac=0,a1=0,aZ=0,H=1,ap=0,aJ=0,N=null;var aR=f(a5);var aa="start";var X=0;var aQ={};var U=0,a3=0,a6=0,ay=0,O=0;var aW=null,af=null;try{aR.bind(K,aN);aR.bind(aD,ba)}catch(aj){f.error("events not supported "+K+","+aD+" on jQuery.swipe")}this.enable=function(){aR.bind(K,aN);aR.bind(aD,ba);return aR};this.disable=function(){aK();return aR};this.destroy=function(){aK();aR.data(C,null);aR=null};this.option=function(bd,bc){if(typeof bd==="object"){au=f.extend(au,bd)}else{if(au[bd]!==undefined){if(bc===undefined){return au[bd]}else{au[bd]=bc}}else{if(!bd){return au}else{f.error("Option "+bd+" does not exist on jQuery.swipe.options")}}}return null};function aN(be){if(aB()){return}if(f(be.target).closest(au.excludedElements,aR).length>0){return}var bf=be.originalEvent?be.originalEvent:be;var bd,bg=bf.touches,bc=bg?bg[0]:bf;aa=g;if(bg){X=bg.length}else{if(au.preventDefaultEvents!==false){be.preventDefault()}}ag=0;aP=null;a2=null;aJ=null;ac=0;a1=0;aZ=0;H=1;ap=0;N=ab();S();ai(0,bc);if(!bg||(X===au.fingers||au.fingers===i)||aX()){U=ar();if(X==2){ai(1,bg[1]);a1=aZ=at(aQ[0].start,aQ[1].start)}if(au.swipeStatus||au.pinchStatus){bd=P(bf,aa)}}else{bd=false}if(bd===false){aa=q;P(bf,aa);return bd}else{if(au.hold){af=setTimeout(f.proxy(function(){aR.trigger("hold",[bf.target]);if(au.hold){bd=au.hold.call(aR,bf,bf.target)}},this),au.longTapThreshold)}an(true)}return null}function a4(bf){var bi=bf.originalEvent?bf.originalEvent:bf;if(aa===h||aa===q||al()){return}var be,bj=bi.touches,bd=bj?bj[0]:bi;var bg=aH(bd);a3=ar();if(bj){X=bj.length}if(au.hold){clearTimeout(af)}aa=k;if(X==2){if(a1==0){ai(1,bj[1]);a1=aZ=at(aQ[0].start,aQ[1].start)}else{aH(bj[1]);aZ=at(aQ[0].end,aQ[1].end);aJ=aq(aQ[0].end,aQ[1].end)}H=a8(a1,aZ);ap=Math.abs(a1-aZ)}if((X===au.fingers||au.fingers===i)||!bj||aX()){aP=aL(bg.start,bg.end);a2=aL(bg.last,bg.end);ak(bf,a2);ag=aS(bg.start,bg.end);ac=aM();aI(aP,ag);be=P(bi,aa);if(!au.triggerOnTouchEnd||au.triggerOnTouchLeave){var bc=true;if(au.triggerOnTouchLeave){var bh=aY(this);bc=F(bg.end,bh)}if(!au.triggerOnTouchEnd&&bc){aa=aC(k)}else{if(au.triggerOnTouchLeave&&!bc){aa=aC(h)}}if(aa==q||aa==h){P(bi,aa)}}}else{aa=q;P(bi,aa)}if(be===false){aa=q;P(bi,aa)}}function M(bc){var bd=bc.originalEvent?bc.originalEvent:bc,be=bd.touches;if(be){if(be.length&&!al()){G(bd);return true}else{if(be.length&&al()){return true}}}if(al()){X=ay}a3=ar();ac=aM();if(bb()||!am()){aa=q;P(bd,aa)}else{if(au.triggerOnTouchEnd||(au.triggerOnTouchEnd==false&&aa===k)){if(au.preventDefaultEvents!==false){bc.preventDefault()}aa=h;P(bd,aa)}else{if(!au.triggerOnTouchEnd&&a7()){aa=h;aF(bd,aa,B)}else{if(aa===k){aa=q;P(bd,aa)}}}}an(false);return null}function ba(){X=0;a3=0;U=0;a1=0;aZ=0;H=1;S();an(false)}function L(bc){var bd=bc.originalEvent?bc.originalEvent:bc;if(au.triggerOnTouchLeave){aa=aC(h);P(bd,aa)}}function aK(){aR.unbind(K,aN);aR.unbind(aD,ba);aR.unbind(ax,a4);aR.unbind(V,M);if(T){aR.unbind(T,L)}an(false)}function aC(bg){var bf=bg;var be=aA();var bd=am();var bc=bb();if(!be||bc){bf=q}else{if(bd&&bg==k&&(!au.triggerOnTouchEnd||au.triggerOnTouchLeave)){bf=h}else{if(!bd&&bg==h&&au.triggerOnTouchLeave){bf=q}}}return bf}function P(be,bc){var bd,bf=be.touches;if(J()||W()){bd=aF(be,bc,l)}if((Q()||aX())&&bd!==false){bd=aF(be,bc,t)}if(aG()&&bd!==false){bd=aF(be,bc,j)}else{if(ao()&&bd!==false){bd=aF(be,bc,b)}else{if(ah()&&bd!==false){bd=aF(be,bc,B)}}}if(bc===q){if(W()){bd=aF(be,bc,l)}if(aX()){bd=aF(be,bc,t)}ba(be)}if(bc===h){if(bf){if(!bf.length){ba(be)}}else{ba(be)}}return bd}function aF(bf,bc,be){var bd;if(be==l){aR.trigger("swipeStatus",[bc,aP||null,ag||0,ac||0,X,aQ,a2]);if(au.swipeStatus){bd=au.swipeStatus.call(aR,bf,bc,aP||null,ag||0,ac||0,X,aQ,a2);if(bd===false){return false}}if(bc==h&&aV()){clearTimeout(aW);clearTimeout(af);aR.trigger("swipe",[aP,ag,ac,X,aQ,a2]);if(au.swipe){bd=au.swipe.call(aR,bf,aP,ag,ac,X,aQ,a2);if(bd===false){return false}}switch(aP){case p:aR.trigger("swipeLeft",[aP,ag,ac,X,aQ,a2]);if(au.swipeLeft){bd=au.swipeLeft.call(aR,bf,aP,ag,ac,X,aQ,a2)}break;case o:aR.trigger("swipeRight",[aP,ag,ac,X,aQ,a2]);if(au.swipeRight){bd=au.swipeRight.call(aR,bf,aP,ag,ac,X,aQ,a2)}break;case e:aR.trigger("swipeUp",[aP,ag,ac,X,aQ,a2]);if(au.swipeUp){bd=au.swipeUp.call(aR,bf,aP,ag,ac,X,aQ,a2)}break;case x:aR.trigger("swipeDown",[aP,ag,ac,X,aQ,a2]);if(au.swipeDown){bd=au.swipeDown.call(aR,bf,aP,ag,ac,X,aQ,a2)}break}}}if(be==t){aR.trigger("pinchStatus",[bc,aJ||null,ap||0,ac||0,X,H,aQ]);if(au.pinchStatus){bd=au.pinchStatus.call(aR,bf,bc,aJ||null,ap||0,ac||0,X,H,aQ);if(bd===false){return false}}if(bc==h&&a9()){switch(aJ){case c:aR.trigger("pinchIn",[aJ||null,ap||0,ac||0,X,H,aQ]);if(au.pinchIn){bd=au.pinchIn.call(aR,bf,aJ||null,ap||0,ac||0,X,H,aQ)}break;case A:aR.trigger("pinchOut",[aJ||null,ap||0,ac||0,X,H,aQ]);if(au.pinchOut){bd=au.pinchOut.call(aR,bf,aJ||null,ap||0,ac||0,X,H,aQ)}break}}}if(be==B){if(bc===q||bc===h){clearTimeout(aW);clearTimeout(af);if(Z()&&!I()){O=ar();aW=setTimeout(f.proxy(function(){O=null;aR.trigger("tap",[bf.target]);if(au.tap){bd=au.tap.call(aR,bf,bf.target)}},this),au.doubleTapThreshold)}else{O=null;aR.trigger("tap",[bf.target]);if(au.tap){bd=au.tap.call(aR,bf,bf.target)}}}}else{if(be==j){if(bc===q||bc===h){clearTimeout(aW);clearTimeout(af);O=null;aR.trigger("doubletap",[bf.target]);if(au.doubleTap){bd=au.doubleTap.call(aR,bf,bf.target)}}}else{if(be==b){if(bc===q||bc===h){clearTimeout(aW);O=null;aR.trigger("longtap",[bf.target]);if(au.longTap){bd=au.longTap.call(aR,bf,bf.target)}}}}}return bd}function am(){var bc=true;if(au.threshold!==null){bc=ag>=au.threshold}return bc}function bb(){var bc=false;if(au.cancelThreshold!==null&&aP!==null){bc=(aT(aP)-ag)>=au.cancelThreshold}return bc}function ae(){if(au.pinchThreshold!==null){return ap>=au.pinchThreshold}return true}function aA(){var bc;if(au.maxTimeThreshold){if(ac>=au.maxTimeThreshold){bc=false}else{bc=true}}else{bc=true}return bc}function ak(bc,bd){if(au.preventDefaultEvents===false){return}if(au.allowPageScroll===m){bc.preventDefault()}else{var be=au.allowPageScroll===s;switch(bd){case p:if((au.swipeLeft&&be)||(!be&&au.allowPageScroll!=E)){bc.preventDefault()}break;case o:if((au.swipeRight&&be)||(!be&&au.allowPageScroll!=E)){bc.preventDefault()}break;case e:if((au.swipeUp&&be)||(!be&&au.allowPageScroll!=u)){bc.preventDefault()}break;case x:if((au.swipeDown&&be)||(!be&&au.allowPageScroll!=u)){bc.preventDefault()}break}}}function a9(){var bd=aO();var bc=Y();var be=ae();return bd&&bc&&be}function aX(){return !!(au.pinchStatus||au.pinchIn||au.pinchOut)}function Q(){return !!(a9()&&aX())}function aV(){var bf=aA();var bh=am();var be=aO();var bc=Y();var bd=bb();var bg=!bd&&bc&&be&&bh&&bf;return bg}function W(){return !!(au.swipe||au.swipeStatus||au.swipeLeft||au.swipeRight||au.swipeUp||au.swipeDown)}function J(){return !!(aV()&&W())}function aO(){return((X===au.fingers||au.fingers===i)||!a)}function Y(){return aQ[0].end.x!==0}function a7(){return !!(au.tap)}function Z(){return !!(au.doubleTap)}function aU(){return !!(au.longTap)}function R(){if(O==null){return false}var bc=ar();return(Z()&&((bc-O)<=au.doubleTapThreshold))}function I(){return R()}function aw(){return((X===1||!a)&&(isNaN(ag)||ag<au.threshold))}function a0(){return((ac>au.longTapThreshold)&&(ag<r))}function ah(){return !!(aw()&&a7())}function aG(){return !!(R()&&Z())}function ao(){return !!(a0()&&aU())}function G(bc){a6=ar();ay=bc.touches.length+1}function S(){a6=0;ay=0}function al(){var bc=false;if(a6){var bd=ar()-a6;if(bd<=au.fingerReleaseThreshold){bc=true}}return bc}function aB(){return !!(aR.data(C+"_intouch")===true)}function an(bc){if(!aR){return}if(bc===true){aR.bind(ax,a4);aR.bind(V,M);if(T){aR.bind(T,L)}}else{aR.unbind(ax,a4,false);aR.unbind(V,M,false);if(T){aR.unbind(T,L,false)}}aR.data(C+"_intouch",bc===true)}function ai(be,bc){var bd={start:{x:0,y:0},last:{x:0,y:0},end:{x:0,y:0}};bd.start.x=bd.last.x=bd.end.x=bc.pageX||bc.clientX;bd.start.y=bd.last.y=bd.end.y=bc.pageY||bc.clientY;aQ[be]=bd;return bd}function aH(bc){var be=bc.identifier!==undefined?bc.identifier:0;var bd=ad(be);if(bd===null){bd=ai(be,bc)}bd.last.x=bd.end.x;bd.last.y=bd.end.y;bd.end.x=bc.pageX||bc.clientX;bd.end.y=bc.pageY||bc.clientY;return bd}function ad(bc){return aQ[bc]||null}function aI(bc,bd){bd=Math.max(bd,aT(bc));N[bc].distance=bd}function aT(bc){if(N[bc]){return N[bc].distance}return undefined}function ab(){var bc={};bc[p]=av(p);bc[o]=av(o);bc[e]=av(e);bc[x]=av(x);return bc}function av(bc){return{direction:bc,distance:0}}function aM(){return a3-U}function at(bf,be){var bd=Math.abs(bf.x-be.x);var bc=Math.abs(bf.y-be.y);return Math.round(Math.sqrt(bd*bd+bc*bc))}function a8(bc,bd){var be=(bd/bc)*1;return be.toFixed(2)}function aq(){if(H<1){return A}else{return c}}function aS(bd,bc){return Math.round(Math.sqrt(Math.pow(bc.x-bd.x,2)+Math.pow(bc.y-bd.y,2)))}function aE(bf,bd){var bc=bf.x-bd.x;var bh=bd.y-bf.y;var be=Math.atan2(bh,bc);var bg=Math.round(be*180/Math.PI);if(bg<0){bg=360-Math.abs(bg)}return bg}function aL(bd,bc){var be=aE(bd,bc);if((be<=45)&&(be>=0)){return p}else{if((be<=360)&&(be>=315)){return p}else{if((be>=135)&&(be<=225)){return o}else{if((be>45)&&(be<135)){return x}else{return e}}}}}function ar(){var bc=new Date();return bc.getTime()}function aY(bc){bc=f(bc);var be=bc.offset();var bd={left:be.left,right:be.left+bc.outerWidth(),top:be.top,bottom:be.top+bc.outerHeight()};return bd}function F(bc,bd){return(bc.x>bd.left&&bc.x<bd.right&&bc.y>bd.top&&bc.y<bd.bottom)}}}));!function(n){"use strict";n.fn.bsTouchSlider=function(i){var a=n(".carousel");return this.each(function(){function i(i){var a="webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";i.each(function(){var i=n(this),t=i.data("animation");i.addClass(t).one(a,function(){i.removeClass(t)})})}var t=a.find(".item:first").find("[data-animation ^= 'animated']");a.carousel(),i(t),a.on("slide.bs.carousel",function(a){var t=n(a.relatedTarget).find("[data-animation ^= 'animated']");i(t)}),n(".carousel .carousel-inner").swipe({swipeLeft:function(n,i,a,t,e){this.parent().carousel("next")},swipeRight:function(){this.parent().carousel("prev")},threshold:0})})}}(jQuery);
//Initialise Bootstrap Carousel Touch Slider
// Curently there are no option available.
$('#bootstrap-touch-slider').bsTouchSlider();
</script>

</html>

