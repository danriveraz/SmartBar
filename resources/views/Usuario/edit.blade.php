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
                {!! Form::open(['route' => ['Auth.usuario.editUsuario',$usuario], 'method' => 'POST','enctype' => 'multipart/form-data', 'id' => 'formEditFotoPerfil']) !!}
                {{ csrf_field() }}
                <div class="widget-content fileupload fileupload-new" data-provides="fileupload" style="margin-left: -15%;margin-bottom: -20%;">
                  <div class="gallery-container fileupload-new img-thumbnail">
                    <div id="imgActual" class="gallery-item filter1" rel="" style="border-radius: 50%; width: 150px; height: 150px;">
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
                  <div id="imgReemplazo" onchange="funcioncita();" class="gallery-item fileupload-preview fileupload-exists img-thumbnail" style="border-radius: 50%; width: 150px; height: 150px; background: #ffffff;" >
                    
                  </div>
                  <div hidden>
                    <span class=" btn-file" id="subirImagenPerfil">
                      <span class="fileupload-new"><i class="fa fa-pencil"></i></span>
                      <span class="fileupload-exists"><i class="fa fa-search-plus"></i></span>
                      <input type="file" value="{{$usuario->imagenPerfil}}" class="form-control" name="imagenPerfil"  id="imagenPerfil">
                    </span>
                  </div>
                </div>
                <div id="btnImagenPerfil" style="display: none; margin-top: 5px;">
                  <button id="btn-guardarimg" class="btn btn-bitbucket" onclick="setValue(this)"  title="Guardar imagen" style="margin-top: 15%; width: 25%; font-size: 10px; margin-left: -5%"><i class="fa fa-save"></i></button>
                </div>

                <div hidden>
                  <input id="ventanaFactura" name="ventanaFactura" class="form-control" value=""  type="text">
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
                    <li class="active"><a data-toggle="tab" href="#tab1"><span class="fa fa-user"></span> Perfil</a></li>
                    <li><a data-toggle="tab" href="#tab2"><span class="fa fa-outdent"></span> Categoria</a></li>
                    <li><a href="{{url('Auth/modificarFactura')}}"><span class="fa fa-newspaper-o"></span> Factura</a></li>
                    <li><a data-toggle="tab" href="#tab4"><span class="fa fa-pencil-square-o"></span> Mesas</a></li>
                  </ul>    
              </nav>
          </div>
          <!-- MAIN CONTENT -->
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
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
                                  <label>Nombre</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}" placeholder="Nombre completo" type="text" >
                                </div>
                              </div>

                              <div class="form-group">
                                <label>Documento</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
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
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
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
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                <input name="nombreEstablecimiento" type="text" class="form-control" placeholder="Nombre del Establecimiento" value="{{$empresa->nombreEstablecimiento}}">
                                </div>
                              </div>

                              <div class="form-group">
                                <label>Dirección</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                              <input name="direccionEstablecimiento" type="text" class="form-control" placeholder="Dirección" value="{{$empresa->direccion}}">
                              </div>
                              </div>


                              <div class="form-group">
                                <label>Teléfono</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                              <input name="telefonoEstablecimiento" type="text" class="form-control" placeholder="Teléfono o celular" value="{{$empresa->telefono}}" maxlength="10">
                              </div>
                              </div>

                              <div class="form-group">
                                <label>Regimen</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span>
                                    <select id="tipoRegimen" name="tipoRegimen" class="form-control" >
                                    @if($empresa->tipoRegimen=='' || $empresa->tipoRegimen == "Tipo regimen")
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
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-drivers-license"></i></span>
                                  <input name="nit" type="text" class="form-control" placeholder="Ingrese su nit xxxxxxx-xx" value="{{$empresa->nit}}">
                                </div>
                              </div>

                              <div class="form-group">
                                <label>Departamento</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                  <input type="text" class="form-control" value="{{$empresa->departamento}}" disabled>
                                </div>
                              </div>

                              <div class="form-group">
                                <label>Ciudad</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-map-o"></i></span>
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
                      <!-- BILLINGS -->
                      <div class="tab-pane fade" id="billings">
                        <div class="clearfix">
                          <div class="left">
                            <div class="profile-section">
                              <h2 class="profile-heading">Membresia</h2>

                              <div id="plan1" class="plan">
                                <h3 class="plan-title">Única<span><i id="check1" class=""></i></span></h3>
                                <ul class="list-unstyled list-plan-details">
                                  <li>Hasta 7 empleados</li>
                                  <li>Asesoria de Lunes a Viernes(✓)</li>
                                  <li>1 sólo negocio</li>
                                  <li>Promociones Únicas SmartShop</li>
                                  <li>Uso del programa por 30 días</li>
                                  <li>Información segura hasta por 90 días</li>
                                  <li>Acceso al 100% de las utilidades SmartBar</li>
                                  <li>No aplica mes GRATIS</li>
                                  <li>0% de ahorro</li>
                                  <li><h4><strong>$ 99.900 COP/Mes</strong></h4></li>
                                  <li>10% descuento en pago trimestral.</li>
                                </ul>
                                <div>
                                  <button id="btn-guardar5" class="btn btn-bitbucket" onclick="setValue(this)" >Unirte al Club</button>
                                </div>
                              </div>

                              <div id="plan2" class="plan">
                                <h3 class="plan-title">Especial<span><i id="check2" class=""></i></span></h3>
                                <ul class="list-unstyled list-plan-details">
                                  <li>Hasta 20 empleados</li>
                                  <li>Asesoria de Lunes a Sábado(✓)</li>
                                  <li>Hasta 2 negocios</li>
                                  <li>Promociones Únicas y especiales SmartShop</li>
                                  <li>Uso del programa por 6 meses</li>
                                  <li>Información segura hasta por 1 año</li>
                                  <li>Acceso al 100% de las utilidades SmartBar</li>
                                  <li>El mes 6 es GRATIS</li>
                                  <li>Ahorra hasta  $ 100.000 Cop</li>
                                  <li><h4><strong>$ 499.500 COP</strong></h4></li>
                                  <li>10% descuento en pago anual.</li>
                                </ul>
                                <div>
                                  <button id="btn-guardar6" class="btn btn-bitbucket" onclick="setValue(this)" >Unirte al Club</button>
                                </div>
                              </div>

                              <div id="plan3" class="plan">
                                <h3 class="plan-title">Élite<span><i id="check3" class=""></i></span></h3>
                                <ul class="list-unstyled list-plan-details">
                                  <li>Empleados infinitos</li>
                                  <li>Asesoria de 24/7, 365 días al año (✓)</li>
                                  <li>Hasta 4 negocios</li>
                                  <li>Todas las promociones SmartShop</li>
                                  <li>Uso del programa por 3 años</li>
                                  <li>Información segura hasta por 5 años</li>
                                  <li>Acceso al 100% de las utilidades SmartBar</li>
                                  <li>El mes 1, 12,24 y 36 son GRATIS</li>
                                  <li>Ahorra hasta $ 400.000 Cop</li>
                                  <li><h4><strong>$ 2.998.800 COP</strong></h4></li>
                                  <li>Descuento en membresia de $ 198.000 Cop</li>
                                </ul>
                                <div>
                                  <button id="btn-guardar7" class="btn btn-bitbucket" onclick="setValue(this)" >Unirte al Club</button>
                                </div>
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
                        <div class="profile-section">
                          <div id="mensajeGratis" class="form-group" style="display: none;">
                            <strong><h3>Para acceder a esta opción adquiere una membresía <a href="">aquí</a></h3></strong>
                          </div>
                          <div id="mensajeClub" class="form-group" style="display: none;">
                            <strong><h3>Tu membresía única solo cuenta con almacenamiento suficiente para un solo negocio, mejora tu 
                                        membresía <a href="">aquí</a></h3></strong>
                          </div>
                          <div id="mensajeClubEspecial" class="form-group" style="display: none;">
                            <strong><h3>Tu membresía especial solo cuenta con almacenamiento suficiente para un dos negocios, mejora tu 
                                        membresía <a href="">aquí</a></h3></strong>
                          </div>
                          <div id="mensajeClubElite" class="form-group" style="display: none;">
                            <strong><h3>¡Has llegado al número máximo de negocios!</h3></strong>
                          </div>
                          <div id="bolsillo" class="clearfix">
                            <h2> Información Bar</h2>
                            <div class="left">
                              <div class="form-group">
                                <label>Nombre</label>
                                <input name="nombreEstablecimientoNBar" type="text" class="form-control" placeholder="Nombre del Establecimiento">
                              </div>
                              <div class="form-group">
                                <label>Dirección</label>
                                <input name="direccionEstablecimientoNBar" type="text" class="form-control" placeholder="Dirección">
                              </div>
                              <div class="form-group">
                                <label>Teléfono</label>
                                <input name="telefonoEstablecimientoNBar" type="text" class="form-control" placeholder="Teléfono o celular"
                                maxlength="10">
                              </div>
                              <div class="form-group">
                                <label>Regimen</label>
                                <div>
                                  <select name="tipoRegimenNBar" class="form-control">
                                      <option>Tipo regimen</option>
                                      <option value="comun">Regimen comun</option>
                                      <option value="simplificado">Regimen simplificado</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="right">
                              <div class="form-group">
                                <label>Nit</label>
                                <div>
                                    <input name="nitNBar" type="text" class="form-control" placeholder="Ingrese su nit xxxxxxx-xx">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Departamento</label>
                                <div>
                                  <select id="idDepto"  name="idDepto" required class="form-control">
                                    @foreach($departamentos as $departamento)
                                      <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Ciudad</label>
                                <div>
                                  <select id="idCiudad" name="idCiudad" class="form-control">
                                    <option></option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group" align="center">
                            <p class="margin-top-30">
                              <button id="btn-guardar3" class="btn btn-bitbucket" onclick="setValue(this)">
                                Guardar
                              </button>
                            </p>
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
      </div>
    <!-- END MAIN CONTENT -->
      <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
      
