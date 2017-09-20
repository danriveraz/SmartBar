@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
@section('content')

<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
{!!Html::style('stylesheets\bootstrap.min.css')!!}
{!!Html::style('stylesheets\font-awesome.min.css')!!}
{!!Html::style('stylesheets\select2.css')!!}
{!!Html::style('stylesheets\bootstrap-switch.css')!!}
{!!Html::style('stylesheets\social-buttons.css')!!}
{!!Html::style('stylesheets\jquery.fileupload-ui.css')!!}
{!!Html::style('stylesheets\style.css')!!}
{!!Html::style('stylesheets\invoque/invoice.css')!!}
{!!Html::style('stylesheets\invoque/utils.css')!!}
{!!Html::style('stylesheets\invoque/layout.css')!!}
 
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"> 
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>



<div id="page-content">
  <div class="container">                   
    <div class="row">
      <div class="col-lg-12">
        <div class="row invoice-header">
          <div class="col-md-6">
            <h2>Facturar Mesa</h2>
          </div>
          <div class="col-md-6 float-right">
            <div class="form-group">
              <label class="control-label col-md-2"></label>
              <div class="col-md-7 float-right">
                <select class="select2able" onchange="editValor(this.value);" >
                  @foreach($facturas as $factura)
                    @if(sizeof($factura->ventasHechas)>0)
                      <option value="{{$factura->mesa->id}}" id="mesas{{$factura->mesa->id}}">{{$factura->mesa->nombreMesa}} </option>
                    @endif
                  @endforeach
                </select>
                <div id="contenedorMesas">
                  @foreach($facturas as $factura)
                    @if(sizeof($factura->ventasHechas)>0)
                      <a id="myButton{{$factura->mesa->id}}" data-toggle="tab" href="#tabMesas{{$factura->mesa->id}}" hidden=""></a>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="tab-content" id="productos">
  @foreach($facturas as $factura)
  @if(sizeof($factura->ventasHechas)>0)
    <div class="tab-pane"  class=" widget-container content-box pad25A" id="tabMesas{{$factura->mesa->id}}">
    <div class="row">
        <div class="col-sm-8">
            <div class="dummy-logo">
                logo de tu compañia
            </div>
            <address class="invoice-address text-center">
                Blanck and White Cra 16 No. 24 -45 B/Principe
                <br>
                Telefono 2300745 - 3152348574
                <br>
                Tulua, Valle
            </address>
        </div>
        <div class="col-sm-4 float-right text-right">       
          <h4 class="invoice-title"><b>Factura</b></h4>
            No. <b>#{{$factura->id}}</b>
            <div class="invoice-date mrg20B">
                  <?php $date = new DateTime($factura->fecha);
                    echo $date->format('d F Y'); ?>
            </div>
            <div class="divider"></div>
              <a class="btn btn-bitbucket pull-right" onclick="javascript:window.print();"><i class="fa fa-print"></i>Imprimir Factura</a>
              <a class="btn btn-danger pull-right" onclick="javascript:window.print();"><i class="fa fa-times"></i>Cancelar Factura</a>
        </div>
    </div>

    <div class="divider"></div>

    <div class="row">
        <div class="col-md-4">
            <h2 class="invoice-client mrg10T">Información deL Cliente:</h2>
        <div class="invoice-address col-md-10">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input class="form-control" placeholder="Nombre" type="text">
          </div>
        </div> 
        <div class="invoice-address col-md-10">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
            <input class="form-control" placeholder="Telefono de  Contacto" type="text">
          </div>
        </div> 
        <div class="invoice-address col-md-10">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
            <input class="form-control" placeholder="Direccion De Residencia" type="text">
          </div>
        </div> 
             
        </div>
        <div class="col-md-4">
            <h2 class="invoice-client mrg10T">Información de la orden:</h2>
            <ul class="reset-ul">
                <li><b>Datos:</b> <?php $date = new DateTime($factura->fecha);
                    echo $date->format('d F Y'); ?></li>
                <li><b>Estado:</b><span class="label label-danger">{{$factura->estado}}</span></li>
                <li>            
      Tipo de Pago:
          <div class="toggle-switch text-toggle-switch" data-off-label="Efectivo" data-on="primary" data-on-label="Tarjeta" style="width:200px; height: 27px">
                <input checked="" type="checkbox">
          </div></li>
            </ul>
        </div>
        <div class="col-md-4">
            <h2 class="invoice-client mrg10T">Detalles de la orden:</h2>
            <address class="invoice-address">
                <b>Mesero:</b>{{$factura->ventasHechas[0]->mesero->nombrePersona}}. 
                <b>Bartender:</b>{{$factura->ventasHechas[0]->bartender->nombrePersona}}.

                <b>Bartender:</b>{{$factura->ventasHechas[0]->bartender->nombrePersona}}.
                <b>Cajero:</b>{{$factura->ventasHechas[0]->cajero->nombrePersona}}.
                <b>Mesa:</b>No.{{$factura->mesa->idMesa}}
            </address>

        </div>
    </div>

      <!-- inicio de tabla de factura -->
      <div class="container-fluid main-content">
        <form name="formulario" autocomplete="on" method="post" action="{{url('cajero/edit')}}">
              {{csrf_field()}}
        <div class="invoice">
          <div class="row">
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                  <table class="table table-striped invoice-table">
                    <thead> 
                      <th>
                        Producto
                      </th>
                      <th width="70">
                        Cantidad
                      </th>
                      <th style="width: 70px">
                        Cant. Pagada
                      </th>
                      <th style="width: 90px">
                        Cant.A Pagar
                      </th>
                      <th  class="text-center" width="100">
                        V. Unitario
                      </th>
                      <th width="120">
                        Total
                      </th>
                    </thead>
                    <tbody>
                      @foreach($factura->ventasHechas as $venta)
                      <tr>
                        <td>
                          {{$venta->producto->nombre}}
                        </td>
                        <td class="text-center">
                          {{$venta->cantidad}}
                        </td>
                        <td class="text-center">
                          {{$venta->estadoCajero}}
                        </td>
                        <td class="text-center" style="width: 50px">
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
                        <td class="text-center">
                          $ <?php echo number_format($venta->producto->precio,0,",","."); ?>
                        </td>
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
                          <strong>Impuesto 19%</strong>
                        </td>
                        <td id="iva{{$factura->ventasHechas[0]->id}}" style="color:#2d0031;">$0</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="5">
                          <h4 class="text-primary" style="color: red;">
                            Total
                          </h4>
                        </td>
                        <td>
                          <h4 class="text-primary">
                            <a id="totalt{{$factura->ventasHechas[0]->id}}" value="0" style="color:  red;">$0</a>
                             <input type="text" name="total" value=0 id="totalInput{{$factura->ventasHechas[0]->id}}" hidden="">
                             <input type="text" name="idFactura" value="{{$factura->id}}" id="" hidden="">
                             <input type="text" id="montoAntiguoo{{$factura->ventasHechas[0]->id}}" name="montoAntiguo" value="{{$factura->total}}" id="" hidden="">
                             <input type="text" id="valorInput{{$factura->ventasHechas[0]->id}}" name="valor" value=0 id="" hidden="">
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
             <div class="col-md-3"> </div>
             
             <div class="col-md-3"> 
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" placeholder="Efectivo" type="text" id="efectivo{{$factura->ventasHechas[0]->id}}" class="efectivoNum" onkeyup="validarEfectivo('#efectivo{{$factura->ventasHechas[0]->id}}');" idVenta="{{$factura->ventasHechas[0]->id}}">
                  </div>
                </div>            
              </div>
             
             <div class="col-md-3"> 
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>
                    <input class="form-control" placeholder="Cambio" type="text" id="cambio{{$factura->ventasHechas[0]->id}}" value="$0" style="color: #2d0031;" valor=0>
                  </div>
                </div>            
              </div>
              
             <div class="col-md-3"> </div>


            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <button class="btn btn-bitbucket pull-right" onclick=""><i class="fa fa-money"></i>Pagar</button>
            </div>
          </div>
        </div>
      </form>
      </div>
     <!-- fin de inicio de tabla de factura --> 



    </div>
  @endif
  @endforeach
