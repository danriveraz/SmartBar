<!DOCTYPE html>
<html>
  <head>
    <script>
      if (location.protocol != 'https:'){
       location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
      }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
       <link rel="shortcut icon" href="{{asset('images/icon.png')}}">
       <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">

       <!-- VALDIACION TOP BAR  -->
       <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
       {!!Html::style('assets-Internas/css/main.css')!!}
       {!!Html::style('assets-Internas/css/bootstrap.css')!!}
       {!!Html::style('assets-Internas/css/style.css')!!}
       {!!Html::style('assets-Internas/css/font-awesome.min.css')!!}
       {!!Html::style('assets-Internas/css/hightop-font.css')!!}
       {!!Html::style('assets-Internas/css/component-chosen.css')!!}
       {!!Html::style('assets-Internas/css/notification.css')!!}

       <!-- jquery -->
       <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
       <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
       {!!Html::script("assets-Internas/javascripts/bootstrap.min.js")!!}

       <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>
       <!-- FIN VALDIACION TOP BAR -->

       <!-- LO QUE SI ES NECESARIO css -->
       {!!Html::style('stylesheets\select2.css')!!}
       {!!Html::style('stylesheets\jquery.fancybox.css')!!}
       {!!Html::style('stylesheets\isotope.css')!!}
       {!!Html::style('stylesheets\morris.css')!!}

       <!-- LO QUE SI ES NECESARIO js-->
       {!!Html::script("javascripts\jquery.bootstrap.wizard.js")!!}
       {!!Html::script("javascripts/fullcalendar.min.js")!!}
       {!!Html::script("assets-Internas/javascripts/jquery.easy-pie-chart.js")!!}
       {!!Html::script('javascripts\raphael.min.js')!!}
       {!!Html::script("javascripts\morris.min.js")!!}
       {!!Html::script("javascripts\jquery.isotope.min.js")!!}
       {!!Html::script("javascripts\isotope_extras.js")!!}
       {!!Html::script("javascripts\modernizr.custom.js")!!}
       {!!Html::script("javascripts\jquery.fancybox.pack.js")!!}
       {!!Html::script("javascripts\select2.js")!!}
       {!!Html::script("javascripts\jquery.inputmask.min.js")!!}
       {!!Html::script("javascripts\jquery.validate.js")!!}
       {!!Html::script("javascripts\bootstrap-timepicker.js")!!}
       {!!Html::script("javascripts\bootstrap-colorpicker.js")!!}
       {!!Html::script("javascripts\ladda.min.js")!!}
       {!!Html::script("javascripts\daterange-picker.js")!!}
       {!!Html::script("javascripts\date.js")!!}
       {!!Html::script("javascripts/fitvids.js")!!}
       {!!Html::script("assets-Internas/javascripts/jquery.sparkline.min.js")!!}
       {!!Html::script("javascripts\dropzone.js")!!}
       {!!Html::script("javascripts\jquery.nestable.js")!!}
       {!!Html::script("assets-Internas/javascripts/main.js")!!}
       {!!Html::script("javascripts\bootstrap-datepicker.js")!!}
       {!!Html::script('javascripts/upload/fileinput.js')!!}
       {!!Html::script("javascripts\bootstrap-fileupload.js")!!}
       <!-- FIN -->

       <!-- DATATABLES + ICONOS-->
       {!!Html::script("assets-Internas\javascripts\datatable-editable.js")!!}
       {!!Html::script("assets-Internas\javascripts\jquery.dataTables.js")!!}
       <!--{!!Html::script("assets-Internas\javascripts\jquery.dataTables.min.js")!!}-->
       {!!Html::style('assets-Internas\css\datatables.css')!!}

       <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
       <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
       <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
       <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
       <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
       <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

       {!!Html::style('assets-Internas\css\buttons.dataTables.css')!!}
       <!-- FIN -->
       {!!Html::script("assets-Internas/javascripts/bootstrap-button-to-input-file.js")!!}
       {!!Html::style('stylesheets\dropzone.css')!!}
       {!!Html::style('stylesheets\nestable.css')!!}
       {!!Html::style('stylesheets\pygments.css')!!}
       <div class="SpacingHeader"></div>
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

   {!!Html::script('javascripts/upload/fileinput.js')!!}

   <!--SCRIPT PARA PONER DATATABLE RESPONSIVE-->
   <script language="JavaScript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script language="JavaScript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
    {!!Html::style('assets-Internas/css/responsive.bootstrap.css')!!}
   <!--SCRIPT PARA PONER DATATABLE RESPONSIVE-->
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  {!!Html::style('stylesheetspropio\stylePropio.css')!!}
  <!-- fin -->

