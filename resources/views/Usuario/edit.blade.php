@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
      
<div class="view-account">
  <div class="module">
      <div class="module-inner">
          <div class="side-bar" >
              <div class="user-info">
                <div align="center">
                  {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
                  {{ csrf_field() }}
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
                  {!! Form::close() !!}
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
                    <li><a data-toggle="tab" href="#tab3"><p><span class="fa fa-newspaper-o"></span> Factura</p></a></li>
                    <li><a data-toggle="tab" href="#tab4"><p><span class="fa fa-pencil-square-o"></span> Mesas</p></a></li>
                    <li class="active"><a data-toggle="tab" href="#tab5"><span class="fa fa-fw fa-bar-chart-o"></span> Reportes</a></li>
                  </ul>    
              </nav>
          </div>
          <!-- MAIN CONTENT -->
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <div id="main-content">
                <div class="container-fluid">
                  <div class="section-heading">
                    <h1 class="page-title">Perfil</h1>
                  </div>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Perfil</a></li>
                    <li><a href="#account" role="tab" data-toggle="tab">Cuenta</a></li>
                    <li><a href="#billings" role="tab" data-toggle="tab">PocketClub</a></li>
                    <li><a href="#preferences" role="tab" data-toggle="tab">Bolsillo</a></li>
                  </ul>
                  <form>
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
                                <input type="text" name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}"/>
                                <div class="bg-danger text-white">{{$errors->first('nombrePersona')}}</div>
                              </div>
                              <div class="form-group">
                                <label>Documento</label>
                                <select class="form-control">
                                  <option value="Category 1">Tipo De Documento</option>
                                    <option value="Category 1">T.I</option>
                                    <option value="Category 3">C.C</option>
                                </select>
                                <br>
                                <div>
                                  <input type="number" name="cedula" placeholder="Cedula" class="form-control" value="{{$usuario->cedula}}">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Sexo</label>
                                <div style="margin-left: 5%;">
                                  <label>
                                    <input name="gender2" value="male" type="radio" checked>
                                    <span><i></i>Masculino</span>
                                  </label>
                                  <label>
                                    <input name="gender2" value="female" type="radio">
                                    <span><i></i>Femenino</span>
                                  </label>
                                  <label>
                                    <input name="gender2" value="female" type="radio">
                                    <span><i></i>Otro</span>
                                  </label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <div class="input-group date" data-date-autoclose="true" data-provide="datepicker">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input type="date" name="fechaNacimiento" class="form-control" value='{{$usuario->fechaNacimiento}}'>
                                  <div class="bg-danger text-white">{{$errors->first('fechaNacimiento')}}</div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Telefono</label>
                                <div>
                                  <input type="text" class="form-control" placeholder="Telefono o Celular" value="{{$usuario->telefono}}">
                                </div>
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <div>
                                      <input type="email" class="form-control" placeholder="Correo Electronico" value="{{$usuario->email}}"/>
                                  </div>
                              </div>
                            </div>
                            <!-- END LEFT SECTION -->
                            <!-- RIGHT SECTION -->
                            <div class="right">
                              <h2> Información Bar</h2>
                              <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre del Establecimiento">
                              </div>
                              <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" placeholder="Dirección">
                              </div>
                              <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" placeholder="Teléfono o celular">
                              </div>
                              <div class="form-group">
                                <label>Regimen</label>
                                <div>
                                  <select class="form-control">
                                      <option value="Category 1">Tipo de Regimen</option>
                                      <option value="Category 1">Regimen Comun</option>
                                      <option value="Category 3">Regimen Simplificado</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Nit</label>
                                <div>
                                    <input type="text" class="form-control" placeholder="Ingrese su nit xxxxxxx-xx">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Departamento</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$usuario->departamento}}" disabled>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Ciudad</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$usuario->ciudad}}" disabled>
                                </div>
                              </div>
                            </div>
                            <!-- END RIGHT SECTION -->
                          </div>
                          <div class="form-group" align="center">
                            <p class="margin-top-30">
                              <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
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
                              <h2 class="profile-heading">Informaciòn de la cuenta</h2>
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value="austinhoffman" disabled>
                              </div>
                              <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="austin.hoffman@yourdomain.com">
                              </div>
                              <div class="form-group">
                                <label>Celular</label>
                                <input type="text" class="form-control">
                              </div>
                            </div>
                            <!-- END LEFT SECTION -->
                            <!-- RIGHT SECTION -->
                            <div class="right">
                              <h2 class="profile-heading">Cambiar contraseña</h2>
                              <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input type="password" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Contraseña Nueva</label>
                                <input type="password" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Confirmar Contraseña</label>
                                <input type="password" class="form-control">
                              </div>
                            </div>
                            <!-- END RIGHT SECTION -->
                          </div>
                          <p class="margin-top-30">
                    <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
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
                  </form>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="tab2">
          <div id="main-content">
            <div class="container-fluid">
              <div class="section-heading">
                <h1 class="page-title">Categoría</h1>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane" id="tab3">
          <div id="main-content">
            <div class="container-fluid">
              <div class="section-heading">
                <h1 class="page-title">Factura</h1>
              </div>
            </div>
          </div>
        </div>
        
        <div class="tab-pane" id="tab4">
          <div id="main-content">
            <div class="container-fluid">
              <div class="section-heading">
                <h1 class="page-title">Mesas</h1>
              </div>
              <div class="col-sm-offset-2 col-sm-8">
                <div class="navbar-form navbar-left" >
                  <div class="form-group" align="left">
                      <a href="#addModal" class="btn btn-default" data-toggle="modal">
                          <i class="fa fa-plus"></i> Crear mesas &ensp;&ensp;&ensp;&ensp;&ensp;
                      </a>
                  </div>
                </div >
                <div class="navbar-form navbar-right" >
                  <div class="form-group" align="right">
                    <div class="icon-addon addon-md">
                        <input  id="nombreInput" type="text" size="40" maxlength="30" placeholder="Buscar..." class="form-control" />
                        <label for="nombreInput" class="glyphicon glyphicon-search" rel="tooltip" title="nombreInput"></label>
                    </div>
                  </div>
                </div>

              <div class="modal fade in" id="addModal" >
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
                                  <input type="number" name="numero" class="form-control" placeholder="Numero de mesas" required="true"/>
                              </div>
                              <div class="form-group">
                                  <input type="text" name="estado" class="form-control" value="Disponible" disabled />
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
              <div id="list-prov" class="col-sm-offset-2 col-sm-8">
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
            </div>
          </div>
        </div>
      </div>
    <!-- END MAIN CONTENT -->
    <div class="clearfix"></div>

      </div>
    </div>
  </div>
      
<!-- JAVASCRIPT -->
<script>
  $(document).ready(function(){  
        $(".gallery-item filter1 fancybox").fancybox({ });  
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
</script>
<style type="text/css">
  #sexo{
    margin-left: 5%;
  }
</style>
@endsection
