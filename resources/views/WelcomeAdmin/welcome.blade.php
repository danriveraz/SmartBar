@extends('Layout.app')
@section('content')
<!--<h1>Hola {{Auth::user()->nombrePersona}}</h1>
<h2>Puede regalar: {{Auth::user()->obsequio}}</h2>-->
@if(Auth::User()->empresa->nombreEstablecimiento=='')
	<div class='alert alert-warning alert-important'>
		<p>Completa tu perfil aquí
			<a href="{{url('Auth/modificarEmpresa')}}"><i class="fa fa-gear"></i>Ajustes</a>
		</p>
	</div>
@endif
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
 {!!Html::style('css/sliderAdmin.css')!!}
<div id="first-slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- Item 1 -->
            <div class="item active slide1">
                <div class="row"><div class="container">
                    
                    <div class="col-md-9 text-left" >
                        <h3 data-animation="animated bounceInDown">Manten el control de tu negocio</h3>
                        <h4 data-animation="animated bounceInUp">más fácil y rápido que nunca!</h4>
                     </div>
                     <div class="col-md-5 text-right">
                        <img style="max-width: 500px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/slider-admin/0.png') }}">
                    </div>
                </div></div>
             </div>
            <!-- Item 2 -->
            <div class="item slide2">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown" color="Black">Ingresa el estado de tu negocio</h3>
                        <h4 data-animation="animated bounceInUp">Asi lograras un control automatico de tus ganancias </h4>
                     </div>
                     <div class="col-md-5 text-right">
                        <img style="max-width: 500px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/slider-admin/2.png') }}">
                    </div>
                                         
                </div></div>
            </div>
            <!-- Item 3 -->
            <div class="item slide3">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown">Solo toma unos minutos añadir tu inventario,</h3>
                        <h4 data-animation="animated bounceInUp">descarga nuestra plantilla en excel, llenala y listo!</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 600px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/slider-admin/4.png') }}">
                    </div>
                </div></div>
            </div>
            <!-- Item 4 -->
            <div class="item slide4">
                <div class="row"><div class="container">
                    <div class="col-md-7 text-left">
                        <h3 data-animation="animated bounceInDown">Cuenta con recetas únicas</h3>
                        <h4 data-animation="animated bounceInUp">y actualización permanente para tus empleados</h4>
                     </div>
                    <div class="col-md-5 text-right">
                        <img style="max-width: 620px;"  data-animation="animated zoomInLeft" src="{{ asset( 'images/slider-admin/3.png') }}">
                    </div>
                </div></div>
            </div>
            <!-- End Item 4 -->

        </div>
        <!-- End Wrapper for slides-->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i><span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i><span class="sr-only">Siguiente</span>
        </a>
    </div>
</div>


<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">


        </div>
    </div>
</footer>

<script type="text/javascript">
	(function( $ ) {
	    //Function to animate slider captions
		function doAnimations( elems ) {
			//Cache the animationend event in a variable
			var animEndEv = 'webkitAnimationEnd animationend';

			elems.each(function () {
				var $this = $(this),
					$animationType = $this.data('animation');
				$this.addClass($animationType).one(animEndEv, function () {
					$this.removeClass($animationType);
				});
			});
		}
		//Variables on page load
		var $myCarousel = $('#carousel-example-generic'),
			$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
		//Initialize carousel
		$myCarousel.carousel();
		//Animate captions in first slide on page load
		doAnimations($firstAnimatingElems);
		//Pause carousel
		$myCarousel.carousel('pause');
		//Other slides to be animated on carousel slide event
		$myCarousel.on('slide.bs.carousel', function (e) {
			var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
			doAnimations($animatingElems);
		});
	    $('#carousel-example-generic').carousel({
	        interval:3000,
	        pause: "false"
	    });
	})(jQuery);

</script>

@endsection