<!-- JAVASCRIPT -->
<script>
  var JSONusuario = eval(<?php echo json_encode($usuario); ?>);
  var JSONempresa = eval(<?php echo json_encode($empresas); ?>);

  $(document).ready(function(){
      listcat();
      listmesas();
      $("#modalImagen").fancybox({
            helpers: {
                title : {
                    type : 'float'
                }
            }
        });
     // $(".gallery-item filter1 fancybox").fancybox({ });

      $("#fechaNacimiento").load(this);
      $('[data-toggle="popover"]').popover();
      function update(){
        document.getElementById('no.').style.width = '10%';
        document.getElementById('opcionesMesas').style.width = '5%';
        document.getElementById('opcionesCategorias').style.width = '5%';
      }
      setTimeout(update, 1000);
      if (JSONusuario.membresia == 0) {
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeGratis").style.display = 'block';
      }else if(JSONusuario.membresia == 1){
        document.getElementById("plan1").className = "plan selected-plan";
        document.getElementById("check1").className = "fa fa-check-circle";
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeClub").style.display = 'block';
      }else if(JSONusuario.membresia == 2 && JSONempresa.length == 2){
        document.getElementById("plan2").className = "plan selected-plan";
        document.getElementById("check2").className = "fa fa-check-circle";
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeClubEspecial").style.display = 'block';
      }else if(JSONusuario.membresia == 2 && JSONempresa.length < 2){
        document.getElementById("plan2").className = "plan selected-plan";
        document.getElementById("check2").className = "fa fa-check-circle";
      }else if(JSONusuario.membresia == 3 && JSONempresa.length == 4){
        document.getElementById("plan3").className = "plan selected-plan";
        document.getElementById("check3").className = "fa fa-check-circle";
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeClubElite").style.display = 'block';
      }else if(JSONusuario.membresia == 3 && JSONempresa.length < 4){
        document.getElementById("plan3").className = "plan selected-plan";
        document.getElementById("check3").className = "fa fa-check-circle";
      }
      setInterval('mostrarBtnImagen()', 1000);
  });

  function mostrarBtnImagen() {
    $prueba = document.getElementById("imgReemplazo");
    if($prueba.childNodes.length > 1){
      document.getElementById("btnImagenPerfil").style.display = 'block';
    }else{
      document.getElementById("btnImagenPerfil").style.display = 'none';
    }
  }

  $('#idDepto').on('change', function (event) {
      var id = $(this).find('option:selected').val();
      $('#idCiudad').empty();
      $('#idCiudad').append($('<option>', {
            value: 0,
            text: 'Elija una opción'
        }));
      JSONCiudades = eval(<?php echo json_encode($ciudades);?>);
      JSONCiudades.forEach(function(currentValue,index,arr) {
        if(currentValue.idDepartamento == id){
          $('#idCiudad').append($('<option>', {
            value: currentValue.id,
            text: currentValue.nombre
        }));
        }
    }); 
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
      ventana.value = 3;  
    }else if(idBtn.id == "btn-guardarimg"){
      ventanaFactura.value = 4;
    }else if(idBtn.id == "btn-guardar5"){
      ventana.value = 5;
      formEditUsuario.submit();
    }else if(idBtn.id == "btn-guardar6"){
      ventana.value = 6;
      formEditUsuario.submit();
    }else if(idBtn.id == "btn-guardar7"){
      ventana.value = 7;
      formEditUsuario.submit();
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

  #imagenPerfilNegocioCircular{
    width: 150px;
    height: 150px;
  }

  #imagenPerfilUsuarioCircular{ 
    width: 150px;
    height: 150px;
  }

</style>
@endsection