<style type="text/css">
  .pocketNoti{
            position: absolute;
            top: 5px;
            left: 0px;
            height: 18px;
            min-width: 18px;
            padding: 0 5px;
            border-radius: 9px;
            background: #00c617;
            text-align: center;
            line-height: 17px;
            color: white;
            font-size: 11px; }
</style>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
    <body class="page-header-fixed bg-1 layout-boxed" style="BACKGROUND-COLOR:WHITE">
    <div class="modal-shiftfix">
      <!-- Navegación-->
      <div class="navbar navbar-fixed-top scroll-hide">
          <div class="container-fluid top-bar">
            <div class="pull-right">
              <ul class="nav navbar-nav pull-right">

                <!--mensajes-->
                <li class="dropdown messages hidden-xs">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="hightop-envelope"></span>
                    <div class="sr-only">
                    Messages
                    </div>
                    <p class="counter">
                    3
                    </p>
                  </a>
                  <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
                     <div class="notification-heading"><h4 class="menu-title">Mensajes</h4><h4 class="menu-title pull-right"><a>Ver Todos<i class="glyphicon glyphicon-circle-arrow-right"></i></a></h4>
                     </div>
                    <div class="notifications-wrapper">

                     <a class="content" href="#">
                       <div class="notification-item chatCation">
                     <img src="http://www.leapcms.com/images/100pixels1.gif">
                        <h4 class="item-title">Marcer Diaz <small> 1 day ago</small></h4>
                   <div class="divtext">
                        hola jefe como esta para comunicarle q hoy no puedo trabajardddddddddddddddddddddddddddddddddddddddddddddddddd
                   </div>
                      </div>
                    </a>
                    <a class="content" href="#">
                      <div class="notification-item chatCation">
                    <img src="http://www.leapcms.com/images/100pixels1.gif">
                       <h4 class="item-title">Alvaro Gome <small> 1 day ago</small></h4>
                  <div class="divtext">
                       hola jefe como esta para comunicarle q hoy no puedo trabajardddddddddddddddddddddddddddddddddddddddddddddddddd
                  </div>
                     </div>
                   </a>
                    </div>
                   </ul>
                  </li>
                  <!-- perfil-->
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
  <!-- iconos empleados -->
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              @if(Auth::User()->esMesero)
                <li>
                <a id="mesero" href="{{url('mesero/')}}">
                  <span aria-hidden="true">
                    <img src="{{asset('assets-Internas/images/Layout-icons/mesero.png')}}">
                  </span>
                  <label>Mesero</label>
                </a>
                </li>
              @endif
              @if(Auth::User()->esBartender)
              <li>
              <a id="bartender" href="{{url('bartender/')}}">
                <span aria-hidden="true">
                  <img src="{{asset('assets-Internas/images/Layout-icons/chef-Bartender.png')}}">
                </span>
                <label>Bartender</label></a>
                <p id="aviso1"></p>
              </li>
              @endif
              @if(Auth::User()->esCajero)
              <li class="dropdown">
              <a id="cajero" href="{{url('cajero/')}}">
                <span aria-hidden="true">
                  <img src="{{asset('assets-Internas/images/Layout-icons/cajero.png')}}">
                </span>
                <label>Caja</label></a>
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
