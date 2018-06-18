@extends('Layout.app_empleado')
@section('content')
@include('flash::message')
{!!Html::style('assets/css/main.css')!!}

<div class="view-account">
  <div class="module">
      <div class="module-inner">
        <div class="container main-content">
          <div class="side-bar" >
              <div class="user-info">
                {!! Form::open(['route' => ['Auth.usuario.posteditProfile',$usuario], 'method' => 'GET','enctype' => 'multipart/form-data', 'id' => 'formEditFotoPerfil']) !!}
                {{ csrf_field() }}
                <div class="widget-content fileupload fileupload-new" data-provides="fileupload" style="margin-left: -15%;margin-bottom: -20%;">
                  <div class="gallery-container fileupload-new img-thumbnail">
                    <div class="gallery-item filter1" rel="" style="border-radius: 50%; width: 150px; height: 150px;">
                      @if($usuario->imagenPerfil!='')
                        {!! Html::image('images/admins/'.$usuario->imagenPerfil,  'imagen de perfil', array('class' => 'img-responsive img-circle user-photo', 'id' => 'imagenPerfilUsuarioCircular')) !!}
                        <!-- clase circular -> , array('class' => 'img-responsive img-circle user-photo') -->
                      @else
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" class="img-responsive img-circle user-photo">
                      @endif
                      <div class="actions">
                        <a  id="modalImagen" href="{{ asset ('images/admins/'.$usuario->imagenPerfil) }}" title="Imagen negocio">
                          <img src="images/admins/{{$usuario->imagenPerfil}}" hidden>
                          <i class="fa fa-search-plus"></i>
                        </a>
                        <a onclick="$('#imagenPerfil').click()">
                          <i class="fa fa-pencil"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="gallery-item fileupload-preview fileupload-exists img-thumbnail" style="border-radius: 50%; width: 150px; height: 150px; background: #ffffff;">
                    
                  </div>
                  <div hidden>
                    <span class=" btn-file" id="subirImagenPerfil">
                      <span class="fileupload-new"><i class="fa fa-pencil"></i></span>
                      <span class="fileupload-exists"><i class="fa fa-search-plus"></i></span>
                      <input type="file" value="{{$usuario->imagenPerfil}}" class="form-control" name="imagenPerfil"  id="imagenPerfil">
                    </span>
                  </div>
                </div>
                <div id="btnImagenPerfil">
                  <button id="btn-guardarimg" class="btn btn-bitbucket" onclick="setValue(this)"  title="Guardar imagen" style="margin-top: 15%; width: 25%; font-size: 10px; margin-left: -5%"><i class="fa fa-save"></i></button>
                </div>
                <div hidden>
                  <input id="ventanaImagenPerfil" name="ventanaImagenPerfil" class="form-control" value=""  type="text">
                </div>
                {!! Form::close() !!}
                <!-- imagen perfil -->
                
                  <!-- fin imagen perfil -->
                <ul class="meta list list-unstyled" style="padding-top: 15%; margin-bottom: -20%; margin-left: -5%;">
                    <li class="name">{{$usuario->nombrePersona}}
                        <br>
                        <label class="label label-info pocketColor" style=" margin: 5px 5px 5px 5px; padding:.3em .9em .3em;"><b>Admin</b></label>
                    </li>
                </ul>
              </div>
              <nav class="side-menu">
                  <ul class="nav">
                    <li><a data-toggle="tab" href="#tab1"><span class="fa fa-user"></span> Perfil</a></li>
                    <li><a href="{{ url('Agenda/') }}"><span class="fa fa-calendar-check-o"></span> Agenda</a></li>
                    <li class="active"><a data-toggle="tab" href="#tab5"><span class="fa fa-fw fa-bar-chart-o"></span> Reportes</a></li>
                  </ul>    
              </nav>
          </div>
          <!-- MAIN CONTENT -->
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <div id="main-content">
                <div class="container-fluid">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Perfil</a></li>
                    <li><a href="#account" role="tab" data-toggle="tab">Cuenta</a></li>
                  </ul>
                  {!! Form::open(['route' => ['Auth.usuario.posteditProfile',$usuario], 'method' => 'GET','enctype' => 'multipart/form-data', 'id' => 'formEditUsuario']) !!}
                  {{ csrf_field() }}
                    <div class="tab-content content-profile">
                      <!-- MY PROFILE -->
                      <div class="tab-pane fade in active" id="myprofile">
                        <div class="profile-section">
                          <div class="clearfix">
                            <h2 align="center">Información General</h2>
                            <!-- LEFT SECTION -->
                            <div class="left">
                              <div class="form-group">
                                <label>Nombres</label>
                                <input name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}" placeholder="Nombre completo" type="text" >
                              </div>
                              <div class="form-group">
                                <label>Documento</label>
                                <div>
                                  <input name="cedula" class="form-control" value="{{$usuario->cedula}}"  placeholder="Identificacion" type="text" maxlength="10">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Sexo</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                    <select name='sexo' class="form-control" placeholder="Tipo De Sexo">
                                      @if($usuario->sexo=='Femenino')
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino" selected="selected">Femenino</option>
                                      @else
                                        <option value="Masculino" selected="selected">Masculino</option>
                                        <option value="Femenino" >Femenino</option>
                                      @endif
                                    </select>
                                </div>
                              </div>
                              <div class="form-group" hidden="true">
                                  <input id="ventana" name="ventana" class="form-control" value=""  type="text">
                              </div>
                            </div>
                            <!-- END LEFT SECTION -->
                            <!-- RIGHT SECTION -->
                            <div class="right">
                              <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <div class="input-group date" >
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input  id="fechaNacimiento" name="fechaNacimiento" value="{{$usuario->fechaNacimiento}}" class="form-control" placeholder="Fecha de Nacimiento" type="date">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Telefono</label>
                                <div>
                                  <input name="telefono" type="text" class="form-control" placeholder="Telefono o Celular" value="{{$usuario->telefono}}" maxlength="10">
                                </div>
                              </div>
                            </div>
                            <!-- END RIGHT SECTION -->
                          </div>
                          <div class="form-group" align="center">
                            <p class="margin-top-30">
                              <button id="btn-guardar1" class="btn btn-bitbucket" onclick="setValue(this)">
                                Guardar
                              </button>
                            </p>
                          </div>
                        </div>
                      </div>
                      <!-- END MY PROFILE -->
                      <!-- ACCOUNT -->
                      <div class="tab-pane fade" id="account">
                        <div class="profile-section">
                          <div class="clearfix">
                            <!-- LEFT SECTION -->
                            <div class="left">
                              <h2 class="profile-heading">Información de la cuenta</h2>
                              <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control" value="{{$usuario->email}}">
                              </div>
                            </div>
                            <!-- END LEFT SECTION -->
                            <!-- RIGHT SECTION -->
                            <div class="right">
                              <h2 class="profile-heading">Cambiar contraseña</h2>
                              <div class="form-group">
                                <label>Contraseña Nueva</label>
                                <input id="password" name="password" type="password" class="form-control" >
                              </div>
                              <div class="form-group">
                                <label>Confirmar Contraseña</label>
                                <input id="passwordC" name="" type="password" class="form-control" min="5">
                              </div>
                            </div>
                            <!-- END RIGHT SECTION -->
                          </div>
                          <p class="margin-top-30">
                            <a href="#" id="btn-guardar2" class="btn btn-bitbucket" onclick="setValue(this)">
                              Guardar
                            </a>
                          </p>
                        </div>
                      </div>
                      <!-- END ACCOUNT -->
                    </div>
                  {!! Form::close() !!}
            </div>
          </div>
        </div>
        <div class="tab-pane active" id="tab5">
          <div id="main-content">
            <div class="container-fluid">
              <div class="section-heading">
                <h1 class="page-title">Reportes</h1>
              </div>
              <!--ALGO -->
              <div class="dashboard-section">
                <div class="section-heading clearfix">
                  <h2 class="section-title"><i class="fa fa-pie-chart"></i> Website Analytics</h2>
                  <a href="#" class="right">View Full Analytics Reports</a>
                </div>
                <div class="panel-content">
                  <div class="row">
                    <div class="col-md-3 col-sm-6">
                      <div class="number-chart">
                        <div class="mini-stat">
                          <div id="number-chart1" class="inlinesparkline">23,65,89,32,67,38,63,12,34,22</div>
                          <p class="text-muted"><i class="fa fa-caret-up text-success"></i> 19% compared to last week</p>
                        </div>
                        <div class="number"><span>$22,500</span> <span>EARNINGS</span></div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="number-chart">
                        <div class="mini-stat">
                          <div id="number-chart2" class="inlinesparkline">77,44,10,80,88,87,19,59,83,88</div>
                          <p class="text-muted"><i class="fa fa-caret-up text-success"></i> 24% compared to last week</p>
                        </div>
                        <div class="number"><span>245</span> <span>SALES</span></div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="number-chart">
                        <div class="mini-stat">
                          <div id="number-chart3" class="inlinesparkline">99,86,31,72,62,94,50,18,74,18</div>
                          <p class="text-muted"><i class="fa fa-caret-up text-success"></i> 44% compared to last week</p>
                        </div>
                        <div class="number"><span>561,724</span> <span>VISITS</span></div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="number-chart">
                        <div class="mini-stat">
                          <div id="number-chart4" class="inlinesparkline">28,44,70,21,86,54,90,25,83,42</div>
                          <p class="text-muted"><i class="fa fa-caret-down text-danger"></i> 6% compared to last week</p>
                        </div>
                        <div class="number"><span>372,500</span> <span>LIKES</span></div>
                      </div>
                    </div>
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
        </div>
      </div>
    <!-- END MAIN CONTENT -->
      <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
      
