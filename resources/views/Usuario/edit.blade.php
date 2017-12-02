@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
@section('content')
  <div content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    <div class ="panel-body">
       {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
          {{ csrf_field() }}
          <!--Imagen de la empresa-->
          <div class="row ">

            <div class="col-md-12">
              <div class="form-group">
                <!-- End Navigation -->
                <div class="container main-content">
                  <!-- inicio de perfil -->

                		<div class="view-account">
                        <div class="module">
                            <div class="module-inner">
                              <div class="col-md-4">
                                <div class="form-group">
                                <div class="side-bar">
                                  <div class="user-info">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                        @if($usuario->imagenPerfil!='')
                                          {!! Html::image('images/admins/'.$usuario->imagenPerfil , 'imagen de perfil') !!}
                                        @else
                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                                        @endif
                                      </div>
                                      <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px">
                                      </div>
                                      <div>
                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar imagen</span><span class="fileupload-exists">Cambiar</span><input type="file" class="form-control" name="imagenPerfil" ></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
                                      </div>
                                    </div>
                                        <ul class="meta list list-unstyled">
                                            <li class="name">"{{$usuario->nombrePersona}}"
                                                <label class="label label-info pocketColor" style=" margin: 5px 5px 5px 5px; padding:.3em .9em .3em;"><b>Admin</b></label>
                                            </li>
                                            <li class="activity">Última sesión iniciada: hoy a las 2:18 p.m.</li>
                                        </ul>
                                    </div>
                                    <nav class="side-menu">
                                        <ul class="nav">
                                          <li class="active"><a data-toggle="tab" href="#tab1"><span class="fa fa-user"></span> Perfil</a></li>
                                          <li><a data-toggle="tab" href="#tab2"><span class="fa fa-gear"></span> Configuracion</a></li>
                                          <li><a data-toggle="tab" href="#tab3"><span class="fa fa-pencil-square-o"></span> Mesas</a></li>
                                          <li><a data-toggle="tab" href="#tab4"><span class="fa fa-envelope"></span> Categoria</a></li>
                                          <li><a data-toggle="tab" href="#tab5"><p><span class="fa fa-envelope"></span> Factura</p></a></li>
                                        </ul>
                                    </nav>
                                </div>
                              </div>
                              </div>
                              <!--Mis Negocios-->
                              <div class="col-md-8">
                                <div class="form-group">
                                  <div class="content-panel">
                                    <div class="content-utilities">
                                      <div class"col-md-4">
                                        <h3 class="fieldset-title" style=" text-align:left;">Informacion Personal </h3>
                                        <div class="col-md-10 col-sm-9 col-xs-12">
                                            <div class="page-nav">
                                              <div class="btn-group" role="group">
                                                <div class="btn-group" >
                                                  <button class="btn  dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Mis Negocios<span class="caret"></span></button>
                                                  <ul class="dropdown-menu">
                                                    <li> <a href="#"><i class="fa fa-plus"></i> Bar 1</a> </li>
                                                    <li> <a href="#"><i class="fa fa-edit"></i> Bar 2</a> </li>
                                                    <li> <a href="#"><i class="fa fa-trash-o"></i> Bar 3</a> </li>
                                                  </ul>
                                                </div>
                                                <button class="btn btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="List View" id="drive-list-toggle"><i class="fa fa-plus"></i></button>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="actions">
                      <!--<div class="btn-group">
                                        <h2 class="title">Mi Negocio</h2>
                                      </div>-->
                      </div>
                                  </div>
                                    <div class="">
                                    <!-- Tab panes -->
                                      <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                					<!-- Profile -->
                					               <form class="form-horizontal">
                                           <fieldset class="fieldset">
                                             <div class="form-group">
                                              <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nombre</label>
                                              <div class="col-md-10 col-sm-9 col-xs-12">
                                                <input type="text" name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}"/>
                                                <div class="bg-danger text-white">{{$errors->first('nombrePersona')}}</div>
                                              </div>

                                              <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Documento</label>
                                                <div class="col-md-4">
                              						        <select class="form-control">
                                                    <option value="Category 1">Tipo De Documento</option>
                                                    	<option value="Category 1">T.I</option>
                                                        <option value="Category 3">C.C</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                  <input type="text" name="cedula" class="form-control" value="{{$usuario->cedula}}"/>
                                                </div>

                                            <!--Fecha de nacimiento-->
                                              <div class="form-group">
                                              <label class="col-md-2 col-sm-3 col-xs-12 control-label">Fecha de Nacimiento</label>
                                              <div class="col-md-10 col-sm-9 col-xs-12">
                                                <input type="date" name="fechaNacimiento" value='{{$usuario->fechaNacimiento}}' class="form-control"/>
                                            <div class="bg-danger text-white">{{$errors->first('fechaNacimiento')}}</div>
                                            </div>
                                            </div>

                                            <!--Sexo-->
                                            <br>
                                            <div class="row">
                                              <label for="sexo" class="control-label col-md-2 col-sm-3 col-xs-12">Sexo:</label>
                                              <div class="col-md-10 col-sm-9 col-xs-12">
                                                <label class="radio-inline">
                                                  @if($usuario->sexo=='Femenino')
                                                    <input type="radio" name="sexo" checked="checked" value="Femenino"><span>Femenino</span>
                                                  @else
                                                    <input type="radio" name="sexo" value="Femenino"><span>Femenino</span>
                                                  @endif
                                                </label>
                                                <label class="radio-inline">
                                                  @if($usuario->sexo=='Masculino')
                                                    <input type="radio" name="sexo" checked="checked" value="Masculino"><span>Masculino</span>
                                                  @else
                                                    <input type="radio" name="sexo" value="Masculino"><span>Masculino</span>
                                                  @endif
                                                </label>
                                                <div class="bg-danger text-white">{{$errors->first('sexo')}}</div>
                                              </div>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                              <label class="col-md-2 col-sm-3 col-xs-12 control-label">Telefono</label>
                                              <div class="col-md-10 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" placeholder="Telefono o Celular" value="{{$usuario->telefono}}">

                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                                                    <input type="email" class="form-control" placeholder="Correo Electronico" value="{{$usuario->email}}"/>
                                                </div>
                                            </div>
                                                                    </fieldset>
                                        <fieldset class="fieldset">
                                            <h3 class="fieldset-title">Blanck And White (Bar)</h3>

                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nombre</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Nombre del Establecimiento">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Direccion</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Direccion del Establecimiento">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Telefono</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Telefono o Celular">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Regimen</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                              						<select class="form-control">
                                                    	<option value="Category 1">Tipo de Regimen</option>
                                                    	<option value="Category 1">Regimen Comun</option>
                                                        <option value="Category 3">Regimen Simplificado</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nit</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Ingrese su nit xxxxxxx-xx">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Ciudad</label>
                                                <div class="col-md-3">
                              						<select class="select2able">
                                                    	<option value="Category 1">Valor 1</option>
                                                    	<option value="Category 1">Valor 2</option>
                                                        <option value="Category 3">Valor 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                              						<select class="select2able">
                                                    	<option value="Category 1">Valor 1.1</option>
                                                    	<option value="Category 1">valor 2.1</option>
                                                        <option value="Category 3">valor 3.1</option>
                                                    </select>
                                                 </div>
                                                 <div class="col-md-3">
                              						<select class="select2able">
                                                    	<option value="Category 1">valor 1.1.2</option>
                                                    	<option value="Category 1">valor 2.1.2</option>
                                                        <option value="Category 3">Valor 3.1.2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Tipo</label>
                                                <div class="col-md-10 col-sm-9 col-xs-12">
                              						<select class="form-control">
                                                    	<option value="Category 1">Tipo de Establecimiento</option>
                                                    	<option value="Category 1">Bar</option>
                                                        <option value="Category 3">Restaurante</option>
                                                    </select>
                                           		</div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                        <div class="form-group">
                                          <div class="modal-footer">
                                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                                <button class="btn btn-default pull-right" style="BACKGROUND-COLOR: rgb(79,0,85)"; onclick = "return confirm ('¿Desea Guardar los Cambios?')"><i class="fa fa-send"></i>Guardar Cambios</button>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                    <!-- fin de profile -->


                                      </div>

                                      <div class="tab-pane" id="tab2">
                                       numero 2
                                      </div>

                                      <div class="tab-pane" id="tab3">
                                      numero 3
                                      </div>

                                      <div class="tab-pane" id="tab4">
                                      numero 4
                                      </div>

                                      <div class="tab-pane" id="tab5">
                                      Numero 5
                                      </div>

                                    </div>
                                    <!-- Tab panes -->
                                    </div>

                                </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>


                <!-- fin de perfil -->
         {!! Form::close() !!}
    </div>
  </div>
  @if(Auth::User()->esAdmin)
    @endsection
  @endif
