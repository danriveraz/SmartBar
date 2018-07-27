@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
@include('flash::message')
<title>
  PERFIL
</title>
<!-- Estilos vista perfil-->
{!!Html::style('assets-Internas/css/styleProfile.css')!!}
<!-- FIN -->

<!-- Contendor todo seleccion-->
<div id="page-content" style="background: #FCFCFC;">
<!-- contenedor de perfil-->
<div class="container">
    <div class="row profile">
		<div class="col-sm-3 col-sm-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
				  <!-- img de perfil-->
				  <div class="user-info">
            {!! Form::open(['route' => ['Auth.usuario.posteditUsuario',$usuario], 'method' => 'POST','enctype' => 'multipart/form-data', 'class' => 'input-append', 'id' => 'formEditFotoPerfil']) !!}
              {{ csrf_field() }}
                <div class="widget-content fileupload fileupload-new" data-provides="fileupload" >
                  <div class="gallery-container fileupload-new img-thumbnail">
                    <div id="imgActual" class="gallery-item filter1" rel="" style="border-radius: 50%; width: 150px; height: 150px;background-color: #2d0031;">
                      @if($usuario->imagenPerfil!='')
                        {!! Html::image('images/admins/'.$usuario->imagenPerfil,  'imagen de perfil', array('class' => 'img-responsive img-circle user-photo', 'id' => 'imagenPerfilUsuarioCircular')) !!}
                        <!-- clase circular -> , array('class' => 'img-responsive img-circle user-photo') -->
                      @else
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" class="img-responsive img-circle user-photo">
                      @endif
                      <div class="actions">
                        <a  id="modalImagen" href="{{asset('images/admins/'.$usuario->imagenPerfil)}}" title="Imagen perfil">
                          <i class="fa fa-search-plus"></i>
                        </a>
                        <a onclick="$('#imagenPerfil').click()" title="Editar imagen">
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
                <div id="btnImagenPerfil">
                  <a id="btn-guardarimg" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Guardar Imagen</a>
                  <p>
                </div>
                <div hidden>
                  <input id="ventanaFactura" name="ventanaFactura" class="form-control" value=""  type="text">
                </div>
            {!! Form::close() !!}
          <ul class="meta list list-unstyled">
            <li class="name">{{$usuario->nombrePersona}}
            <br>
            <label class="label label-info pocketColor"  style=" margin: 5px 5px 5px 5px; padding:.3em .9em .3em;">
              <b>Admin</b>
            </label>
            </li>
          </ul>
        </div>
				<!-- fin de imagen de perfil-->
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						@if($nuevaTab == 'perfil')
						<li class="active">
						@else
						<li>
						@endif
						  <a data-toggle="tab" href="#tab1">
                <i class="glyphicon glyphicon-user"></i>
  							Perfil
						  </a>
						</li>
						@if($nuevaTab == 'categorias')
						<li class="active">
						@else
						<li>
						@endif
						  <a data-toggle="tab" href="#tab2">
                <i class="glyphicon glyphicon-list-alt"></i>
  							Categoria</a>
						</li>
						<li>
						  <a href="{{url('Auth/modificarFactura')}}">
                <i class="fa fa-newspaper-o"></i>
  							Factura</a>
						</li>
						@if($nuevaTab == 'mesas')
						<li class="active">
						@else
						<li>
						@endif
						  <a data-toggle="tab" href="#tab4"><i class="fa fa-pencil-square-o"></i>
							Mesas</a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-sm-9 col-md-9">
      <div class="profile-content">
        <!-- MAIN CONTENT -->
        <div class="tab-content">
  				@if($nuevaTab == "perfil")
  				<div class="tab-pane active" id="tab1">
  				@else
  				<div class="tab-pane" id="tab1">
  				@endif
				    <div>
				<!-- Inicio tab Perfil-->
				      <div class="well" style="background-color: white;">
        				<ul class="nav nav-tabs">
        				  <li class="active" title="Perfil">
                    <a href="#myprofile" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-user"></i><label>&#160;Perfil</label>
                    </a>
                  </li>
        				  <li title="Empresa">
                    <a href="#empresa" role="tab" data-toggle="tab">
                      <i class="fa fa-reorder">
                      </i>
                      <label>&#160;Empresa</label>
                    </a>
                  </li>
        				  <li title="PocketClub">
                    <a href="#billings" role="tab" data-toggle="tab">
                      <i class="glyphicon glyphicon-globe"></i>
                      <label>&emsp;PockeClub</label>
                    </a>
                  </li>
        				  <li title="Bolsillo">
                    <a href="#preferences" role="tab" data-toggle="tab">
                      <i class="fa fa-reddit-alien"></i>
                      <label>&emsp;Bolsillo</label>
                    </a>
                  </li>
        				</ul>
                  {!! Form::open(['route' => ['Auth.usuario.posteditUsuario',$usuario], 'method' => 'POST','enctype' => 'multipart/form-data', 'class' => 'login-form', 'id' => 'formEditUsuario']) !!}
                  {{ csrf_field() }}
                    <div class="tab-content content-profile">
                      <!-- MY PROFILE -->
                      <div class="tab-pane fade in active" id="myprofile">
                        <div class="profile-section">
                          <!-- Inicio de contenedor del perfil-->
							            <div class="row">
          								<div class="col-sm-6">
          								<!-- Input de personal -->
          								<div class="container">
          									<div class="containerSpacing">
          										<div class="input-container">
          											<i class="fa fa-user"></i>
          											<input class="input" name="nombrePersona" value="{{$usuario->nombrePersona}}" placeholder="Nombre Completo" type="text"/>
          										</div>
          										<div class="input-container">
          											<i class="fa fa-address-card"></i>
          											<input class="input"name="cedula" value="{{$usuario->cedula}}"  placeholder="Identificacion" type="text" maxlength="10"/>
          										</div>
          										<div class="input-container">
          										<i class="fa fa-venus-mars"></i>
          										<select name='sexo' class="select" placeholder="Tipo De Sexo">
          										  @if($usuario->sexo=='Femenino')
          											<option value="Masculino">Masculino</option>
          											<option value="Femenino" selected="selected">Femenino</option>
          										  @else
          											<option value="Masculino" selected="selected">Masculino</option>
          											<option value="Femenino" >Femenino</option>
          										  @endif
          										</select>
          										</div>
          										<div class="input-container">
          											<i class="fa fa-birthday-cake"></i>
          											<input id="fechaNacimiento" name="fechaNacimiento" value="{{$usuario->fechaNacimiento}}" type="date" class="input" placeholder="Fecha Nacimiento" />
          										</div>
          										<div class="input-container">
          											<i class="fa fa-phone"></i>
          											<input class="input" name="telefono" type="text"  placeholder="Telefono o Celular" value="{{$usuario->telefono}}" maxlength="10"/>
          										</div>
            									<div class="form-group" hidden="true">
            									 <input id="ventana" name="ventana" class="form-control" value=""  type="text">
            									</div>
          									</div>
          								</div>
          								</div><!--fin del col conte1-->
          								<div class="col-sm-6">
          								<div class="widget-container" style="min-height: 250px !important;">
          									<div class="containerSpacing">
          									 <p class="lead col-centrada" style="margin-bottom: 10px;">
                              Información de tu<span class="text-success"> Cuenta</span>
                             </p>
          									<div class="container">
          										<div class="input-container">
          											<i class="fa fa-envelope-o"></i>
          											<input type="text" class="input" name="email" placeholder="Email" value="{{$usuario->email}}"/>
          										</div>
          										<div class="input-container">
          											<i class="fa fa-lock"></i>
          											<input type="password"  id="password" class="input" name="password" placeholder="Contraseña"/>
          											<i id="show-password" class="fa fa-eye"></i>
          										</div>
          										<div class="input-container">
          											<i class="fa fa-lock"></i>
          											<input type="password"  id="passwordC" class="input" name="password" placeholder="Confirmar Contraseña"/>
          											<i id="show-password1" class="fa fa-eye"></i>
          										</div>
          									</div>
          									</div>
          								</div>
          								</div>
          							</div>
                          <!-- Fin de contenedor del perfil-->
                          <div class="row">
            								<div class="col-sm-12">
            								<div class="form-group" align="center">
            									<a id="btn-guardar-perfil" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
            									<i class="fa fa-send"></i>Guardar
            									</a>
            								</div>
            								</div>
            							</div>
                        </div><!-- fin de profile-section-->
                      </div>
                      <div class="tab-pane fade" id="empresa">
                        <div class="profile-section">
                          <!-- Inicio de contenedor del Empresa-->
							<div class="row">
								<div class="col-sm-6">

								<!-- Input de personal -->
								<div class="container">
									<div class="containerSpacing">
										<div class="input-container">
											<i class="fa fa-bars"></i>
											<input class="input" name="nombreEstablecimiento" type="text" placeholder="Nombre del Establecimiento" value="{{$empresa->nombreEstablecimiento}}" required="true"/>
										</div>
										<div class="input-container">
											<i class="fa fa-map-marker"></i>
											<input type="text" class="input" name="direccionEstablecimiento" type="text"  placeholder="Dirección" value="{{$empresa->direccion}}" required="true"/>
										</div>
										<div class="input-container">
											<i class="fa fa-phone"></i>
											<input class="input" name="telefonoEstablecimiento" type="text" placeholder="Teléfono o celular" value="{{$empresa->telefono}}" maxlength="10" required="true"/>
										</div>
										<div class="input-container">
											<i class="fa fa-map-marker"></i>
											<input class="input"  value="{{$empresa->departamento}}" disabled/>
										</div>
										<div class="input-container">
											<i class="fa fa-map-marker"></i>
											<input class="input" value="{{$empresa->ciudad}}" disabled/>
										</div>
									</div>
								</div>
								</div><!--fin del col conte1-->
								<div class="col-sm-6">
								<div class="widget-container">
									<div class="containerSpacing">
                    <div class="container">
                    <p class="lead" style="margin-bottom: 10px;">Informacion <span class="text-success">Tributaria</span></p>
                  </div>
                  <div class="container">
									  <div class="input-container">
										  @if($empresa->nit == 0)
											<i class="fa fa-drivers-license"></i>
											<input name="nit" type="text" class="input" placeholder="Ingrese su nit xxxxxxx-xx" required="true">
										  @else
											<i class="fa fa-drivers-license"></i>
											<input name="nit" type="text" class="input" placeholder="Ingrese su nit xxxxxxx-xx" value="{{$empresa->nit}}" required="true">
										  @endif
									  </div>
										<div class="input-container">
                    <i class="fa fa-venus-mars"></i>
                    <select id="tipoRegimen" name="tipoRegimen" class="select" onchange="valor(this.value);">
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
                    <div id="regimenComun" style="display: none;">
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
                          <input class="input" id="resolucion" name="resolucion" placeholder="Resolución de facturación" type="text" id="regimen" name="regimen" value="{{$empresa->nresolucionFacturacion}}"">
                        </div>
                      <div class="input-container">
                          <i class="fa fa-drivers-license"></i>
                          <input class="input" name="fechaResolucion" id="fechaResolucion" type="date" placeholder="Fecha resolución" value="{{$empresa->fechaResolucion}}">
                      </div>
                      <div class="input-container">
                        <div class="input-group">
                          <div class="col-md-4">
                            <input name="prefijo" id="prefijo" type="text" class="input" placeholder="Prefijo" value="{{$empresa->prefijo}}" required="true">
                          </div>
                          <div class="col-md-4">
                            @if($empresa->nInicio != 0)
                            <input name="nInicio" id="nInicio" type="text" class="input" placeholder="Del No." value="{{$empresa->nInicio}}" required="true">
                            @else
                            <input name="nInicio" id="nInicio" type="text" class="input" placeholder="Del No." required="true">
                            @endif
                          </div>
                          <div class="col-md-4">
                            @if($empresa->nFinal != 0)
                            <input name="nFinal" id="nFinal" type="text" class="input" placeholder="Hasta" value="{{$empresa->nFinal}}" required="true">
                            @else
                            <input name="nFinal" id="nFinal" type="text" class="input" placeholder="Hasta" required="true">
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
          <!-- Fin de contenedor del Empresa-->
          <div class="row">
						<div class="col-sm-12">
						<div class="form-group" align="center">
							<a id="btn-guardarEmpresa" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
							 <i class="fa fa-send"></i>Guardar
							</a>
						</div>
						</div>
					</div>
				</div>
      </div>
      <!-- END MY PROFILE -->
      <!-- Tap PocketClub -->
      <div class="tab-pane fade" id="billings">
        <div class="row">
          <div class="col-sm-12">
            <div class="container PocketAlertPro">
            	<p>
                <div class="alert alert-info">
                  <h4>!Estas al día</h4>
                  <p>
                    Tu Membresia PocketClub vence en 30 dias faltando 7 dias te recordaremos el vencimiento de la membresia<p>
                </div>
            </div>
          </div>
        <div class="col-sm-12">
          <!-- PLANES -->
          <div class="container">
          <!-- PLANES -->
            <div class="blockPlanes text-center">
              <h2>Membresias PocketClub</h2>
              <div class="row plans cards-basic">
          	<div class="row">
              @if($usuario->membresia == 1)
                <div class="col plan bg-gray">
              @else
                <div class="col plan">
              @endif
                <h2 class="plan-title">ÚNICA</h2>
                <ul>
                  <li>Hasta 10 Empleados</li>
                  <li>Asesoria Permanente(✓)</li>
                  <li>1 sólo negocio</li>
                  <li>Promociones Únicas SmartShop</li>
                  <li>Uso del programa por 30 días</li>
                  <li>Información segura hasta por 90 días</li>
                  <li>Acceso al 100% de las utilidades SmartBar</li>
                  <li>No aplica mes GRATIS</li>
                  <li>0% de ahorro</li>
                </ul>
                <h3 class="plan-price"> $ 99.900 COP/Mes</h3>
                @if($usuario->membresia == 1)
                  <a id="btn-guardar1" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Atual Membresia</a>
                @else
                  <a id="btn-guardar1" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Adquirir</a>
                @endif
                <p>
                  <br>
                  10% descuento en pago trimestral.
                </p>
              </div>
              @if($usuario->membresia == 3)
                <div class="col plan bg-gray">
              @else
                <div class="col plan">
              @endif
                <h2 class="plan-title">ÉLITE</h2>
                <ul>
                    <li>Empleados Infinitos</li>
                    <li>Asesoria Permanente (✓)</li>
                    <li>Hasta 4 Negocios</li>
                    <li>Todas las promociones SmartShop</li>
                    <li>Uso del programa por 3 años</li>
                    <li>Información segura hasta por 4 años</li>
                    <li>Acceso al 100% de las utilidades SmartBar</li>
                    <li>Personaje Real Smartbar GRATIS</li>
                    <li>El mes 1, 12,24 y 36 son GRATIS</li>
                    <li>CAPACITACIÓN PROFESIONAL GRATIS (Servicio al Cliente)</li>
                    <li>Ahorra hasta $ 400.000 Cop</li>
                </ul>

                <h3 class="plan-price">$ 2.998.800 COP</h3>
                @if($usuario->membresia == 3)
                  <a id="btn-guardar1" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Atual Membresia</a>
                @else
                  <a id="btn-guardar1" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Adquirir</a>
                @endif
                <p>
                  <br>
                  Descuento en membresia de $ 198.000 Cop
                </p>
              </div>
              @if($usuario->membresia == 2)
                <div class="col plan bg-gray">
              @else
                <div class="col plan">
              @endif
                <h2 class="plan-title">ESPECIAL</h2>
                  <ul>
                    <li>Hasta 20 Empleados</li>
                    <li>Asesoria Permanente (✓)</li>
                    <li>Hasta 2 negocios</li>
                    <li>Promociones Únicas y especiales SmartShop</li>
                    <li>Uso del programa por 6 meses</li>
                    <li>Información segura hasta por 1 año</li>
                    <li>Acceso al 100% de las utilidades SmartBar</li>
                    <li>El mes 6 es GRATIS</li>
                    <li>Ahorra hasta $ 100.000 Cop</li>
                </ul>
                <h3 class="plan-price">$ 499.500 COP</h3>
                @if($usuario->membresia == 2)
                  <a id="btn-guardar1" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Atual Membresia</a>
                @else
                  <a id="btn-guardar1" class="btn btn-pocket" style="font-weight: 400;" type="submit" onclick="setValue(this)">
                  <i class="fa fa-send"></i>Adquirir</a>
                @endif
                <p>
                  <br>
                  10% descuento en pago anual.
                </p>
              </div>
            </div>
        	</div>
          <hr>
        	<div class="pocket">
            <h4>Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas.</h4></div>
            <hr>
          </div>
        <!-- PLANES -->
        </div>
        <!-- Fin PLANES -->
      </div>
    </div>
  </div>
                      <!-- END BILLINGS -->
                      <!-- PREFERENCES -->
                      <div class="tab-pane fade" id="preferences">
                        <div class="profile-section">
                          <p>
                          <div id="mensajeGratis" class="form-group" style="display: none;">
                              <strong><h3 style="font-size: 18px">Para acceder a esta opción adquiere una membresía <a href=""><span class="text-success">Aqui.</span></a></h3></strong>
                          </div>
                          <div id="mensajeClub" class="form-group" style="display: none;">
                            <strong><h3 style="font-size: 18px">Tu membresía única solo cuenta con almacenamiento suficiente para un solo negocio, mejora tu
                          membresía <a href=""><span class="text-success">Aqui.</span></a></h3></strong>
                          </div>
                          <div id="mensajeClubEspecial" class="form-group" style="display: none;">
                              <strong><h3 style="font-size: 18px">Tu membresía especial solo cuenta con almacenamiento suficiente para un dos negocios, mejora tu
                          membresía <a href=""><span class="text-success">Aqui.</span></a></h3></strong>
                          </div>
                          <div id="mensajeClubElite" class="form-group" style="display: none;">
                              <strong><h3 style="font-size: 18px">¡Has llegado al número máximo de negocios!</h3></strong>
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
                                                      <button id="btn-guardar3" class="btn btn-pocket" onclick="setValue(this)">
                                                        Guardar
                                                      </button>
                                                    </p>
                                                  </div>
                                                </div>

                      </div>
                      <!-- END PREFERENCES -->
                    </div>
                  </form>
				</div>
				<!-- Fin Inicio Tap Perfil-->

				</div>
				</div>
        @if($nuevaTab == 'categorias')
        <div class="tab-pane active" id="tab2">
        @else
        <div class="tab-pane" id="tab2">
        @endif
				  <div id="">
          <!--contiene la categoria-->
            <div class="container-fluid">
              <div class="section-heading">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-sm-8">
                      <p class="lead" style="margin-bottom: 10px;font-size: 18px;">
                        Llenar tus categorias es mucho mas 
                        <span class="text-success">
                          facil y rapido
                        </span>
                      </p>
                    </div>
                    <div class="col-sm-4">
                      <div align="right">
                        <a href="#addModalCategoria" class="btn btn-pocket" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                          <i class="fa fa-plus"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <p>
              </div>
              <div class="col-sm-12" style="align-content: center;">
                <div id="list-cat"></div>
              </div>
              <div class="modal fade in" id="addModalCategoria" role="dialog">
                <div class="modal-dialog modal-md" style="width: 50%;">
                  <div class="modal-content">
                    {!! Form::open(['method' => 'POST', 'action' => 'CategoriaController@store', 'class' => 'login-form']) !!}
                      {{ csrf_field() }}
                      <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                        <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                        <h4 class="modal-title" style="font-weight: 400;font-size: 16px;">
                          Nueva Categoría
                        </h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="col-sm-6">
                              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    						<div class="carousel-inner">
              										<div class="item active">
              												<img src="{{asset ('assets-Internas/images/SliderProfileCategoria/image-iso3.png')}}" alt="First Slide">
            											</div>
            										</div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="widget-content">
                                <div class="form-group">
                                  <div class="input-container">
                                    <i class="glyphicon glyphicon-glass"></i>
                                      <input type="text" name="nombre" class="input" placeholder="Nombre" required="true" required="true" />
                                  </div>
                                  <br>
                                  <div class="input-container">
                                    <i class="fa fa-money"></i>
                                      <input type="number" min="0" step="any" name="precio" placeholder="Precio" class="input" />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-pocket" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" ><i class="fa fa-send"></i>Guardar</button>
                              </div>
                            </div>
                          </div>
                        </div>
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

			@if($nuevaTab == 'mesas')
      <div class="tab-pane active" id="tab4">
      @else
      <div class="tab-pane" id="tab4">
      @endif
				<div id="">
          <!--Inicio de mesas-->
          <div class="container-fluid">
            <div class="section-heading">
              <div class="row">
                <div class="col-sm-12">
                  <div class="col-sm-8">
                    <p class="lead" style="margin-bottom: 10px;font-size: 18px;">Llenar tu numero de Mesas es <span class="text-success">facil y rapido</span></p>
                  </div>
                  <div class="col-sm-4">
                    <div align="right">
                      <a href="#addModalMesas" class="btn btn-pocket" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                        <i class="fa fa-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <p>
            </div>
            <div class="col-sm-12">
              <div id="list-mesas"> </div>
            </div>
            <div class="col-sm-12">
              <div class="modal fade in" id="addModalMesas" >
                <div class="modal-dialog modal-md" style="width: 50%;">
                  <div class="modal-content">
                    <form class="login-form" name="formulario" autocomplete="on" method="post" action="{{url('mesas/create')}}">
                    {{csrf_field()}}
                      <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                        <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                        <h4 class="modal-title" style="font-weight: 400;font-size: 16px;">
                          Nueva Mesa
                        </h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="col-sm-6">
                              <div id="myCarousel" class="carousel slide" data-ride="carousel">
            										<div class="carousel-inner">
            											<div class="item active">
            												<img src="{{asset ('assets-Internas/images/SliderProfileCategoria/image-iso3.png')}}" alt="First Slide">
            											</div>
            										</div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <p class="lead" style="margin-bottom: 10px;">
                                Añade la cantidad de
                                <span class="text-success">
                                  Mesas
                                </span>
                              </p>
                              <ul class="list-unstyled" style="line-height: 1.5">
                                <li>
                                  <span class="fa fa-check text-success" style="padding-right:5px;">
                                  </span>Nombralas a tu elección en la tabla
                                </li>
                                <br>
                              </ul>
                              <div class="widget-content">
                                <div class="form-group">
                                  <div class="input-container">
                                    <i class="glyphicon glyphicon-glass"></i>
                                    <input class="input" type="number" name="cantidad"  placeholder="Cantidad de mesas" min="0" required="true"/>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-pocket" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" ><i class="fa fa-send"></i>Guardar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fin de Mesas-->
			  </div>
			</div>
      			</div>
    			<!-- END MAIN CONTENT -->
			</div><!-- Fin profile-content-->
		</div>
	</div>
	</div>
