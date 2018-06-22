@extends('Layout.app_principales')
@section('content')

<section class="block bg-pocket gap-top-contact" data-name="ContactHead">
    <div class="block-content no-pad">
        <div class="head-small">        
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        <div class="hide-mobile">
          <img class="head-small-icon" src="{{asset('assets-home/images/head-character.png')}}" alt="¿Tienes dudas?" title="Soporte">
          <div class="head-small-text">
            <h3 class="roboto1 white margin-tiny">Que es el PocketClub?</h3>
            <p class=" margin-tiny">Como tu amigo inseparable, siempre estoy presente para hacer la vida de tus empleados, proveedores y clientes mucho más fácil, por ende <span class="bold">ESTAR EN TU NEGOCIO</span>, es lo mejor para todos!</p>
          </div>
          </div>
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        </div>
    </div>
</section>
<!-- PLANES -->
<section class="block" data-name="Plans">
  <div class="block-content text-center">
    <h2>Membresias PocketClub</h2>
    <div class="row plans cards-basic">
      <div class="col plan">
          <h2 class="plan-title">ÚNICA</h2>
          <ul>
              <li>Hasta 10 Empleados</li>
              <li>Asesoria Permanente(✓)</li>
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
      <div class="col plan bg-gray">

          <h2 class="plan-title">ÉLITE</h2>
          <ul>
              <li>Empleados Infinitos</li>
              <li>Asesoria Permanente (✓)</li>
              <li>Hasta 4 Negocios</li>
              <li>Todas las promociones SmartShop</li>
              <li>Uso del programa por 3 años</li>
              <li>Información segura hasta por 4 años</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>Personaje Real Smartbar GRATIS</li>
              <li>El mes 1, 12,24 y 36 son GRATIS</li>
              <li>CAPACITACIÓN PROFESIONAL GRATIS (Servicio al Cliente)</li>
              <li>Ahorra hasta $ 400.000 Cop</li>
          </ul>

          <h3 class="plan-price">$ 2.998.800 COP</h3>
          <p>
            Descuento en membresia de $ 198.000 Cop
          </p>
          
      </div>
      <div class="col plan">
                <h2 class="plan-title">ESPECIAL</h2>
          <ul>
              <li>Hasta 20 Empleados</li>
              <li>Asesoria Permanente (✓)</li>
              <li>Hasta 2 negocios</li>
              <li>Promociones Únicas y especiales SmartShop</li>
              <li>Uso del programa por 6 meses</li>
              <li>Información segura hasta por 1 año</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>El mes 6 es GRATIS</li>
              <li>Ahorra hasta $ 100.000 Cop</li>
              
          </ul>
          <h3 class="plan-price">$ 499.500 COP</h3>
          <p>
            10% descuento en pago anual.
          </p>

      </div>
    </div>
    <p><img class="plan-payment" src="{{asset('assets-home/images/logos-payment-col-pocket.png')}}" alt="Métodos de pago"/></p>
    <p><a class="button large" href="http://pocketsmartbar.com/Auth/register" rel="alternate"><strong>UNIRSE A POCKETCLUB</strong></a></p>
    <hr>
  <div class="pocket">
    <h4>Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas.</h4></div>
    <hr>
  </div>
</section>    
<!-- DESCARGAR APPS 
<section class="block " data-name="DownloadApps">
    <div class="block-content text-center">
        <h4 class="margin-tiny">Muy pronto descarga nuestra aplicación móvil</h4>
        <!-- Descargar para iOS
        <a href="" target="_blank" rel="alternate">
            <img src="assets/images/button-ios.png" alt="Descargar Sistema de Facturación emprendedores" width="250" height="82">
        </a>
        <!-- Descargar para Android
        <a href="" target="_blank" rel="alternate">
            <img src="assets/images/button-android.png" alt="Descargar Software Contable Pequeñas empresas" width="250" height="82">
        </a>
    </div>
</section>-->
<!-- PREGUNTAS FRECUENTES -->
<section class="block" data-name="Faqs">
    <div class="block-content" style="padding-top: 0px;">
        <h2 class="text-center">Lo que debes saber de nuestras membresias</h2>
        <div class="row cards-basic bg-white">
            <div class="col bg-gray-white">
                <div class="pocketClub">
                    <h3 class="text-green margin-tiny">¿Cómo funciona el Demo de 7 días?</h3>
                    <p class="margin-tiny">Durante 7 días podrás utilizar SMARTBAR con todas sus funciones, crear una cuenta solo toma minutos y transcurridos los 7 días debes seleccionar el plan que utilizaras, para conservar tu información y la ayuda de tu compañero inseparable</p>
                    <hr>
                </div>
                <div class="pocketClub">
                    <h3 class="text-green margin-tiny">¿Cuándo puedo Cancelar mi Plan?</h3>
                    <p class="margin-tiny">El plan que hayas seleccionado se puede cancelar en cualquier momento, no hay cláusulas de permanencia o contratos a largo plazo. Para cancelar tu plan simplemente escríbenos en cancelaciones@pocketsmartbar.com</p>
                    <hr>
                </div>
            </div>
            <div class="col bg-gray-white">
                <div class="pocketClub">
                    <h3 class="text-green margin-tiny">¿Puedo cambiar de Plan en cualquier momento?</h3>
                    <p>Puedes cambiar de Plan cada mes si así lo requieres, simplemente unete al club con una nueva membresia y listo! </p>
                    <hr>
                </div>
                <div class="pocketClub">
                    <h3 class="text-green margin-tiny">Aún tengo preguntas</h3>
                    <p>Consulta nuestra sección de Preguntas Frecuentes o la Ayuda de la aplicación. Si quieres hablar con el equipo SmartBar, chatea con nosotros en nuestro chat online</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- PIE DE PÁGINA -->

<!-- logos -->

@endsection