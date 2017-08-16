@extends('Layout.app_empleado')
@section('content')

<!-- Slider -->
@if(sizeof($facturas) == 0)
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">

<div id="first-slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- Item 1 -->
            <div class="item active slide1">
                <div class="row"><div class="container">
                    <div class="col-md-3 text-right">
                        <img style="max-width: 200px;"  data-animation="animated zoomInLeft" src="http://s20.postimg.org/pfmmo6qj1/window_domain.png">
                    </div>
                    <div class="col-md-9 text-left">
                        <h3 data-animation="animated bounceInDown">Oh no!</h3>
                        <h4 data-animation="animated bounceInUp">Me tocaron</h4>             
                     </div>
                </div></div>
             </div> 
            <!-- Item 2 -->
            <div class="item slide2">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown"> 50 animation options A beautiful</h3>
                        <h4 data-animation="animated bounceInUp">Create beautiful slideshows </h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 200px;"  data-animation="animated zoomInLeft" src="http://s20.postimg.org/sp11uneml/rack_server_unlock.png">
                    </div>
                </div></div>
            </div>
            <!-- Item 3 -->
            <div class="item slide3">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown">Simple Bootstrap Carousel</h3>
                        <h4 data-animation="animated bounceInUp">Bootstrap Image Carousel Slider with Animate.css</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 200px;"  data-animation="animated zoomInLeft" src="http://s20.postimg.org/eq8xvxeq5/globe_network.png">
                    </div>     
                </div></div>
            </div>
            <!-- Item 4 -->
            <div class="item slide4">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown">We are creative</h3>
                        <h4 data-animation="animated bounceInUp">Get start your next awesome project</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 200px;"  data-animation="animated zoomInLeft" src="http://s20.postimg.org/9vf8xngel/internet_speed.png">
                    </div>  
                </div></div>
            </div>
            <!-- End Item 4 -->
    
        </div>
        <!-- End Wrapper for slides-->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i><span class="sr-only">Next</span>
        </a>
    </div>
</div>

<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
            
            
        </div>   
    </div>
</footer>
@endif
<!-- fin slider -->

{!!Html::style('stylesheets\mesero.css')!!}
<script type="text/javascript">
  $(window).load(function() {
    cambiarCurrent("#bartender");
      function update(){
        facturas = eval(<?php echo json_encode($facturas);?>);
        if(facturas.total == 0){
          location.reload();
        }
      }   
      setInterval(update, 15000);      
    });

function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};
</script>
<div class="container-fluid main-content"><div class="social-wrapper">
  <div id="social-container">

    <div id="hidden-items"> 
    @foreach($facturas as $factura)
        <div class="item social-widget" nombre="pedidoMesa" id="{{$factura->mesa->id}}">
          <div class="social-data">
            <h1>
              {{$factura->mesa->nombreMesa}}
            </h1>
            <b>
            <?php
              $posiciones = explode(" ", $factura->fecha);
              $hora = explode(":", $posiciones[1]);
            ?>
            {{$hora[0]}}:{{$hora[1]}}<br>{{$posiciones[0]}} 
            </b>
          </div>
        </div>
        <a class="btn btn-primary btn" data-toggle="modal" href="#myModal{{$factura->mesa->id}}" id="boton{{$factura->mesa->id}}" hidden="true"></a>
    @endforeach   
    </div>
  </div>
  </div>
 

 @foreach($facturas as $factura)
  <div class="modal fade" id="myModal{{$factura->mesa->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form name="formulario" autocomplete="on" method="post" action="{{url('bartender/')}}">
            {{csrf_field()}}
        <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button"  style="color:white">&times;</button>
          <h4 class="modal-title">
            {{$factura->mesa->nombreMesa}}
          </h4>
        </div>
        <div class="modal-body">
            <div class="widget-container scrollable list task-widget">
            <div class="heading">
                Pedidos
              </div>
            <div class="widget-content">
              <table  name="tabla" class="table table-hover">
               <thead>
                  <th>Cant.</th>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th width="150">Detalles</th>
                  <th>
                    <div class="btn btn-default"  onclick="seleccionar({{$factura->id}});" style="BACKGROUND-COLOR: rgb(79, 0, 85); color:white" valor="0" id="seleccionarTodos">
                    <i class="fa fa-check"></i>
                    </div>
                  </th>
                </thead>
              @foreach($factura->ventas as $venta)
               <tr>
                  <td>{{$venta->cantidad}}</td>
                  <td>{{$venta->producto->nombre}}</td>
                  <td>{{$venta->producto->categoria->nombre}}</td>
                  <td><a class="btn btn btn-default popover-trigger" data-html="true" data-content="
                  <div>
                    <strong>Ingredientes:</strong>
                    @foreach($venta->producto->contienen as $contiene)
                    <li>{{$contiene->insumo->nombre}}</li>
                    @endforeach
                    <strong>Receta:</strong>
                    <p>{{$venta->producto->receta}}</p>
                  </div>"
                  data-placement="bottom" data-toggle="popover">Receta</a></td>
                  <td>
                  <label>
                  <input type="checkbox" name="pedidos[]" value="{{$venta->id}}" width="25" height="25" class="check{{$factura->id}}" ><span></span></label>
                  </td>
                </tr>
              @endforeach 
              </table>
                <input type="text" hidden="" name="idFactura" value="{{$factura->idFactura}}">
            </div>
            </div>
            </div>
        <div class="modal-footer">
          <button class="btn btn-primary" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Guardar</button>
          <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endforeach 
 

