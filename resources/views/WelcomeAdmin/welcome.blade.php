@extends('Layout.app_administradores')
@section('content')
{!!Html::style('assets-Internas\css/tutorial/tutorial.css')!!}
{!!Html::script('assets-Internas\javascripts/tutorial/tutorial.js')!!}
<title>
  SMARTBAR
</title>


<!--css para Nuevo Tutorial-->
{!!Html::script('assets-Internas\javascripts/tutorial/sliderTuto.js')!!}

<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});
</script>
<!-- INICIO ESTADISTICAS -->
<br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4">
        <div class="item social-widget twitter" style="margin-bottom: 2%;">
          <i class="fa fa-money"></i>
          <div class="social-data">
            <h1>
              <?php
                echo(ceil($utilidadHoy))
              ?>
            </h1>
          </div>
          <div>
            <p>
              Utilidad facturado HOY
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="item social-widget twitter" style="margin-bottom: 2%;">
          <img src="images/mesa.png" style="margin-left: -5%;">
          <div class="social-data">
            <h1>
              {{$nMesasReservadas}}
            </h1>
          </div>
          <div>
            <p>
              Mesas reservadas HOY
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="item social-widget twitter" style="margin-bottom: 2%;">
          <i class="fa fa-group"></i>
          <div class="social-data">
            <h1>
              {{$flujoPersonas}}
            </h1>
          </div>
          <div>
            <p>
              Flujo de personas
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-6" style="margin-top: 2%;">
        <div id="piechart"></div>
      </div>
      <div class="col-md-6">
        <div id="container"></div>
      </div>
    </div>
  </div>
</div>
<br>
<!-- FIN ESTADISTICAS -->

<!-- Inicio del tutorial -->

<!-- Modal 1 -->
<div class="modal fade" style="overflow: auto !important;" data-backdrop="static" data-keyboard="false" id="modal1" role="dialog">
<!--Inicio-->
<div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="RegPocket modal-body">
              <div class="Tupo row">
                  <div class="col-md-6">
                      <div class="well">
				<div class="RegPocket container">
					<div class="row form-group">
						<div class="col-xs-12 TutoPocket">
							<ul class="nav nav-pills nav-justified thumbnail setup-panel">
								<li class="active"><a href="#step-1">
									<h4 class="list-group-item-heading"><i class="fa fa-2x fa-reorder"></i></h4>
									<p class="list-group-item-text"><label>Configuracion Establecimiento</label></p>
								</a></li>
								<li class="disabled"><a href="#step-2">
									<h4 class="list-group-item-heading"><i class="fa fa-1x fa-newspaper-o"></i></h4>
									<p class="list-group-item-text"><label>Informacion Tributaria</label></p>
								</a></li>
							</ul>
						</div>
					</div>
					<div class="row setup-content" id="step-1">
						<div class="col-xs-12">
							<div class="col-md-12 well ">

							<div id="tab-content2" class="tab-content">
								<!-- registro-->
								<div class="login-form-content">
								<form method="post" action="" class="login-form">
								<div class="input-container">
									<i class="fa fa-reorder"></i>
									<input type="text" class="input" name="negocio" placeholder="Nombre de tu Negocio" required/>
								</div>
								<div class="input-container">
									<i class="fa fa-map-marker"></i>
									<input type="text" class="input" name="direccion" placeholder="Dirección" required/>
								</div>
								<div class="input-container">
									<i class="fa fa-address-card"></i>
									<input type="text" class="input" name="telefono" placeholder="Telefono" required/>
								</div>
								<div class="input-container">
									<i class="fa fa-map"></i>
								<select class="select" id="sexo" name="sexo" required="">
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
									<option value="Otro">Otro</option>
								</select>
								</div>
								<div class="input-container">
									<i class="fa fa-map"></i>
								<select class="select" id="sexo" name="sexo" required="">
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
									<option value="Otro">Otro</option>
								</select>
								</div>
								<!--a href="#" class="register">Register</a-->
							</form>

							</div><!--  fin de login-form-content-->
							  </div> <!-- tab-content2-->
								<br>
								<div class="col-centrada">
									<a id="activate-step-2" class="btn btn-pocket" style="font-weight: 400;" type="submit">
										<i class="fa fa-send"></i>Siguiente Paso
									</a>
								</div>
								<br>
							</div>
						</div>
					</div>
					<div class="row setup-content" id="step-2">
						<div class="col-xs-12">
							<div class="col-md-12 well ">

							<div id="tab-content2" class="tab-content">
								<!-- registro-->
								<div class="login-form-content">
								<form method="post" action="" class="login-form">
									<div class="container">
									<p class="lead" style="margin-bottom: 10px;">Informacion <span class="text-success">Tributaria</span></p>
								  </div>
									<div class="input-container">
									<i class="fa fa-drivers-license"></i>
									<input name="nit" type="text" class="input" placeholder="Ingrese su nit xxxxxxx-xx" required="true">
									</div>
									<div class="input-container">
									<i style="line-height: inherit; position: inherit;" class="glyphicon glyphicon-list-alt"></i>
								<select class="select" id="TipReg" name="TipReg" onchange="valor(this.value);" required="">
										<option value="RegSimpli">Regimen Simplificado</option>
										<option value="RegComun">Regimen Comun</option>
								</select>
									</div>
									<div id="ViewReg" style="display: none;">
									  <div class="input-container">
										<div class="input-group" style="width: 100%;">
										  <label class="input-group-btn" style="display: table-cell;">
											<span class="btn btn-pocket">
												Subir resolución <input type="file" name="imgRes" id="imgRes" style="display: none;" multiple>
											</span>
										  </label>
										  <input type="text" class="form-control" readonly>
										</div>
									  </div>
										<div class="input-container">
										  <i class="fa fa-address-card"></i>
										  <input class="input" id="resolucion" name="resolucion" placeholder="Resolución de facturación" type="text" id="regimen" name="regimen" >
										</div>
									  <div class="input-container">
										  <i class="fa fa-drivers-license"></i>
										  <input class="input" name="fechaResolucion" id="fechaResolucion" type="date" placeholder="Fecha resolución">
									  </div>
									  <div class="input-container">
										<div class="input-group">
										  <div class="col-md-6">
											<input name="nInicio" id="nInicio" type="text" class="input" placeholder="Del No." required="true">
										  </div>
										  <div class="col-md-6">
											<input name="nFinal" id="nFinal" type="text" class="input" placeholder="Hasta" required="true">
										  </div>
										</div>
									  </div>
									</div>
								</form>

							</div><!--  fin de login-form-content-->
							  </div> <!-- tab-content2-->
								<br>
								<div class="col-centrada">
									<a id="activate-step-2" class="btn btn-pocket" style="font-weight: 400;" type="submit">
										<i class="fa fa-send"></i>Guardar
									</a>
								</div>
								<br>
							</div>
						</div>
					</div>
				</div>

                          </form>
                      </div>
                  </div>
                  <div class="col-md-6 TutoPo">
										<br>
                    <img style="max-width:100%;" src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/admin/BienvenidaComple.jpg" />


                  </div>
              </div>

	<div class="modal-footer buttonTuto slide1Tuto" style="padding: 0px;">
        <button type="button" class="btn btn-pocket" data-dismiss="modal" onclick="cambio(0,0)"  style="font-weight: 400">Siguiente</button>
    </div>

          </div>
      </div>
  </div>
