@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
@include('flash::message')
<!-- Styles -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab%7CRoboto:300,400" rel="stylesheet"> 

<section class="block" data-name="Plans">
  <div class="block-content text-center">
    <h2>Membresia PocketClub</h2>
    <div class="row plans cards-basic">
      <div class="col plan" id="unica">
          <h2 class="plan-title">ÚNICA</h2>
          <ul>
              <li>Hasta 7 Empleados</li>
              <li>Asesoria de Lunes a Viernes(✓)</li>
              <li>1 sólo negocio</li>
              <li>Promociones Únicas SmartShop</li>
              <li>Uso del programa por 30 días</li>
              <li>Información segura hasta por 90 días</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>No aplica mes GRATIS</li>
              <li>0% de ahorro</li>
              
          </ul>
          <h3 class="plan-price"> $ 99.900 COP/Mes</h3>
          <p>
            10% descuento en pago trimestral.
          </p>
      </div>
      <div class="col plan bg-gray-white" id="especial">
        <h2 class="plan-title">ESPECIAL</h2>
          <ul>
              <li>Hasta 20 Empleados</li>
              <li>Asesoria de Lunes a Sábado (✓)</li>
              <li>Hasta 3 negocios</li>
              <li>Promociones Únicas y especiales SmartShop</li>
              <li>Uso del programa por 6 meses</li>
              <li>Información segura hasta por 1 año</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>El mes 6 es GRATIS</li>
              <li>Ahorra hasta $ 100.000 Cop</li>
              
          </ul>
          <h3 class="plan-price">$ 499.500 COP/Mes</h3>
          <p>
            10% descuento en pago anual.
          </p>
      </div>
      <div class="col plan" id="elite">
          <h2 class="plan-title">ÉLITE</h2>
          <ul>
              <li>Empleados infinitos</li>
              <li>Asesoria de 24/7, 365 días al año (✓)</li>
              <li>Hasta 10 Negocios</li>
              <li>Todas las promociones SmartShop</li>
              <li>Uso del programa por 3 años</li>
              <li>Información segura hasta por 5 años</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>El mes 1, 12,24 y 36 son GRATIS</li>
              <li>Ahorra hasta $ 400.000 Cop</li>
          </ul>
          <h3 class="plan-price">$ 2.998.800 COP/Mes</h3>
          <p>
            Descuento en membresia de $ 198.000 Cop
          </p>
      </div>
    </div>
    <p><img class="plan-payment" src="../../../assetsNew/images/logos-payment-col.png" alt="Métodos de pago"/></p>
    <hr>
    <h4 class="text-gris">Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="http://www.alegra.com/fundaciones" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4>
    <hr>
  </div>
</section>

<!-- Inicio estilos de todo el <section> -->
<style type="text/css">