</div>
<script type="text/javascript">
    $("div[nombre|='pedidoMesa']").click(function(){
      var idElegido = $(this).attr("id");
      var palabra = "#boton";
      var id = palabra.concat(idElegido);
      $(id).trigger('click');
    });

    function seleccionar(idMesa){
      var checks = document.getElementsByName("pedidos[]");
      if($("#seleccionarTodos").attr("valor") == "0"){
        for (var i=0; i<checks.length; i++) {
            checks[i].checked = true;
            $("#seleccionarTodos").attr("valor", "1");
        }
      }
      else {
        for (var i=0; i<checks.length; i++) {
            checks[i].checked = false;
            $("#seleccionarTodos").attr("valor", "0");
        }
      }
    }
</script>

<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
{!!Html::style('stylesheets\font-awesome.min.css')!!}
{!!Html::style('stylesheets\isotope.css')!!}
{!!Html::style('stylesheets\fullcalendar.css')!!}

{!!Html::script('javascripts\bootstrap.min.js')!!}
{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\fullcalendar.min.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.isotope.min.js')!!}
{!!Html::script('javascripts\jquery.fancybox.pack.js')!!}
{!!Html::script('javascripts\select2.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}

<!--Slider-->
<style type="text/css">
  /*
Bootstrap Image Carousel Slider with Animate.css
Code snippet by Hashif (http://hashif.com) for Bootsnipp.com
Image credits: unsplash.com
*/
  @import url(https://fonts.googleapis.com/css?family=Quicksand:400,700);

  body {
      font-family: 'Quicksand', sans-serif;
      font-weight:700;
  }
  /********************************/
  /*          Main CSS     */
  /********************************/
  #first-slider .main-container {
    padding: 0;
  }

  #first-slider .slide1 h3, #first-slider .slide2 h3, #first-slider .slide3 h3, #first-slider .slide4 h3{
      color: #fff;
      font-size: 30px;
        text-transform: uppercase;
        font-weight:700;
  }

  #first-slider .slide1 h4,#first-slider .slide2 h4,#first-slider .slide3 h4,#first-slider .slide4 h4{
      color: #fff;
      font-size: 30px;
        text-transform: uppercase;
        font-weight:700;
  }

  #first-slider .slide1 .text-left ,#first-slider .slide3 .text-left{
      padding-left: 40px;
  }

  #first-slider .carousel-indicators {
    bottom: 0;
  }

  #first-slider .carousel-control.right,
  #first-slider .carousel-control.left {
    background-image: none;
  }

  #first-slider .carousel .item {
    min-height: 425px; 
    height: 100%;
    width:100%;
  }

  .carousel-inner .item .container {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
  }

  #first-slider h3{
    animation-delay: 1s;
  }

  #first-slider h4 {
    animation-delay: 2s;
  }

  #first-slider h2 {
    animation-delay: 3s;
  }

  #first-slider .carousel-control {
      width: 6%;
          text-shadow: none;
  }

  #first-slider h1 {
    text-align: center;  
    margin-bottom: 30px;
    font-size: 30px;
    font-weight: bold;
  }

  #first-slider .p {
    padding-top: 125px;
    text-align: center;
  }

  #first-slider .p a {
    text-decoration: underline;
  }

  #first-slider .carousel-indicators li {
      width: 14px;
      height: 14px;
      background-color: rgba(255,255,255,.4);
    border:none;
  }

  #first-slider .carousel-indicators .active{
      width: 16px;
      height: 16px;
      background-color: #fff;
    border:none;
  }

  .carousel-fade .carousel-inner .item {
    -webkit-transition-property: opacity;
    transition-property: opacity;
  }

  .carousel-fade .carousel-inner .item,
  .carousel-fade .carousel-inner .active.left,
  .carousel-fade .carousel-inner .active.right {
    opacity: 0;
  }

  .carousel-fade .carousel-inner .active,
  .carousel-fade .carousel-inner .next.left,
  .carousel-fade .carousel-inner .prev.right {
    opacity: 1;
  }

  .carousel-fade .carousel-inner .next,
  .carousel-fade .carousel-inner .prev,
  .carousel-fade .carousel-inner .active.left,
  .carousel-fade .carousel-inner .active.right {
    left: 0;
    -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
  }

  .carousel-fade .carousel-control {
    z-index: 2;
  }

  .carousel-control .fa-angle-right, .carousel-control .fa-angle-left {
      position: absolute;
      top: 50%;
      z-index: 5;
      display: inline-block;
  }

  .carousel-control .fa-angle-left{
      left: 50%;
      width: 38px;
      height: 38px;
      margin-top: -15px;
      font-size: 30px;
      color: #fff;
      border: 3px solid #ffffff;
      -webkit-border-radius: 23px;
      -moz-border-radius: 23px;
      border-radius: 53px;
  }

  .carousel-control .fa-angle-right{
      right: 50%;
      width: 38px;
      height: 38px;
      margin-top: -15px;
      font-size: 30px;
      color: #fff;
      border: 3px solid #ffffff;
      -webkit-border-radius: 23px;
      -moz-border-radius: 23px;
      border-radius: 53px;
  }

  .carousel-control {
      opacity: 1;
      filter: alpha(opacity=100);
  }

