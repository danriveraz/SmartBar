@extends('Layout.app_administradores')
@section('content')
{!!Html::style('assets/css/main.css')!!}
<!--<h1>Hola {{Auth::user()->nombrePersona}}</h1>
<h2>Puede regalar: {{Auth::user()->obsequio}}</h2>-->
@if(Auth::User()->empresa->nombreEstablecimiento=='')
	<div class='alert alert-warning alert-important'>
		<p>Completa tu perfil aquí
			<a href="{{url('Auth/modificarEmpresa')}}"><i class="fa fa-gear"></i>Mis Ajustes</a>
		</p>
	</div>
@endif
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
 {!!Html::style('css/sliderAdmin.css')!!}

 <!-- Inicio del carusel -->
<div id="first-slider" hidden>
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
 <!-- Fin del carusel -->


 <!--Inicio de las gráficas-->
<div id="main-content">
    <div class="container-fluid">
      <div class="section-heading">
        <h1 class="page-title">Reportes</h1>
      </div>
      <!--ALGO -->
      <div class="dashboard-section">
        <div class="section-heading clearfix">
          <h2 class="section-title"><i class="fa fa-pie-chart"></i> Categorias más vendidas </h2>
          <a href="{{url('Estadisticas/')}}" class="right">Ver más Estadísticas</a>
        </div>
        <div class="panel-content">
          <div class="row">
            @foreach($categoriasMasVendidas as $key => $categoria)
                <div class="col-md-3 col-sm-6">
                  <div class="number-chart">
                    <div class="mini-stat">
                      <div id="number-chart{{$key+1}}" class="inlinesparkline">
                        {{$sumaVentasDeCadaCategoria[$key][0]}},
                        {{$sumaVentasDeCadaCategoria[$key][1]}},
                        {{$sumaVentasDeCadaCategoria[$key][2]}},
                        {{$sumaVentasDeCadaCategoria[$key][3]}},
                        {{$sumaVentasDeCadaCategoria[$key][4]}},
                        {{$sumaVentasDeCadaCategoria[$key][5]}}
                      </div>
                      <p class="text-muted"><i class="fa fa-pause text-success"></i> 0% Comparado a la semana pasada</p>
                    </div>
                    <div class="number"><span>${{$categoria->precio}}</span> <span>{{$categoria->nombre}}</span></div>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <!-- TRAFFIC SOURCES -->
            <div class="panel-content">
              <h2 class="heading"><i class="fa fa-square"></i> Traffic Sources</h2>
              <div id="demo-pie-chart" class="ct-chart"></div>
            </div>
            <!-- END TRAFFIC SOURCES -->
          </div>
          <div class="col-md-4">
            <!-- REFERRALS -->
            <div class="panel-content">
              <h2 class="heading"><i class="fa fa-square"></i> Referrals</h2>
              <ul class="list-unstyled list-referrals">
                <li>
                  <p><span class="value">3,454</span><span class="text-muted">visits from Facebook</span></p>
                  <div class="progress progress-xs progress-transparent custom-color-blue">
                    <div class="progress-bar" data-transitiongoal="87"></div>
                  </div>
                </li>
                <li>
                  <p><span class="value">2,102</span><span class="text-muted">visits from Twitter</span></p>
                  <div class="progress progress-xs progress-transparent custom-color-purple">
                    <div class="progress-bar" data-transitiongoal="34"></div>
                  </div>
                </li>
                <li>
                  <p><span class="value">2,874</span><span class="text-muted">visits from Affiliates</span></p>
                  <div class="progress progress-xs progress-transparent custom-color-green">
                    <div class="progress-bar" data-transitiongoal="67"></div>
                  </div>
                </li>
                <li>
                  <p><span class="value">2,623</span><span class="text-muted">visits from Search</span></p>
                  <div class="progress progress-xs progress-transparent custom-color-yellow">
                    <div class="progress-bar" data-transitiongoal="54"></div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- END REFERRALS -->
          </div>
          <div class="col-md-4">
            <div class="panel-content">
              <!-- BROWSERS -->
              <h2 class="heading"><i class="fa fa-square"></i> Browsers</h2>
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                    <tr>
                      <th>Browsers</th>
                      <th>Sessions</th>
                      <th>%Sessions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Chrome</td>
                      <td>1,756</td>
                      <td>23%</td>
                    </tr>
                    <tr>
                      <td>Firefox</td>
                      <td>1,379</td>
                      <td>14%</td>
                    </tr>
                    <tr>
                      <td>Safari</td>
                      <td>1,100</td>
                      <td>17%</td>
                    </tr>
                    <tr>
                      <td>Edge</td>
                      <td>982</td>
                      <td>25%</td>
                    </tr>
                    <tr>
                      <td>Opera</td>
                      <td>967</td>
                      <td>19%</td>
                    </tr>
                    <tr>
                      <td>IE</td>
                      <td>896</td>
                      <td>12%</td>
                    </tr>
                    <tr>
                      <td>Android Browser</td>
                      <td>752</td>
                      <td>27%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- END BROWSERS -->
            </div>
          </div>
        </div>
      </div>
    <!-- END ALGO -->
    <!-- SALES SUMMARY -->
      <div class="dashboard-section">
        <div class="section-heading clearfix">
          <h2 class="section-title"><i class="fa fa-shopping-basket"></i> Sales Summary</h2>
          <a href="#" class="right">View Sales Reports</a>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="panel-content">
              <h3 class="heading"><i class="fa fa-square"></i> Today</h3>
              <ul class="list-unstyled list-justify large-number">
                <li class="clearfix">Earnings <span>$215</span></li>
                <li class="clearfix">Sales <span>47</span></li>
              </ul>
            </div>
          </div>
          <div class="col-md-9">
            <div class="panel-content">
              <h3 class="heading"><i class="fa fa-square"></i> Sales Performance</h3>
              <div class="row">
                <div class="col-md-6">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Last Week</th>
                        <th>This Week</th>
                        <th>Change</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Earnings</th>
                        <td>$2752</td>
                        <td><span class="text-info">$3854</span></td>
                        <td><span class="text-success">40.04%</span></td>
                      </tr>
                      <tr>
                        <th>Sales</th>
                        <td>243</td>
                        <td>
                          <div class="text-info">322</div>
                        </td>
                        <td><span class="text-success">32.51%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <div id="chart-sales-performance">Loading ...</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="panel-content">
              <h3 class="heading"><i class="fa fa-square"></i> Recent Purchases</h3>
              <div class="table-responsive">
                <table class="table table-striped no-margin">
                  <thead>
                    <tr>
                      <th>Order No.</th>
                      <th>Name</th>
                      <th>Amount</th>
                      <th>Date &amp; Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="#">763648</a></td>
                      <td>Steve</td>
                      <td>$122</td>
                      <td>Oct 21, 2016</td>
                      <td><span class="label label-success">COMPLETED</span></td>
                    </tr>
                    <tr>
                      <td><a href="#">763649</a></td>
                      <td>Amber</td>
                      <td>$62</td>
                      <td>Oct 21, 2016</td>
                      <td><span class="label label-warning">PENDING</span></td>
                    </tr>
                    <tr>
                      <td><a href="#">763650</a></td>
                      <td>Michael</td>
                      <td>$34</td>
                      <td>Oct 18, 2016</td>
                      <td><span class="label label-danger">FAILED</span></td>
                    </tr>
                    <tr>
                      <td><a href="#">763651</a></td>
                      <td>Roger</td>
                      <td>$186</td>
                      <td>Oct 17, 2016</td>
                      <td><span class="label label-success">SUCCESS</span></td>
                    </tr>
                    <tr>
                      <td><a href="#">763652</a></td>
                      <td>Smith</td>
                      <td>$362</td>
                      <td>Oct 16, 2016</td>
                      <td><span class="label label-success">SUCCESS</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel-content">
              <h3 class="heading"><i class="fa fa-square"></i> Top Products</h3>
              <div id="chart-top-products" class="chartist"></div>
            </div>
          </div>
        </div>
      </div>
        <!-- END SALES SUMMARY -->
        <!-- CAMPAIGN -->
      <div class="dashboard-section">
        <div class="section-heading clearfix">
          <h2 class="section-title"><i class="fa fa-flag-checkered"></i> Campaign</h2>
          <a href="#" class="right">View All Campaigns</a>
        </div>
        <div class="panel-content">
          <div class="row margin-bottom-15">
            <div class="col-md-8 col-sm-7 left">
              <div id="demo-line-chart" class="ct-chart"></div>
            </div>
            <div class="col-md-4 col-sm-5 right">
              <div class="row margin-bottom-30">
                <div class="col-xs-4">
                  <p class="text-right text-larger"><span class="text-muted">Impression</span>
                    <br><strong>32,743</strong></p>
                </div>
                <div class="col-xs-4">
                  <p class="text-right text-larger"><span class="text-muted">Clicks</span>
                    <br><strong>1423</strong></p>
                </div>
                <div class="col-xs-4">
                  <p class="text-right text-larger"><span class="text-muted">CTR</span>
                    <br><strong>4,34%</strong></p>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-4">
                  <p class="text-right text-larger"><span class="text-muted">Cost</span>
                    <br><strong>$42.69</strong></p>
                </div>
                <div class="col-xs-4">
                  <p class="text-right text-larger"><span class="text-muted">CPC</span>
                    <br><strong>$0,03</strong></p>
                </div>
                <div class="col-xs-4">
                  <p class="text-right text-larger"><span class="text-muted">Budget</span>
                    <br><strong>$200</strong></p>
                </div>
              </div>
            </div>
          </div>
          <div class="action-buttons">
            <a href="#" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Budget</a> <a href="#" class="btn btn-default"><i class="fa fa-file-text-o"></i> View Campaign Details</a>
          </div>
        </div>
      </div>
      <!-- END CAMPAIGN -->
      <!-- SOCIAL -->
      <div class="dashboard-section no-margin">
        <div class="section-heading clearfix">
          <h2 class="section-title"><i class="fa fa-user-circle"></i> Social <span class="section-subtitle">(7 days report)</span></h2>
          <a href="#" class="right">View Social Reports</a>
        </div>
        <div class="panel-content">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <p class="metric-inline"><i class="fa fa-thumbs-o-up"></i> +636 <span>LIKES</span></p>
            </div>
            <div class="col-md-3 col-sm-6">
              <p class="metric-inline"><i class="fa fa-reply-all"></i> +528 <span>FOLLOWERS</span></p>
            </div>
            <div class="col-md-3 col-sm-6">
              <p class="metric-inline"><i class="fa fa-envelope-o"></i> +1065 <span>SUBSCRIBERS</span></p>
            </div>
            <div class="col-md-3 col-sm-6">
              <p class="metric-inline"><i class="fa fa-user-circle-o"></i> +201 <span>USERS</span></p>
            </div>
          </div>
        </div>
      </div>
    <!-- END SOCIAL -->
    </div>
