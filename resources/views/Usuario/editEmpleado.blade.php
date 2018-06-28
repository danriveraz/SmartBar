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
                {!! Form::open(['route' => ['Auth.usuario.posteditUsuario',$usuario], 'method' => 'GET','enctype' => 'multipart/form-data', 'id' => 'formEditFotoPerfil']) !!}
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
                        <a  id="modalImagen" href="{{asset('images/admins/'.$usuario->imagenPerfil)}}" title="Imagen">
                          <img src="{{asset('images/admins/'.$usuario->imagenPerfil)}}" hidden>
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
                        <label class="label label-info pocketColor" style=" margin: 5px 5px 5px 5px; padding:.3em .9em .3em;"><b>Trabajador</b></label>
                    </li>
                </ul>
              </div>
              <nav class="side-menu">
                  <ul class="nav">
                    <li class="active"><a data-toggle="tab" href="#tab1"><span class="fa fa-user"></span> Perfil</a></li>
                    <li><a href="{{ url('Agenda/') }}"><span class="fa fa-calendar-check-o"></span> Agenda</a></li>
                  </ul>    
              </nav>
          </div>
          <!-- MAIN CONTENT -->
          <div class="tab-content">
            <div class="tab-pane  active" id="tab1">
              <div id="main-content">
                <div class="container-fluid">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Perfil</a></li>
                    <li><a href="#account" role="tab" data-toggle="tab">Cuenta</a></li>
                  </ul>
                  {!! Form::open(['route' => ['Auth.usuario.posteditUsuario',$usuario], 'method' => 'GET','enctype' => 'multipart/form-data', 'id' => 'formEditUsuario']) !!}
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
      //setInterval('mostrarBtnImagen()', 1000);
  });

  function mostrarBtnImagen() {
    $prueba = document.getElementById("imgReemplazo");
    if($prueba.childNodes.length > 1){
      document.getElementById("btnImagenPerfil").style.display = 'block';
    }else{
      document.getElementById("btnImagenPerfil").style.display = 'none';
    }
  }

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
