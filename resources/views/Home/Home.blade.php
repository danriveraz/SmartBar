<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pocket SMARTBAR</title>
		<link rel="shortcut icon" href={{ asset('images/icon.png') }}>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="assets/typicons/typicons.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">

        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/bootstrap-social.css" rel="stylesheet">



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<link href="css/style3.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets\ico\favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets\ico\apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets\ico\apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets\ico\apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets\ico\apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Loader -->
    	<div class="loader">
    		<div class="loader-img"></div>
    	</div>

        <!-- Top content -->
        <div class="top-content">

        	<!-- Top menu -->
  <div class="header" id="home">
  	  <div class="header_top">
	   <div class="wrap">
		 	     <div class="logo">
						<a href="{{url('/')}}"><img src="images/logo.png" alt="" /></a>
					</div>
						<div class="menu">
						    <ul>
						    	<li><a href="{{url('RegistrarProveedor')}}" class="">Registrar como Proveedor</a></li>
						    	<li class="current"><a  class="scroll">Ayuda</a></li>
								<li><a class="scroll">Contactos</a></li>
								<li class="login" >
									<div id="loginContainer" ><a href="#" id="loginButton"><span>Iniciar Sesión</span></a>
						                <div id="loginBox">
						                    <form id="loginForm" method="post" action="{{url('Auth/login')}}">
                                   				{{csrf_field()}}
						                        <fieldset id="body">
						                            <fieldset>
						                                <label for="email">Username</label>
						                                <input type="text1" name="username" placeholder="Username">
						                            </fieldset>
						                            <fieldset>
						                                <label for="password">Contraseña</label>
						                                <input type="password" name="password" value="" placeholder="Contraseña">
						                            </fieldset>
						                            <input type="submit" id="login" value="Iniciar">
						                            <label for="checkbox"><input type="checkbox"> <i>Guardar sesión</i></label>
						                        </fieldset>
						                    </form>
						                </div>
						               </div>
								   </li>
								<div class="clear"></div>
							</ul>
						</div>
	    		 <div class="clear"></div>
	        </div>
	    </div>
	 </div>

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 text">
                              <h1 class="wow fadeInLeftBig">La nueva herramienta que hará <br>
                            <strong> MÁS FACIL TU VIDA</strong></h1>
                            <div class="description wow fadeInLeftBig">
                            	<p>
	                            	Manten el control de tu negocio, tus empleados, tu contabilidad, tu inventario,<br
	                            >
	                            	y la eficiencia y todo al alcance de tu celular.
                            	</p>
                            </div>
                            <div class="top-big-link wow fadeInUp">
                                <div class="description wow fadeInLeftBig">
                                    <p><b>Logueate usando redes sociales</b></p>
                                </div>
     <a class="btn btn-link-1 btn-social-icon btn-twitter scroll-link" href="#pricing"><span class="fa fa-twitter"></span></a>
     <a class="btn btn-link-1 btn-social-icon btn-facebook scroll-link" href="#pricing"><span class="fa fa-facebook"></span></a>
     <a class="btn btn-link-1 btn-social-icon btn-google scroll-link" href="#pricing"><span class="fa fa-google"></span></a>

                            </div>
                        </div>
                        <div class="col-sm-5 form-box wow fadeInUp">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Registro</h3>
                                    <p>Ahora serás dueño de un negocio inteligente.</p>
                        		</div>
                        		<div class="form-top-right">
                        			<span aria-hidden="true" class="typcn typcn-pencil"></span>
                        		</div>
                            </div>
                            <div class="form-bottom">
								<form autocomplete="off" role="form" method="POST" enctype="multipart/form-data" action="{{ url('Auth/register') }}" files="true">
								{{ csrf_field() }}
									<div class="text-danger">
						                 @if (Session::has('message'))
										   {{Session::get('message')}}
										 @endif
									 </div>
			                    	<div class="form-group">
			                    		
			                        	<input type="text" name="nombreEstablecimiento" placeholder="Nombre de Empresa" value="{{ old('nombreEstablecimiento') }}" class="form-first-name form-control" id="form-first-name">
										<div class="text-danger">{{$errors->first('nombreEstablecimiento')}}</div>
			                        </div>
			                        <div class="form-group">
			                        	
			                        	<input value="{{ old('name') }}" type="text" name="nombrePersona" placeholder="Nombre..." class="form-last-name form-control" id="form-last-name">
			                        	<div class="text-danger">{{$errors->first('name')}}</div>
			                        </div>
			                        <div class="form-group">
			                        	
			                        	<input type="text"  name="email" value="{{ old('email') }}" placeholder="Email..." class="form-email form-control" id="form-email">
			                        	<div class="text-danger">{{$errors->first('email')}}</div>
			                        </div>
			                        <div class="form-group">
                                       <div class="password">
                                            <input type="password" id="passwordfield" placeholder="Contraseña..."class="form-email form-control" name="password" id="form-email">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </div>
                                        <div class="text-danger">{{$errors->first('password')}}</div>
			                        </div>

                                <div class="form-group">
                                    <div class="left-w3-agile">
                                    <select id="idCiudad" name="idCiudad" class="form-email form-control" id="form-email" required>
                                    	<option></option>  
                                    </select>
                                	</div>
									<div class="right-agileits">
                                    <select name="idDepto" class="form-last-name form-control" id="idDepto" required>
										@foreach($departamentos as $departamento)
	                                  		<option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
	                                 	@endforeach
                                    </select>
									</div>
                                </div>


			                        <button type="submit" class="btn">Registrarme</button>
			                        <div class="form-links">
			                        	<a href="#" class="launch-modal" data-modal-id="modal-privacy">Políticas</a> -
			                        	<a href="#" class="launch-modal" data-modal-id="modal-faq">Preguntas</a>
			                        </div>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

      <!-- Features -->
        <div class="features-container section-container">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 features section-description wow fadeIn">
	                    <h2>Ventajas</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
                	<div class="col-sm-4 features-box features-box-gray wow fadeInUp">
	                	<div class="features-box-icon">
	                		<i class="fa fa-desktop" aria-hidden="true"></i>
	                	</div>
	                    <h3>Interfaz ágradable y facil de usar</h3>
	                    <p>Tenga acceso fácil y rápido a todas las herramientas necesarias para obtener la mejor gestión de su negocio. </p>
                    </div>
                    <div class="col-sm-4 features-box wow fadeInDown">
	                	<div class="features-box-icon">
	                		<span aria-hidden="true" class="fa fa-picture-o"></span>
	                	</div>
	                    <h3>Diseño sobrio e intuitivo</h3>
	                    <p>Sólo una pequeña guia que le mostrar el orden en que debe hacer el fácil proceso de volver su negocio inteligente.</p>
                    </div>
                    <div class="col-sm-4 features-box features-box-gray wow fadeInUp">
	                	<div class="features-box-icon">
	                		<span aria-hidden="true" class="fa fa-gears"></span>
	                	</div>
	                    <h3>Sistema de Ordenes</h3>
	                    <p>Sistema, rápido, sencillo, que hace el control de los pedidos muy eficiente.</p>
                    </div>
	            </div>
	            <div class="row">
                	<div class="col-sm-4 features-box wow fadeInUp">
	                	<div class="features-box-icon">
	                		<span aria-hidden="true" class="fa fa-cloud-download"></span>
	                	</div>
	                    <h3>Actualizaciones de Recetas</h3>
	                    <p>videos y blogs sobre las ultimas tendencias en Cóctelería, Cafetería y restaurante.</p>
                    </div>
                    <div class="col-sm-4 features-box features-box-gray wow fadeInDown">
	                	<div class="features-box-icon">
	                		<span aria-hidden="true" class="fa fa-tablet"></span>
	                	</div>
	                    <h3>Cualquier Dispositivo</h3>
	                    <p>Funcionamos directamente en la nube, viendonos en cualquier dispositivo en cualquier momento, sólo se necesita una conexión a internet.</p>
                    </div>
                    <div class="col-sm-4 features-box wow fadeInUp">
	                	<div class="features-box-icon">
	                		<span aria-hidden="true" class="fa fa-sitemap"></span>
	                	</div>
	                    <h3>Enorme Comunidad de Empresarios</h3>
	                    <p>Los mejores precios en licor, donde conseguirlo, acceso a todas las recetas y nuevas recetas y mucho más...</p>
                    </div>
	            </div>
	            </div>
	        </div>
        </div>

		<!-- More features -->
        <div class="more-features-container section-container section-container-gray-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 more-features section-description wow fadeIn">
	                    <h2>Actualizaciones...</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
	            	<div class="col-sm-5 more-features-box wow fadeInLeft">
	                    <img src="assets\img\devices\pc.png" alt="">
	                </div>
	                <div class="col-sm-7 more-features-box wow fadeInUp">
	                    <div class="more-features-box-text">
	                    	<div class="more-features-box-text-icon">
	                    		<span aria-hidden="true" class="typcn typcn-attachment"></span>
	                    	</div>
	                    	<h3>Tienda Virtual </h3>
	                    	<div class="more-features-box-text-description">
	                    		Podrá comprar todo lo relacionado a su negocio, dosificadores, mezcladores, cubiertos, cristalería y más... muy pronto...
	                    	</div>
	                    </div>
	                    <div class="more-features-box-text">
	                    	<div class="more-features-box-text-icon">
	                    		<span aria-hidden="true" class="typcn typcn-user"></span>
	                    	</div>
	                    	<h3>Servicios Extra</h3>
	                    	<div class="more-features-box-text-description">
	                    		Podrá contratar personal, inscrito en nuestra plataforma y más...<br> Muy pronto...
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>

        <!-- Negocio Inteligente en  pasos -->
        <div class="how-it-works-container section-container section-container-image-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 how-it-works section-description wow fadeIn">
	                    <h2>Tu Negocio inteligente en 4 pasos</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
                	<div class="col-sm-4 col-sm-offset-1 how-it-works-box wow fadeInUp">
	                	<div class="how-it-works-box-icon">
	                		<span aria-hidden="true" class="fa fa-pencil"></span>
	                		<span aria-hidden="true" class="how-it-works-step">1</span>
	                	</div>
	                    <h3>Registro y Membresía</h3>
	                    <p>Registrate con tus datos personales y los de tu negocio, escoge la mejor membresía y felicitaciones por hacer tu vida más facil con Pocket SMARTBAR.</p>
                    </div>
                    <div class="col-sm-4 col-sm-offset-2 how-it-works-box wow fadeInDown">
	                	<div class="how-it-works-box-icon">
	                		<span aria-hidden="true" class="fa fa-truck"></span>
	                		<span aria-hidden="true" class="how-it-works-step">2</span>
	                	</div>
	                    <h3>Proveedores</h3>
	                    <p>Agrega tus proveedores y toda su información con el fin que la plataforma pueda ayudarte hacer tus pedidos y tener tu información a la manos más facil y rápido.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1 how-it-works-box wow fadeInUp">
	                	<div class="how-it-works-box-icon">
	                		<span aria-hidden="true" class="fa fa-list-ol"></span>
	                		<span aria-hidden="true" class="how-it-works-step">3</span>
	                	</div>
	                    <h3>Inventario</h3>
	                    <p>Agrega tus productos al inventario y crea tu menú con el fin que siempre estes informado sobre la cantidad de productos que tienes, sus costos, marcas y rentabilidad.</p>
                    </div>
                    <div class="col-sm-4 col-sm-offset-2 how-it-works-box wow fadeInDown">
	                	<div class="how-it-works-box-icon">
	                		<span aria-hidden="true" class="fa fa-user"></span>
	                		<span aria-hidden="true" class="how-it-works-step">4</span>
	                	</div>
	                    <h3>Personal</h3>
	                    <p>Agrega la información de tu personal y los permisos de uso de plataforma, con el fin que tu sistema sea más fácil y rápido, sin perder el control.</p>
                    </div>
	            </div>
	            </div>
	        </div>
        </div>

		<!-- Pricing -->
        <div class="pricing-container section-container">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 pricing section-description wow fadeIn">
	                    <h2>Membresia</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
                	<div class="col-sm-4 pricing-box wow fadeInUp">
                		<div class="pricing-box-inner">
		                	<div class="pricing-box-price"><span>$ </span><strong>89.000</strong><span> / Cop</span>
		                	</div>
		                    <h3>UNICA</h3>
		                    <h4>Mensual</h4>
		                    <div class="pricing-box-features">
		                    	<ul>
		                    		<li>Uso del programa = 1 mes</li>
		                    		<li>Sin clausulas, ni recargos.</li>
		                    		<li></li>
		                    		<li></li>
		                    		<li></li>
		                    		<li></li>
		                    		<li></li>

		                    	</ul>
		                    </div>
		                    <div class="pricing-box-sign-up">
		                    	<a class="btn btn-link-1 scroll-link" href="#top-content">Adquirir</a>
		                    </div>
	                    </div>
                    </div>
                    <div class="col-sm-4 pricing-box pricing-box-best wow fadeInDown">
                    	<div class="pricing-box-inner">
		                	<div class="pricing-box-price"><span>$ </span><strong>2.000.000</strong><span> / Cop</span>
		                		<div class="pricing-box-icon">
			                		<span aria-hidden="true" class="typcn typcn-star"></span>
			                	</div>
		                	</div>
		                    <h3>INFINITA</h3>
		                    <h4>POR SIEMPRE</h4>
		                    <div class="pricing-box-features">
		                    	<ul>

		                    		<li>Uso del programa = Por siempre.</li>
		                    		<li>Nunca más tendra que pagar por el.</li>
		                    		<li>Membresia por tiempo limitado.</li>
		                    		<li>Sin clausulas, ni recargos.</li>

		                    	</ul>
		                    </div>
		                    <div class="pricing-box-sign-up">
		                    	<a class="btn btn-link-1 scroll-link" href="#top-content">Adquirir</a>
		                    </div>
		                </div>
                    </div>
                    <div class="col-sm-4 pricing-box wow fadeInUp">
                    	<div class="pricing-box-inner">
		                	<div class="pricing-box-price"><span>$ </span><strong>800.000</strong><span> / Cop</span></div>
		                    <h3>ESPECIAL</h3>
		                    <h4>ANUAL</h4>

		                    <div class="pricing-box-features">
		                    	<ul>
		                    	<li>Uso del programa = 12 Meses.</li>
		                    		<li>Ahorro de $ 268.000 Cop.</li>
		                    		<li>Sin clausulas, ni recargos.</li>
		                    		<li></li>
		                    		<li></li>

		                    	</ul>
		                    </div>
		                    <div class="pricing-box-sign-up">
		                    	<a class="btn btn-link-1 scroll-link" href="#top-content">Adquirir</a>
		                    </div>
		                </div>
                    </div>
	            </div>
	        </div>
        </div>

        <!-- Call to action -->
        <div class="call-to-action-container section-container section-container-image-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 call-to-action section-description wow fadeInLeftBig">
	                    <h2>¿Quieres una membresía única Gratis?</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                    <p>
	                    	"Registrate, llenando todos los campos del formulario y obtén una membresía por un mes"<br>
	                    	"Hazlo yá, quedán pocas membresías únicas de obsequio"
	                    </p>
	                </div>
	            </div>
	            <div class="row">
	            	<div class="col-sm-12 section-bottom-button wow fadeInUp">
                        <a class="btn btn-link-1 scroll-link" href="#top-content">Registrate</a>
	            	</div>
	            </div>
	        </div>
        </div>

        <!-- About us -->
        <div class="about-us-container section-container">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 about-us section-description wow fadeIn">
	                    <h2>CONOCE NUESTROS SOCIOS SMARTBAR</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-4 about-us-box wow fadeInUp">
		                <div class="about-us-photo">
		                	<img src="assets\img\about\1.jpg" alt="" data-at2x="assets/img/about/1.jpg">
		                	<div class="about-us-role">Black And White</div>
		                </div>
	                    <h3>María Correa</h3>
	                    <p>No puedo esperar a que SMARTBAR de la ópción para que los clientes programen la música.</p>
	                    <div class="about-us-social">
		                	<a href="#"><span class="typcn typcn-social-facebook"></span></a>
		                	<a href="#"><span class="typcn typcn-social-instagram"></span></a>
		                    <a href="#"><span class="typcn typcn-social-twitter"></span></a>
		                </div>
	                </div>
	                <div class="col-sm-4 about-us-box wow fadeInDown">
		                <div class="about-us-photo">
		                	<img src="assets\img\about\2.jpg" alt="" data-at2x="assets/img/about/2.jpg">
		                	<div class="about-us-role">PIMIENTA Y LIMÓN</div>
		                </div>
	                    <h3>Juan Camilo</h3>
	                    <p>Ser dueño de un restaurante, nunca llego a ser tan fácil.</p>
	                    <div class="about-us-social">
		                	<a href="#"><span class="typcn typcn-social-facebook"></span></a>
		                	<a href="#"><span class="typcn typcn-social-instagram"></span></a>
		                    <a href="#"><span class="typcn typcn-social-twitter"></span></a>
		                </div>
	                </div>
	                <div class="col-sm-4 about-us-box wow fadeInUp">
		                <div class="about-us-photo">
		                	<img src="assets\img\about\3.jpg" alt="" data-at2x="assets/img/about/3.jpg">
		                	<div class="about-us-role">LA BARRA BAR</div>
		                </div>
	                    <h3>Sara Gómez</h3>
	                    <p>Conoce nuestro bar y disfruta de la comodidad del cliente VIP SmartBar</p>
	                    <div class="about-us-social">
		                	<a href="#"><span class="typcn typcn-social-facebook"></span></a>
                    		<a href="#"><span class="typcn typcn-social-instagram"></span></a>
		                    <a href="#"><span class="typcn typcn-social-twitter"></span></a>
		                </div>
	                </div>
	            </div>
	        </div>
        </div>

        <!-- Testimonials -->
        <div class="testimonials-container section-container section-container-gray-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 testimonials section-description wow fadeIn">
	                    <h2>COMENTARIOS</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-10 col-sm-offset-1 testimonial-list wow fadeInUp">
	                	<div role="tabpanel">
	                		<!-- Tab panes -->
	                		<div class="tab-content">
	                			<div role="tabpanel" class="tab-pane fade in active" id="tab1">
	                				<div class="testimonial-image">
	                					<img src="assets\img\testimonials\1.jpg" alt="" data-at2x="assets/img/testimonials/1.jpg">
	                					<div class="testimonial-icon">
	                						<span aria-hidden="true" class="typcn typcn-pin"></span>
	                					</div>
	                				</div>
	                				<div class="testimonial-text">
		                                <p>
		                                	"Definitivamente tener el control de tu negocio de una forma tan fácil y rapido como esta, es lo mejor! ya que tengo más timepo para otras cosas, mientras gano más dinero y mis empleados estan más felices"<br>
		                                	<a href="#">www.smartbar.com</a>
		                                </p>
	                                </div>
	                			</div>
	                			<div role="tabpanel" class="tab-pane fade" id="tab2">
	                				<div class="testimonial-image">
	                					<img src="assets\img\testimonials\2.jpg" alt="" data-at2x="assets/img/testimonials/2.jpg">
	                					<div class="testimonial-icon">
	                						<span aria-hidden="true" class="typcn typcn-pin"></span>
	                					</div>
	                				</div>
	                				<div class="testimonial-text">
		                                <p>
		                                	"Rápido, y fácil poner toda la información de tu bar en esta página de internet y ella te dice donde comprar licor y productos, como preparar tus cócteles y comidas, y me recomienda los mejores productos para mi negocio, me encanta."<br>
		                                	<a href="#">www.smartbar.com</a>
		                                </p>
	                                </div>
	                			</div>
	                			<div role="tabpanel" class="tab-pane fade" id="tab3">
	                				<div class="testimonial-image">
	                					<img src="assets\img\testimonials\3.jpg" alt="" data-at2x="assets/img/testimonials/3.jpg">
	                					<div class="testimonial-icon">
	                						<span aria-hidden="true" class="typcn typcn-pin"></span>
	                					</div>
	                				</div>
	                				<div class="testimonial-text">
		                                <p>
		                                	"Por fin puedo dormir a la hora que quiera!"<br>
		                                	<a href="#">www.smartbar.com</a>
		                                </p>
	                                </div>
	                			</div>
	                			<div role="tabpanel" class="tab-pane fade" id="tab4">
	                				<div class="testimonial-image">
	                					<img src="assets\img\testimonials\4.jpg" alt="" data-at2x="assets/img/testimonials/4.jpg">
	                					<div class="testimonial-icon">
	                						<span aria-hidden="true" class="typcn typcn-pin"></span>
	                					</div>
	                				</div>
	                				<div class="testimonial-text">
		                                <p>
		                                	"Mis empleados son más eficientes, mis entregas y mis productos son mejores, nunca olvido comprar nada, porque tengo quien me lo recuerde, gracias."<br>
		                                	<a href="#">www.smartbar.com</a>
		                                </p>
	                                </div>
	                			</div>
	                		</div>
	                		<!-- Nav tabs -->
	                		<ul class="nav nav-tabs" role="tablist">
	                			<li role="presentation" class="active">
	                				<a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"></a>
	                			</li>
	                			<li role="presentation">

	                				<a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"></a>
	                			</li>
	                			<li role="presentation">
	                				<a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"></a>
	                			</li>
	                			<li role="presentation">
	                				<a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"></a>
	                			</li>
	                		</ul>
	                	</div>
	                </div>
	            </div>
	        </div>
        </div>

        <!-- Footer -->
        <footer>
	        <div class="container">
	        	<div class="row">
                    <div class="col-sm-12 footer-social">
                    	<a href="#"><span class="typcn typcn-social-facebook"></span></a>
                    	<a href="#"><span class="typcn typcn-social-twitter"></span></a>
                    	<a href="#"><span class="typcn typcn-social-google-plus"></span></a>
                    	<a href="#"><span class="typcn typcn-social-instagram"></span></a>
                    </div>
	            </div>
	            <div class="row">
                    <div class="col-sm-12 footer-copyright">
                    	&copy; 2017 condiciones de uso y privacidad <a href="">  Derechos Reservados SmartBar</a>.
                    </div>
                </div>
	        </div>
        </footer>


        <!-- MODAL: Privacy policy-->
        <div class="modal fade" id="modal-privacy" tabindex="-1" role="dialog" aria-labelledby="modal-privacy-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        			
        			</div>
        			<div class="modal-header">        				
        				<h2 class="modal-title" id="modal-privacy-label">Politicas</h2>
        			</div>
        			<div class="modal-body">
        				<h3>1.Politicas de Privacidad</h3>
        				<p style="text-align:justify">
	                    	La presente Política de Privacidad establece los términos en que Pocket Compañy usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.

	                    	Información que es recogida en nuestro sitio web podrá tener información personal por ejemplo: Nombre,  información de contacto como  su dirección de correo electrónica e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.</p>
	                    	<br>
	                    	<h3>2. Uso de la Información</h3>
	                    	<p style="text-align:justify">                   	
	                    	Uso de la información recogida en nuestro sitio web, emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios.  Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.<br>

	                    	
	                    	Pocket Compañy está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.</p>
	                    	<br>
                            <h3>3. Uso de Cookies</h3>
                            <p style="text-align:justify">
                            Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.

	                    	Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente. Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.</p>
	                    	<br>
                            <h3>4. Enlaces a terceros</h3>
                            <p style="text-align:justify">
	                    	este sitio web pudiera contener en laces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.</p>
	                    	<br>
	                    	<h3>5. Control de su información personal</h3>
                            <p style="text-align:justify"> 
	                    	En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web.  Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico.  En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.

	                    	Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.

	                    	Pocket Compañy Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.
	                    	 </p>
	             
        			</div>
        			</div>
        	</div>
        </div>

        <!-- MODAL: Frequent questions-->
        <div class="modal fade" id="modal-faq" tabindex="-1" role="dialog" aria-labelledby="modal-faq-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				 </div>

           			<div class="modal-body">
        			<b><h3 class="modal-title" >Preguntas Frecuentes</h3></b><br>
        				<h4>1. ¿Cómo ingreso de forma rápida mi inventario?</h4><br>
        				<p>
	                    	Se recomienda descargar la plantilla de excel, llenarla y cargarla al programa, el automaticamente cargará la información en el lugar correcto.
	                    </p><br>

	                    <h4>2. ¿Cómo me subscribo al canal de SmartBar?</h4><br>
        				<p>
	                    	Puedes Inscribirte en la parte superior de nuestra página, clickeando en contactos, sigue los pasos y seguiras recibiendo todas las actualizaciones de SmartBar.
	                    </p><br>

        			</div>
        			</div>
        	</div>
        </div>

        <!-- Javascript -->
        <script src="assets\js\jquery-1.11.1.min.js"></script>
        <script src="assets\bootstrap\js\bootstrap.min.js"></script>
        <script src="assets\js\jquery.backstretch.min.js"></script>
        <script src="assets\js\wow.min.js"></script>
        <script src="assets\js\retina-1.1.0.min.js"></script>
        <script src="assets\js\scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
	<script>
		$('#idDepto').on('change', function (event) {
		    var id = $(this).find('option:selected').val();
		    $('#idCiudad').empty();
		    $('#idCiudad').append($('<option>', {
					    value: 0,
					    text: 'Elija una opción'
					}));
		    JSONCiudades = eval(<?php echo json_encode($ciudades);?>);
		    JSONCiudades.forEach(function(currentValue,index,arr) {
			    if(currentValue.idDepartamento == id){
			    	$('#idCiudad').append($('<option>', {
					    value: currentValue.id,
					    text: currentValue.nombre
					}));
			    }
			});
			 
		});
	</script>



        <!--  script para contraseña -->
    <script type="text/javascript">
        $("#passwordfield").on("keyup",function(){
            if($(this).val())
                $(".glyphicon-eye-open").show();
            else
                $(".glyphicon-eye-open").hide();
            });
        $(".glyphicon-eye-open").mousedown(function(){
                        $("#passwordfield").attr('type','text');
                    }).mouseup(function(){
                        $("#passwordfield").attr('type','password');
                    }).mouseout(function(){
                        $("#passwordfield").attr('type','password');
                    });
    </script>
        <!--  script para contraseña -->
    </body>

</html>