<!--fin-->
</div>

<!-- Modal 2 -->
<div class="modal fade" style="overflow: auto !important;" data-backdrop="static" data-keyboard="false" id="modal2" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
			<br>
<!--Inicio-->
<div id="slider1_container" style="visibility: hidden; position: relative; margin: 0 auto;
	top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
			<!-- Loading Screen -->
			<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
					<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/loading/static-svg/spin.svg" />
			</div>

			<!-- Slides Container -->
			<div data-u="slides" style="position: absolute; left: 0px; top: 0px; width: 1300px; height: 500px; overflow: hidden;">
					<div>
							<img data-u="image" src="https://images.pexels.com/photos/312491/pexels-photo-312491.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" />
					</div>
					<div>
							<img data-u="image" src="https://images.pexels.com/photos/312491/pexels-photo-312491.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" />
					</div>
					<div>
							<img data-u="image" src="https://images.pexels.com/photos/305268/pexels-photo-305268.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" />
					</div>
			</div>

			<!--#region Bullet Navigator Skin Begin -->
			<!-- Help: https://www.jssor.com/development/slider-with-bullet-navigator.html -->
			<div data-u="navigator" class="jssorb031" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
					<div data-u="prototype" class="i" style="width:16px;height:16px;">
							<svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
									<circle class="b" cx="8000" cy="8000" r="5800"></circle>
							</svg>
					</div>
			</div>
			<!--#endregion Bullet Navigator Skin End -->

			<!--#region Arrow Navigator Skin Begin -->
			<!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->

			<div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
					<svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
					</svg>
			</div>
			<div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
					<svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
					</svg>
			</div>
			<!--#endregion Arrow Navigator Skin End -->
	</div>
	<!-- Jssor Slider End -->
<!--Fin-->
      <div class="modal-footer buttonTuto" style="padding: 0px;">
        <button type="button" class="btn btn-pocket pull-left" data-dismiss="modal" onclick="cambio(0,1)" style="font-weight: 400">Anterior</button>
        <button type="button" class="btn btn-pocket" data-dismiss="modal" onclick="cambio(1,0)" style="font-weight: 400">Siguiente</button>
      </div>
