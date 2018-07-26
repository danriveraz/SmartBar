@extends('Layout.app_administradores')
@section('content')

    <div class="modal-shiftfix">
      <div class="container-fluid main-content">
        <div class="page-title chart-container">
          <h1>
            Gráficas
          </h1>
        </div>

<div class="row">
  <div class="col-md-6">
    <!-- Inicio Gráfica de categorias ventas totales -->
    <div class="row">
      <i class="fa fa-bar-chart-o"></i>Categorias Más Vendidas
      <form id="formCategoriaTotal" class="login-form">
        <fieldset>
        <div class="col-md-4">
            <div class="input-container"> 
              <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha Inicio" name="fechaInicio"  type="date">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-container"> 
              <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha Fin" name="fechaFin" type="date">
            </div>
        </div>
        <div class="col-md-2">
          <div  class="form-group">
            <a id='buscarCategoriaTotal' class="btn btn-pocket" type="submit" style="font-weight: 400;">
              <i class="fa fa-send"></i>
              Buscar
            </a>
          </div>
        </div>
      </form>
    </div>
    <div class="row">
        <div class="widget-container fluid-height">
          <div class="widget-content padded text-center">
            <div class="graph-container">
              <div class="caption"></div>
              <div class="graph" id="GraficaCategoriasTotal"></div>
              <!-- Bar Charts:Morris -->
            </div>
          </div>
        </div>
    </div>
    <!-- Fin Gráfica de categorias ventas totales -->
  </div>
  <!-- Inicio de tabulador de Gráfica de categorias -->
  <div class="col-md-6">
    <div id="exTab2" class="container"> 
      <ul class="nav nav-tabs">
        <li >
          <a href="#tabCategoriasDias" data-toggle="tab">Por Días</a>
        </li>
        <li class="active">
          <a  href="#tabCategoriasSemana" data-toggle="tab">Por Semana</a>
        </li>
        <li><a href="#3" data-toggle="tab">Solution</a>
        </li>
      </ul>

      <div class="tab-content">

        <!-- Inicio Gráfica de categorias Por Días -->
        <div class="tab-pane" id="tabCategoriasDias">
          <div class="row">
            <form id="formCategoriaSemana" class="login-form">
              <fieldset>
              <div class="col-md-4">
                  <div class="input-container"> 
                    <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha Inicio" name="fechaInicio"  type="date">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="input-container"> 
                    <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha Fin" name="fechaFin" type="date">
                  </div>
              </div>
              <div class="col-md-2">
                <div  class="form-group">
                  <a id='buscarCategoriaDias' class="btn btn-pocket" type="submit" style="font-weight: 400;">
                    <i class="fa fa-send"></i>
                    Buscar
                  </a>
                </div>
              </div>
            </form>
          </div>
          <div class="row">
              <div class="widget-container fluid-height">
                <div class="widget-content padded text-center">
                  <div class="graph-container">
                    <div class="caption"></div>
                    <div class="graph" id="GraficaCategoriasDias"></div>
                    <!-- Bar Charts:Morris -->
                  </div>
                </div>
              </div>            
          </div>
        </div>
        <!-- Fin Gráfica de categorias Por Dias -->
        <!-- Inicio Gráfica de categorias Por semanas -->
        <div class="tab-pane active" id="tabCategoriasSemana">
          <div class="row">
            <form id="formCategoriaSemana" class="login-form">
              <fieldset>
              <div class="col-md-4">
                  <div class="input-container"> 
                    <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha Inicio" name="fechaInicio" id="fechaInicio" type="date">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="input-container"> 
                    <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha Fin" name="fechaFin" id="fechaFin" type="date">
                  </div>
              </div>
              <div class="col-md-2">
                <div  class="form-group">
                  <a id='buscarCategoriaSemana' class="btn btn-pocket" type="submit" style="font-weight: 400;">
                    <i class="fa fa-send"></i>
                    Buscar
                  </a>
                </div>
              </div>
            </form>
          </div>
          <div class="row">
              <div class="widget-container fluid-height">
                <div class="widget-content padded text-center">
                  <div class="graph-container">
                    <div class="caption"></div>
                    <div class="graph" id="GraficaCategoriasSemana"></div>
                    <!-- Bar Charts:Morris -->
                  </div>
                </div>
              </div>            
          </div>
        </div>
        <!-- Fin Gráfica de categorias Por semanas -->
        <div class="tab-pane" id="3">
          <h3>add clearfix to tab-content (see the css)</h3>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin de tabulador de Gráfica de categorias -->
