@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado');
@section('content')

{!!Html::style('css/content-box.css')!!}
{!!Html::style('stylesheets/invoque/invoice.css')!!}
{!!Html::style('stylesheets/cajero.css')!!}
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">


<div class="container">                   
  <div class="row">
    <div class="col-lg-12">
            
            
           
<!-- inicio-->

<div class="receipt-content">
    <div class="container bootstrap snippet">
    <div class="row">
      <div class="col-md-12">
        <div class="invoice-wrapper">

<!-- inicio de prueba -->

        <div class="row">
          <div class="col-md-3">
              <div class="cover-inside ">
                 <img class="cover-avatar size-md img-round" src="{{'images/bar.png'}}" alt="profile">
              </div>
          </div>
          <div class="col-md-6">

              <div class="factspace text-center">
                <strong class=" text1">
                  {{$user->EmpresaActual->nombreEstablecimiento}}
                </strong>
                <span class="spanR">Nit: {{$user->EmpresaActual->nit}}</span>
                <p>
                  {{$user->EmpresaActual->direccion}} {{$user->EmpresaActual->ciudad}} {{$user->EmpresaActual->departamento}} <br>
                  {{$user->EmpresaActual->telefono}} <br>
                </p>
              </div>
          </div>
          <div class="col-md-3">

              <div class="factspace text-right" >
                <strong class=" text1 text-danger" style="color: #2d0031;" id="mesaActual">
                  Factura No. #
                  @if(sizeof($facturas) == 0)
                    0
                  @else
                  {{$facturas[0]->idBar}}
                  @endif
                </strong>
                <p>
                    <strong>Mesa:</strong>
                        <select class="selectFact numberFact" onchange="cambiarFactura(this.value);">
                           @foreach($facturas as $factura)
                            @if(sizeof($factura->ventasHechas)>0)
                              <option data-idFactura="{{$factura->id}}"  data-idMesaBar="{{$factura->idBar}}" value="{{$factura->mesa->id}}" id="mesas{{$factura->mesa->id}}"
                                data-fecha="<?php  $date = new DateTime($factura->fecha);
                        echo $date->format('M d, Y');
                        ?>" data-hora="<?php echo  $date->format('g:i A'); 
                        ?>"
                        data-mesero="{{$factura->ventasHechas[0]->mesero->nombrePersona}}"
                        data-cajero="{{$factura->ventasHechas[0]->cajero->nombrePersona}}"
                        data-bartender="{{$factura->ventasHechas[0]->bartender->nombrePersona}}"
                        data-idFactura="{{$facturas[0]->id}}">{{$factura->mesa->nombreMesa}} </option>
                            @endif
                          @endforeach
                        </select>
                        <a class="recarga"  title="recargar" href=""><span class="fa fa-fw fa-repeat" title="recargar"></span></a>
                        <br>
                    <span class="spanR" id="fecha"> 
                    <?php   
                      if(sizeof($facturas)!=0){
                        $date = new DateTime($facturas[0]->fecha);
                        echo $date->format('M d, Y');
                        echo " - ". $date->format('g:i A'); 
                      }else{
                        echo "<br>";
                      }
                      ?></span>
                    <span class="label label-danger">Pendiente</span>
                        </p>
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
        
<form name="formulario" autocomplete="on" method="post" action="{{url('cajero/edit')}}">
              {{csrf_field()}}
<div class="divider factspace3"></div>
<div class="row" id="toggle">
<div class="col-md-12 text-center">
  <a class="invoice-client mrg10T pocketMorado" >Información deL Cliente:</a>
              <i class="pocketMorado fa fa-toggle-down"></i>
