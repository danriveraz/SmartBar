@extends('Layout.app')
@section('content')

<!DOCTYPE html>
<html>
  <head>
    <title>
      hightop - Dashboard
    </title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\bootstrap.min.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\font-awesome.min.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\hightop-font.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\isotope.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\jquery.fancybox.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\fullcalendar.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\wizard.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\select2.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\morris.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\datatables.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\datepicker.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\timepicker.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\colorpicker.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\bootstrap-switch.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\bootstrap-editable.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\daterange-picker.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\typeahead.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\summernote.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\social-buttons.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css"><link href="stylesheets\dropzone.css" media="screen" rel="stylesheet" type="text/css"><link href="stylesheets\nestable.css" media="screen" rel="stylesheet" type="text/css"><link href="stylesheets\pygments.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\style.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\color\green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css"><link href="stylesheets\color\orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css"><link href="stylesheets\color\magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css"><link href="stylesheets\color\gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css"><script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script><script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script><script src="javascripts\bootstrap.min.js" type="text/javascript"></script><script src="javascripts\raphael.min.js" type="text/javascript"></script><script src="javascripts\selectivizr-min.js" type="text/javascript"></script><script src="javascripts\jquery.mousewheel.js" type="text/javascript"></script><script src="javascripts\jquery.vmap.min.js" type="text/javascript"></script><script src="javascripts\jquery.vmap.sampledata.js" type="text/javascript"></script><script src="javascripts\jquery.vmap.world.js" type="text/javascript"></script><script src="javascripts\jquery.bootstrap.wizard.js" type="text/javascript"></script><script src="javascripts\fullcalendar.min.js" type="text/javascript"></script><script src="javascripts\gcal.js" type="text/javascript"></script><script src="javascripts\jquery.dataTables.min.js" type="text/javascript"></script><script src="javascripts\datatable-editable.js" type="text/javascript"></script><script src="javascripts\jquery.easy-pie-chart.js" type="text/javascript"></script><script src="javascripts\excanvas.min.js" type="text/javascript"></script><script src="javascripts\jquery.isotope.min.js" type="text/javascript"></script><script src="javascripts\isotope_extras.js" type="text/javascript"></script><script src="javascripts\modernizr.custom.js" type="text/javascript"></script><script src="javascripts\jquery.fancybox.pack.js" type="text/javascript"></script><script src="javascripts\select2.js" type="text/javascript"></script><script src="javascripts\styleswitcher.js" type="text/javascript"></script><script src="javascripts\wysiwyg.js" type="text/javascript"></script><script src="javascripts\typeahead.js" type="text/javascript"></script><script src="javascripts\summernote.min.js" type="text/javascript"></script><script src="javascripts\jquery.inputmask.min.js" type="text/javascript"></script><script src="javascripts\jquery.validate.js" type="text/javascript"></script><script src="javascripts\bootstrap-fileupload.js" type="text/javascript"></script><script src="javascripts\bootstrap-datepicker.js" type="text/javascript"></script><script src="javascripts\bootstrap-timepicker.js" type="text/javascript"></script><script src="javascripts\bootstrap-colorpicker.js" type="text/javascript"></script><script src="javascripts\bootstrap-switch.min.js" type="text/javascript"></script><script src="javascripts\typeahead.js" type="text/javascript"></script><script src="javascripts\spin.min.js" type="text/javascript"></script><script src="javascripts\ladda.min.js" type="text/javascript"></script><script src="javascripts\moment.js" type="text/javascript"></script><script src="javascripts\mockjax.js" type="text/javascript"></script><script src="javascripts\bootstrap-editable.min.js" type="text/javascript"></script><script src="javascripts\xeditable-demo-mock.js" type="text/javascript"></script><script src="javascripts\xeditable-demo.js" type="text/javascript"></script><script src="javascripts\address.js" type="text/javascript"></script><script src="javascripts\daterange-picker.js" type="text/javascript"></script><script src="javascripts\date.js" type="text/javascript"></script><script src="javascripts\morris.min.js" type="text/javascript"></script><script src="javascripts\skycons.js" type="text/javascript"></script><script src="javascripts\fitvids.js" type="text/javascript"></script><script src="javascripts\jquery.sparkline.min.js" type="text/javascript"></script><script src="javascripts\dropzone.js" type="text/javascript"></script><script src="javascripts\jquery.nestable.js" type="text/javascript"></script><script src="javascripts\main.js" type="text/javascript"></script><script src="javascripts\respond.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a href="index.htm"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
              </li>
              <li><a href="social.htm">
                <span aria-hidden="true" class="hightop-feed"></span>Social Feed</a>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="hightop-star"></span>UI Features<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="buttons.htm">Buttons</a>
                  </li>
                  <li>
                    <a href="fontawesome.htm">Font Awesome Icons</a>
                  </li>
                  <li>
                    <a href="glyphicons.htm">Glyphicons</a>
                  </li>
                  <li>
                    <a href="components.htm">Components</a>
                  </li>
                  <li>
                    <a href="widgets.htm">Widgets</a>
                  </li>
                  <li>
                    <a href="nestable-lists.htm">Nestable Lists</a>
                  </li>
                  <li>
                    <a href="typo.htm">Typography</a>
                  </li>
                  <li>
                    <a href="grid.htm">Grid Layout</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="hightop-forms"></span>Forms<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="form-components.htm">Form Components</a>
                  </li>
                  <li>
                    <a href="form-advanced.htm">Advanced Forms</a>
                  </li>
                  <li>
                    <a href="xeditable.htm">X-Editable</a>
                  </li>
                  <li>
                    <a href="file-upload.htm">Multiple File Upload</a>
                  </li>
                  <li>
                    <a href="dropzone-file-upload.htm">Dropzone File Upload</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="hightop-tables"></span>Tables<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="tables.htm">Basic tables</a>
                  </li>
                  <li>
                    <a href="datatables.htm">DataTables</a>
                  </li>
                  <li>
                    <a href="datatables-editable.htm">Editable DataTables</a>
                  </li>
                </ul>
              </li>
              <li><a class="current" href="charts.htm">
                <span aria-hidden="true" class="hightop-charts"></span>Charts</a>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="hightop-pages"></span>Pages<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="chat.htm">Chat</a>
                  </li>
                  <li>
                    <a href="calendar.htm">Calendar</a>
                  </li>
                  <li>
                    <a href="timeline.htm">Timeline</a>
                  </li>
                  <li>
                    <a href="login1.htm">Login 1</a>
                  </li>
                  <li>
                    <a href="login2.htm">Login 2</a>
                  </li>
                  <li>
                    <a href="messages.htm">Messages/Inbox</a>
                  </li>
                  <li>
                    <a href="pricing.htm">Pricing Tables</a>
                  </li>
                  <li>
                    <a href="signup1.htm">Sign Up 1</a>
                  </li>
                  <li>
                    <a href="signup2.htm">Sign Up 2</a>
                  </li>
                  <li>
                    <a href="invoice.htm">Invoice</a>
                  </li>
                  <li>
                    <a href="faq.htm">FAQ</a>
                  </li>
                  <li>
                    <a href="filters.htm">Filter Results</a>
                  </li>
                  <li>
                    <a href="404-page.htm">404 Page</a>
                  </li>
                  <li>
                    <a href="500-page.htm">500 Error</a>
                  </li>
                </ul>
              </li>
              <li><a href="gallery.htm">
                <span aria-hidden="true" class="hightop-gallery"></span>Gallery</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content">
        <div class="page-title chart-container">
          <h1>
            Charts
          </h1>
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
                  <div class="graph" id="hero-graph"></div>
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
                  <div class="graph" id="hero-bar"></div>
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
  </body>
</html>
