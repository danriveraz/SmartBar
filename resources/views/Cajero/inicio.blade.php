@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
{!!Html::style('stylesheets\mesero.css')!!}


<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle" align="center">
      <h3><B>CAJA</B></h3>
  </div>

  <div id="message">
    @if(Session::has('error_msg'))
      <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{Session::get('error_msg')}}
      </div>
    @endif
   </div>

   <div class="bs-example" id="contenedor" style="height: calc(7 * 61px);" >
      <div id="contenedorCategorias" style="height: calc(7 * 61px); overflow: scroll;">
        @foreach($mesas as $mesa)
            <a data-toggle="tab" href="#tabMesas{{$mesa->id}}" >
              <div id="categoria">
                    {{$mesa->nombreMesa}}
              </div>
            </a>      
        @endforeach
      </div>

      <div id="contenedorProductos">
          <div class="tab-content" id="productos">
            @foreach($mesas as $mesa)
              <div class="tab-pane" id="tabMesas{{$mesa->id}}">
                <table class="table table-striped" id="tablaProductos">
                  <thead>
                    <th width="120px">Estado</th>
                    <th width="120px">Fecha</th>
                    <th width="120px">Hora</th>
                    <th width="120px">Total</th>
                    <th width="120px">Mesero</th>
                    <th width="120px">Bartender</th>
                   </thead>
                   <tbody style="height: calc(7 * 49px);">
                     @foreach($facturas as $factura)
                        @if($factura->idMesa == $mesa->id and sizeof($factura->ventasHechas) != 0)
                        <tr id="{{$factura->id}}" class="seleccionar">
                          <td width="120px">{{$factura->estado}}</td>
                          <td  width="120px">
                              <?php $date = new DateTime($factura->fecha);
                              echo $date->format('Y-m-d'); ?>
                          </td>
                          <td width="120px">
                              <?php $date = new DateTime($factura->fecha);
                              echo $date->format('H:i:s');?>
                          </td>
                          <td width="120px">{{$factura->total}}</td>
                          <td width="120px">{{$factura->ventasHechas[0]->mesero->nombrePersona}}</td>
                          <td  width="120px"> {{$factura->ventasHechas[0]->bartender->nombrePersona}}</td>
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
                </table>
              </div>
            @endforeach
          </div>
      </div>

  </div>
</div>