/********************************/
/*       Slides backgrounds     */
/********************************/
  #first-slider .slide1 {
      background-image: url(http://s20.postimg.org/h50tgcuz1/image.jpg);
        background-size: cover;
      background-repeat: no-repeat;
  }

  #first-slider .slide2 {
    background-image: url(http://s20.postimg.org/uxf8bzlql/image.jpg);
        background-size: cover;
      background-repeat: no-repeat;
  }

  #first-slider .slide3 {
    background-image: url(http://s20.postimg.org/el56m97f1/image.jpg);
        background-size: cover;
      background-repeat: no-repeat;
  }

  #first-slider .slide4 {
    background-image: url(http://s20.postimg.org/66pjy66dp/image.jpg);
        background-size: cover;
      background-repeat: no-repeat;
  }

/********************************/
/*          Media Queries       */
/********************************/
  @media screen and (min-width: 980px){
        
  }
  @media screen and (max-width: 640px){
        
  }
</style>

<script type="text/javascript">
  (function( $ ) {
      //Function to animate slider captions 
    function doAnimations( elems ) {
      //Cache the animationend event in a variable
      var animEndEv = 'webkitAnimationEnd animationend';
      
      elems.each(function () {
        var $this = $(this),
          $animationType = $this.data('animation');
        $this.addClass($animationType).one(animEndEv, function () {
          $this.removeClass($animationType);
        });
      });
    }
    //Variables on page load 
    var $myCarousel = $('#carousel-example-generic'),
      $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    //Initialize carousel 
    $myCarousel.carousel();
    //Animate captions in first slide on page load 
    doAnimations($firstAnimatingElems);
    //Pause carousel  
    $myCarousel.carousel('pause');
    //Other slides to be animated on carousel slide event 
    $myCarousel.on('slide.bs.carousel', function (e) {
      var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
      doAnimations($animatingElems);
    });  
      $('#carousel-example-generic').carousel({
          interval:3000,
          pause: "false"
      });
  })(jQuery); 

</script>

@endsection