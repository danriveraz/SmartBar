@extends('Layout.app_administradores')
@section('content')
{!!Html::style('assets-Internas\css/tutorial/tutorial.css')!!}
{!!Html::script('assets-Internas/javascripts/tutorial/tutorial.js')!!}
<!-- css para hoy-->
{!!Html::style('assets-Internas/css/styleWeladmin.css')!!}
<title>
  PocketSmarBar - Bienvenido
</title>
<!--css para Nuevo Tutorial
{!!Html::script('assets-Internas\javascripts/tutorial/sliderTuto.js')!!}-->

<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});
</script>
<!-- INICIO ESTADISTICAS -->
<div class="container">
<!-- iconos datos hoy-->
@include('flash::message')
<div  class="row">
          <div  class="col-lg-4 col-md-6 col-sm-6">
              <div  class="card card-stats">
                  <div  class="card-header card-header-warning card-header-icon">
                      <div  class="card-icon">
                        <img src="{{asset('assets-Internas/images/Layout-icons/FacturadoHoy.png')}}">
                      </div>
                      <p  class="card-category">Utilidad Facturado</p>
                      <h3  class="card-title">
                        <?php
                          echo(ceil($utilidadHoy))
                        ?>
                          <small >.00</small>
                      </h3>
                  </div>
                  <div  class="card-footer">
					  <div class="col-sm-6 pull-right">
                      	<div  class="stats">
							  <i  class="material-icons text-gray">date_range</i>
							  <a>últimas 24 horas</a>
						</div>
                      </div>
						<div class="col-sm-6 lupe">
							  <a href="" title="Ver Mas"><i style="font-size: 21px;" class="pull-right material-icons">loupe</i></a>
						</div>
                  </div>
              </div>
          </div>
          <div  class="col-lg-4 col-md-6 col-sm-6">
              <div  class="card card-stats">
                  <div  class="card-header card-header-success card-header-icon">
                      <div  class="card-icon">
                        <img src="{{asset('assets-Internas/images/Layout-icons/mesa.png')}}">
                      </div>
                      <p  class="card-category">Mesas Reservadas</p>
                      <h3  class="card-title">
                        {{$nMesasReservadas}}
                      </h3>
                  </div>
                  <div  class="card-footer">
					  <div class="col-sm-6 pull-right">
                      	<div  class="stats">
							  <i  class="material-icons text-gray">date_range</i>
							  <a>últimas 24 horas</a>
						</div>
                      </div>
						<div class="col-sm-6 lupe">
							  <a href="" title="Ver Mas"><i style="font-size: 21px;" class="pull-right material-icons">loupe</i></a>
						</div>
                  </div>
              </div>
          </div>
          <div  class="col-lg-4 col-md-6 col-sm-6">
              <div  class="card card-stats">
                  <div  class="card-header card-header-danger card-header-icon">
                      <div  class="card-icon">
                        <img src="{{asset('assets-Internas/images/Layout-icons/mesero.png')}}">
                      </div>
                      <p  class="card-category">Flujo De Personas</p>
                      <h3  class="card-title">
                        {{$flujoPersonas}}
                      </h3>
                  </div>
                  <div  class="card-footer">
					  <div class="col-sm-6 pull-right">
                      	<div  class="stats">
							  <i  class="material-icons text-gray">date_range</i>
							  <a>últimas 24 horas</a>
						</div>
                      </div>
						<div class="col-sm-6 lupe">
							  <a href="" title="Ver Mas"><i style="font-size: 21px;" class="pull-right material-icons">loupe</i></a>
						</div>
                  </div>
              </div>
          </div>
		<!-- col-lg-3 en todas
          <div  class="col-lg-3 col-md-6 col-sm-6">
              <div  class="card card-stats">
                  <div  class="card-header card-header-info card-header-icon">
                      <div  class="card-icon">
                          <i  class="fa fa-twitter"></i>
                      </div>
                      <p  class="card-category">Followers</p>
                      <h3  class="card-title">+245</h3>
                  </div>
                  <div  class="card-footer">
                      <!--<div  class="stats">
                          <i  class="material-icons">date_range</i>
                          <a  href="#pablo">Get More Space...</a>
                      </div>
                  </div>
              </div>
          </div>-->
      </div>