</div>
</div>

  
    <div class="row plegable">
        <div class="col-md-4">
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
            <input id="nombre" class="form-control" placeholder="Nombre" type="text" name="nombre">
          </div>
        </div> 
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
            <input id="nit" class="form-control" placeholder="Nit o Identificacion" type="text" name="nit">
          </div>
        </div> 
           
        </div>
        <div class="col-md-4">
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-volume-control-phone"></i></span>
            <input id="telefono" class="form-control" placeholder="Telefono" type="text" name="telefono">
          </div>
        </div> 
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            <input id="direccion" class="form-control" placeholder="Direccion" type="text" name="direccion">
          </div>
        </div>     
        </div>
        <div class="col-md-4">
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope-open-o"></i></span>
            <input id="mail" class="form-control" placeholder="Email" type="text" name="mail">
          </div>
        </div> 
    
        <div class="invoice-address col-md-12" style="aling-items: center;justify-content: center;">
          <div class="input-group" >
            <label class="checkbox"><input id="check" type="checkbox" name="enviarCorreo" onchange="activarRequired();"><span>Enviar a correo en Pdf</span></label>
          </div>
        </div>     
    
        </div>
    </div>

<!-- fin de inicio de barra para cliente -->

        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
          
              <div class="col-md-4 text-center">
                <div class="heading" style="color:#9F9F9F;">
                  <i class="fa fa-houzz"></i>Mesero:<span id="mesero">         
                    @if(sizeof($facturas) != 0)
                      {{$facturas[0]->ventasHechas[0]->mesero->nombrePersona}}
                    @endif</span>
                </div>
          <div class="factspace3"></div>
              </div>
              <div class="col-md-4 text-center">
                <div class="heading"  style="color:#9F9F9F;">
                  <i class="fa fa-imdb"></i>Bartender:<span id="bartender"> 
                   @if(sizeof($facturas) != 0)
                      {{$facturas[0]->ventasHechas[0]->bartender->nombrePersona}}
                    @endif</span>
                </div>
          <div class="factspace3"></div>
              </div>
              <div class="col-md-4 text-center">
                <div class="heading"  style="color:#9F9F9F;">
                  <i class="fa fa-imdb"></i>Cajero:<span id="cajero">  @if(sizeof($facturas) != 0)
                      {{$facturas[0]->ventasHechas[0]->cajero->nombrePersona}}
                    @endif</span>
                </div>
          <div class="factspace3"></div>
              </div>
          
              </div>
              </div>
          </div>