</div>
</div>
</div>
<script>
   $(document).ready(function(){
    cambiarCurrent("#cajero");
    $("#contenedorMesas a:first-child").click();
    
    <?php 
      $cantidad = sizeof($facturas);
      $index = 0;
      $ventas[] = null;
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
  function printInvoice() {
    window.print();
  }
  var editValor = function(id){
    var palabra = "#myButton";
    var idA = palabra.concat(id);
    $(idA).trigger("click");
  };
function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};
  
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
    $("#cambio"+id).val("$" + Intl.NumberFormat().format(resultado));
};
function actualizarTotal(ventas) {
  var total = 0;
  var iva = 0;
  for (var i=0; i< ventas.length; i++)
  {
    var precio = parseInt($("#cantidad"+ventas[i].id).attr("precioUnitario"));
    var cantidad = parseInt($("#cantidad"+ventas[i].id).val());
    total = total + (cantidad*precio);
  }
  iva = total*.19;
  var montoAntiguo = parseInt($("#montoAntiguoo"+ventas[0].id).attr("value"));
  $("#totalInput"+ventas[0].id).val(total);
  $("#valorInput"+ventas[0].id).val(total + montoAntiguo);
  $("#subtotal"+ventas[0].id).html("$" + Intl.NumberFormat().format(total-iva));
  $("#iva"+ventas[0].id).html("$" + Intl.NumberFormat().format(iva));
  $("#totalt"+ventas[0].id).html("$" + Intl.NumberFormat().format(total));
}

</script>


@endsection