<script>
  var JSONusuario = eval(<?php echo json_encode($usuario); ?>);
  $(document).ready(function(){
      $("#modalImagen").fancybox({
            helpers: {
                title : {
                    type : 'float'
                }
            }
        });
     // $(".gallery-item filter1 fancybox").fancybox({ });

      $("#fechaNacimiento").load(this);
  });


  function setValue(idBtn) {
    if(idBtn.id == "btn-guardar1"){
      ventana.value = 8;
    }else if(idBtn.id == "btn-guardar2"){
      if(password.value == passwordC.value) {
        ventana.value = 9;
        formEditUsuario.submit();
      }else{
        alert("Las contraseña no coinciden");
      }
    }else if(idBtn.id == "btn-guardarimg"){
      ventanaImagenPerfil.value = 10;
    }
  };
</script>
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

<style type="text/css">

  .cover-img {
      display: block;
      min-height: 100%;
      margin: 0 auto;
  }

  .cover-avatar.size-md {
      width: 170px;
      height: 170px;
      border: 5px solid #f0f0f0;
    }

  .cover-inside * {
      line-height: 2;
  }

  .img-round {
  border-radius: 100px 100px 100px 100px;
  -moz-border-radius: 100px 100px 100px 100px;
  -webkit-border-radius: 100px 100px 100px 100px;
  }
  
  #main-content {
    padding-top: 4%;
  }
  #sexo{
    margin-left: 5%;
  }

  #imagenPerfilUsuarioCircular{ 
    width: 150px;
    height: 150px;
  }

</style>
@endsection