<!-- iconos datos hoy-->
</div>

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
              <form method="post" class="login-form">
							<div id="tab-content2" class="tab-content">
								<!-- registro-->
								<div class="login-form-content">
								<div class="input-container" style="margin-top:0px !important;">
									<i class="fa fa-reorder"></i>
									<input type="text" class="input" id="negocio" placeholder="Nombre de tu Negocio" value="{{$empresa->nombreEstablecimiento}}" required/>
								</div>
                <div class="input-container" id="TipNeg">
                  <i class="fa fa-reorder"></i>
                  <select class="select" id="TipoNegocio" name="TipoNegocio" required>
                    @if($empresa->baroRestaurante=='bar')
                    <option value="bar"selected="selected">Bar</option>
                    <!--<option value="restaurante">Restaurante</option>
                    <option value="barRestaurante">Bar y Restaurante</option>-->
                    @elseif($empresa->baroRestaurante=='restarutante')
                    <option value="bar">Bar</option>
                    <!--<option value="restaurante" selected="selected">Restaurante</option>
                    <option value="barRestaurante">Bar y Restaurante</option>-->
                    @else
                    <option value="bar">Bar</option>
                    <!--<option value="restaurante">Restaurante</option>
                    <option value="barRestaurante" selected="selected">Bar y Restaurante</option>-->
                    @endif
                  </select>
                </div>
								<div class="input-container">
									<i class="fa fa-map-marker"></i>
									<input type="text" class="input" id="direccion" placeholder="Dirección" value="{{$empresa->direccion}}" required/>
								</div>
								<div class="input-container">
									<i class="fa fa-address-card"></i>
									<input type="text" class="input" id="telefono" placeholder="Telefono" value="{{$empresa->telefono}}" required/>
								</div>
								<!--a href="#" class="register">Register</a-->
							</div><!--  fin de login-form-content-->
            <p class="lead" style="margin-bottom: 10px; margin-top: 10px;">Cantidad de <span class="text-success">Mesas</span></p>
              <div class="login-form-content">
                <div class="input-container" style="margin-top:0px !important;">
                  <i class="fa fa-pencil-square-o"></i>
                  <input type="text" class="input" id="mesas" placeholder="No. Mesas" required/>
                </div>
              </div>

							  </div> <!-- tab-content2-->
              </form>

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
								<form method="post" class="login-form">
									<div class="container">
									<p class="lead" style="margin-bottom: 10px;">Informacion <span class="text-success">Tributaria</span></p>
								  </div>
									<div class="input-container">
									<i class="fa fa-drivers-license"></i>
									<input id="nit" type="text" class="input" placeholder="Ingrese su nit xxxxxxx-xx" required="true">
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
								<br>
								<div class="col-centrada">
									<a id="guardar-step-2" class="btn btn-pocket" style="font-weight: 400;" type="submit">
										<i class="fa fa-send"></i>Guardar
									</a>
								</div>
								<br>

							</div><!--  fin de login-form-content-->
							  </div> <!-- tab-content2-->

							</div>
						</div>
					</div>
				</div>


                      </div>
                  </div>
                  <div class="col-md-6 TutoPo">
										<br>
                    <img style="max-width:100%;" src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/admin/BienvenidaComple.jpg" />


                  </div>
              </div>

	<div class="modal-footer buttonTuto slide1Tuto" style="padding: 0px;">
        <button type="button" id="mod1" class="btn btn-pocket" disabled data-dismiss="modal" onclick="cambio(0,0)"  style="font-weight: 400">Siguiente</button>
    </div>

          </div>
      </div>
  </div>
<!--fin-->
</div>

<!-- Modal 2 -->
<div class="modal fade" style="overflow: auto !important;" data-backdrop="static" data-keyboard="false" id="modal2" role="dialog">
<!-- Inicio-->
<div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="well">
				<div class="RegPocket container">
					<div class="row form-group">
						<div class="col-xs-12" style="background-color: white">
							<div class="nav nav-pills">
								<p></p>
								<p class="lead text-center" style="margin-bottom: 10px;font-family: "open sans", "segoe ui"; font-weight: 300">Añade y edita tus <span class="text-success">Categorias</span></p>
								<p></p>
							</div>
						</div>
					</div>
					<div class="row" >
						<div class="col-md-12">
							<div class="col-md-12 well ">

							<div id="tab-content2" class="tab-content">
								<!-- registro-->

        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">

              <div class="widget-content padded clearfix height400" >
