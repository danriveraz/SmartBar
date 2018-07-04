<!DOCTYPE html>
<html>
<head>
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      SMARTBAR
    </title>
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}">
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">

    <!-- VALDIACION TOP BAR  -->
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
    {!!Html::style('assets-Internas/css/main.css')!!}
    {!!Html::style('assets-Internas/css/bootstrap.css')!!}
    {!!Html::style('assets-Internas/css/style.css')!!}
    
    <!-- style font font-awesome hightop-font -->
    {!!Html::style('assets-Internas/css/font-awesome.min.css')!!}
    {!!Html::style('assets-Internas/css/hightop-font.css')!!}
    <!-- ascrip y css de menu -->
   
    <!-- estylos para multiselect -->
    {!!Html::style('assets-Internas/css/component-chosen.css')!!}
    

    <!-- jquery -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

    {!!Html::script("assets-Internas/javascripts/jquery.easy-pie-chart.js")!!}
    {!!Html::script("assets-Internas/javascripts/jquery.sparkline.min.js")!!}
    {!!Html::script("assets-Internas/javascripts/bootstrap.min.js")!!}
    <!-- FIN VALDIACION TOP BAR -->

    <!-- LO QUE SI ES NECESARIO css -->
    {!!Html::style('stylesheets\select2.css')!!}
    <!-- FIN-->

    <!-- LO QUE SI ES NECESARIO js-->
    {!!Html::script("javascripts\select2.js")!!}
    {!!Html::script("javascripts/fullcalendar.min.js")!!}
    {!!Html::script("javascripts\daterange-picker.js")!!}
    {!!Html::script("javascripts\date.js")!!}
    {!!Html::script("javascripts\bootstrap-datepicker.js")!!}
    {!!Html::script("javascripts\bootstrap-timepicker.js")!!}
    {!!Html::script("javascripts\bootstrap-colorpicker.js")!!}
    {!!Html::script("javascripts/fitvids.js")!!}
    {!!Html::script("javascripts\modernizr.custom.js")!!}
    {!!Html::script("javascripts\ladda.min.js")!!}
    {!!Html::script("javascripts\dropzone.js")!!}
    {!!Html::script("javascripts\jquery.nestable.js")!!}
    {!!Html::script('javascripts/upload/fileinput.js')!!}
    {!!Html::script("javascripts\jquery.bootstrap.wizard.js")!!}
    {!!Html::script("javascripts\jquery.isotope.min.js")!!}
    {!!Html::script("javascripts\jquery.fancybox.pack.js")!!}
    <!-- FIN -->

    <!-- DATATABLES + ICONOS-->
    {!!Html::script("assets-Internas\javascripts\datatable-editable.js")!!}
    {!!Html::script("assets-Internas\javascripts\jquery.dataTables.js")!!}
    {!!Html::script("assets-Internas\javascripts\jquery.dataTables.min.js")!!}
    {!!Html::style('assets-Internas\css\datatables.css')!!}

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

    {!!Html::style('assets-Internas\css\buttons.dataTables.css')!!}
    <!-- FIN -->

    {!!Html::script("assets-Internas/javascripts/main.js")!!}
    <!-- -->

    <!-- scrip y style para select multiple-->
    {!!Html::script("assets-Internas/javascripts/bootstrap-button-to-input-file.js")!!}

    <!-- 
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
    -->


    <!-- SUBIR IMAGENES -->

    <!-- 
    {!!Html::style('stylesheets\jquery.fileupload-ui.css')!!}
    
    {!!Html::style('stylesheets\dropzone.css')!!}
    {!!Html::style('stylesheets\nestable.css')!!}
    {!!Html::style('stylesheets\pygments.css')!!}
    -->
    <!-- NO BORRAR-->
    <!-- {!!Html::style('stylesheets/style.css')!!} -->

    <!--
    {!!Html::style('stylesheets\color\green.css')!!}
    {!!Html::style('stylesheets\color\orange.css')!!}
    {!!Html::style('stylesheets\color\magenta.css')!!}
    {!!Html::style('stylesheets\color\gray.css')!!}
    -->

    <!-- 
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    -->
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


  <!-- PRIMORDIALES --><!--
  {!!Html::script("javascripts\bootstrap.min.js")!!}
  {!!Html::script("javascripts\select2.js")!!}
  {!!Html::script('javascripts\main.js')!!}
  {!!Html::script("javascripts\jquery.fancybox.pack.js")!!}-->

  <!-- AFECTA SI SE QUITA --><!--
  {!!Html::script("javascripts\jquery.easy-pie-chart.js")!!} 
  {!!Html::script("javascripts\jquery.isotope.min.js")!!}-->

  <!-- BOOTSTRAP --><!--
  {!!Html::script("javascripts\bootstrap-select.js")!!}
  {!!Html::script("javascripts\jquery.bootstrap.wizard.js")!!}
  {!!Html::script("javascripts\bootstrap-datepicker.js")!!}
  {!!Html::script("javascripts\bootstrap-timepicker.js")!!}
  {!!Html::script("javascripts\bootstrap-colorpicker.js")!!}
  {!!Html::script("javascripts\bootstrap-switch.min.js")!!}
  {!!Html::script('javascripts\bootstrap-editable.min.js')!!}-->

  <!-- DATATABLES --><!--
  {!!Html::script("javascripts\datatable-editable.js")!!}
  {!!Html::script("javascripts\jquery.dataTables.js")!!}-->
  <!-- VERSION MIN DE DATATABLES.JS -->
  <!-- {!!Html::script("javascripts\jquery.dataTables.min.js")!!}--> 


  <!-- FULL CALENDAR Y DATE JS'S--> <!--
  {!!Html::script("javascripts/fullcalendar.min.js")!!}
  {!!Html::script("javascripts\daterange-picker.js")!!}
  {!!Html::script("javascripts\date.js")!!}-->
  
  <!-- SUBIR IMAGENES --><!--
  {!!Html::script("javascripts\bootstrap-fileupload.js")!!}-->


  <!-- GRAFICOS --><!--
  {!!Html::script('javascripts\excanvas.min.js')!!}
  {!!Html::script('javascripts\raphael.min.js')!!}
  {!!Html::script("javascripts\morris.min.js")!!}-->
  <!--
  {!!Html::script("javascripts\isotope_extras.js")!!}
  {!!Html::script("javascripts\jquery.inputmask.min.js")!!}
  {!!Html::script("javascripts\jquery.validate.js")!!}
  {!!Html::script("javascripts\ladda.min.js")!!}
  {!!Html::script("javascripts\mockjax.js")!!}
  {!!Html::script("javascripts/fitvids.js")!!}
  {!!Html::script("javascripts\jquery.sparkline.min.js")!!}
  {!!Html::script("javascripts\dropzone.js")!!}
  {!!Html::script("javascripts\jquery.nestable.js")!!}
  {!!Html::script('javascripts\jquery.vmap.min.js')!!}-->
  <!-- FIN AFECTA SI SE QUITA -->

  <!-- APARENTEMENTE NO AFECTA SI SE QUITA -->
  <!--
  {!!Html::script("javascripts\gcal.js")!!}
  {!!Html::script("javascripts\modernizr.custom.js")!!}
  {!!Html::script("javascripts\styleswitcher.js")!!}
  {!!Html::script("javascripts\wysiwyg.js")!!}
  {!!Html::script("javascripts/typeahead.js")!!}
  {!!Html::script("javascripts\summernote.min.js")!!}
  {!!Html::script("javascripts\spin.min.js")!!}
  {!!Html::script("javascripts\moment.js")!!}
  
  {!!Html::script("javascripts\skycons.js")!!}
  {!!Html::script('javascripts\respond.js')!!}
  
  {!!Html::script('javascripts\selectivizr-min.js')!!}
  {!!Html::script('javascripts\jquery.mousewheel.js')!!}
  {!!Html::script('javascripts\jquery.vmap.sampledata.js')!!}
  {!!Html::script('javascripts\jquery.vmap.world.js')!!}
  {!!Html::script('javascripts\xeditable-demo-mock.js')!!}
  {!!Html::script('javascripts\xeditable-demo.js')!!}
  {!!Html::script('javascripts\address.js')!!}
  -->
  <!-- FIN APARENTEMENTE NO AFECTA SI SE QUITA -->
  
  
  <!-- ERRORES CROPPIE -->
  <!-- {!!Html::script('croppie/croppie.js')!!} -->
  <!-- {!!Html::script('croppie/upload.js')!!} -->
  <!-- {!!Html::style('croppie/croppie.css')!!} -->
  

  <!-- UPLOAD --><!--
  {!!Html::script('javascripts/upload/plugins/sortable.js')!!}
  {!!Html::script('javascripts/upload/fileinput.js')!!}
  {!!Html::script('javascripts/upload/locales/fr.js')!!}
  {!!Html::script('javascripts/upload/locales/es.js')!!}
  {!!Html::script('javascripts/upload/theme.js')!!}
  
  {!!Html::style('stylesheets/upload/fileinput.css')!!}
  {!!Html::style('stylesheets/upload/theme.css')!!}-->
  <!-- FIN UPLOAD -->


  <!-- ascrip y css de menu --><!--
  {!!Html::style('stylesheets/menu/bootstrap-submenu.css')!!}
  {!!Html::script('javascripts/menu/bootstrap-submenu.min.js')!!}-->
  <!-- ascrip y css de menu -->

  <!-- PARA EL PERFIL-->
  <!--FALTAN ALGUNOS ESTILOS, EL LAYOUT OPTIMIZADO NO SIRVE AÚN PARA EL PERFIL--><!--
  {!!Html::style('assets/css/main.css')!!}
  {!!Html::style('stylesheets/profile.css')!!}

  {!!Html::style('assets/vendor/linearicons/style.css')!!}
  {!!Html::style('assets/vendor/metisMenu/metisMenu.css')!!}

  {!!Html::style('assets/vendor/toastr/toastr.min.css')!!}

  {!!Html::style('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')!!}


  {!!Html::script('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')!!}
  {!!Html::script('assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js')!!}

  {!!Html::script('assets/vendor/toastr/toastr.js')!!}-->
  <!-- MAIN CSS --><!--
  {!!Html::style('stylesheetspropio\stylePropio.css')!!}-->
  <!-- FIN PARA EL PERFIL -->


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
                    <span aria-hidden="true" class="hightop-flag"></span>
                    <div class="sr-only">
                      Notifications
                    </div>
                    <p class="counter">
                      4
                    </p>
                  </a>
                  <!-- NOTIFICACIONES -->
                  <ul class="dropdown-menu">
                    
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
                </li>
                <li class="dropdown user hidden-xs">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  {{ HTML::image('images/admins/'.Auth::User()->imagenPerfil , 'avatar', array( 'width' => '34', 'height'=>'34')) }} <label>{{Auth::User()->nombrePersona}}</label><b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="{{route('Auth.usuario.edit', Auth::id())}}">
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
            <div class="logo">
              <a href="{{url('/')}}"> <img src="{{asset('assets-Internas/images/logo.png')}}"> </a>
            </div>
          </div>
          <div class="container-fluid main-nav clearfix">
            <div class="nav-collapse">
              <ul class="nav">
               <li class="dropdown">
                <a data-toggle="dropdown" href="">
                  <span aria-hidden="true" class="fa fa-5x fa-reorder">
                  </span><label>{{Auth::User()->EmpresaActual->nombreEstablecimiento}}</label><b class="caret">
                  </b>
                </a>
                  <ul class="dropdown-menu">
                    @foreach( Auth::User()->empresas  as $empresa)
                      @if($empresa->nombreEstablecimiento != Auth::User()->EmpresaActual->nombreEstablecimiento)
                      <li>
                          <a onclick="cambiarBar({{$empresa->id}});" valor="">
                            <i class="fa fa-reorder pull-left"></i>
                            {{$empresa->nombreEstablecimiento}}
                          </a>
                      </li>
                      @endif
                    @endforeach
                  </ul>
                </li>

                <li>
                  <a id="miPersonal" href={{url("/Auth/usuario")}}>
                    <span aria-hidden="true" class="fa fa-fw fa-users">
                    </span><label>Mi Personal</label></a>
                </li>

                <li>
                  <a id="miCarta" href="{{route('producto.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-square">
                    </span><label>Mi Carta</label></a>
                </li>

                <li>
                  <a id="miInventario" href="{{route('insumo.index')}}">
                    <span aria-hidden="true" class="fa fa-fw fa-scribd">
                    </span><label>Mi Inventario</label></a>
                </li>

                <li>
                  <a id="informacion" href="{{url('Estadisticas/')}}">
                  <span aria-hidden="true" class="fa fa-fw fa-line-chart">
                  </span><label>Informacion</label></a>
                </li>

                <li>
                  <a id="smartShop" href="">
                  <span aria-hidden="true" class="fa fa-fw fa-cart-plus ">
                  </span><label>SmartShop</label></a>
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
  <!-- Smartsupp Live Chat script -->
  <script type="text/javascript">
  var _smartsupp = _smartsupp || {};
  _smartsupp.key = '15d63f5166d34952519b49507e22c761deb5e5b2';
  window.smartsupp||(function(d) {
    var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
    s=d.getElementsByTagName('script')[0];c=d.createElement('script');
    c.type='text/javascript';c.charset='utf-8';c.async=true;
    c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
  })(document);
  </script> 
</html>
