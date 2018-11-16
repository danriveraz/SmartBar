@extends('Layout.app_principales')
@section('content')

<!-- ENCABEZADO -->
<section class="block bg-gray-light" data-name="Hero">
<div class="text-danger" style="text-align: center;">
  @if (Session::has('message'))
    {{Session::get('message')}}
  @endif
</div>
  <div class="hero" style="background-image: url('assets-home/images/Found-Pocket.jpg'" target="_blank')">
    <div class="hero-content overlay-mobile">
      <div class="hero-message">
        <div class="hero-text-right">
          <!-- Text -->
          <h1 class="pocket-color"><b>¡Felicidad!</b></h1>
          <p class="pocket-negro"><b>Es tener un amigo inseparable Smartbar,<br>
            para hacer mil cosas por ti...</b>
          </p>
          <!-- Buttons -->
          <a class="button large" href="{{ url('/Auth/register') }}" rel="nofollow">REGISTRATE</a><br>
           <span class="textpar"><b>7 DIAS GRATIS</b></span>
      <!-- inicio de section-->
           <section class="content">
        <div class="hero-login bg-cover">
       <br>
            <p class="pocket-negro">
               <small class="socialRed">Síguenos en nuestras redes sociales</small><br>
                <a title="Twitter" style="background-color:#ffff;" class="button-circle" href="https://twitter.com/pocketsmartbar/" target="_blank">
                    <svg xmlns="" class="hero-sgv" width="48" height="48" viewBox="0 0 48 48">
                        <path fill="" d="M35,17.9949748 C34.2270821,18.3335138 33.3977523,18.563107 32.5263881,18.6656082 C33.4161102,18.1389582 34.0971701,17.3036174 34.4199598,16.3113025 C33.58538,16.7990143 32.6641579,17.1531556 31.6825779,17.3451334 C30.8965521,16.516271 29.7785062,16 28.5384061,16 C26.1592944,16 24.2302765,17.9067872 24.2302765,20.2571923 C24.2302765,20.5905417 24.2683305,20.9161238 24.3418306,21.2274602 C20.762011,21.0497281 17.5876774,19.3543879 15.4631396,16.7782562 C15.0917616,17.4060847 14.8804916,18.1376354 14.8804916,18.9185372 C14.8804916,20.3959861 15.6416056,21.6996035 16.7964016,22.4622912 C16.0903956,22.4389554 15.4263896,22.2469776 14.8450798,21.9278739 L14.8450798,21.9810578 C14.8450798,24.0434962 16.3305577,25.764784 18.3002374,26.1565408 C17.9393594,26.2525297 17.5588195,26.3057137 17.1651375,26.3057137 C16.8869557,26.3057137 16.6179357,26.2784772 16.3541656,26.2265822 C16.9026714,27.9193446 18.4931495,29.1503089 20.3775594,29.1840577 C18.9038855,30.3255454 17.0457256,31.0039461 15.0274919,31.0039461 C14.679756,31.0039461 14.3372358,30.983188 14,30.9455726 C15.9067139,32.1558128 18.1703598,32.8614499 20.6032755,32.8614499 C28.5279747,32.8614499 32.8597465,26.3731772 32.8597465,20.7462268 L32.8453004,20.1949521 C33.6916841,19.5982268 34.4239059,18.8484959 35,17.9949748 Z"/>
                    </svg>
                </a>
                <a title="Facebook" style="background-color:#ffff;"  class="button-circle" href="https://www.facebook.com/PocketSmartBar/" target="_blank">
                    <svg xmlns="" class="hero-sgv" width="48" height="48" viewBox="0 0 48 48">
                        <path fill="" d="M25.4913914,33.257811 L25.4913914,24.4740625 L28.4385481,24.4740625 L28.8807085,21.0498641 L25.4913914,21.0498641 L25.4913914,18.8640127 C25.4913914,17.8729378 25.7654762,17.1975322 27.1882844,17.1975322 L29,17.1967874 L29,14.1340632 C28.6866893,14.0933477 27.6112042,14 26.3594508,14 C23.7455902,14 21.9560943,15.5954766 21.9560943,18.5248824 L21.9560943,21.0498641 L19,21.0498641 L19,24.4740625 L21.9560943,24.4740625 L21.9560943,33.257811 L25.4913914,33.257811 Z"/>
                </a>
                    </svg>
                <a title="Instagram" style="background-color:#ffff;" class="button-circle" href="https://www.instagram.com/pocketsmartbar/" target="_blank">
                    <svg xmlns="" class="hero-sgv" width="48" height="48" viewBox="0 0 48 48">
                        <g fill="" transform="translate(14 14)">
                            <path d="M14.4007059,0 L5.48870588,0 C2.46223529,0 0,2.46235294 0,5.48882353 L0,14.4008235 C0,17.4274118 2.46223529,19.8896471 5.48870588,19.8896471 L14.4007059,19.8896471 C17.4274118,19.8896471 19.8896471,17.4272941 19.8896471,14.4008235 L19.8896471,5.48882353 C19.8897647,2.46235294 17.4274118,0 14.4007059,0 Z M18.1250588,14.4008235 C18.1250588,16.4543529 16.4543529,18.1249412 14.4008235,18.1249412 L5.48870588,18.1249412 C3.43529412,18.1250588 1.76470588,16.4543529 1.76470588,14.4008235 L1.76470588,5.48882353 C1.76470588,3.43541176 3.43529412,1.76470588 5.48870588,1.76470588 L14.4007059,1.76470588 C16.4542353,1.76470588 18.1249412,3.43541176 18.1249412,5.48882353 L18.1249412,14.4008235 L18.1250588,14.4008235 Z"/>
                            <path d="M9.94482353 4.82C7.11882353 4.82 4.81976471 7.11905882 4.81976471 9.94505882 4.81976471 12.7709412 7.11882353 15.0698824 9.94482353 15.0698824 12.7708235 15.0698824 15.0698824 12.7709412 15.0698824 9.94505882 15.0698824 7.11905882 12.7708235 4.82 9.94482353 4.82zM9.94482353 13.3050588C8.092 13.3050588 6.58447059 11.7977647 6.58447059 9.94494118 6.58447059 8.092 8.09188235 6.58458824 9.94482353 6.58458824 11.7977647 6.58458824 13.3051765 8.092 13.3051765 9.94494118 13.3051765 11.7977647 11.7976471 13.3050588 9.94482353 13.3050588zM15.2848235 3.32364706C14.9448235 3.32364706 14.6108235 3.46129412 14.3707059 3.70247059 14.1294118 3.94247059 13.9907059 4.27658824 13.9907059 4.61776471 13.9907059 4.95788235 14.1295294 5.29188235 14.3707059 5.53305882 14.6107059 5.77305882 14.9448235 5.91188235 15.2848235 5.91188235 15.626 5.91188235 15.9589412 5.77305882 16.2001176 5.53305882 16.4412941 5.29188235 16.5789412 4.95776471 16.5789412 4.61776471 16.5789412 4.27658824 16.4412941 3.94247059 16.2001176 3.70247059 15.9601176 3.46129412 15.626 3.32364706 15.2848235 3.32364706z"/>
                        </g>
                    </svg>
                </a>
            </p>
        </div>
    </section>
  <!-- fin inicio de section 2-->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- FIN ENCABEZADO -->