</div>



        <div class="row">
          <!-- Line Chart -->
          <div class="col-md-6">
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Line Chart
              </div>
              <div class="widget-content padded">
                <div class="chart-graph line-chart">
                  <div id="linechart-2">
                    Loading...
                  </div>
                  <ul class="chart-text-axis">
                    <li>
                      1
                    </li>
                    <li>
                      2
                    </li>
                    <li>
                      3
                    </li>
                    <li>
                      4
                    </li>
                    <li>
                      5
                    </li>
                    <li>
                      6
                    </li>
                    <li>
                      7
                    </li>
                    <li>
                      8
                    </li>
                    <li>
                      9
                    </li>
                    <li>
                      10
                    </li>
                    <li>
                      11
                    </li>
                    <li>
                      12
                    </li>
                  </ul>
                  <!-- end Line Chart -->
                </div>
              </div>
            </div>
          </div>
          <!-- Line Chart -->
          <div class="col-md-6">
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Bar chart
              </div>
              <div class="widget-content padded text-center">
                <div class="chart-graph">
                  <div id="barchart-2">
                    Loading...
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end Line Chart -->
        </div>
        <div class="row">
          <!-- Donut Charts -->
          <div class="col-lg-8">
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Donut Charts
              </div>
              <div class="widget-content clearfix">
                <div class="col-sm-4">
                  <div class="pie-chart1 pie-chart pie-number" data-percent="87">
                    87%
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="pie-chart2 pie-chart pie-number" data-percent="26">
                    26%
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="pie-chart3 pie-chart pie-number" data-percent="54">
                    54%
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end Donut Charts --><!-- Pie Chart -->
          <div class="col-lg-4">
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Pie Chart
              </div>
              <div class="widget-content padded">
                <div class="pie-chart">
                  <div id="pie-chart"></div>
                  <ul class="chart-key">
                    <li>
                      <span class="green"></span>Category 1
                    </li>
                    <li>
                      <span class="orange"></span>Category 2
                    </li>
                    <li>
                      <span class="red"></span>Category 3
                    </li>
                    <li>
                      <span class="blue"></span>Category 4
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- end Pie Chart -->
        </div>
        <div class="row">
          <!-- Composite Graph -->
          <div class="col-lg-6">
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Composite Graph
              </div>
              <div class="widget-content padded text-center">
                <div id="composite-chart-1">
                  Loading...
                </div>
              </div>
            </div>
          </div>
          <!-- end Composite Graph --><!-- Composite Graph -->
          <div class="col-lg-6">
            <div class="widget-container">
              <div class="heading">
                <i class="fa fa-bar-chart"></i>Composite Graph
              </div>
              <div class="widget-content padded">
                <div id="linechart-1">
                  Loading...
                </div>
              </div>
            </div>
          </div>
          <!-- end Composite Graph -->
        </div>
        <!-- Line Chart:Morris -->
        <div class="row">
          <div class="col-md-6">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Line Chart
              </div>
              <div class="widget-content padded text-center">
                <div class="graph-container">
                  <div class="caption"></div>
                  <div class="graph" id=""></div>
                  <!-- Line Chart:Morris -->
                </div>
              </div>
            </div>
          </div>
          <!-- Bar Charts:Morris -->
          <div class="col-md-6">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Bar Charts
              </div>
              <div class="widget-content padded text-center">
                <div class="graph-container">
                  <div class="caption"></div>
                  <div class="graph" id="categoriasBar"></div>
                  <!-- Bar Charts:Morris -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Area Charts:Morris -->
          <div class="col-md-6">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Area Chart
              </div>
              <div class="widget-content padded text-center">
                <div class="graph-container">
                  <div class="caption"></div>
                  <div class="graph" id="hero-area"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Area Charts:Morris --><!-- Donut Charts:Morris -->
          <div class="col-md-6">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="fa fa-bar-chart-o"></i>Donut Chart
              </div>
              <div class="widget-content padded text-center">
                <div class="graph-container">
                  <div class="caption"></div>
                  <div class="graph" id="hero-donut"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Donut Charts:Morris -->
        </div>
      </div>
    </div>
    <div class="style-selector">
      <div class="style-selector-container">
        <h2>
          Layout Style
        </h2>
        <select name="layout"><option value="fluid">Fluid<option value="boxed">Boxed</select>
        <h2>
          Navigation Style
        </h2>
        <select name="nav"><option value="top">Top<option value="left">Left</select>
        <h2>
          Color Options
        </h2>
        <ul class="color-options clearfix">
          <li>
            <a class="blue" href="javascript:chooseStyle('none', 30)"></a>
          </li>
          <li>
            <a class="green" href="javascript:chooseStyle('green-theme', 30)"></a>
          </li>
          <li>
            <a class="orange" href="javascript:chooseStyle('orange-theme', 30)"></a>
          </li>
          <li>
            <a class="magenta" href="javascript:chooseStyle('magenta-theme', 30)"></a>
          </li>
          <li>
            <a class="gray" href="javascript:chooseStyle('gray-theme', 30)"></a>
          </li>
        </ul>
        <h2>
          Background Patterns
        </h2>
        <ul class="pattern-options clearfix">
          <li>
            <a class="active" href="#" id="bg-1"></a>
          </li>
          <li>
            <a href="#" id="bg-2"></a>
          </li>
          <li>
            <a href="#" id="bg-3"></a>
          </li>
          <li>
            <a href="#" id="bg-4"></a>
          </li>
          <li>
            <a href="#" id="bg-5"></a>
          </li>
        </ul>
        <div class="style-toggle closed">
          <span aria-hidden="true" class="hightop-gear"></span>
        </div>
      </div>
    </div>

