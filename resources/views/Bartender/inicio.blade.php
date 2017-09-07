@extends('Layout.app_empleado')
@section('content')

<!-- Slider -->
@if(sizeof($facturas) == 0)
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
{!!Html::style('css/sliderBartender.css')!!}

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
                    
                    <div class="col-md-9 text-left">
                        <h3 data-animation="animated bounceInDown">Lo nuevo en mixología,</h3>
                        <h4 data-animation="animated bounceInUp">Lo tienes con SMARTBAR</h4>             
                     </div>
                     <div>
                     <iframe width="560" height="315" src="https://www.youtube.com/embed/fn6hCcPS2Z0?autoplay=1" frameborder="0" allowfullscreen></iframe></div>
                </div>
                </div>
             </div> 
            <!-- Item 2 -->
            <div class="item slide2">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown"> <b>Cócteles Únicos </b> </h3>
                        <h4 data-animation="animated bounceInUp">Ideas innovadoras todo el tiempo</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 700px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/Slider-bartender/0.png') }}">
                    </div>
                </div></div>
            </div>
            <!-- Item 3 -->
            <div class="item slide3">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown">Conoce los Nuevos licores</h3>
                        <h4 data-animation="animated bounceInUp">Mejora tus mezclas con ellos</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 500px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/Slider-bartender/2.png') }}">
                    </div>     
                </div></div>
            </div>
            <!-- Item 4 -->
            <div class="item slide4">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown">Ingresa a nuestra tienda</h3>
                        <h4 data-animation="animated bounceInUp">Conoce todo lo que tenemos para ti</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 700px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/Slider-bartender/3.png') }}">
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

{!!Html::style('stylesheets\bartender.css')!!}
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