<section class="design-avatar">
  <div class="container-pocket">
    <div class="row">
      <div class="col avatar">
              <h1>Hola! Soy SmartBar</h1>
        <h2>TU COMPAÑERO</h2>
        <h3>Inseparable</h3>
        <br>
        <h3>DESDE AHORA</h3>
        <p>Tu trabajo es mucho Más fácil</p>
      </div>
      <div class="col">
        <div class="device-laptop banner-mobiles">
          <img class="design-bottom-img" src="{{asset('assets-home/images/avatar-smartbar.png')}}">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- FIN section avatar smartbar -->
<section class="contet-video">
  <div class="content-wrapper bg-gray">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <div class="vc_column-inner vc_custom_1456148217813">
          <div class="wpb_wrapper">
            <div class="wpb_wrapper">
              <span class="text1">REPRODUCE Y OBSERVA</span>
              <h3 class="text2">Conoce tu amigo inseparable</h3>
            <div class="separator1"></div>
              <p>Tu amigo Smartbar te ayuda a Controlar, administrar y Crecer tu Negocio de una manera mucho mas facil y divertida; lleva el control de tus facturas, contabiliza y Administra tus gastos, Controla los horarios de tus empleados, salarios y chats, Organiza tus inventarios, Ordena la información de tus clientes y proveedores, consulta en tiempo real reportes estadisticos inteligentes.</p>
              <p>Smartbar, hace posible que manejar varios negocios sea fácil, simplemente usando un botón, conoce más... </p>
            <div class="separator1"></div>
                    <a class="button large" href="{{ url('/Auth/register') }}" rel="nofollow">REGISTRATE</a>
            </div>
          </div>
          </div>
        </div>
        <div class="col-6">
          <div class="qode_video_box wpb_wrapper">
            <div class="qode_video_box">
              <a class="qode_video_image" data-rel="prettyPhoto">
              <img width="541" height="370" src="{{asset('assets-home/images/video-cover.jpg')}}" class="attachment-full size-full" alt="Company Intro" srcset="assets-home/images/video-cover-300x205.jpg, assets-home/images/video-cover.jpg 541w" sizes="(max-width: 541px) 100vw, 541px"/>
        <span class="qode_video_box_button_holder youtube-link"  youtubeid="srKymyt4_dM">
          <span class="qode_video_box_button">
            <span class="qode_video_box_button_arrow">
            </span>
          </span>
        </span>
      </a>
    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- FIN section video smartbar -->

