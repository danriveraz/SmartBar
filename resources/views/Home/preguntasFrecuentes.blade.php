@extends('Layout.app_principales')
@section('content')

<section class="block bg-pocket gap-top-contact" data-name="ContactHead">
    <div class="block-content no-pad">
        <div class="head-small">        
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        <div class="hide-mobile">
          <img class="head-small-icon" src="{{asset('assets-home/images/head-character.png')}}" alt="¿Tienes dudas?" title="Soporte">
          <div class="head-small-text">
            <h3 class="roboto1 white margin-tiny">¿Tienes dudas?</h3>
            <p class=" margin-tiny">Como tu amigo inseparable, siempre estamos presente para brindarte la mejor asesoria, darte un consejo y solucionar cualquier inquietud o inconveniente, es <span class="bold">Gratis</span>, e Ilimitado.</p>
          </div>
          </div>
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        </div>
    </div>
</section>
<!-- PREGUNTAS FRECUENTES -->
<section class="block" data-name="Faqs">
    <div class="block-content">
        <h2 class="text-center">Preguntas Frecuentes</h2>
        <div class="row cards-basic bg-white">
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Qué quiere decir que SmartBAr está en la Nube?</h3>
                    <p class="margin-tiny">La aplicación funciona desde internet, no tienes que preocuparte por instalaciones, servidores, versiones o por copias de seguridad, todo está guardado y protegido por <a href="https://www.pocketSmartbar.com">SmartBar</a>, para acceder sólo necesitas internet. </p>
                    <p class="margin-tiny">Algunos ejemplos de servicios en la Nube son Dropbox y Facebook.  </p>
                    <p class="margin-tiny">La Nube es la forma más segura de guardar la información, es mucho más seguro que hacerlo en tu computador o en otros medios locales.  </p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Qué debo tener en cuenta antes de empezar?</h3>
                    <p class="margin-tiny">Para utilizar SmartBar simplemente debes registrarte en el sistema, al ingresar encontrarás todas las ayudas necesarias para empezar a elaborar facturas, registrar los gastos, llevar tu inventario, registrar empleados, productos a tu inventario, a tu carta y muchas funciones más. Es muy fácil, la mejor forma de averiguarlo es probarlo, puedes crear tu cuenta <a href="">acá</a></p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Quiénes pueden utilizar SmartBar?</h3>
                    <p class="margin-tiny"><strong>PocketSamrtBar</strong> está diseñado para que todas las personas que son dueños, empleados o clientes de un negocio tipo bar o restaurante, se vean beneficiados con el uso de smartbar, ya que ayudará a todos los usuarios a obtener una mejor esperiencia en el servicio. </p>
                    <p class="margin-tiny">Puedes hacer con Smartbar divertido lo que antes era aburrido y además de esto, Smartbar, te ayudará a llevar el control, haciendo cosas por si solo, contando unicamente con tu aprobación.<a href="">acá</a> o <a href="">crea una cuenta</a>  GRATIS </p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">Si tengo dudas con el uso de mi amigo inseparable Smartbar, ¿quién me ayuda?</h3>
                    <p class="margin-tiny">Nuestro Equipo de Soporte siempre está dispuesto para ayudarte hasta con el mínimo problema, tenemos 5 estrellas de calificación y los usuarios son nuestra prioridad, pruébalo tu mismo <a href="">acá</a>  </p>
                    <p class="margin-tiny">Conoce cómo contactarnos <a href="">aquí</a>.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿SmartBar, puede hacer todas las facturas por mi?</h3>
                    <p class="margin-tiny">SmartBar cumple con todos los requisitos para realizar facturas en Colombia, solo debes solicitar la resolución para facturar por computador a la DIAN si perteneces al régimen común, ya contamos con <a href="">Facturación Electrónica</a> </p>
                    <p class="margin-tiny">Si eres régimen simplificado también puedes generar cuentas de cobro.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Que pasa cuando caduquen mis 7 dias de membresia  gratis?</h3>
                    <p class="margin-tiny">SmartBar cumple con todos los requisitos para realizar facturas en Colombia, solo debes solicitar la resolución para facturar por computador a la DIAN si perteneces al régimen común, ya contamos con <a href="">Facturación Electrónica</a> </p>
                    <p class="margin-tiny">Si eres régimen simplificado también puedes generar cuentas de cobro.</p>
                    <hr>
                </div>
            </div>
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">¿Está segura mi información con mi amigo inseparable SmartBar?</h3>
                    <p>Claro que sí, la información que registres solo será visible para ti y los usuarios autorizados con los correspondientes permisos. La información almacenada en pocketsmartbar se aloja en servidores de Amazon Web Services, una de las mejores plataformas a nivel mundial que realiza copias de seguridad automáticas y es utilizada por empresas como Dropbox, Twitter, La Nasa, Ferrari y muchos más. Tu información está en las mejores manos, Puedes estar tranquilo y ocuparte de hacer crecer tu empresa, de cuidar tu información se encarga tu amigo inseparable SmartBar.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Quién me explica cómo empezar a utilizar SmartBar?</h3>
                    <p>SamrtBar  es una herramienta sencilla y práctica, no se requiere de conocimientos previos. Dentro de la aplicación cuentas con todas las ayudas y explicaciones necesarias para empezar a usarla. Además, el  <a href="">centro de soporte</a>  está disponible para ti las 24 horas del día.</p>
                    <p>Si tienes dudas o inconvenientes contáctanos por soporte y te responderemos lo más pronto posible. Escríbenos o solicita que te llamemos en  <a href="123">www.pocketsmartbar.com</a> </p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Qué características debe tener mi computador?</h3>
                    <p>SmartBar funciona en Internet, no hay restricciones y puedes acceder desde cualquier equipo, lo único que necesitas es una conexión a internet.
