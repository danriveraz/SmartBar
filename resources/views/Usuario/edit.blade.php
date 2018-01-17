@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
@include('flash::message')
{!!Html::style('assets/css/main.css')!!}

<div class="view-account">
  <div class="module">
      <div class="module-inner">
        <div class="container main-content">
          <div class="side-bar" >
              <div class="user-info">
                <div align="center">
                  <a id="perfil" class="gallery-item filter1 fancybox" href="../../../../public/images/admins/{{$usuario->imagenPerfil}}" rel="gallery1" title="Imagen perfil">
                    @if($usuario->imagenPerfil!='')
                      {!! Html::image('images/admins/'.$usuario->imagenPerfil,  'imagen de perfil', array('class' => 'img-responsive img-circle user-photo')) !!}
                    @else
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                    @endif
                    <div class="actions">
                      <i class="fa fa-trash-o"></i>
                      <i class="fa fa-search-plus"></i>
                      <i class="fa fa-pencil"></i>
                    </div>
                  </a>
                </div>
                <ul class="meta list list-unstyled">
                    <li class="name">{{$usuario->nombrePersona}}
                        <br>
                        <label class="label label-info pocketColor" style=" margin: 5px 5px 5px 5px; padding:.3em .9em .3em;"><b>Admin</b></label>
                    </li>
                </ul>
              </div>
              <nav class="side-menu">
                  <ul class="nav">
                    <li><a data-toggle="tab" href="#tab1"><span class="fa fa-user"></span> Perfil</a></li>
                    <li><a data-toggle="tab" href="#tab2"><span class="fa fa-bars"></span> Categoria</a></li>
                    <li><a data-toggle="tab" href="#tab3"><span class="fa fa-newspaper-o"></span> Factura</a></li>
                    <li><a data-toggle="tab" href="#tab4"><span class="fa fa-pencil-square-o"></span> Mesas</a></li>
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
                    <li><a href="#billings" role="tab" data-toggle="tab">PocketClub</a></li>
                    <li><a href="#preferences" role="tab" data-toggle="tab">Bolsillo</a></li>
                  </ul>
                  {!! Form::open(['route' => ['Auth.usuario.editUsuario',$usuario], 'method' => 'POST','enctype' => 'multipart/form-data', 'id' => 'formEditUsuario']) !!}
                  {{ csrf_field() }}
                    <div class="tab-content content-profile">
                      <!-- MY PROFILE -->
                      <div class="tab-pane fade in active" id="myprofile">
                        <div class="profile-section">
                          <div class="clearfix">
                            <!-- LEFT SECTION -->
                            <div class="left">
                              <h2>Información General</h2>
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
                              <div class="form-group" hidden="true">
                                  <input id="ventana" name="ventana" class="form-control" value=""  type="text">
                              </div>
                            </div>
                            <!-- END LEFT SECTION -->
                            <!-- RIGHT SECTION -->
                            <div class="right">
                              <h2> Información Bar</h2>
                              <div class="form-group">
                                <label>Nombre</label>
                                <input name="nombreEstablecimiento" type="text" class="form-control" placeholder="Nombre del Establecimiento" value="{{$empresa->nombreEstablecimiento}}">
                              </div>
                              <div class="form-group">
                                <label>Dirección</label>
                                <input name="direccionEstablecimiento" type="text" class="form-control" placeholder="Dirección" value="{{$empresa->direccion}}">
                              </div>
                              <div class="form-group">
                                <label>Teléfono</label>
                                <input name="telefonoEstablecimiento" type="text" class="form-control" placeholder="Teléfono o celular" value="{{$empresa->telefono}}" maxlength="10">
                              </div>
                              <div class="form-group">
                                <label>Regimen</label>
                                <div>
                                  <select id="tipoRegimen" name="tipoRegimen" class="form-control">
                                    @if($empresa->tipoRegimen=='')
                                      <option>Tipo regimen</option>
                                      <option value="comun">Regimen comun</option>
                                      <option value="simplificado">Regimen simplificado</option>
                                    @elseif($empresa->tipoRegimen=='comun')
                                      <option value="comun" selected="selected">Regimen comun</option>
                                      <option value="simplificado" >Regimen simplificado</option>
                                    @else
                                      <option value="comun">Regimen comun</option>
                                      <option value="simplificado" selected="selected">Regimen simplificado</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Nit</label>
                                <div>
                                    <input name="nit" type="text" class="form-control" placeholder="Ingrese su nit xxxxxxx-xx" value="{{$empresa->nit}}">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Departamento</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$empresa->departamento}}" disabled>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Ciudad</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$empresa->ciudad}}" disabled>
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
                                <input id="password" name="password" type="password" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Confirmar Contraseña</label>
                                <input id="passwordC" name="" type="password" class="form-control">
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
                      <!-- BILLINGS -->
                      <div class="tab-pane fade" id="billings">
                        <div class="clearfix">
                          <div class="left">
                            <div class="profile-section">
                              <h2 class="profile-heading">Membresia</h2>
                              <div class="plan selected-plan">
                                <h3 class="plan-title">Única <span> (Actualmente) <i class="fa fa-check-circle"></i></span></h3>
                                <ul class="list-unstyled list-plan-details">
                                  <li>Uso del programa = 1 Mes</li>
                                  <li>Promociones únicas SmartShop</li>
                                  <li>Protección de información = 1 Mes extra</li>
                                </ul>
                                <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Unirte al Club</button>
                              </div>
                              <div class="plan">
                                <h3 class="plan-title">Especial</h3>
                                <ul class="list-unstyled list-plan-details">
                                  <li>Uso del programa = 12 Meses</li>
                                  <li>Promociones especiales y únicas SmartShop</li>
                                  <li>Ahorro de $268.000</li>
                                  <li>Protección información = 3 Meses extra</li>
                                  <li>Sin clausulas, Ni recargos</li>
                                </ul>
                                <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Unirte al Club</button>
                              </div>
                              <div class="plan">
                                <h3 class="plan-title">Master</h3>
                                <ul class="list-unstyled list-plan-details">
                                  <li>Uso del Programa = 60 Meses</li>
                                  <li>Todas las promociones Smartshop</li>
                                  <li>Ahorro de $ 2.400.000</li>
                                  <li>Protecciòn de la información = 6 Meses Extra</li>
                                  <li>Membresia con Descuento especial, por tiempo limitado</li>
                                  <li>Sin clausulas, ni recargos</li>
                                </ul>
                                <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Unirte al Club</button>
                              </div>
                            </div>
                          </div>
                          <div class="right">
                            <div class="profile-section">
                              <h2 class="profile-heading">Metodo de Pago</h2>
                              <div class="payment-info">
                                <h3 class="payment-name"><i class="fa fa-paypal"></i> PayPal ****6345</h3>
                                <span>Próximo pago $89.900</span>
                                <br>
                                <em class="text-muted">Autopago Febrero 12, 2018</em>
                                <a href="#" class="edit-payment-info">Cambiar método de pago</a>
                              </div>
                              <p class="margin-top-30"><a href="#"><i class="fa fa-plus-circle"></i> Añadir oro método de pago</a></p>
                            </div>
                            <div class="profile-section">
                              <h2 class="profile-heading">Historial de facturación</h2>
                              <table class="table billing-history">
                                <thead class="sr-only">
                                  <tr>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <h3 class="billing-title">Membresia Única <span class="invoice-number">#UNC00001</span></h3>
                                      <span class="text-muted">Cargada en Octubre 12, 2017</span>
                                    </td>
                                    <td class="amount">$ 89.900</td>
                                    <td class="action"><a href="#">Ver</a></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <h3 class="billing-title">Membresia Única <span class="invoice-number">#UNC00001</span></h3>
                                      <span class="text-muted">Cargada en Noviembre 12, 2017</span>
                                    </td>
                                    <td class="amount">$ 89.900</td>
                                    <td class="action"><a href="#">Ver</a></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <h3 class="billing-title">Membresia Única <span class="invoice-number">#UNC00001</span></h3>
                                      <span class="text-muted">Cargada en Diciembre 12, 2017</span>
                                    </td>
                                    <td class="amount">$ 89.900</td>
                                    <td class="action"><a href="#">Ver</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END BILLINGS -->
                      <!-- PREFERENCES -->
                      <div class="tab-pane fade" id="preferences">
                        <div class="clearfix">
                          <div class="left">
                            <div class="profile-section">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END PREFERENCES -->
                    </div>
                  {!! Form::close() !!}
            </div>
          </div>
        </div>
        <div class="tab-pane" id="tab2">
          <div id="main-content">
            <div class="container-fluid">
              <div class="section-heading">
                <div align="right" style="padding-right: 10%;">
                  <a href="#addModalCategoria" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                    <i class="fa fa-plus"></i>
                  </a>
                </div>
              </div>
              <div class="col-sm-offset-1 col-sm-10" style="align-content: center;">
                <div id="list-cat"></div>
              </div>
              <div class="modal fade in" id="addModalCategoria" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    {!! Form::open(['method' => 'POST', 'action' => 'CategoriaController@store']) !!}
                      <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                      <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                        <h4 class="modal-title">
                        Nueva Categoría
                        </h4>
                      </div>
                      <div class="modal-body">
                        <div class="" >
                        <div class="widget-content">
                          <div class="form-group">
                            <div class="form-group">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="true" required="true" />
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="precio" placeholder="Precio" class="form-control" />
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                      </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>                 
            </div>
          </div>
        </div>

        <div class="tab-pane" id="tab3">
          <div id="main-content">
            {!! Form::open(['route' => ['Auth.usuario.editUsuario',$usuario], 'method' => 'POST','enctype' => 'multipart/form-data', 'id' => 'formEditFactura']) !!}
              {{ csrf_field() }}
              <div class="container-fluid">
                <div class="cover-inside">
                  <div class="col-md-3">
                    <img class="cover-avatar size-md img-round" src="{{'../../../images/bar.png'}}" alt="profile">
                  </div>
                  <div class="col-md-9" id="notasAdicionales">
                    <label style="display: block;">Notas adicionales</label>
                    <textarea id="notas" name="notas" class="form-control" rows="4" cols="100" maxlength="140" placeholder="Pon tu mensaje aquí" style="resize: none;">{{$empresa->notas}}</textarea>
                  </div>
                </div>
              </div>

              <div id="divComun" class="form-group"  style="display: none;" <?php if($empresa->tipoRegimen == "asdas")echo'style="display:block;"' ?>>
                <label class="control-label col-md-2"></label>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                    @if($empresa->imagenResolucionFacturacion!='')
                      {!! Html::image('images/admins/'.$empresa->imagenResolucionFacturacion , 'resolución') !!}
                    @else
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                    @endif
                  </div>
                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                  <div align="center">
                    <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar</span><span class="fileupload-exists">Cambiar</span><input type="file" class="form-control" name="imagenEstablecimiento" ></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
                  </div>
                </div>
              </div>
              <div class="form-group" hidden="true">
                  <input id="ventanaFactura" name="ventanaFactura" class="form-control" value=""  type="text">
              </div>
              <div class="form-group" style="text-align: center;">
                <button id="btn-guardar3" class="btn btn-bitbucket" onclick="setValue(this)" style="margin-top: 30px;">Guardar</button>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
        
        <div class="tab-pane" id="tab4">
          <div id="main-content">
            <div class="container-fluid">
              <div class="section-heading">
                <div align="right" style="padding-right: 10%;">
                  <a href="#addModalMesas" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                      <i class="fa fa-plus"></i>
                  </a>
                </div> 
              </div>
              <div class="col-sm-offset-1 col-sm-10" style="align-content: center;">
                <div id="list-mesas"> </div>
              </div>
              <div class="col-sm-offset-2 col-sm-8">
                <div class="modal fade in" id="addModalMesas" >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form name="formulario" autocomplete="on" method="post" action="{{url('mesas/create')}}">
                          {{csrf_field()}}
                        <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                        <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                          <h4 class="modal-title">
                          Nuevo Mesa
                          </h4>
                        </div>
                        <div class="modal-body">
                          <div class="" >
                          <div class="widget-content">
                            <div class="form-group">
                              <div class="form-group">
                                  <input type="number" name="cantidad" class="form-control" placeholder="Cantidad de mesas" min="0" required="true"/>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                        </div>
                      </form>
                  </div>
                 </div>
                </div>
              </div>
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
      
