
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      Pocket SMARTBAR
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
    <!--
    {!!Html::style('stylesheets\color\green.css')!!}
    {!!Html::style('stylesheets\color\orange.css')!!}
    {!!Html::style('stylesheets\color\magenta.css')!!}
    {!!Html::style('stylesheets\color\gray.css')!!}

    -->








      <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
      <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>


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
                <a id="mensajes" class="dropdown-toggle" data-toggle="dropdown" href="#" title="mensajes"><span aria-hidden="true" class="hightop-envelope"></span>
								      <div class="sr-only">
                            Mensajes
                          </div>
                          <p class="counter">
                            <?php echo ''.Auth::User()->id;?>
                          </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <img width="34" height="34" src="../images\avatar-male2.png">Hola</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                {{ HTML::image('images/admins/'.Auth::User()->imagenPerfil , 'avatar', array( 'width' => '34', 'height'=>'34')) }} {{Auth::User()->nombrePersona}}<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('Auth/usuario/'.Auth::id().'/edit')}}">
                    <i class="fa fa-user-circle"></i>Perfil</a>
                  </li>
                  <li><a href="{{url('Auth/modificarEmpresa')}}">
                    <i class="fa fa-gear"></i>Ajustes</a>
                  </li>
                  <?php if( Auth::User()->estadoTut == 13){ ?>
                  <li>
                    <a data-toggle="modal" href="#tutModal" id="tutorial">
                    <i class="fa fa-question"></i>Ayuda</a>
                  </li>
                  <?php }?>
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
                <span aria-hidden="true" class="fa fa-5x fa-reorder"></span> {{Auth::User()->empresa->nombreEstablecimiento}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a id="usuario" nombre="barraNavegacion" href={{url("/Auth/usuario")}}>
                    <i aria-hidden="true" class="fa fa-users pull-left"></i>Mi Personal</a>
                  </li>
                  <li><a id="productos" nombre="barraNavegacion" href="{{route('producto.index')}}" >
                    <i aria-hidden="true" class="fa fa-square  pull-left"></i>Mi Carta</a>
                  </li>
                  <li><a id="insumos" nombre="barraNavegacion" href="{{route('insumo.index')}}">
                    <i aria-hidden="true" class="fa fa-scribd pull-left"></i>Mi Inventario</a>
                  </li>
                  <li><a id="proveedor" nombre="barraNavegacion" href="{{route('proveedor.index')}}">
                    <i aria-hidden="true" class="fa fa-500px pull-left"></i>Mis Proveedores</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown">
                <a data-toggle="dropdown" href=#>
                <span aria-hidden="true" class="fa fa-fw fa-sliders"></span>Control<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a id="bartender" nombre="barraNavegacion" href={{url("bartender/")}}>
                    <i aria-hidden="true" class="fa fa-imdb pull-left"></i>Bartenders</a>
                  </li>
                  <li><a id="mesero" nombre="barraNavegacion" href="{{url('mesero/')}}" >
                    <i aria-hidden="true" class="fa fa-houzz"></i>Meseros</a>
                  </li>
                  <li><a id="cajero" nombre="barraNavegacion" href="{{url('cajero/')}}">
                    <i aria-hidden="true" class="fa fa-wpbeginner pull-left"></i>Cajeros</a>
                  </li>
                </ul>
              </li>

              <li class="dropdown">
                <a id="Estadisticas" nombre="barraNavegacion" href="{{url('Estadisticas/')}}">
                  <span aria-hidden="true" class="fa fa-fw fa-bar-chart-o"></span>Estadisticas</a>
              </li>

              <li>
                <a id="Tienda" nombre="barraNavegacion" href="{{url('Tienda/')}}">
                <span aria-hidden="true" class="fa fa-fw fa-cart-plus "></span>Tienda</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- fin de la navegación -->

  <div class="modal fade" id="tutModal" role="dialog" >
    <div class="modal-dialog modal-lg" style="min-width: 800px;">
      <div class="modal-content" >
          <div class="modal-body">
            <div class="" >
              <div class="widget-content">
                <div class="form-group">
                   <!-- Add this css File in head tag-->
                  <!--
                  If you want to change #bootstrap-touch-slider id then you have to change Carousel-indicators and Carousel-Control  #bootstrap-touch-slider slide as well
                  Slide effect: slide, fade
                  Text Align: slide_style_center, slide_style_left, slide_style_right
                  Add Text Animation: https://daneden.github.io/animate.css/
                  -->
                <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php if( Auth::User()->estadoTut == 13){ ?>
                          <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
                          <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
                          <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
                          <li data-target="#bootstrap-touch-slider" data-slide-to="3"></li>
                          <li data-target="#bootstrap-touch-slider" data-slide-to="4"></li>
                          <li data-target="#bootstrap-touch-slider" data-slide-to="5"></li>
                        <?php }?>
                    </ol>
                  <!-- Wrapper For Slides -->
                  <div class="carousel-inner" role="listbox">

                    <!-- First Slide -->
                    <?php if( Auth::User()->estadoTut == 0){ ?>
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Proveedores</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>

                    <?php if( Auth::User()->estadoTut == 1){ ?>
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro de proveedores con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <!-- End of Slide -->
                    <!-- Second Slide -->
                    <?php if( Auth::User()->estadoTut == 2){ ?>
                    <div class="item active">
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Categorías</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('usuarios.tutorial')}}" class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 3){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro de categorías con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <!-- End of Slide -->
                    <!-- Third Slide -->
                    <?php if( Auth::User()->estadoTut == 4){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Inventario</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 5){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro del inventario con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <!-- End of Slide -->
                    <?php if( Auth::User()->estadoTut == 6){ ?>
                    <div class="item active">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Productos</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 7){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro de productos con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 8){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro de insumos al producto con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 9){ ?>
                    <div class="item active">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Usuarios</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 10){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro de usuarios con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 11){ ?>
                    <div class="item active">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Mesas</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if( Auth::User()->estadoTut == 12){ ?>
                    <div class="item active">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Registro</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción sobre el registro de mesas con imagen de fondo explicativa de donde se deben registrar etc...</p>
                          <a class="btn btn-default" data-animation="animated fadeInUp" data-dismiss="modal" >
                          Entendido</a>
                          <a href="{{route('usuarios.tutorial')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                     <?php if( Auth::User()->estadoTut == 13){ ?>
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
                    <div class="item">
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Categorías</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('categoria.index')}}" class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Inventario</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('insumo.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <div class="item">
                        <!-- Slide Background -->
                        <!-- Slide Background -->
                        <img src="https://images.pexels.com/photos/207990/pexels-photo-207990.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Bootstrap Touch Slider"  class="slide-image"/>
                        <div class="bs-slider-overlay"></div>
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                          <h1 data-animation="animated zoomInRight">Productos</h1>
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
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
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('Auth.usuario.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
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
                          <p data-animation="animated fadeInLeft">Acá va una descripción</p>
                          <a href="{{route('mesas.index')}}"  class="btn btn-default" data-animation="animated fadeInUp">Ir</a>
                        </div>
                    </div>
                    <?php }?>
                    </div><!-- End of Wrapper For Slides -->
                    <!-- Left Control -->
                    <?php if( Auth::User()->estadoTut == 13){ ?>
                    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                        <span class="fa fa-angle-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <!-- Right Control -->
                    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                        <span class="fa fa-angle-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <?php }?>
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
</div>
  </body>

<script type="text/javascript">

  $(document).ready(function(){
    if({{Auth::User()->estadoTut}} <= 12){
      $('#tutModal').modal('show');
    }
  });

</script>

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


//Initialise Bootstrap Carousel Touch Slider
// Curently there are no option available.
//$('#bootstrap-touch-slider').bsTouchSlider();
</script>

</html>