</div>
 <!--Fin de las gráficas-->

<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">


        </div>
    </div>
</footer>


<!-- JS REPORTE -->
<script>
  $(function() {

    // sparkline charts
    var sparklineNumberChart = function() {

      var params = {
        width: '140px',
        height: '30px',
        lineWidth: '2',
        lineColor: '#20B2AA',
        fillColor: false,
        spotRadius: '2',
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        disableInteraction: false
      };

      $('#number-chart1').sparkline('html', params);
      $('#number-chart2').sparkline('html', params);
      $('#number-chart3').sparkline('html', params);
      $('#number-chart4').sparkline('html', params);
    };

    sparklineNumberChart();


    // traffic sources
    var dataPie = {
      series: [45, 25, 30]
    };

    var labels = ['Direct', 'Organic', 'Referral'];
    var sum = function(a, b) {
      return a + b;
    };

    new Chartist.Pie('#demo-pie-chart', dataPie, {
      height: "290px",
      labelInterpolationFnc: function(value, idx) {
        var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
        return labels[idx] + ' (' + percentage + ')';
      }
    });


    // progress bars
    $('.progress .progress-bar').progressbar({
      display_text: 'none'
    });

    // line chart
    var data = {
      labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      series: [
        [200, 380, 350, 480, 410, 450, 550],
      ]
    };

    var options = {
      height: "200px",
      showPoint: true,
      showArea: true,
      axisX: {
        showGrid: false
      },
      lineSmooth: false,
      chartPadding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 30
      },
      plugins: [
        Chartist.plugins.tooltip({
          appendToBody: true
        }),
        Chartist.plugins.ctAxisTitle({
          axisX: {
            axisTitle: 'Day',
            axisClass: 'ct-axis-title',
            offset: {
              x: 0,
              y: 50
            },
            textAnchor: 'middle'
          },
          axisY: {
            axisTitle: 'Reach',
            axisClass: 'ct-axis-title',
            offset: {
              x: 0,
              y: -10
            },
          }
        })
      ]
    };

    new Chartist.Line('#demo-line-chart', data, options);


    // sales performance chart
    var sparklineSalesPerformance = function() {

      var lastWeekData = [142, 164, 298, 384, 232, 269, 211];
      var currentWeekData = [352, 267, 373, 222, 533, 111, 60];

      $('#chart-sales-performance').sparkline(lastWeekData, {
        fillColor: 'rgba(90, 90, 90, 0.1)',
        lineColor: '#5A5A5A',
        width: '' + $('#chart-sales-performance').innerWidth() + '',
        height: '100px',
        lineWidth: '2',
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        chartRangeMin: 0,
        chartRangeMax: 1000
      });

      $('#chart-sales-performance').sparkline(currentWeekData, {
        composite: true,
        fillColor: 'rgba(60, 137, 218, 0.1)',
        lineColor: '#3C89DA',
        lineWidth: '2',
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        chartRangeMin: 0,
        chartRangeMax: 1000
      });
    }

    sparklineSalesPerformance();

    var sparkResize;
    $(window).on('resize', function() {
      clearTimeout(sparkResize);
      sparkResize = setTimeout(sparklineSalesPerformance, 200);
    });


    // top products
    var dataStackedBar = {
      labels: ['Q1', 'Q2', 'Q3'],
      series: [
        [800000, 1200000, 1400000],
        [200000, 400000, 500000],
        [100000, 200000, 400000]
      ]
    };

    new Chartist.Bar('#chart-top-products', dataStackedBar, {
      height: "280px",
      stackBars: true,
      axisX: {
        showGrid: false
      },
      axisY: {
        labelInterpolationFnc: function(value) {
          return (value / 1000) + 'k';
        }
      },
      plugins: [
        Chartist.plugins.tooltip({
          appendToBody: true
        }),
        Chartist.plugins.legend({
          legendNames: ['Phone', 'Laptop', 'PC']
        })
      ]
    }).on('draw', function(data) {
      if (data.type === 'bar') {
        data.element.attr({
          style: 'stroke-width: 30px'
        });
      }
    });


    // notification popup
  });
</script>

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