<script type="text/javascript">
  /*
   * =============================================================================
   *   Morris Chart JS
   * =============================================================================
   */
   // datos para las gráficas, se pasa por medio de variables globales para tener acceso a ellas desde las funciones de ajax y la función que se llama cada vez que se hace resize
   var datosCategoriaTotal = {!!$categorias->toJson(JSON_PRETTY_PRINT);!!};
   var datosCategoriaSemana = {!! $categoriasVentasPorSemana !!};

  $(window).resize(function(e) {
    var morrisResize;
    clearTimeout(morrisResize);
    return morrisResize = setTimeout(function() {
      return buildMorris(true);
    }, 500);
  });
  $(function() {
    return buildMorris();
  });
  buildMorris = function($re) {
    var tax_data;
    if ($re) {
      $(".graph").html("");
    }
    tax_data = [
      {
        period: "2011 Q3",
        licensed: 3407,
        sorned: 660
      }, {
        period: "2011 Q2",
        licensed: 3351,
        sorned: 629
      }, {
        period: "2011 Q1",
        licensed: 3269,
        sorned: 618
      }, {
        period: "2010 Q4",
        licensed: 3246,
        sorned: 661
      }, {
        period: "2009 Q4",
        licensed: 3171,
        sorned: 676
      }, {
        period: "2008 Q4",
        licensed: 3155,
        sorned: 681
      }, {
        period: "2007 Q4",
        licensed: 3226,
        sorned: 620
      }, {
        period: "2006 Q4",
        licensed: 3245,
        sorned: null
      }, {
        period: "2005 Q4",
        licensed: 3289,
        sorned: null
      }
    ];

    if ($('#hero-donut').length) {
      Morris.Donut({
        element: "hero-donut",
        data: [
          {
            label: "Development",
            value: 25
          }, {
            label: "Sales & Marketing",
            value: 40
          }, {
            label: "User Experience",
            value: 25
          }, {
            label: "Human Resources",
            value: 10
          }
        ],
        colors: ["#f0ad4e"],
        formatter: function(y) {
          return y + "%";
        }
      });
    }
    if ($('#hero-area').length) {
      Morris.Area({
        element: "hero-area",
        data: [
          {
            period: "2010 Q1",
            iphone: 2666,
            ipad: null,
            itouch: 2647
          }, {
            period: "2010 Q2",
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
          }, {
            period: "2010 Q3",
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
          }, {
            period: "2010 Q4",
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
          }, {
            period: "2011 Q1",
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
          }, {
            period: "2011 Q2",
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
          }, {
            period: "2011 Q3",
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
          }, {
            period: "2011 Q4",
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
          }, {
            period: "2012 Q1",
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
          }, {
            period: "2012 Q2",
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
          }
        ],
        xkey: "period",
        ykeys: ["iphone", "ipad", "itouch"],
        labels: ["iPhone", "iPad", "iPod Touch"],
        hideHover: "auto",
        lineWidth: 2,
        pointSize: 4,
        lineColors: ["#a0dcee", "#f1c88e", "#a0e2a0"],
        fillOpacity: 0.5,
        smooth: true
      });
    }
//Gráfica del comportamiento de ventas agrupado por semana
    if ($('#GraficaCategoriasSemana').length) {
      Morris.Line({
        element: "GraficaCategoriasSemana",
        data: datosCategoriaSemana,
        xkey: "semana",
        ykeys: ["Bebidas", "Cervezas","Otros","Licores"],
        labels: ["Bebida", "Cerveza","Otros","Licores"],
        lineColors: ["#5bc0de", "#60c560", "#2d0031", "#666666"],
        hideHover: "auto",
        smooth:false,
        postUnits:' Ventas',
        //dateFormat:function (x) { return new Date(x).toString(); },
        //hoverCallback: function (index, options, content, row) {return "sin(" + content + ") = " + options;}
      });
    }

//Gráfica del comportamiento de ventas agrupado por Días
    if ($('#GraficaCategoriasDias').length) {
      Morris.Line({
        element: "GraficaCategoriasDias",
        data: datosCategoriaSemana,
        xkey: "semana",
        ykeys: ["Bebidas", "Cervezas","Otros","Licores"],
        labels: ["Bebida", "Cerveza","Otros","Licores"],
        lineColors: ["#00ff00", "#00ff00", "#00ff00", "#00ff00"],
        hideHover: "auto",
        smooth:false,
        postUnits:' Ventas',
        //dateFormat:function (x) { return new Date(x).toString(); },
        //hoverCallback: function (index, options, content, row) {return "sin(" + content + ") = " + options;}
      });
    }

//Gráfica de barras para las ventas totales
    if ($('#GraficaCategoriasTotal').length) {
      return Morris.Bar({
        element: "GraficaCategoriasTotal",
        data: datosCategoriaTotal,
        xkey: "nombre",
        ykeys: ["total"],
        labels: ["total"],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: "auto",
        barColors: ["#5bc0de"]
      });
    }




  };