<!--  prueba-->

          <div class="line-items">
                    
            <div class="col-lg-12 ">
            <div class="headers clearfix">
              <div class="row">
                <div class="col-xs-5">Producto</div>
                <div class="FactPocket col-xs-2 text-center">Cantidad</div>
                <div class="FactPocket col-xs-2 text-center">Pago</div>
                                <div class="FactPocket col-xs-2 text-center">A Pagar</div>
                                <div class="FactPocket col-xs-2 text-center">V. Unitario</div>
                                <div class="FactPocket col-xs-2 text-center">Total</div>
              </div>
            </div>
            <div class="items" id="tabla">
              @foreach($productos as $producto)
                @if($producto[0] == $facturas[0]->id)
                <div class="row item">
                                <div class="col-xs-5 desc" >{{$producto[2]}}</div>
                  <div class="FactPocket col-xs-2 text-center" >{{$producto[3]}}</div>
                  <div class="FactPocket col-xs-2 amount text-center">{{$producto[6]}}</div>
                                  <div class="FactPocket col-xs-2 amount text-center">
                                    @if($producto[5] != "Cancelado")
                                    <input type="text" hidden="" name="productosId[]" value="{{$producto[1]}}">
                                    <input type="text" hidden="" name="estados[]" id="estado{{$producto[1]}}"
                                    data-estadoActual="{{$producto[6]}}" value="{{$producto[3]}}">
                                       <input name="productos[]" type="number" class="numberFact" max="{{$producto[3] - $producto[6]}}" min="0" id="cantidad{{$producto[1]}}" step="1" onkeyup="validarMinMax('#cantidad{{$producto[1]}}');"  value="{{($producto[3] - $producto[6])}}" data-idVenta="{{$producto[1]}}" data-precio="{{$producto[4]}}">
                                    @else
                                      <input  type="number" class="popover-trigger" readonly value="0"  data-content="<div>Pedido cancelado</div>" data-html="true" data-placement="bottom" data-toggle="popover" style="">
                                    @endif
                  </div>
                                  <div class="FactPocket col-xs-2 amount text-center">$<?php echo number_format($producto[4],0,",","."); ?></div>
                                   @if($producto[5] != "Cancelado")
                                        <div class="FactPocket col-xs-2 amount text-right" id="total{{$producto[1]}}" data-valor="{{$producto[4] * ($producto[3] - $producto[6])}}">$<?php echo number_format($producto[4] * ($producto[3] - $producto[6]
                                    ),0,",","."); ?></div>
                                    @else
                                     <div class="FactPocket col-xs-2 amount text-right" id="total{{$producto[1]}}" data-valor="0">$<?php echo number_format(0,0,",","."); ?></div>
                                    @endif
                                 
                </div>

                @endif
              @endforeach

            </div>
            <div class="total text-right">
              <p class="extra-notes">
                <strong>Notas Adicionales</strong>
                Vive la Vida "a cada instante como si fuera el ultimo de tu vida... Porque la felicidad no llega de afuera, nace desde adentro..."
              </p>
              <div class="field">
                Subtotal <span id="subtotal">$379.00</span>
              </div>
              <div class="field">
                @if($user->EmpresaActual->tipoRegimen == "comun")
                Iva 19% <span id="iva" data-regimen="comun">$0.00</span>
                @else
                <span id="iva" data-regimen="simplificado"></span>
                @endif                
              </div>
              <div class="field grand-total">
                <input type="text" id="valorInput" name="valor" value=0 id="" hidden="" data-valorAntiguo="{{$facturas[0]->total}}"><input type="text" id="idFactura" name="idFactura" value="{{$facturas[0]->id}}" id="" hidden="">
                Total <span id="total" data-total="0">$312.00</span>
              </div>
            </div>
</div>




          <div class="factspace1"></div>
          
          <div class="row">
            <div class="col-lg-12">
             
             
             <div class="col-md-4">
             
          <div class="form-group">
           
            <div class="col-md-8  pull-right">
               <label>Método de Pago:</label>
              <div class="toggle-switch text-toggle-switch" data-off-label="Tarjeta" data-on="primary" data-on-label="Efectivo" style="width:110px; height: 30px">
                <input checked="" type="checkbox">
              </div>
            </div>
          </div>
                      
              </div>             
             
             <div class="col-md-2" style="padding-left: 0px;"> 
                <div class="form-group" style="padding-top: 25px;">
                  <div class="input-group" >
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" placeholder="Propina" onkeyup="validarPropina();" type="text" value="" id="propina" data-propina="0" data-modificacion="false" style="paddin">
                  </div>
                </div>            
              </div>

             <div class="col-md-3"> 
                <div class="form-group">
                  <div class="input-group" style="padding-top: 25px;">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" placeholder="Efectivo" onkeyup="validarEfectivo();" type="text" id="efectivo">
                  </div>
                </div>            
              </div>
             
             <div class="col-md-3"> 
                <div class="form-group" style="padding-top: 25px;">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>
                    <input class="form-control" id="cambio" disabled="" placeholder="Cambio" type="text">
                  </div>
                </div>            
              </div>
              
             
            </div>
          </div>          
          
          <div class="row">
            <div class="col-lg-12 center">
        <button class="factBot btn btn-bitbucket pull-right"><i class="fa fa-money"></i>Pagar</button>
        </form>

        <button class=" factBot btn btn-bitbucket pull-right" onclick="nada();"><i class="fa fa-print"></i>Imprimir</button>
        <button class=" factBot btn btn btn-pinterest pull-right" onclick="nada();" style="background-color: #999999;"><i class="fa fa-close"></i>Volver</button>

            </div>
          </div>
          </div>
        </div>

        <div class="footer">
          Copyright © 2018. Pocket Smartbar
        </div>
      </div>
    </div>
  </div>
</div>                    

