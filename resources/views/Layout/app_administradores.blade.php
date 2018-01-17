<!DOCTYPE html>
<html>
<head>
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
    {!!Html::style('stylesheets\select2.css')!!}
    {!!Html::style('stylesheets\datatables.css')!!}
    {!!Html::style('stylesheets\bootstrap.css')!!}
    {!!Html::style('stylesheets/font-awesome.min.css')!!}
    {!!Html::style('stylesheets/hightop-font.css')!!}
    {!!Html::style('stylesheets/bootstrap-select.css')!!}
    {!!Html::style('stylesheets\isotope.css')!!}
    {!!Html::style('stylesheets\jquery.fancybox.css')!!}
    {!!Html::style('stylesheets\fullcalendar.css')!!}
    {!!Html::style('stylesheets\wizard.css')!!}
    {!!Html::style('stylesheets\morris.css')!!}
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
     
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

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
  {!!Html::script("javascripts\select2.js")!!}
  {!!Html::script("javascripts\datatable-editable.js")!!}
  {!!Html::script("javascripts\jquery.dataTables.js")!!}
  {!!Html::script("javascripts\bootstrap.min.js")!!}
  {!!Html::script("javascripts/bootstrap-select.js")!!}
  {!!Html::script("javascripts\jquery.bootstrap.wizard.js")!!}
  {!!Html::script("javascripts/fullcalendar.min.js")!!}
  {!!Html::script("javascripts\gcal.js")!!}
  {!!Html::script("javascripts\jquery.dataTables.min.js")!!}
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
  <!-- errores croppie -->
  <!-- 
  {!!Html::script('croppie/croppie.js')!!}
  {!!Html::script('croppie/upload.js')!!} -->
  {!!Html::script('javascripts/upload/plugins/sortable.js')!!}
  {!!Html::script('javascripts/upload/fileinput.js')!!}
  {!!Html::script('javascripts/upload/locales/fr.js')!!}
  {!!Html::script('javascripts/upload/locales/es.js')!!}
  {!!Html::script('javascripts/upload/theme.js')!!}
  <!-- 
  {!!Html::style('croppie/croppie.css')!!}
  -->
  {!!Html::style('stylesheets/upload/fileinput.css')!!}
  {!!Html::style('stylesheets/upload/theme.css')!!}

  <!-- ascrip y css de menu -->

  {!!Html::style('stylesheets/menu/bootstrap-submenu.css')!!}
  {!!Html::script('javascripts/menu/bootstrap-submenu.min.js')!!}

  <!-- ascrip y css de menu -->

  <!-- para el perfil -->
  {!!Html::style('stylesheets/profile.css')!!}
  {!!Html::style('assets/vendor/linearicons/style.css')!!}
  {!!Html::style('assets/vendor/metisMenu/metisMenu.css')!!}
  {!!Html::style('assets/vendor/chartist/css/chartist.min.css')!!}
  {!!Html::style('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')!!}
  {!!Html::style('assets/vendor/toastr/toastr.min.css')!!}

  {!!Html::style('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')!!}
  {!!Html::script('assets/vendor/chartist/js/chartist.min.js')!!}

  {!!Html::script('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')!!}
  {!!Html::script('assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js')!!}
  {!!Html::script('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js')!!}
  {!!Html::script('assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js')!!}
  {!!Html::script('assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js')!!}
  {!!Html::script('assets/vendor/toastr/toastr.js')!!}
  <!-- MAIN CSS -->

  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->


  {!!Html::style('stylesheetspropio\stylePropio.css')!!}
  <!-- fin -->


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
                  <span aria-hidden="true" class="fa fa-fw fa-bar-chart-o">
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