//Ajax para cargar los datos de 
$("#buscarCategoriaSemana").click(function(){
    console.log("entro");
    var type = "POST";
    var formData = new FormData($('#formCategoriaSemana')[0]);
    $.ajax({
        url: '{{url('Estadisticas/ventasCategoriasPorSemana')}}',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: type,
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
          $('#GraficaCategoriasSemana').empty();
          datosCategoriaSemana = data;
          Morris.Line({
            element: "GraficaCategoriasSemana",
            data: data,
            xkey: "semana",
            ykeys: ["Bebidas", "Cervezas","Otros","Licores"],
            labels: ["Bebida", "Cerveza","Otros","Licores"],
            lineColors: ["#5bc0de", "#60c560", "#2d0031", "#666666"]
          });
        }, error: function(xhr,status, response) {
          console.log(xhr.responseText);
        }
    });
});
$("#buscarCategoriaTotal").click(function(){
    console.log("entro");
    var type = "POST";
    var formData = new FormData($('#formCategoriaTotal')[0]);
    $.ajax({
        url: '{{url('Estadisticas/categoriasMasVendidas')}}',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: type,
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
          $('#GraficaCategoriasTotal').empty();
          datosCategoriaTotal = data;
          Morris.Bar({
            element: "GraficaCategoriasTotal",
            data: data,
            xkey: "nombre",
            ykeys: ["total"],
            labels: ["total"],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: "auto",
            barColors: ["#5bc0de"]
          });
        }, error: function(xhr,status, response) {
          console.log(xhr.responseText);
        }
    });
});


//Esto es para refresar las gráficas cada vez que se cambia de tabulación, PD: esas gráficas molestan mucho 
$('[data-toggle="tab"]').click(function(){
  var morrisResize;
  clearTimeout(morrisResize);
  return morrisResize = setTimeout(function() {
    return buildMorris(true);
  }, 500);
});

</script>
@endsection