<!-- PLANES -->
<section class="block" data-name="Plans">
  <div class="block-content text-center">
    <h2>PocketClub Membresías</h2>
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
              <li>CAPACITACIÓN PROFESIONAL GRATIS <br>(Servicio al Cliente)</li>
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
    <p><a class="button large" href="{{ url('PocketClub') }}" rel="alternate"><strong>UNIRSE A POCKETCLUB</strong></a></p>
    <hr>
  <div class="pocket">
    <h4>Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas.
      <a href="{{ url('PocketClub') }}" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4></div>
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
<!-- smartshop -->
<section class="block design-smartshop" data-name="smarshop">
    <div class="block-content text-center">
    <div class="avatar">
        <h2>Ingresa a nuestra SmartShop</h2>
        <h3 style="line-height: 1;">La tienda inteligente que cambiara la forma en la que compras en tu negocio.</h3>
    </div>
      <p><a class="button shop large" href="usuarios.html" rel="alternate"><strong>INGRESA YA!</strong></a></p>
    </div>
</section>
<!-- TESTIMONIOS MIEMBROS CLUB-->
<section class="block" data-name="Users">
    <div class="block-content">
      <h2 class=" text-center">Miembros PocketClub Opinan</h2>

		<div class="testimonial-container">
	<div class="dk-container">
		<div class="cd-testimonials-wrapper cd-container">
			<ul class="cd-testimonials">
				<li>
					<div class="testimonial-content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
						<div class="cd-author">
							<img src="https://placehold.it/350x350/222222/222222" alt="Author image">
							<ul class="cd-author-info">
								<li>Lorem<strong>Ipsum</strong><br><span>@twitterhandle</span></li>
								<li></li>
							</ul>
						</div>
					</div>
				</li>
				<li>
					<div class="testimonial-content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet fermentum.</p>
						<div class="cd-author">
							<img src="https://placehold.it/350x350/222222/222222" alt="Author image">
							<ul class="cd-author-info">
								<li>Lorem<strong>Ipsum</strong><br><span>@twitterhandle</span></li>
								<li></li>
							</ul>
						</div>
					</div>
				</li>
				<li>
					<div class="testimonial-content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet fermentum.</p>
						<div class="cd-author">
							<img src="https://placehold.it/350x350/222222/222222" alt="Author image">
							<ul class="cd-author-info">
								<li>Lorem<strong>Ipsum</strong><br><span>@twitterhandle</span></li>
								<li></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<!-- cd-testimonials -->
	</div>
</div>

    </div>
</section>

<!-- script para testimonios-->
{!!Html::script("assets-home\scripts\jquery.flexslider.js")!!}
	    <script >
      jQuery(document).ready(function ($) {
	//create the slider
	$('.cd-testimonials-wrapper').flexslider({
		selector: ".cd-testimonials > li",
		animation: "slide",
		controlNav: true,
		slideshow: true,
		smoothHeight: true,
		start: function start() {
			$('.cd-testimonials').children('li').css({
				'opacity': 1,
				'position': 'relative' });

		} });

});
      //# sourceURL=pen.js
    </script>
@endsection