<!-- Inicio de input dinamico-->
<form class="login-form" role="form">

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="input-group control-group after-add-more">

							<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="input-container">
											<i class="glyphicon glyphicon-list-alt"></i>
											<input type="text" class="input2" name="nombre" placeholder="Nombre"/>
										</div>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="input-container">
								<i class="fa fa-address-card"></i>
								<input type="text" name="addmore[]" id="ContactNo" class="input2" placeholder="Valor">
							</div>
							</div>


							<div class="input-group-btn">
								<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
							</div>
						</div>
					</div>
			    </div>
				<div class="copy hide">
					<div class="control-group input-group" style="margin-top:10px">

						<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="input-container">
							<i class="glyphicon glyphicon-list-alt"></i>
							<input type="text" class="input2" id="nombre" placeholder="Nombre"/>
						</div>

						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="input-container">
							<i class="fa fa-address-card"></i>
							<input type="text" class="input2" id="valor" placeholder="Valor"/>
						</div>
						</div>


						<div class="input-group-btn">
							<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
						</div>
					</div>
				</div>

		    </form>
              </div>

            </div>
          </div>
        </div>

								<!-- tab-content2-->
							</div>
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

      <div class="modal-footer buttonTuto" style="padding: 0px;">
        <button type="button" class="btn btn-pocket pull-left" data-dismiss="modal" onclick="cambio(0,1)" style="font-weight: 400">Anterior</button>
        <button type="button" class="btn btn-pocket" data-dismiss="modal" onclick="cambio(1,0)" style="font-weight: 400">Siguiente</button>
      </div>

          </div>
      </div>
  </div>
<!-- Fin -->
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
        <button type="button" style="font-weight: 400" class="btn btn-pocket btn-lg"data-dismiss="modal" >Get Started</button>
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

<!-- SCRIPT SWEETALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- SCRIPT SWEETALERT -->


<script>
  $(document).ready(function () {
    var tutorial = '{{$tutorial}}';
    if(tutorial != 1){
      $("#modal1").modal("show");
    }else{
    	$("#modal1").modal("hide");
    }
  });
</script>

<!--Script para input dinamico-->
<script>
$(document).ready(function() {
      $(".add-more").click(function(){
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });
      $("body").on("click",".remove",function(){
          $(this).parents(".control-group").remove();
      });
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
    });

    $('#guardar-step-2').on('click', function(e) {
    	var negocio = $("#negocio").val();
    	var direccion = $("#direccion").val();
    	var telefono = $("#telefono").val();
    	var mesas = $("#mesas").val();
    	var TipoNegocio = $("#TipoNegocio").val();

    	var nit = $("#nit").val();
    	var tipReg = $("#TipReg").val();

    	var imgRes = $("#imgRes").val();
    	var resolucion = $("#resolucion").val();
    	var fechaResolucion = $("#fechaResolucion").val();
    	var nInicio = $("#nInicio").val();
    	var nFinal = $("#nFinal").val();

    	$.ajax({
    		url: 'https://localhost/SmartBar/public/WelcomeAdmin/datos',
    		type: 'GET',
    		data: {
    			negocio: negocio,
    			direccion: direccion,
    			telefono: telefono,
    			TipoNegocio: TipoNegocio,
    			mesas: mesas,
    			nit: nit,
    			tipReg: tipReg,
    			imgRes: imgRes,
    			resolucion: resolucion,
    			fechaResolucion: fechaResolucion,
    			nInicio: nInicio,
    			nFinal: nFinal
    		},
    		success: function(){
    			//alert("La información se ha actualizado correctamente.");
          //swal ( "La información se ha actualizado correctamente ") ;
          swal({
            title: "Información Guardada!",
            text: "Registro actualizado correctamente ",
            icon: "success",
            buttons: false,
            //timer: 10000,
          });
    			document.getElementById("mod1").disabled = false;
    		},
    		error: function(data){
          swal({
            title: "warning!",
            text: "por favor disculpanos. Ocurrió un error y estamos trabajando en ello.",
            icon: "warning",
            buttons: false,
            //timer: 10000,
          });

    		}
    	});
    });
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
<!--- script de slider tuto-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" type="text/javascript"></script>
<script>
$(function () {
    var count = 0;
    $('.owl-carousel').each(function () {
        $(this).attr('id', 'owl-demo' + count);
        $('#owl-demo' + count).owlCarousel({
            navigation: true,
            slideSpeed: 300,
            pagination: true,
            singleItem: true,
            autoPlay: 2000,
            autoHeight: true
        });
        count++;
    });
});
</script>
<!--- script de slider tuto-->

@endsection