<!-- fin -->
    </div>
  </div>
</div>

<script>
  var JSONproductos = eval(<?php echo json_encode($productos); ?>);
  var clic = 0;
  jQuery.fn.animateAuto = function(prop, speed, callback){
    var elem, height, width;
    return this.each(function(i, el){
        el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("body");
        height = elem.css("height"),
        width = elem.css("width"),
        elem.remove();
        
        if(prop === "height")
            el.animate({"height":height}, speed, callback);
        else if(prop === "width")
            el.animate({"width":width}, speed, callback);  
        else if(prop === "both")
            el.animate({"width":width,"height":height}, speed, callback);
    });  
  }
  $(window).ready(function(){
    actualizarTotal();
  $('#toggle').on('click',function(){
      if($(this).next().hasClass('desplegado')){
        $(this).next().removeClass('desplegado').animate({height:0},500);
      }else{
        $(this).next().addClass('desplegado').animateAuto("height",500);
      }
    })
  })

var cambiarFactura = function(id){
  $("#mesaActual").html("Factura No. # "+$("#mesas"+id).data('idmesabar'));
  $("#fecha").html($("#mesas"+id).data('fecha')+" - "+$("#mesas"+id).data('hora'));
  $("#mesero").html(" "+$("#mesas"+id).data('mesero'));
  $("#cajero").html(" "+$("#mesas"+id).data('cajero'));
  $("#bartender").html(" "+$("#mesas"+id).data('bartender'));  
  refrescarTabla(id);
};

function refrescarTabla(id) {
  var capa = $("#tabla");
  capa.empty();
  var idFactura = $("#mesas"+id).data('idfactura');
  $("#idFactura").val(idFactura);
  for(i=0; i < JSONproductos.length; i++){
    if(JSONproductos[i][0] == idFactura){
      var string = "#cantidad"+JSONproductos[i][1];
      if(JSONproductos[i][5] != "Cancelado"){
      $("#tabla").append('<div class="row item"><div class="col-xs-5 desc" >'+JSONproductos[i][2]+'</div><div class="FactPocket col-xs-2 text-center" >'+JSONproductos[i][3]+'</div><div class="FactPocket col-xs-2 amount text-center">'+ JSONproductos[i][6]+'</div><div class="FactPocket col-xs-2 amount text-center"><input type="text" hidden="" name="productosId[]" value="'+JSONproductos[i][1]+'"><input type="text" hidden="" name="estados[]" id="estado'+JSONproductos[i][1]+'" data-estadoActual = "'+JSONproductos[i][5]+'" value="'+ JSONproductos[i][3]+'"><input type="number" class="numberFact" onchange="cambio();" max="'+(JSONproductos[i][3] - JSONproductos[i][6])+'" min="0" id="cantidad'+JSONproductos[i][1]+'" step="1" onkeyup="validarMinMax('+String.fromCharCode(39)+string+String.fromCharCode(39)+');"  value="'+ (JSONproductos[i][3] - JSONproductos[i][6])+'" data-idVenta="'+JSONproductos[i][1]+'" data-precio="'+JSONproductos[i][4]+'"></div><div class="FactPocket col-xs-2 amount text-center">$' +Intl.NumberFormat().format(JSONproductos[i][4])+ ' </div><div class="FactPocket col-xs-2 amount text-right" id="total'+JSONproductos[i][1]+'" data-valor="'+(JSONproductos[i][4]*(JSONproductos[i][3] - JSONproductos[i][6]))+'">$'+Intl.NumberFormat().format(JSONproductos[i][4]*(JSONproductos[i][3] - JSONproductos[i][6]))+'</div></div>');
      }
      else{
        $("#tabla").append('<div class="row item"><div class="col-xs-5 desc" >'+JSONproductos[i][2]+'</div><div class="FactPocket col-xs-2 text-center" >'+JSONproductos[i][3]+'</div><div class="FactPocket col-xs-2 amount text-center">'+ JSONproductos[i][6]+'</div><div class="FactPocket col-xs-2 amount text-center">'+ '<input  type="number" class="popover-trigger" readonly value="0"  data-content="<div>Pedido cancelado</div>" data-html="true" data-placement="bottom" data-toggle="popover">'+'</div><div class="FactPocket col-xs-2 amount text-center">$' +Intl.NumberFormat().format(JSONproductos[i][4])+ ' </div><div class="FactPocket col-xs-2 amount text-right" id="total{{$producto[1]}}" data-valor="0">$'+Intl.NumberFormat().format(0)+'</div></div>');
      }
    }
  }
  $('[data-toggle="popover"]').popover(); 
  document.getElementById("propina").dataset.modificacion="false";
  actualizarTotal();
}

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

