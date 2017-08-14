@extends('Layout.app_empleado')
@section('content')

{!!Html::style('stylesheets\mesero.css')!!}
<script type="text/javascript">
  $(window).load(function() {
      function update(){
        facturas = eval(<?php echo json_encode($facturas);?>);
        if(facturas.total == 0){
          location.reload();
        }
      }   
      setInterval(update, 15000);      
    });
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
              <table class="table table-hover">
               <thead>
                  <th>Cant.</th>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th width="150">Detalles</th>
                  <th><i class="fa fa-check"></i></th>
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
                  <input type="checkbox" name="pedidos[]" value="{{$venta->id}}"" width="25" height="25"><span></span></label>
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
@endsection
