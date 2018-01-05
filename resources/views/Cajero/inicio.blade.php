@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado');
@section('content')

{!!Html::style('css/content-box.css')!!}
{!!Html::style('stylesheets/invoque/invoice.css')!!}
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<style type="text/css">
      
.receipt-content .logo a:hover {
  text-decoration: none;
}

.receipt-content .invoice-wrapper {
  background: #FFF;
  /*border: 1px solid #CDD3E2;*/
  box-shadow: 0px 0px 1px #CCC;
  padding: 20px 40px 60px;
  margin-top: 0px;
  border-radius: 4px; 
}

.spanR {
  display: block;
}
.receipt-content .invoice-wrapper .payment-details a {
  display: inline-block;
  margin-top: 0px; 
}

.receipt-content .invoice-wrapper .line-items .print a {
  display: inline-block;
  padding: 13px 13px;
  border-radius: 5px;
  font-size: 13px;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .line-items .print a:hover {
  text-decoration: none;
  border-color: #333;
  color: #333; 
}

.receipt-content {
  background: #FFFFFF; 
}

.numberFact {
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  width: 70%;
  padding: 3px 10px;
  border: 1px solid #b7b7b7;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  font: normal 16px/normal "Times New Roman", Times, serif;
  color: rgba(0,142,198,1);
  -o-text-overflow: clip;
  text-overflow: clip;
  -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
}

.selectFact{
    width: 30%;

  }

.FactPocket{
  width: 11.6%;
  }
  
.text1{
  font-family: "Open Sans", "Helvetica", "Arial", "sans-serif";
  font-size:20px;
  }
  
.text2{
  font-family: 'Roboto', sans-serif;

  font-size:20px;
  }
  
.factBot{
  margin:0 5px 5px 0;
  
  }

.factspace{
  margin-top: 20px;
  
  }
.factspace1{
  margin-top: 30px; 
  }

.factspace3{
  margin-top: 10px;
  
  }
  
      .plegable{
        height:0;
        overflow:hidden;
      }
@media (min-width: 1200px) {
  .receipt-content .container {width: 900px; } 
}

.receipt-content .logo {
  text-align: center;
  margin-top: 50px; 
}

.receipt-content .logo a {
  font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
  font-size: 36px;
  letter-spacing: .1px;
  color: #555;
  font-weight: 300;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .intro {
  line-height: 25px;
  color: #444; 
}

.receipt-content .invoice-wrapper .payment-info {
  margin-top: 25px;
  padding-top: 15px; 
}

.receipt-content .invoice-wrapper .payment-info span {
  color: #A9B0BB; 
}

.receipt-content .invoice-wrapper .payment-info strong {
  display: block;
  color: #444;
  margin-top: 3px; 
}

/* css de la imagen redonda*/
.cover-img {
    display: block;
    min-height: 100%;
    margin: 0 auto;
}

.cover-avatar.size-md {
    width: 150px;
    height: 150px;
border: 5px solid #f0f0f0;
    margin: 0px auto 0;
  }

.cover-inside * {
    line-height: 2;
}
.cover-avatar {
    display: block;
}
.img-round {
border-radius: 100px 100px 100px 100px;
-moz-border-radius: 100px 100px 100px 100px;
-webkit-border-radius: 100px 100px 100px 100px;
}
/* fin de css de la imagen redonda*/




@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-info .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .payment-details {
  margin-top: 0px;
  padding-top: 0px;
  line-height: 22px; 
}


@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-details .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .line-items {
  margin-top: 20px; 
}
.receipt-content .invoice-wrapper .line-items .headers {
  color: #A9B0BB;
  font-size: 13px;
  letter-spacing: .3px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 4px; 
}
.receipt-content .invoice-wrapper .line-items .items {
  margin-top: 8px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 8px; 
}
.receipt-content .invoice-wrapper .line-items .items .item {
  padding: 0px 0;
  color: #696969;
  font-size: 15px; 
}
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item {
  font-size: 13px; } 
}
.receipt-content .invoice-wrapper .line-items .items .item .amount {
  letter-spacing: 0.1px;
  color: #84868A;
  font-size: 16px;
 }
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item .amount {
  font-size: 13px; } 
}

