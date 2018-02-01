@extends('Layout.app_principales')
@section('content')

<!-- PÁGINA ACTUAL -->
<br>
<br>

<!-- PLANES -->
<section class="block" data-name="Plans">
  <div class="block-content text-center">
    <h2>Membresias PocketClub</h2>
    <div class="row plans cards-basic">
      <div class="col plan">
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
      <div class="col plan bg-gray-white">
        <h2 class="plan-title">ESPECIAL</h2>
          <ul>
              <li>Hasta 20 Empleados</li>
              <li>Asesoria de Lunes a Sábado (✓)</li>
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
      <div class="col plan">
          <h2 class="plan-title">ÉLITE</h2>
          <ul>
              <li>Empleados infinitos</li>
              <li>Asesoria de 24/7, 365 días al año (✓)</li>
              <li>Hasta 4 Negocios</li>
              <li>Todas las promociones SmartShop</li>
              <li>Uso del programa por 3 años</li>
              <li>Información segura hasta por 5 años</li>
              <li>Acceso al 100% de las utilidades SmartBar</li>
              <li>El mes 1, 12,24 y 36 son GRATIS</li>
              <li>Ahorra hasta $ 400.000 Cop</li>
          </ul>
          <h3 class="plan-price">$ 2.998.800 COP</h3>
          <p>
            Descuento en membresia de $ 198.000 Cop
          </p>
      </div>
    </div>
    <p><img class="plan-payment" src="assetsNew/images/logos-payment-col.png" alt="Métodos de pago"/></p>
    <p><a class="button large" href="{{ url('Auth/register') }}" target="_blank" rel="alternate">UNIRTE A <strong>POCKETCLUB</strong></a></p>
    <hr>
    <h4 class="text-gris">Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4>
    <hr>
  </div>
</section>


<!-- SOPORTE  -->
<section class="block " data-name="Support">
    <div class="block-content no-pad text-center">
      <h3 class="hide">¡SmartBar te Asesora!</h3>
      <h4 class="margin-tiny text-Morado">Si necesitas ayuda contáctanos en <a class=" text-gris" rel="alternate">Nuestro chat en linea</a></h4>
    </div>
</section>


<!-- PREGUNTAS FRECUENTES -->
<section class="block" data-name="Faqs">
    <div class="block-content">
        <h2 class="text-center">Lo que debes saber de nuestras membresias</h2>
        <div class="row cards-basic bg-white">
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Cómo funciona el Demo de 7 días?</h3>
                    <p class="margin-tiny">Durante 7 días podrás utilizar SMARTBAR con todas sus funciones, crear una cuenta solo toma minutos y transcurridos los 7 días debes seleccionar el plan que utilizaras, para conservar tu información y la ayuda de tu compañero inseparable</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Cuándo puedo Cancelar mi Plan?</h3>
                    <p class="margin-tiny">El plan que hayas seleccionado se puede cancelar en cualquier momento, no hay cláusulas de permanencia o contratos a largo plazo. Para cancelar tu plan simplemente escríbenos en cancelaciones@pocketsmartbar.com</p>
                    <hr>
                </div>
            </div>
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Puedo cambiar de Plan en cualquier momento?</h3>
                    <p>Puedes cambiar de Plan cada mes si así lo requieres, simplemente unete al club con una nueva membresia y listo! </p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">Aún tengo preguntas</h3>
                    <p>Consulta nuestra sección de Preguntas Frecuentes o la Ayuda de la aplicación. Si quieres hablar con el equipo SmartBar, chatea con nosotros en nuestro chat online</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- REGISTRO -->
<section class="block" data-name="Register">
    <div class="block-content text-center">
        <h2 class="margin-tiny">Empieza tus <strong>7 dias gratis</strong></h2>
        <h4 class="margin-tiny">Prueba todas las características de tu amigo SMARTBAR y sin limitaciones</h4>
      <p><a class="button large" href="{{ url('Auth/register') }}" rel="alternate"><strong>INGRESA YA!</strong></a></p>
    </div>
</section>


<!-- PIE DE PÁGINA -->

<!-- logos -->

@endsection