section{
  background: #fff;
  }

  .bg-gray-white {
      background: #f7f7f7;
  }
  .block-content,.container{max-width:960px;margin:0 auto;width:80%}.row{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;margin-top:1rem;margin-bottom:1rem}.row>:first-child{margin-left:0}.col{-webkit-box-flex:1;-ms-flex:1;flex:1}.col,[class*=" col-"],[class^=col-]{margin-left:4%}.col-1{-webkit-box-flex:1;-ms-flex:1;flex:1}.col-2{-webkit-box-flex:2;-ms-flex:2;flex:2}.col-3{-webkit-box-flex:3;-ms-flex:3;flex:3}.col-4{-webkit-box-flex:4;-ms-flex:4;flex:4}.col-5{-webkit-box-flex:5;-ms-flex:5;flex:5}.col-6{-webkit-box-flex:6;-ms-flex:6;flex:6}.col-7{-webkit-box-flex:7;-ms-flex:7;flex:7}.col-8{-webkit-box-flex:8;-ms-flex:8;flex:8}.col-9{-webkit-box-flex:9;-ms-flex:9;flex:9}.col-10{-webkit-box-flex:10;-ms-flex:10;flex:10}.col-11{-webkit-box-flex:11;-ms-flex:11;flex:11}.col-12{-webkit-box-flex:12;-ms-flex:12;flex:12}

  .block-content,.container{max-width:1120px;padding:5rem 2rem 5rem 2rem;width:100%}

  @media screen and (max-width:768px){
    .block-content,.container{width:100%;padding:1rem 2rem 4rem 2rem}}

  .container-expanded{width:100%;margin:0 auto}.block{overflow:hidden}.block-content{max-width:1120px;padding:5rem 2rem 5rem 2rem;width:100%}@media screen and (max-width:768px){
  
  .block-content{width:100%;padding:1rem 2rem 4rem 2rem}}
  .block .expanded{width:100%;max-width:100%;padding:0}body.show-grid .row{outline:#00eed3 solid 1px}.row.show-grid,.show-grid .row,.show-grid.block-content .row,.show-grid.container .row,.show-grid.container-expanded .row{outline:#00eed3 solid 1px}body.show-grid .col{background:rgba(0,177,157,.2)}.show-grid .col,.show-grid.block-content .col,.show-grid.container .col,.show-grid.container-expanded .col{background:rgba(0,177,157,.2)}.cards{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;overflow:hidden;margin-bottom:2rem}


  @media screen and (max-width:768px){.plan-payment img,img.plan-payment{width:100%}}.feature img{background:#e3ece9;border-radius:50%;-webkit-transition:all .5s;transition:all .5s}.feature:hover img{background:#B9B9B9;}.feature-item{border-bottom:1px solid #e8ebf0;margin-bottom:3rem;padding-bottom:1rem}.feature-item h4{color:#bfcd31;font-size:2rem;margin:.2rem}.feature-item p{color:#58595f;font-size:1.2rem}.feature-item img{width:5.5rem;height:5.5rem;margin-bottom:3rem;float:left;margin-top:1rem;margin-right:2rem}.features-devices h1,.features-devices h2,.features-devices h3,.features-devices h4,.features-devices h5,.features-devices p{margin-bottom:0;margin-top:0;padding:0}.features-devices p{margin-bottom:.4rem}.js-Accordion{margin:0 auto;max-width:70rem}
  .cards-basic .col{margin-left:1%;padding:1rem 2rem;border:1px solid #e8ebf0;color:#58595f}
  .plans ul li{list-style:none;border-bottom:1px solid rgba(232,235,240,.8)}.plan{border-top:4px solid #2d0031!important;color:#58595f}.plan-title{color:#2D0031;font-weight:700}h2.plan-title,h3.plan-title,h4.plan-title{color:#2D0031}.plan-price{font-weight:700;font-size:3rem}

  bg-green a,.bg-green h1,.bg-green h2,.bg-green h3,.bg-green h4,.bg-green h5,.bg-green h6,.bg-green p,.bg-green-semi a,.bg-green-semi h1,.bg-green-semi h2,.bg-green-semi h3,.bg-green-semi h4,.bg-green-semi h5,.bg-green-semi h6,.bg-green-semi p{color:#fff}.bg-green-semi{background:#00c3ad;color:#fff}
  .bg-green-dark{background:#008e79;color:#fff}.bg-green-light{background:#bde3dc}.bg-green-lemon{background:#bfcd31;color:#fff}.bg-blue-dark{background:#606060;color:#fff}.bg-gray{background:#90909a}.bg-gray-dark{background:#58595f}.bg-gray-black{background:#4a4b50}.bg-gray-light{background:#e8ebf0}.bg-gray-white{background:#f7f7f7}.bg-gray-white h1,.bg-gray-white h2,.bg-gray-white h3,.bg-gray-white h4,.bg-gray-white h5,.bg-gray-white h6,.bg-gray-white p{color:#606060}.bg-gray-blue{background:#809bb6}.bg-red{background:#e85e42}.bg-red-dark{background:#bf5037}.bg-red-light{background:#e96f53}.bg-yellow{background:#f99d36}.bg-yellow-dark{background:#da8a2c}.bg-yellow-light{background:#f9d863}.plans ul li{list-style:none;border-bottom:1px solid rgba(232,235,240,.8)}.plan{border-top:4px solid #2d0031!important;color:#58595f}.plan-title{color:#2D0031;font-weight:700}h2.plan-title,h3.plan-title,h4.plan-title{color:#2D0031}.plan-price{font-weight:700;font-size:3rem}

  p{font-family:Roboto,sans-serif;color:#8492a6}
  .serif{font-family:"Roboto Slab",serif;font-weight:regular}
  .bold{font-weight:500!important}ol,ul{padding-left:0;margin-top:0}ol ol,ol ul,ul ol,ul ul{margin:1rem 0 1rem 2rem;font-size:95%}ul{list-style:circle inside}ol{list-style:decimal inside}li{margin-bottom:1rem}
  .table{width:100%;border:none;border-collapse:collapse;border-spacing:0;text-align:left}.table td,.table th{vertical-align:middle;padding:12px 4px}
  .table thead{border-bottom:2px solid #333030}

</style>
<!-- Fin  -->

<!-- Inicio js -->
<script type="text/javascript">
  var JSONplan = eval(<?php echo json_encode($plan); ?>);
  $(document).ready(function(){
    if(JSONplan == 1){
      document.getElementById('especial').style.display = 'none';
      document.getElementById('elite').style.display = 'none';
    }else if(JSONplan == 2){
      document.getElementById('unica').style.display = 'none';
      document.getElementById('elite').style.display = 'none';
    }else{
      document.getElementById('unica').style.display = 'none';
      document.getElementById('especial').style.display = 'none';
    }
  });
</script>
<!-- Fin js-->
@endsection