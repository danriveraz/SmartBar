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
<link rel="stylesheet" href="stylesheets/styleMesas.css">
<link rel="stylesheet" href="stylesheets/styleCategorias.css">
<link rel="stylesheet" href="stylesheets/mesero.css">
<div class="modal-shiftfix">
  <div id="page-content">
    <main id="mesas" class="cd-main-content">
        <section class="cd-gallery">
          <ul>
            @foreach($facturas as $factura)
              <li class="mix color-2 option3">
                <a nombre="pedidoMesa" id="{{$factura->mesa->id}}" href="#myModal{{$factura->mesa->id}}" data-toggle="modal" >
                  <i class="ocupada"><img src="images/mesa.png"></i>
                  <div class="text-Mesas">{{$factura->mesa->nombreMesa}}<br>Hace
                      <?php   
                        $fecha1 = new DateTime();
                        if(sizeof($factura->ventas)!=0){
                          $fecha1 = new DateTime($factura->ventas[0]->hora);
                        }
                        $fecha2 = new DateTime();//fecha de cierre
                        $intervalo = $fecha1->diff($fecha2);
                        $horas = $intervalo->format('%H');
                        $minutos = $intervalo->format('%i');
                        echo (($horas*60)+$minutos);
                      ?>  mins 
                  </div>
                </a>
              </li>
              <li class="gap" style="width: 0.5%;"></li>
            @endforeach   
             <!-- PARA DAR ESPACIO  NO BORRAR-->
            <li class="gap"></li>
            <!-- PARA DAR ESPACIO NO BORRAR-->

          </ul>
          <div class="cd-fail-message">No se han encontrado resultados</div>
        </section> <!-- cd-gallery -->
      </main>
  </div>
</div>

@foreach($facturas as $factura)
  <div class="modal fade" id="myModal{{$factura->mesa->id}}">
    <div class="modal-dialog" >
      <div class="modal-content">
      <form name="formulario" autocomplete="on" method="post" action="{{url('bartender/edit')}}">
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
                    <div class="btn btn-default"  onclick="seleccionar({{$factura->id}});" style="BACKGROUND-COLOR: rgb(79, 0, 85); color:white; " valor="0" id="seleccionarTodos">
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
                  <td style="padding-left: 20px;">
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

<script src="javascripts/mesero.js"></script>
<script src="javascripts/jquery.mixitup.min.js"></script>
<script src="javascripts/mainMesas.js"></script> 
<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
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
@endsection