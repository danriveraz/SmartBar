@extends('Layout.app')
@section('content') 
 
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
                <th width="50"><i class="fa fa-check"></i> </th>
                <th>
                  Producto
                </th>
                <th width="70">
                  Cant.
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
                  <td><input class="micheckbox" type="checkbox" name="productos[]" value="{{$venta->id}}" monto="{{$venta->producto->precio*$venta->cantidad}}"></td>
                  <td>{{$venta->producto->nombre}}</td>
                  <td>{{$venta->cantidad}}</td>
                  <td> $ <?php echo number_format($venta->producto->precio,0,",","."); ?></td>
                  <td> $ <?php echo number_format($venta->producto->precio * $venta->cantidad,0,",","."); ?></td>
                  <td><input type="number" min="0" max="5" step="1" readonly="" />
</td>
                </tr>
                @endforeach 
              </tbody>
              <tfoot>
                <tr>
                  <td class="text-right" colspan="4">
                    <strong>Subtotal</strong>
                  </td>
                  <td>
                    <a id="subtotal">$0</a>
                    <input type="text" name="subtotal" value=0 id="subtotalInput" hidden="">
                  </td>
                </tr>
                <tr>
                  <td class="text-right" colspan="4">
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
$(".micheckbox").on( 'change', function() {
    if( $(this).is(':checked') ) {
        var montoAntiguo = parseInt($("#montoAntiguoo").attr("value"));
        var montoSuma = parseInt($(this).attr("monto"));
        var montoActual = parseInt($("#subtotalInput").val());
        var suma = (montoActual+montoSuma);
        $("#subtotalInput").val(suma);
        $("#totalInput").val(suma);
        $("#valorInput").val(suma + montoAntiguo);
        $("#subtotal").html("$" + Intl.NumberFormat().format(suma));
        $("#total").html("$" + Intl.NumberFormat().format(suma));
    } else {
        var montoSuma = parseInt($(this).attr("monto"));
        var montoActual = parseInt($("#subtotalInput").val());
        var resta = (montoActual-montoSuma);
        $("#subtotalInput").val(resta);
        $("#subtotal").html("$" + Intl.NumberFormat().format(resta));
        $("#total").html("$" + Intl.NumberFormat().format(resta));
    }
});
</script>
@endsection