.receipt-content .invoice-wrapper .line-items .total {
  margin-top: 30px; 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes {
  float: left;
  width: 65%;
  text-align: left;
  font-size: 13px;
  color: #7A7A7A;
  line-height: 20px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .total .extra-notes {
  width: 100%;
  margin-bottom: 30px;
  float: none; } 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
  display: block;
  margin-bottom: 5px;
  color: #454545; 
}

.receipt-content .invoice-wrapper .line-items .total .field {
  margin-bottom: 7px;
  font-size: 14px;
  color: #555; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total {
  margin-top: 10px;
  font-size: 16px;
  font-weight: 500; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
  color: #20A720;
  font-size: 16px; 
}

.receipt-content .invoice-wrapper .line-items .total .field span {
  display: inline-block;
  margin-left: 20px;
  min-width: 85px;
  color: #84868A;
  font-size: 15px; 
}

.receipt-content .invoice-wrapper .line-items .print {
  margin-top: 50px;
  text-align: center; 
}



.receipt-content .invoice-wrapper .line-items .print a i {
  margin-right: 3px;
  font-size: 14px; 
}

.receipt-content .footer {
  margin-top: 30px;
  margin-bottom: 30px;
  text-align: center;
  font-size: 12px;
  color: #969CAD; 
}                    
    </style> 

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
                  {{$facturas[0]->empresa->nombreEstablecimiento}}
                </strong>
                <span class="spanR">Nit: {{$facturas[0]->empresa->nit}}</span>
                <p>
                  {{$facturas[0]->empresa->direccion}} {{$facturas[0]->empresa->ciudad}} {{$facturas[0]->empresa->departamento}} <br>
                  {{$facturas[0]->empresa->telefono}} <br>

                </p>
              </div>
          </div>
          <div class="col-md-3">

              <div class="factspace text-right" >
                <strong class=" text1 text-danger" style="color: #2d0031;" id="mesaActual">
                  Factura No. #{{$facturas[0]->idBar}}
                </strong>
                <p>
                                <strong>Mesa:</strong>
                                    <select class="selectFact numberFact">
                                       @foreach($facturas as $factura)
                                        @if(sizeof($factura->ventasHechas)>0)
                                          <option value="{{$factura->mesa->id}}" id="mesas{{$factura->mesa->id}}">{{$factura->mesa->nombreMesa}} </option>
                                        @endif
                                      @endforeach
                                    </select>
                                    <br>
                                <span class="spanR"> 
                                <?php   
                                  $date = new DateTime($factura->fecha);
                                  echo $date->format('M d, Y');
                                  echo " - ". $date->format('g:i A');
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
                  <i class="fa fa-houzz"></i>Mesero:<span> Diego A Fajardo</span>
                </div>
          <div class="factspace3"></div>
              </div>
              <div class="col-md-4 text-center">
                <div class="heading"  style="color:#9F9F9F;">
                  <i class="fa fa-imdb"></i>Bartender:<span> Tatiana Hurtado</span>
                </div>
          <div class="factspace3"></div>
              </div>
              <div class="col-md-4 text-center">
                <div class="heading"  style="color:#9F9F9F;">
                  <i class="fa fa-imdb"></i>Cajero:<span> Alvaro J Diaz</span>
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
            <div class="items">
              <div class="row item">
                              <div class="col-xs-5 desc" >Cerveza club colombia negra</div>
                <div class="FactPocket col-xs-2 text-center" >3</div>
                <div class="FactPocket col-xs-2 amount text-center">2</div>
                                <div class="FactPocket col-xs-2 amount text-center">
                                     <input type="number" class="numberFact">
                </div>
                                <div class="FactPocket col-xs-2 amount text-center">$5000</div>
                                <div class="FactPocket col-xs-2 amount text-right">$10.000</div>
              </div>

              <div class="row item">
                              <div class="col-xs-5 desc" >Cerveza club colombia negra</div>
                <div class="FactPocket col-xs-2 text-center" >3</div>
                <div class="FactPocket col-xs-2 amount text-center">2</div>
                                <div class="FactPocket col-xs-2 amount text-center">
                                     <input type="number" class="numberFact">
                </div>
                                <div class="FactPocket col-xs-2 amount text-center">$5000</div>
                                <div class="FactPocket col-xs-2 amount text-right">$10.000</div>
              </div>

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
  $('#toggle').on('click',function(){
      if($(this).next().hasClass('desplegado')){
        $(this).next().removeClass('desplegado').animate({height:0},500);
      }else{
        $(this).next().addClass('desplegado').animateAuto("height",500);
      }
    })
  })
</script>          

@endsection