<br>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" style="overflow: auto !important;" data-backdrop="static" data-keyboard="false" id="modal3" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
<!-- Inicio de Contenido-->
<div class="container bg-overlay">
	<div class="row text-center">
		<h1>This is a beautiful background image<br> with a transparent overlay.</h1>
        <h4>You can just use the "<strong>.bg-overlay</strong>" class on any container/element,<br>
        and specify the image you want to use and its height.</h4>
        <br><br>
        <button type="button" style="font-weight: 400" class="btn btn-pocket btn-lg"data-dismiss="modal" onclick="finTutorial()">Get Started</button>
	</div>
</div>
<!-- Fin de Contenido-->
      <div class="modal-footer">
<!--    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(1,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(2,0)">Siguiente</button>
-->
<section id="carousel" class="sliderTuText" style="background-color: white;">
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
      <!-- Carousel indicators -->
      <!-- Carousel items -->
      <div class="carousel-inner">
        <div class="active item">
          <blockquote>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantiumtempore</p>
          </blockquote>
        </div>
        <div class="item">
          <blockquote>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantiumtempore</p>
          </blockquote>
        </div>
        <div class="item">
          <blockquote>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantiumtempore</p>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>

      </div>
    </div>
  </div>
</div>
<!-- Modal 4 -->
<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
        </div>
    </div>
</footer>

<script>
  $(document).ready(function () {
    var tutorial = '{{$tutorial}}';
    if(tutorial != 1){
      $("#modal1").modal("show");
    }else{
      //$("#modal1").modal("hide");
    }
  });
</script>

<!-- JS ESTADISTICAS -->
<script type="text/javascript">
  var mesas = <?php echo $mesas; ?>;
  var vendedores = <?php echo $vendedores; ?>;
  google.charts.load('current', {'packages':['corechart']});
  //Estadisticas de las mesas
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    console.log(mesas, vendedores[0]);
    if(mesas.length > 1){
      var data = google.visualization.arrayToDataTable(mesas);
    }else{
      var data = google.visualization.arrayToDataTable([
        ['Nombre', 'Total venta'],
        ['Mesa de ejemplo 1', 2],
        ['Mesa de ejemplo 2', 1]
        ]);
    }

    var options = {
      width: 500,
      height: 350,
      is3D: true,
      legend: { position: 'none' },
      title: 'Ventas por mesas HOY',
      titleTextStyle: {
        color: '#666666',
        fontName: 'Lato',
        fontSize: '20',
        bold: 'false',
      },
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('container'));
    google.visualization.events.addListener(chart, 'ready', titleCenter);

    chart.draw(data, options);

    function titleCenter() {
      var $container = $('#container');
      var svgWidth = $container.find('svg').width();
      var $titleElem = $container.find("text:contains(" + options.title + ")");
      var titleWidth = $titleElem.html().length * ($titleElem.attr('font-size')/2);
      var xAxisAlign = (svgWidth - titleWidth)/2;
      $titleElem.attr('x', xAxisAlign);
    }
  }

  //Estadisticas de los vendedores
  google.charts.setOnLoadCallback(drawChartPie);

  function drawChartPie() {
    if(vendedores.length > 1){
      var dataPie = google.visualization.arrayToDataTable(vendedores);
    }else{
      var dataPie = google.visualization.arrayToDataTable([
        ['Nombre', 'Total venta'],
        ['Vendedor de ejemplo 1', 2],
        ['Vendedor de ejemplo 2', 1]
        ]);
    }

    var optionsPie = {
      width: 500,
      height: 350,
      is3D: true,
      legend: { position: 'none' },
      title: 'Ventas por vendedor HOY',
      titleTextStyle: {
        color: '#666666',
        fontName: 'Lato',
        fontSize: '20',
        bold: 'false',
      },
      isStacked: true,
    };

    var chartPie = new google.visualization.PieChart(document.getElementById('piechart'));
    google.visualization.events.addListener(chartPie, 'ready', titleCenterPie);
    chartPie.draw(dataPie, optionsPie);

    function titleCenterPie() {
      var $container = $('#piechart');
      var svgWidth = $container.find('svg').width();
      var $titleElem = $container.find("text:contains(" + optionsPie.title + ")");
      var titleWidth = $titleElem.html().length * ($titleElem.attr('font-size')/2);
      var xAxisAlign = (svgWidth - titleWidth)/2;
      $titleElem.attr('x', xAxisAlign);
    }
  }

</script>
<!-- FIN JS ESTADISTICAS -->

<style type="text/css">
  #piechart{
  }
</style>

<!-- Script DE TUTORIAL SLIDER-->

<script>
$(document).ready(function() {

    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');

        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });

    $('ul.setup-panel li.active a').trigger('click');

    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })
});


</script>
<script>

$('#TipReg').change(function(){
    var valorCambiado =$(this).val();
    if((valorCambiado == 'RegSimpli')){
       $('#ViewReg').css('display','none');
     }
     else if(valorCambiado == 'RegComun')
     {
       $('#ViewReg').css('display','block');
     }
});


</script>



@endsection
