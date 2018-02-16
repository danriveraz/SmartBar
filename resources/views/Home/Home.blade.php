@extends('Layout.app_principales')
@section('content')

<!-- ENCABEZADO -->
<section class="block bg-gray-light" data-name="Hero">
  <div class="hero" style="background-image: url('assetsNew/images/Found-Pocket.jpg" target="_blank')">
    <div class="hero-content overlay-mobile">
      <div class="hero-message">
        <div class="hero-text-right">
          <!-- Text -->
          <h1 class="h1Prin"><b>¡Felicidad!</b></h1>
          <p class="P1Prin"><b>Es tener un amigo inseparable Smartbar,<br>
            para hacer mil cosas por ti...</b>
          </p>

          <!-- Buttons -->

          <a class="button large" href="{{ url('Auth/register') }}" rel="nofollow">REGISTRATE</a><br>
           <span class="textpar"><b>7 DIAS GRATIS</b></span>
           <section class="content">
        <div class="hero-login bg-cover">

   <br>
            <p class="P1Prin">
               <small class="socialRed">Síguenos en nuestras redes sociales</small><br> 
                <a title="Twitter" style="background-color:#ffff;" class="button-circle" href="https://twitter.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <path fill="#2d0031" d="M35,17.9949748 C34.2270821,18.3335138 33.3977523,18.563107 32.5263881,18.6656082 C33.4161102,18.1389582 34.0971701,17.3036174 34.4199598,16.3113025 C33.58538,16.7990143 32.6641579,17.1531556 31.6825779,17.3451334 C30.8965521,16.516271 29.7785062,16 28.5384061,16 C26.1592944,16 24.2302765,17.9067872 24.2302765,20.2571923 C24.2302765,20.5905417 24.2683305,20.9161238 24.3418306,21.2274602 C20.762011,21.0497281 17.5876774,19.3543879 15.4631396,16.7782562 C15.0917616,17.4060847 14.8804916,18.1376354 14.8804916,18.9185372 C14.8804916,20.3959861 15.6416056,21.6996035 16.7964016,22.4622912 C16.0903956,22.4389554 15.4263896,22.2469776 14.8450798,21.9278739 L14.8450798,21.9810578 C14.8450798,24.0434962 16.3305577,25.764784 18.3002374,26.1565408 C17.9393594,26.2525297 17.5588195,26.3057137 17.1651375,26.3057137 C16.8869557,26.3057137 16.6179357,26.2784772 16.3541656,26.2265822 C16.9026714,27.9193446 18.4931495,29.1503089 20.3775594,29.1840577 C18.9038855,30.3255454 17.0457256,31.0039461 15.0274919,31.0039461 C14.679756,31.0039461 14.3372358,30.983188 14,30.9455726 C15.9067139,32.1558128 18.1703598,32.8614499 20.6032755,32.8614499 C28.5279747,32.8614499 32.8597465,26.3731772 32.8597465,20.7462268 L32.8453004,20.1949521 C33.6916841,19.5982268 34.4239059,18.8484959 35,17.9949748 Z"/>
                    </svg>

                </a>
                <a title="Facebook" style="background-color:#ffff;"  class="button-circle" href="https://www.facebook.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <path fill="#2d0031" d="M25.4913914,33.257811 L25.4913914,24.4740625 L28.4385481,24.4740625 L28.8807085,21.0498641 L25.4913914,21.0498641 L25.4913914,18.8640127 C25.4913914,17.8729378 25.7654762,17.1975322 27.1882844,17.1975322 L29,17.1967874 L29,14.1340632 C28.6866893,14.0933477 27.6112042,14 26.3594508,14 C23.7455902,14 21.9560943,15.5954766 21.9560943,18.5248824 L21.9560943,21.0498641 L19,21.0498641 L19,24.4740625 L21.9560943,24.4740625 L21.9560943,33.257811 L25.4913914,33.257811 Z"/>
                </a>          
                    </svg>
                <a title="Instagram" style="background-color:#ffff;" class="button-circle" href="https://www.instagram.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <g fill="#2d0031" transform="translate(14 14)">
                            <path d="M14.4007059,0 L5.48870588,0 C2.46223529,0 0,2.46235294 0,5.48882353 L0,14.4008235 C0,17.4274118 2.46223529,19.8896471 5.48870588,19.8896471 L14.4007059,19.8896471 C17.4274118,19.8896471 19.8896471,17.4272941 19.8896471,14.4008235 L19.8896471,5.48882353 C19.8897647,2.46235294 17.4274118,0 14.4007059,0 Z M18.1250588,14.4008235 C18.1250588,16.4543529 16.4543529,18.1249412 14.4008235,18.1249412 L5.48870588,18.1249412 C3.43529412,18.1250588 1.76470588,16.4543529 1.76470588,14.4008235 L1.76470588,5.48882353 C1.76470588,3.43541176 3.43529412,1.76470588 5.48870588,1.76470588 L14.4007059,1.76470588 C16.4542353,1.76470588 18.1249412,3.43541176 18.1249412,5.48882353 L18.1249412,14.4008235 L18.1250588,14.4008235 Z"/>
                            <path d="M9.94482353 4.82C7.11882353 4.82 4.81976471 7.11905882 4.81976471 9.94505882 4.81976471 12.7709412 7.11882353 15.0698824 9.94482353 15.0698824 12.7708235 15.0698824 15.0698824 12.7709412 15.0698824 9.94505882 15.0698824 7.11905882 12.7708235 4.82 9.94482353 4.82zM9.94482353 13.3050588C8.092 13.3050588 6.58447059 11.7977647 6.58447059 9.94494118 6.58447059 8.092 8.09188235 6.58458824 9.94482353 6.58458824 11.7977647 6.58458824 13.3051765 8.092 13.3051765 9.94494118 13.3051765 11.7977647 11.7976471 13.3050588 9.94482353 13.3050588zM15.2848235 3.32364706C14.9448235 3.32364706 14.6108235 3.46129412 14.3707059 3.70247059 14.1294118 3.94247059 13.9907059 4.27658824 13.9907059 4.61776471 13.9907059 4.95788235 14.1295294 5.29188235 14.3707059 5.53305882 14.6107059 5.77305882 14.9448235 5.91188235 15.2848235 5.91188235 15.626 5.91188235 15.9589412 5.77305882 16.2001176 5.53305882 16.4412941 5.29188235 16.5789412 4.95776471 16.5789412 4.61776471 16.5789412 4.27658824 16.4412941 3.94247059 16.2001176 3.70247059 15.9601176 3.46129412 15.626 3.32364706 15.2848235 3.32364706z"/>
                        </g>
                    </svg>
                </a>    
            </p>                                                  
        </div>
    </section>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- VIDEO INFO -->
