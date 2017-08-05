<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/icon.png">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
<title>PocketSmartBar</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all"/>

<link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>

<!-- fuentes google -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,700,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

<!-- sript basico -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- style sript bontones select-->
<script src="js/jquery.easydropdown.js"></script>
<!-- sript para login -->
<script type="text/javascript" src="js/script.js"></script>
<!-- sript para slider -->
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>

 <!-- script para select estilo -->
 <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
 <link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
 <!-- script para select estilo -->

 <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
</head>
<body>
  <div class="header" id="home">
  	  <div class="header_top">
	   <div class="wrap">
		 	     <div class="logo">
						<a href="index.html"><img src="images/logo.png" alt="" /></a>
					</div>
						<div class="menu">
						    <ul>
						    	<li class="current"><a href="#section-1" class="scroll">Inicio</a></li>
								<li><a href="#section-2" class="scroll">Conócenos</a></li>
								<li><a href="" class="scroll">Contacto</a></li>
								<li class="login" >
									<div id="loginContainer" ><a href="#" id="loginButton"><span>Iniciar Sesión</span></a>
						                <div id="loginBox">
						                    <form id="loginForm" method="post" action="{{url('Auth/login')}}">
                                   				{{csrf_field()}}
						                        <fieldset id="body">
						                            <fieldset>
						                                <label for="email">Correo Electronico</label>
						                                <input type="text" name="email" placeholder="Email o SubName">
						                            </fieldset>
						                            <fieldset>
						                                <label for="password">Contraseña</label>
						                                <input type="password" name="password" value="" placeholder="Contraseña">
						                            </fieldset>
						                            <input type="submit" id="login" value="Iniciar">
						                            <label for="checkbox"><input type="checkbox"> <i>Guardar sección</i></label>
						                        </fieldset>
						                        <span><a href="{{url('/Auth/register') }}">¿Adquiere Tu Cuenta?</a></span>
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
     <div class="main" id="container">
	 	<div class="content">
	 		 <div class="content_top section" id="section-1">
	 		     <div class="wrap">
            	   <div class="banner_desc">
            	      <div class="wmuSlider example1">
							<div class="wmuSliderWrapper">
                <article><p>Ten el control de tu establecimiento desde cualquier lugar.</p> <img src="images/clouds.png"  alt="" /> </article>
  							<article><p>Conoce la plataforma que hace las cosas mas faciles para ti.</p> <img src="images/system.png"  alt="" /> </article>
  							<article><p>Manten el control de tu personal, optimizando tus ingresos.</p> <img src="images/slider-img3.png"  alt="" /> </article>
							</div>
                       </div>
            	      <script src="js/jquery.wmuSlider.js"></script>
						<script type="text/javascript" src="js/modernizr.custom.min.js"></script>
						<script>
       						 $('.example1').wmuSlider();
   						 </script>

            		<div class="dropdown-buttons">
            		  <div class="quote_button">

					</div>
				     <div class="quote_button">

					 </div>
				   </div>
                 		 <div class="quote_button">
                  	 		<a class="" href="{{url('Auth/register')}}">Registrarse</a>
                 				 </div>
              				</div>
          				</div>
                  <div class="comment_icons">
                      	<ul>
                      		<li><a class="comments" href="#"> <span>34 Comments</span> </a></li>
                      		<li><a class="email" href="#"> <span>86 Shares</span> </a></li>
                      		<li><a class="like" href="#"> <span>105 Likes</span> </a></li>
                      	</ul>
                      </div>
     		 </div>

        <!-- banner-bottom -->
	<br>	<br>
	<!-- //banner-bottom -->
	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<div class="welcome-grids">
				<div class="col-md-6 w3ls-welcome-left">
					<div class="w3ls-welcome-left-img">

					</div>
				</div>
				<div class="col-md-6 w3ls-welcome-right">
					<div class="w3ls-welcome-right-info">
						<h2><strong>Quienes Somos</strong></h2>
						<p>PocketSmartBar, es la plataforma que le permite a usted, como dueño de un establecimiento Comercial tipo bar o restaurante, tener un control permantente del lugar. Podra tener toda al información detallada de tu personal, inventario, provedores y lo mejor sin estar presente.<br><strong class="">Bienvenido a tu negocio inteligente con pocket ByR.</strong></br></p>
					</div>
					<div class="agileits-border">
						<div class="agileinfo-red"> </div>
						<div class="agileinfo-red agileinfo-green"> </div>
						<div class="agileinfo-red agileinfo-blue"> </div>
						<div class="agileinfo-red agileinfo-yellow"> </div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //welcome -->

       	    <div class="features section" id="section-2">
       	   	 	<h2>Simplemente Genial!</h2>

       	    <!------ Slider ------------>
       	    <div class="browser">
       	   	    <div id="mySliderTabsContainer">
	               <div id="mySliderTabs">
	               <ul>
	                <li><a class="cloud_icon" href="#mother"><i class="cloud_icon"> </i></a></li>
	                <li><a class="cross" href="#parks">  <i class="cross"> </i> </a></li>
	                <li><a class="bubble" href="#theOffice"><i class="bubble"> </i></a></li>
	                <li><a class="right_arrow" href="#southPark"> <i class="right_arrow"> </i></a></li>
	              </ul>
	              <div id="mother">
	              	<img src="images/browser1.png" alt="" />
	              </div>
	              <div id="parks">
	                 <img src="images/browser2.png" alt="" />
	              </div>
	              <div id="theOffice">
	              	<img src="images/browser3.png" alt="" />
	              </div>
	              <div id="southPark">
	              	<img src="images/browser4.png" alt="" />
	              </div>
	            </div>
	            <div class="clear"></div>
	          </div>
          </div>
            <link rel="stylesheet" href="css/jquery.sliderTabs.min.css">
			<script src="js/jquery.sliderTabs.min.js"></script>
			<script>
				 $(document).ready(function(){
				      var tabs = $("div#mySliderTabs").sliderTabs({
				        autoplay:5000,
				        indicators: true,
				        panelArrows: true,
				        panelArrowsShowOnHover: true
				      });
				/*      $("#mySliderTabsContainer").resizable({
				        maxHeight: 200,
				        minHeight: 200,
				        maxWidth: 605
				      });
				*/
				      prettyPrint();
				    });

				    $(document).delegate(".nav-list li a", "click", function(){
				      $(this).parent().siblings().removeClass("active");
				      $(this).parent().addClass("active");
				    });
			</script>
		    <!------End Slider ------------>
       	   </div>
       	 </div>
      </div>

     		<div class="copy-right">
            <div class="footer_logo">
							 <img src="images/logo.png" alt="" />
							</div>
			<div class="wrap">
				<p class="copy">© 2017 condiciones de uso y privacidad  <a href="" target="_blank">Derechos Reservados</a> </p>
			</div>
	  </div>

	</body>
</html>