@foreach($facturas as $factura)
  <div class="modal fade" id="myModal{{$factura->id}}">
    <div class="modal-dialog" style="min-width: 800px;">
      <div class="modal-content">
        <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button"  style="color:white">&times;</button>
          <h4 class="modal-title">
            {{$factura->mesa->nombreMesa}}
          </h4>
        </div>
        <div class="modal-body">
            <div class="heading">
                
            </div>
            <div class="widget-content">
              <div class="container-fluid main-content">
                <div class="invoice">
                <form name="formulario" autocomplete="on" method="post" action="{{url('cajero/edit')}}">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="widget-container fluid-height">
                        <div class="widget-content padded clearfix">
                          <table class="table table-striped invoice-table">
                            <thead>
                              <th width="50">Cant. a pagar</i> </th>
                              <th>
                                Producto
                              </th>
                              <th width="70">
                                Cant. total
                              </th>
                              <th width="70">
                                Cant. pagó.
                              </th>
                              <th width="120">
                                Valor unitario
                              </th>
                              <th width="120">
                                Total
                              </th>
                            </thead>
                            <tbody>
                              @foreach($factura->ventasHechas as $venta)
                              <tr>
                                <td>
                                <input type="text" hidden="" name="productosId[]" value="{{$venta->id}}">
                                <input type="text" hidden="" name="estados[]" id="estado{{$venta->id}}"
                                estadoActual = "{{$venta->estadoCajero}}" value={{$venta->cantidad}}>
                                @if($venta->estadoMesero == "Cancelado")
                                  <input name="productos[]" class="cantidadSeleccionada" max=0 id="cantidad{{$venta->id}}" type="number" min="0" step="1" onkeyup="validarMinMax('#cantidad{{$venta->id}}');" value="{{($venta->cantidad - $venta->estadoCajero)}}" Style="width:50px" idVenta = "{{$venta->id}}" precioUnitario="{{$venta->producto->precio}}" disabled="" />
                                @endif
                                @if($venta->estadoMesero != "Cancelado")
                                  <input name="productos[]" class="cantidadSeleccionada" max="{{($venta->cantidad - $venta->estadoCajero)}}" id="cantidad{{$venta->id}}" type="number" min="0" step="1" onkeyup="validarMinMax('#cantidad{{$venta->id}}');" value="{{($venta->cantidad - $venta->estadoCajero)}}" Style="width:50px" idVenta = "{{$venta->id}}" precioUnitario="{{$venta->producto->precio}}"  />
                                @endif
                                
                                  </td>                  
                                <td>{{$venta->producto->nombre}}</td>
                                <td>{{$venta->cantidad}}</td>
                                <td>{{$venta->estadoCajero}}</td>
                                <td> $ <?php echo number_format($venta->producto->precio,0,",","."); ?></td>
                                <td id="total{{$venta->id}}"> $ <?php echo number_format($venta->producto->precio * ($venta->cantidad - $venta->estadoCajero),0,",","."); ?></td>
                              </tr>
                              @endforeach 
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="text-right" colspan="5">
                                  <strong>Subtotal</strong>
                                </td>
                                <td>
                                  <a id="subtotal">$0</a>
                                  <input type="text" name="subtotal" value=0 id="subtotalInput" hidden="">
                                </td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="5">
                                  <h4 class="text-primary">
                                    Total
                                  </h4>
                                </td>
                                <td>
                                  <h4 class="text-primary">
                                    <a id="total" value="0">$0</a>
                                     <input type="text" name="total" value=0 id="totalInput" hidden="">
                                     <input type="text" name="idFactura" value="{{$factura->id}}" id="" hidden="">
                                     <input type="text" id="montoAntiguoo" name="montoAntiguo" value="{{$factura->total}}" id="" hidden="">
                                     <input type="text" id="valorInput" name="valor" value=0 id="" hidden="">
                                  </h4>
                                </td>
                              </tr>
                            </tfoot>
                          </table>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal"  style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick="modificar({{$mesa->id}})">Guardar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach 

   

{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}

<script type="text/javascript">
 $(document).ready(function(){
    cambiarCurrent("#cajero");
    actualizarTotal();
  });
function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};
  function scrollZero(){
    $('#tablaProductos tbody').scrollTop(0);
  };
  $(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    var palabra = "#myModal";
    var id = palabra.concat(idElegido);
    $(id).modal();
});
  function validarMinMax(idInput) {
    var valor = parseInt($(idInput).val());
    var max = parseInt($(idInput).attr("max"));
    if(valor > max) {
        $(idInput).val(max);
    } 
    if (valor < 0){
        $(idInput).val(0);
    }
};
$(".cantidadSeleccionada").on( 'change', function() {
    var cantidadNueva = parseInt($(this).val());
    var id = "#total"+$(this).attr("idVenta");
    var id2 = "#estado"+$(this).attr("idVenta");
    var cantidadEstado = parseInt($(id2).attr("estadoActual"));
    var precioUnitario =  parseInt($(this).attr("precioUnitario"));
    $(id2).val(cantidadNueva+cantidadEstado);
    $(id).html("$" + Intl.NumberFormat().format(cantidadNueva * precioUnitario));
    actualizarTotal();
});
function actualizarTotal() {
  facturas = eval(<?php echo json_encode($factura->ventasHechas);?>);
  var total = 0;
  for (var i=0; i< facturas.length; i++)
  {
    var precio = parseInt($("#cantidad"+facturas[i].id).attr("precioUnitario"));
    var cantidad = parseInt($("#cantidad"+facturas[i].id).val());
    total = total + (cantidad*precio);
  }
  var montoAntiguo = parseInt($("#montoAntiguoo").attr("value"));
  $("#totalInput").val(total);
  $("#valorInput").val(total + montoAntiguo);
  $("#subtotal").html("$" + Intl.NumberFormat().format(total));
  $("#total").html("$" + Intl.NumberFormat().format(total));
}
</script>
<style type="text/css">
  ::-webkit-scrollbar { 
    display: none; 
}
#content browser {
  overflow:-moz-scrollbars-none;
 overflow:-moz-hidden-unscrollable;
}
</style>
@endsection