$("body").on("mouseenter",".popover-trigger",function(event){
    var num = 1;
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
      if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
        $(this).click();
      }else{
        $(this).click();
        $(this).click();
      }
});

$("body").on("mouseleave",".popover-trigger",function(event){
    var num = 2;
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
      if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
        $(this).click();
      }else{
        $(this).click();
        $(this).click();
      }
});

$("body").on("change",".numberFact",function(event){
    var valor = $(this).val();
    var idNumber = $(this).attr("id");
    var precio = $("#"+idNumber).data('precio');
    var idVenta = $("#"+idNumber).data('idventa');
    var idEstadoCajero = "estado"+idVenta;
    var estadoActual = document.getElementById(idEstadoCajero).dataset.estadoactual;
    $("#"+idEstadoCajero).val(parseInt(valor)+ parseInt(estadoActual));
    $("#total"+idVenta).html("$" + Intl.NumberFormat().format(valor*precio));
    document.getElementById("total"+idVenta).dataset.valor = (valor*precio);
    actualizarTotal();
});

$("body").on("change",".infoClinte",function(event){
    var datos = document.getElementsByClassName("form-control");
    alert(datos.length);
});

function activarRequired(){
    var check = document.getElementById("check");
    if(check.checked){
      document.getElementById("nombre").required;
    }else{

    }
}


function mostrarMensaje(campo, num) {
    //var clase = document.getElementsByClassName("btn btn btn-default popover-trigger");
    //alert(clase.length);
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
    if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
      $(campo).click();
    }else{
      $(campo).click();
      $(campo).click();
    }
    
}
function validarEfectivo() {
    var efectivo = $("#efectivo").val();
    if(efectivo != ""){
      var total = document.getElementById("total").dataset.total;
      var cambio = efectivo - total;    
      $("#cambio").val("$" + Intl.NumberFormat().format(cambio));
    }
    else{
      $("#cambio").val("");
    }
    
}

function validarPropina() {
    document.getElementById("propina").dataset.modificacion= "true";
    document.getElementById("propina").dataset.propina = document.getElementById("propina").value;
    actualizarTotal();
}

function actualizarTotal() {
  var totales = document.getElementsByClassName("FactPocket col-xs-2 amount text-right");
  var acumulador = 0;
  for (i = 0; i < totales.length; i++) {
    acumulador = acumulador + parseInt(totales[i].dataset.valor);
  }
  $("#subtotal").html("$" + Intl.NumberFormat().format(acumulador));
  var campoIva = document.getElementById("iva").dataset.regimen;
  var iva = acumulador*0.19;
  var total = acumulador;
  if(campoIva == "comun"){
    $("#iva").html("$" + Intl.NumberFormat().format(iva));  
  }
  var propina = document.getElementById("propina");
  if(propina.dataset.modificacion == "false"){
    propina.dataset.propina = total*.10;
    propina.value= total*.10;
    total= total+total*.10;
  }else if(propina.value != ""){
    total= total+parseInt(propina.value);
  }
  var totalInput = document.getElementById("valorInput");
  totalInput.value = parseInt(totalInput.dataset.valorantiguo) + total;
  document.getElementById("total").dataset.total = (total);
  $("#total").html("$" + Intl.NumberFormat().format(total));
  validarEfectivo();
}
</script>        

@endsection