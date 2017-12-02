@extends('Layout.app')
@section('content')

    <div class="modal-shiftfix">
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
