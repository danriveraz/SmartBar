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
            <input class="form-control" placeholder="Nombre" type="text">
          </div>
        </div> 
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
            <input class="form-control" placeholder="Nit o Identificacion" type="text">
          </div>
        </div> 
           
        </div>
        <div class="col-md-4">
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-volume-control-phone"></i></span>
            <input class="form-control" placeholder="Telefono" type="text">
          </div>
        </div> 
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            <input class="form-control" placeholder="Direccion" type="text">
          </div>
        </div>     
        </div>
        <div class="col-md-4">
        <div class="invoice-address col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope-open-o"></i></span>
            <input class="form-control" placeholder="Email" type="text">
          </div>
        </div> 
    
        <div class="invoice-address col-md-12" style="aling-items: center;justify-content: center;">
          <div class="input-group" >
            <label class="checkbox"><input type="checkbox"><span>Enviar A Correo en Pdf</span></label>
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
                                       <input type="number" class="numberFact">
                  </div>
                                  <div class="FactPocket col-xs-2 amount text-center">$ <?php echo number_format($producto[4],0,",","."); ?></div>
                                  <div class="FactPocket col-xs-2 amount text-right">$10.000</div>
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
                Subtotal <span>$379.00</span>
              </div>
              <div class="field">
                Iva 19% <span>$0.00</span>
              </div>
              <div class="field grand-total">
                Total <span>$312.00</span>
              </div>
            </div>
</div>




          <div class="factspace1"></div>
          
          <div class="row">
            <div class="col-lg-12">
             
             
             <div class="col-md-6">
             
          <div class="form-group">
            <label class="control-label col-md-4 pull-left">Metodo Pago:</label>
            <div class="col-md-8  pull-right">
              <div class="toggle-switch text-toggle-switch" data-off-label="Tarjeta" data-on="primary" data-on-label="Efectivo" style="width:150px; height: 30px">
                <input checked="" type="checkbox">
              </div>
            </div>
          </div>
                      
              </div>             
             
             <div class="col-md-3"> 
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" placeholder="Efectivo" type="text">
                  </div>
                </div>            
              </div>
             
             <div class="col-md-3"> 
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>
                    <input class="form-control" placeholder="Cambio" type="text">
                  </div>
                </div>            
              </div>
              
             
            </div>
          </div>          
          
          <div class="row">
            <div class="col-lg-12 center">
        <button class="factBot btn btn-bitbucket pull-right"><i class="fa fa-money"></i>Pagar</button>
        <button class=" factBot btn btn-bitbucket pull-right"><i class="fa fa-print"></i>Imprimir</button>
        <button class=" factBot btn btn btn-pinterest pull-right" style="background-color: #999999;"><i class="fa fa-close"></i>Volver</button>

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
    //aqui

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
  for(i=0; i < JSONproductos.length; i++){
    if(JSONproductos[i][0] == idFactura){
      $("#tabla").append('<div class="row item"><div class="col-xs-5 desc" >'+JSONproductos[i][2]+'</div><div class="FactPocket col-xs-2 text-center" >'+JSONproductos[i][3]+'</div><div class="FactPocket col-xs-2 amount text-center">'+ JSONproductos[i][6]+'</div><div class="FactPocket col-xs-2 amount text-center"><input type="number" class="numberFact"></div><div class="FactPocket col-xs-2 amount text-center">$' +formatNumber.new(JSONproductos[i][4])+ ' </div> <div class="FactPocket col-xs-2 amount text-right">$10.000</div></div>');
    }
   // 
  }

}
var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}
</script>          

@endsection