<!-- Fin contenedor de perfil-->
</div>
</div><!-- page-content-->
<!--fin Contendor de botones de busqueda seleccion-->

<!-- JAVASCRIPT -->
<script>
  var JSONusuario = eval(<?php echo json_encode($usuario); ?>);
  var JSONempresa = eval(<?php echo json_encode($empresa); ?>);
  $(document).ready(function(){
    // Show Password
    $('#show-password').click(function()
    {
      if ($(this).hasClass('fa-eye'))
      {
        $('#password').attr('type', 'text');
        $(this).removeClass('fa-eye');
        $(this).addClass('fa-eye-slash');
      } else {
        $('#password').attr('type', 'password');
        $(this).removeClass('fa-eye-slash');
        $(this).addClass('fa-eye');
      }
    })
    
    $('#show-password1').click(function()
      {
        if ($(this).hasClass('fa-eye'))
        {
          $('#passwordC').attr('type', 'text');
          $(this).removeClass('fa-eye');
          $(this).addClass('fa-eye-slash');
        } else {
          $('#passwordC').attr('type', 'password');
          $(this).removeClass('fa-eye-slash');
          $(this).addClass('fa-eye');
        }
    })
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
      if(JSONempresa.tipoRegimen == "comun"){
        document.getElementById('regimenComun').style.display = "block";
      }

      $("#fechaNacimiento").load(this);
      $('[data-toggle="popover"]').popover();
      function update(){
        document.getElementById('no').style.width = '10%';
        document.getElementById('opcionesMesas').style.width = '5%';
        document.getElementById('opcionesCategorias').style.width = '5%';
      }
      setTimeout(update, 1000);
      if (JSONusuario.membresia == 0) {
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeGratis").style.display = 'block';
      }else if(JSONusuario.membresia == 1){
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeClub").style.display = 'block';
      }else if(JSONusuario.membresia == 2 && JSONempresa.length == 2){
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeClubEspecial").style.display = 'block';
      }else if(JSONusuario.membresia == 2 && JSONempresa.length < 2){
        document.getElementById("plan2").className = "plan selected-plan";
        document.getElementById("check2").className = "fa fa-check-circle";
      }else if(JSONusuario.membresia == 3 && JSONempresa.length == 4){
        document.getElementById("bolsillo").style.display = 'none';
        document.getElementById("btn-guardar3").style.display = 'none';
        document.getElementById("mensajeClubElite").style.display = 'block';
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

  var valor = function(x){
    if(x == 'comun'){
      document.getElementById('regimenComun').style.display = "block";
      document.getElementById('resolucion').required = true;
      document.getElementById('fechaResolucion').required = true;
      document.getElementById('nInicio').required = true;
      document.getElementById('nFinal').required = true;
    }else{
      document.getElementById('regimenComun').style.display = "none";
      document.getElementById('resolucion').required = false;
      document.getElementById('resolucion').value = null;
      document.getElementById('fechaResolucion').required = false;
      document.getElementById('fechaResolucion').value = null;
      document.getElementById('prefijo').value = null;
      document.getElementById('nInicio').required = false;
      document.getElementById('nInicio').value = null;
      document.getElementById('nFinal').required = false;
      document.getElementById('nFinal').value = null;
    }
  };

  function setValue(idBtn) {
    if(idBtn.id == "btn-guardar-perfil"){
      if(password.value == passwordC.value) {
        ventana.value = 1;
        formEditUsuario.submit();
      }
      else{
        alert("Las contraseña no coinciden");
      }
    }else if(idBtn.id == "btn-guardarEmpresa"){
      ventana.value = 2;
      formEditUsuario.submit();
    }else if(idBtn.id == "btn-guardar3"){
      ventana.value = 3;
    }else if(idBtn.id == "btn-guardarimg"){
      ventanaFactura.value = 4;
      formEditFotoPerfil.submit();
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