<section class="block hide-mobile" data-name="VideoInfo">
    <div class="block-content">
      <div class="row">
        <div class="col spacin">
          <span class="text1" style="color:#373737">REPRODUCE Y OBSERVA</span>
          <span class="textpar">Asi haremos tu vida más fácil</span>
          <br><p>
          <span class="textpar spacin30"><strong>Configuración Fácil</strong></span>
          <br> <span class="text-small">Prueba todas las funciones durante <strong>
          <br>7 días sin limitaciones.</strong></span></p>
        </div>
        <div class="col">
          <div class="device-laptop">
            <iframe width="463" height="294" src="https://www.youtube.com/embed/kmmGXKeVVuk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
          </div>
        </div>
      </div>
    </div>
</section>


<!-- CARACTERÍSTICAS (INICIO) -->
<section class="block bg-gray-white" data-name="Features">
    <div class="block-content text-center">
        <h2 class="serif bold text-Morado margin-tiny">¡Conoce tu amigo inseparable!</h2>
        <h3 class="serif margin-tiny">Tu amigo Smartbar te ayuda a <span class="bold">Administrar, Controlar y Crecer tu Negocio</span></h3>
        <div class="row cards-basic">
            <div class="col feature">
                <h3>Facturas</h3>
                <img src="assetsNew/images/feature-facturas.png" width="120" height="120" alt="Logo de Facturas de venta Régimen Común">
                <p>Crea, imprime, envía y administra tus facturas con el fin de ordenar tus cuentas y tener la informaciòn detallada de cada venta.</p>
            </div>
            <div class="col feature">
                <h3>Gastos</h3>
                <img src="assetsNew/images/feature-gastos.png" width="120" height="120" alt="Logo Sistema Administrativo ">
                <p>Controla, contabiliza y Administra tus gastos, con el fin de darte información util para la toma de decisiones dentro de tu negocio.</p>
            </div>
            <div class="col feature">
                <h3>Personal</h3>
                <img src="assetsNew/images/feature-bancos.png" width="120" height="120" alt="Logo bancos para integración Sistema contable">
                <p>Controla los horarios de ingreso y salida, de tus empleados, agenda de trabajo, salarios y chats, los cuales haràn que nunca más tengas que preocuparte por agendar personal. </p>
            </div>
        </div>
        <div class="row cards-basic">
            <div class="col feature">
                <h3>Inventarios</h3>
                <img src="assetsNew/images/feature-inventarios.png" width="120" height="120" alt="Imágen de control de inventarios de programa contable">
                <p>Organiza y controla tus inventarios, con el fin que nunca falte ningun producto en tu negocio, montando pedidos automaticos a los proveedores que recomendamos con el mejor precio posible.</p>
            </div>
            <div class="col feature">
                <h3>Contactos</h3>
                <img src="assetsNew/images/feature-usuarios.png" width="120" height="120" alt="Logo Programa de facturación en Manizales">
                <p>Ordena la información de tus clientes y proveedores, teniendo claro, cuales son los mejores, cuales facturan más y cuales, te dan mejores precios.</p>
            </div>
            <div class="col feature">
                <h3>Informes</h3>
                <img src="assetsNew/images/feature-reportes.png" width="120" height="120" alt="Reportes facturas resolución de facturación Pyme">
                <p>Consulta reportes inteligentes y en tiempo real, con el fin de tener toda la información de tu negocio al alcance de unos cuantos clicks, siempre actualizados.</p>
            </div>
        </div>
        <div class="row cards-basic">
            <div class="col feature">
                <h3> APK </h3>
                <img src="assetsNew/images/feature-movil.png" width="120" height="120" alt="Logo de software de contabilidad móvil">
                <p>Descarga la App y accede desde cualquier lugar, además tus clientes podrán hacer hacer pedidos sin necesidad de un mesero y hacer pagos automaticos directo desde la APK.</p>
            </div>
            <div class="col feature">
                <h3>Carta Virtual</h3>
                <img src="assetsNew/images/feature-api.png" width="120" height="120" alt="Api contable sistema de facturacion nube">
                <p>Tendras tu carta virtual, la cual podrás editar, saber los costos de los productos que estan en ella, y los usuarios VIP podrán ver y ordenar sin necesidad de personal, Smartbar, hará el trabajo por ti.</p>
            </div>
            <div class="col feature">
                <h3>Maneja todos tus negocios al mismo tiempo</h3>
                <img src="assetsNew/images/feature-pos.png" width="120" height="120" alt="POS Facturación nen puntos de venta">
                <p>Smartbar, hace posible que manejar varios negocios en una misma pestaña sea posible.</p>
            </div>
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
      <div class="col plan bg-gray-white">

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
    <p><img class="plan-payment" src="assetsNew/images/logos-payment-col.png" alt="Métodos de pago"/></p>
    <p><a class="button large" href="{{ url('Auth/register') }}" rel="alternate">UNIRTE A <strong>POCKETCLUB</strong></a></p>
    <hr>
    <h4 class="text-gris">Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4>
    <hr>
  </div>
