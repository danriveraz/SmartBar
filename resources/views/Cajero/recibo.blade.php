@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
@section('content') 
<script type="text/javascript">
  $(window).load(function() {
      actualizarTotal();     
    });
</script>
<div class="container-fluid main-content">
  <div class="page-title">
    <h1>
      Recibo {{$factura->mesa->nombreMesa}}
    </h1>
  </div>
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
    
    <div class="row">
      <div class="col-lg-12">
        <button class="btn btn-primary pull-right" >Guardar</button>
        <a class="btn btn-primary pull-right" onclick="javascript:window.print();"><i class="fa fa-print"></i>Imprimir</a>
      </div>
    </div>
    </form>
  </div>
</div>
<script>
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
@endsection