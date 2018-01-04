@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
      
<div class="view-account">
  <div class="module">
      <div class="module-inner">
        {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
          <div class="side-bar">
              <div class="user-info">
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
                  <ul class="meta list list-unstyled">
                      <li class="name">{{$usuario->nombrePersona}}
                          <label class="label label-info pocketColor" style=" margin: 5px 5px 5px 5px; padding:.3em .9em .3em;"><b>Admin</b></label>
                      </li>
                  </ul>
              </div>
              <nav class="side-menu">
                  <ul class="nav">
                    <li class="active"><a data-toggle="tab" href="#tab1"><span class="fa fa-user"></span> Perfil</a></li>
                  </ul>    
              </nav>
          </div>
          <!-- MAIN CONTENT -->
    <div id="main-content">
      <div class="container-fluid">
        <div class="section-heading">
          <h1 class="page-title">Perfil</h1>
        </div>
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Perfil</a></li>
          <li><a href="#account" role="tab" data-toggle="tab">Cuenta</a></li>
          <li><a href="#billings" role="tab" data-toggle="tab">PocketClub</a></li>
          <li><a href="#mesas" role="tab" data-toggle="tab">Mesas</a></li>
          <li><a href="#preferences" role="tab" data-toggle="tab">Bolsillo</a></li>
        </ul>
        <form>
          <div class="tab-content content-profile">
            <!-- MY PROFILE -->
            <div class="tab-pane fade in active" id="myprofile">
              <div class="profile-section">
                <h2 class="profile-heading">Información General</h2>
                <div class="clearfix">
                  <!-- LEFT SECTION -->
                  <div class="left">
                    <div class="form-group">
                     <div class="page-nav">
                        <div class="btn-group" role="group">
                          <div class="btn-group" >
                            <button id="btn-misnego" class="btn  dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Mis Negocios<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li> <a href="#"><i class="fa fa-plus"></i> Bar 1</a> </li>
                              <li> <a href="#"><i class="fa fa-edit"></i> Bar 2</a> </li>
                              <li> <a href="#"><i class="fa fa-trash-o"></i> Bar 3</a> </li>
                            </ul>
                          </div>
                          <button id="btn-masnego" class="btn btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="List View" id="drive-list-toggle"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Nombres</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Sexo</label>
                      <div>
                        <label class="fancy-radio">
                          <input name="gender2" value="male" type="radio" checked>
                          <span><i></i>Masculino</span>
                        </label>
                        <label class="fancy-radio">
                          <input name="gender2" value="female" type="radio">
                          <span><i></i>Femenino</span>
                        </label>
                        <label class="fancy-radio">
                          <input name="gender2" value="female" type="radio">
                          <span><i></i>Otro</span>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Fecha de Nacimiento</label>
                      <div class="input-group date" data-date-autoclose="true" data-provide="datepicker">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  <!-- END LEFT SECTION -->
                  <!-- RIGHT SECTION -->
                  <div class="right">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Indicaciones extra</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Ciudad</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Departamento</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <!-- END RIGHT SECTION -->
                </div>
                <p class="margin-top-30">
              <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                
                </p>
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
            <div class="tab-pane fade" id="mesas">
              <div class="clearfix">
                <div class="left">
                  <div class="profile-section">
                    <h3>MIS MESAS</h3>
                  </div>
                </div>
              </div>
            </div>
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
    <!-- END MAIN CONTENT -->
    <div class="clearfix"></div>

        {!! Form::close() !!}
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



<!-- 
   <div class="user-account">
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
    <div class="dropdown">
      <a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Hola, <strong>{{$usuario->nombrePersona}}</strong></a>
  
    </div>
  </div>
                -->