</section>

<!-- SOPORTE  -->
<section class="block " data-name="Support">
    <div class="block-content no-pad text-center">
      <h3 class="hide">¡SmartBar te Asesora!</h3>
      <h4 class="margin-tiny text-Morado">Si necesitas ayuda contáctanos en <a class=" text-gris" href="http://pocketsmartbar.com/asesoramos" rel="alternate">www.pocketsmartbar.com/asesoramos</a></h4>
    </div>
</section>

<!-- DESCARGAR APPS -->
<section class="block " data-name="DownloadApps">
    <div class="block-content text-center">
        <h4 class="margin-tiny">Descarga nuestra aplicación móvil</h4>
        <!-- Descargar para iOS -->
        <a href="" target="_blank" rel="alternate">
            <img src="assetsNew/images/button-ios.png" alt="Descargar Sistema de Facturación emprendedores" width="250" height="82">
        </a>
        <!-- Descargar para Android -->
        <a href="" target="_blank" rel="alternate">
            <img src="assetsNew/images/button-android.png" alt="Descargar Software Contable Pequeñas empresas" width="250" height="82">
        </a>
    </div>
</section>


<!-- REGISTRO -->
<section class="block bg-gray-white" data-name="Register">
    <div class="block-content text-center">
        <h2 class="margin-tiny">Ingresa a nuestra<strong> SmartShop</strong></h2>
        <h3 class="margin-tiny">Configura Smartbar y el se hará cargo de tu negocio.</h3>
      <p><a class="button large" href="usuarios.html" rel="alternate"><strong>INGRESA YA!</strong></a></p>
    </div>