También lo puedes usar desde tu celular descargando la aplicación móvil para <a target="_blank" href="">Android</a> o <a target="_blank" href="">iOS</a>. </p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Es SmartBar la solución ideal para mi Negocio?</h3>
                    <p>Tu amigo inseparable Smartbar es un <a href="">sistema inteliegente super completo de gestión,</a> el cual permite, olvidarte para siempre de agendar empleados, de realizar tus pedidos, de descontar d etu inventario los productos que usas, del contrl general d etus empleados y muchas cosas ´más, lo único que tienes que hacer, es analisar la información que te da tu amigo inseparable SmartBar, para tomar las mejores desiciones para tu negocio.</p>
                    <p>Puedes realizar facturas, llevar el control de gastos, inventarios, empleados, pedidos, compras, varios negocios simultaneamente y mucho más. La mejor forma de descubrirlo es <a href="">crear una cuenta</a> y empezar a probar.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">¿Tengo que firmar contrato para empezar a usar mi amigo inseparable SmartBar?</h3>
                    <p>Para usar <strong>tu amigo inseparable SmartBar</strong> no tienes que firmar ningún contrato, solo aceptar las <a href="">condiciones y términos de uso</a>. Cuando te registras y empiezas a usar la herramienta se entiende que estos términos y condiciones son aceptados por ambas partes, el usuario y el equipo de SmartBar.</p>
                    <p>Para empezar a usar <strong>SamrtBar</strong> simplemente creas una cuenta <a href="">aquí</a> al entrar al pocketClub con una de nuestras membresias, obtendrás beneficios nunca antes vistos, como descuentos, regalos, productos unicos y todo lo que necesitas para tu negocio al alcance de tu mano. </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 7 DIAS GRATIS-->
<section class="block" data-name="Plans">
  <div class="block-content text-center" style="padding-top: 0px;">
    <h2 class="margin-tiny">Empieza tus <strong>7 Dias gratis</strong></h2>    
    <p><img class="plan-payment" src="{{asset('assets-home/images/logos-payment-col-pocket.png')}}" alt="Métodos de pago"/></p>
    <p><a class="button large" href="https://pocketsmartbar.com/Auth/register" rel="alternate"><strong>UNIRSE A POCKETCLUB</strong></a></p>
    <hr>
    <div class="pocket">
    <h4>Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4></div>
    <hr>
  </div>
</section>  

@endsection