<!-- JAVASCRIPT -->
<script>
  $(document).ready(function(){  
        listcat();
        listmesas();
        $(".gallery-item filter1 fancybox").fancybox({ });
        $("#fechaNacimiento").load(this);
        $('[data-toggle="popover"]').popover();
        function update(){
          document.getElementById('no.').style.width = '10%';
          document.getElementById('opcionesMesas').style.width = '5%';
          document.getElementById('opcionesCategorias').style.width = '5%';
        }
        setTimeout(update, 1000);
    }); 

  $(function() {
    // plans
    $('.btn-choose-plan').on('click', function() {
      $('.plan').removeClass('selected-plan');
      $('.plan-title span').find('i').remove();
      $(this).parent().addClass('selected-plan');
      $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
    });
  });

  function setValue(idBtn) {
    if(idBtn.id == "btn-guardar1"){
      ventana.value = 1;
    }else if(idBtn.id == "btn-guardar2"){
      if(password.value == passwordC.value) {
        ventana.value = 2;
        formEditUsuario.submit();
      }else{
        alert("Las contraseña no coinciden");
      }
    }else if(idBtn.id == "btn-guardar3"){
      ventanaFactura.value = 3;
    }
  };

  var listcat = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('catlistall')}}',
      success:  function(data){
        $('#list-cat').empty().html(data);
      }
    });
  }

  var listmesas = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('mesaslistall')}}',
      success:  function(data){
        $("#list-mesas").empty().html(data);
      }
    });
  }

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

  #notasAdicionales{

  }
  
  #main-content {
    padding-top: 5%;
  }
  #sexo{
    margin-left: 5%;
  }
</style>
@endsection