</section>


<!-- TESTIMONIOS -->
<section class="block" data-name="Users">
    <div class="block-content text-center">
      <h2>Miembros PocketClub opinan</h2>
      <div class="row cards-basic">
        <div class="col bg-gray-white">
            <img class="grayscale" src="assetsNew/images/user-monica.png" alt="" />
            <h3>Mónica Tatiana</h3>
            <p>Nunca senti que fuera tan fácil manejar mis negocios, desde que hago parte de Smartbar. ¡Gracias por existir!</p>
            <a class="button small lemon" href="" target="_blank" rel="nofollow">Ver testimonio</a>
        </div>        
        <div class="col bg-gray-white">
            <img class="grayscale" src="assetsNew/images/user-monica4.png" alt="" />
            <h3>Carlos Monsalve</h3>
              <input type="checkbox" class="read-more-state" id="post-1" />
            <p class="read-more-wrap">Desde que cuento con Smartbar, tomo mejores desiciones, y mi negocio a crecido<span class="read-more-target"> más rápido de lo que algun avez soñe, definitivamente, nunca me puede faltar, Smartbar.</span><label for="post-1" class="read-more-trigger"></label></p>
            <a class="button small lemon" href="" target="_blank">Ver testimonio</a>
        </div>        
        <div class="col bg-gray-white">
            <img class="grayscale" src="assetsNew/images/user-monica2.png" alt="" />
            <h3>Mauricio Burbano</h3>
              <input type="checkbox" class="read-more-state" id="post-2" />
            <p class="read-more-wrap">Smartbar es un Excelente aplicativo... Una herramienta muy fácil y dinámica  para <span class="read-more-target">conocer el estado actual de la organización. Me gusta mucho.</span><label for="post-2" class="read-more-trigger"></label></p>
            <a class="button small lemon" href="" target="_blank" rel="nofollow">Ver testimonio</a>
        </div>        
        <div class="col bg-gray-white">
            <img class="grayscale" src="assetsNew/images/user-monica3.png" alt="" />
            <h3>BarNight</h3>
              <input type="checkbox" class="read-more-state" id="post-3" />
            <p>Mis empleados tienen más claro lo que tienen que hacer, tienen todas las herramientas a la mano y <span class="read-more-target">yo soy menos indispensable, nunca pense tener tanto tiempo libre, y mi negocio creciendo a pasos agigantados.</span><label for="post-3" class="read-more-trigger"></label></p>
            <a class="button small lemon" href="" target="_blank" rel="nofollow">Ver testimonio</a>
        </div>
      </div>
      <p><a class="button large" href="usuarios.html" rel="alternate">MÁS <strong>TESTIMONIOS</strong></a></p>
    </div>
</section>


<!-- PIE DE PÁGINA -->

<!-- logos -->

@endsection