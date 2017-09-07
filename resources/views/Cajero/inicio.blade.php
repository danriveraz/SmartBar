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

   <div class="bs-example" id="contenedor" style="height: calc(10 * 61px);" >
      <div id="contenedorCategorias" style="height: calc(10 * 61px); overflow: scroll;">
        @foreach($facturas as $factura)
          @if(sizeof($factura->ventasHechas)>0)
            <a data-toggle="tab" href="#tabMesas{{$factura->mesa->id}}" >
              <div id="categoria">
                    {{$factura->mesa->nombreMesa}}
              </div>
            </a>      
          @endif
        @endforeach
      </div>

      <div id="contenedorProductos">
          <div class="tab-content" id="productos" style="height: calc(10 * 61px);">
            @foreach($facturas as $factura)
            @if(sizeof($factura->ventasHechas)>0)
              <div class="tab-pane" id="tabMesas{{$factura->mesa->id}}">
               <div class="invoice">     
                <div class="row">
                  <div class="col-md-">
                    <div class="well">
                      <strong>Datos</strong>
                      <h3>
                        {{$factura->mesa->nombreMesa}}
                      </h3>
                      <p>
                        Fecha: <?php $date = new DateTime($factura->fecha);
                              echo $date->format('Y-m-d'); ?>
                        <br>
                        Hora: <?php $date = new DateTime($factura->fecha);
                              echo $date->format('H:i:s');?>
                        <br>
                        Mesero: {{$factura->ventasHechas[0]->mesero->nombrePersona}}
                        <br>
                        Bartender: {{$factura->ventasHechas[0]->bartender->nombrePersona}}
                        <br>
                      </p>
                    </div>
                  </div>
               
                </div>
              </div>
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
                              <th>Cant. a pagar</i> </th>
                              <th>
                                Producto
                              </th>
                              <th>
                                Cant. total
                              </th>
                              <th>
                                Cant. pagó.
                              </th>
                              <th>
                                Valor unitario
                              </th>
                              <th>
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
                                  <a id="subtotal{{$factura->ventasHechas[0]->id}}" style="color:#2d0031;">$0</a>
                                  <input type="text" name="subtotal" value=0 id="subtotalInput" hidden="">
                                </td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="5">
                                  <h4 class="text-primary" style="color:#2d0031;">
                                    Total
                                  </h4>
                                </td>
                                <td>
                                  <h4 class="text-primary">
                                    <a id="totalt{{$factura->ventasHechas[0]->id}}" value="0" style="color: #2d0031;">$0</a>
                                     <input type="text" name="total" value=0 id="totalInput{{$factura->ventasHechas[0]->id}}" hidden="">
                                     <input type="text" name="idFactura" value="{{$factura->id}}" id="" hidden="">
                                     <input type="text" id="montoAntiguoo{{$factura->ventasHechas[0]->id}}" name="montoAntiguo" value="{{$factura->total}}" id="" hidden="">
                                     <input type="text" id="valorInput{{$factura->ventasHechas[0]->id}}" name="valor" value=0 id="" hidden="">
                                  </h4>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="5">
                                  <strong>Forma de pago:</strong>
                                </td>
                                <td>
                                  <select Style="width:100px" id="formaPago{{$factura->ventasHechas[0]->id}}" class="form-last-name form-control"  onchange="editValor(this.value,{{$factura->ventasHechas[0]->id}});">
                                  <option value="efectivo">Efectivo</option>
                                  <option value="credito">Crédito</option>
                                  <option value="debito">Débito</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="5">
                                  <strong id="textoEfectivo{{$factura->ventasHechas[0]->id}}">Efectivo:</strong>
                                </td>
                                <td>
                                  <input Style="width:100px" type="number" name="" id="efectivo{{$factura->ventasHechas[0]->id}}" class="efectivoNum" onkeyup="validarEfectivo('#efectivo{{$factura->ventasHechas[0]->id}}');" idVenta="{{$factura->ventasHechas[0]->id}}">
                                </td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="5">
                                  <strong id="textoCambio{{$factura->ventasHechas[0]->id}}">Cambio:</strong>
                                </td>
                                <td>
                                  <a id="cambio{{$factura->ventasHechas[0]->id}}" value="0" style="color: #2d0031;" valor=0>$0</a>
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
                      <button class="btn btn-primary pull-right" style="background: #2d0031; border-color:#2d0031;">Guardar</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
                     
              </div>
              @endif
            @endforeach
          </div>
      </div>

  </div>
</div>
 

{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}

<script type="text/javascript">
 $(document).ready(function(){
    cambiarCurrent("#cajero");
    $("#contenedorCategorias a:first-child").click();
    <?php 
      $cantidad = sizeof($facturas);
      $index = 0;
      for($i = 0; $i < sizeof($facturas); $i++){
        if(sizeof($facturas[$i]->ventasHechas)>0){
          $ventas[] = $facturas[$i]->ventasHechas;
        }
      }
    ?>
    var cantidad = <?php echo $cantidad;?>;
    var ventasFacturas = <?php echo json_encode($ventas);?>;
    for (var i = 0; i < cantidad; i++) {
      actualizarTotal(ventasFacturas[i]);
    }    
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
    if(isNaN(valor)){
      $(idInput).val(0);
      valor = 0;
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
    var cantidad = <?php echo $cantidad;?>;
    var ventasFacturas = <?php echo json_encode($ventas);?>;
    for (var i = 0; i < cantidad; i++) {
      actualizarTotal(ventasFacturas[i]);
    } 
});
 function validarEfectivo(idInput) {
    var valor = parseInt($(idInput).val()); 
    if (valor < 0){
        $(idInput).val(0);
        valor = 0;
    }
    if(isNaN(valor)){
      $(idInput).val(0);
      valor = 0;
    }
    var id = $(idInput).attr("idVenta");
    var total = $("#totalInput"+id).val();
    var resultado = valor - total;
    $("#cambio"+id).html("$" + Intl.NumberFormat().format(resultado));

};
function actualizarTotal(ventas) {
  var total = 0;
  for (var i=0; i< ventas.length; i++)
  {
    var precio = parseInt($("#cantidad"+ventas[i].id).attr("precioUnitario"));
    var cantidad = parseInt($("#cantidad"+ventas[i].id).val());
    total = total + (cantidad*precio);
  }
  var montoAntiguo = parseInt($("#montoAntiguoo"+ventas[0].id).attr("value"));
  $("#totalInput"+ventas[0].id).val(total);
  $("#valorInput"+ventas[0].id).val(total + montoAntiguo);
  $("#subtotal"+ventas[0].id).html("$" + Intl.NumberFormat().format(total));
  $("#totalt"+ventas[0].id).html("$" + Intl.NumberFormat().format(total));
}
 var editValor = function(x,id){
    if(x != 'efectivo'){
      document.getElementById('textoEfectivo'+id).style.display='none';
      document.getElementById('efectivo'+id).style.display='none';
      document.getElementById('textoCambio'+id).style.display='none';
      document.getElementById('cambio'+id).style.display='none';
     }else{
      document.getElementById('textoEfectivo'+id).style.display='block';
      document.getElementById('efectivo'+id).style.display='block';
      document.getElementById('textoCambio'+id).style.display='block';
      document.getElementById('cambio'+id).style.display='block';
    }
  };
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