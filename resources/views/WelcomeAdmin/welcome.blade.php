@extends('Layout.app_administradores')
@section('content')
{!!Html::style('assets-Internas\css/tutorial/tutorial.css')!!}
{!!Html::script('assets-Internas\javascripts/tutorial/tutorial.js')!!}
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/1.jpg">
        <progress value="0" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(0,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal2" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/2.jpg">
        <progress value="12.5" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(0,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(1,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 3 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal3" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/3.jpg">
        <progress value="25" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(1,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(2,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 4 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal4" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/4.jpg">
        <progress value="37.5" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(2,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(3,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 5 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal5" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/5.jpg">
        <progress value="50" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(3,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(4,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 6 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal6" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/6.jpg">
        <progress value="62.5" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(4,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(5,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 7 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal7" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/7.jpg">
        <progress value="75" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(5,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(6,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 8 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal8" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/8.jpg">
        <progress value="87.5" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(6,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(7,0)">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 9 -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal9" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="http://localhost/Smartbar/public/assets-Internas/images/tutorial/9.jpg">
        <progress value="100" max="100"></progress>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cambio(7,1)">Anterior</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="finTutorial()">Continuar</button>
      </div>
    </div>
  </div>
</div>
<!--Fin del tutorial-->
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
@endsection
