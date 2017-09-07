@extends('Layout.app')
@section('content')

<div class="container-fluid main-content">
  <div class="panel-tittle" align="center">
      @include('flash::message')
      <!--<a href="{{ route('AgendaTrabajadores.create') }}" class="btn btn-default"><i class="fa fa-calendar"></i> Agenda de Trabajadores </a><BR><BR>-->
  </div>
  <div class="social-wrapper">
    <div class="col-lg-12">
      <div class="row"  id="filters" align="center">
          <a href="{{ route('Auth.usuario.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Nuevo Empleado </a>
          <a  class="btn btn-bitbucket" data-filter="*"><i class="fa fa-user-o"></i>Todos</a>
          <!--<a  class="btn btn-bitbucket" data-filter=".Administrador"><i class="fa fa-user-o"></i>Administradores</a>
          <a  class="btn btn-bitbucket" data-filter=".Mesero"><i class="fa fa-user-o"></i>Meseros</a>
          <a  class="btn btn-bitbucket" data-filter=".Bartender"><i class="fa fa-user-o"></i>Bármanes</a>
          <a  class="btn btn-bitbucket" data-filter=".Cajero"><i class="fa fa-user-o"></i>Cajeros</a>-->
          <a  class="btn btn-bitbucket" data-filter=".Habilitado"><i class="fa fa-user-o"></i>Habilitados</a>
          <a  class="btn btn-bitbucket" data-filter=".Deshabilitado"><i class="fa fa-user-o"></i>Deshabilitados</a>
      </div>
    </div>

<div id="social-container"></div>
  <div class="row">
    <div class="col-lg-12">
    </div>
  </div>
  <div id="hidden-items"> 
    @foreach($usuarios as $usuario)
      <div class=" item row widget-container fluid-height
             @if($usuario->esAdmin == 1) Administrador
             @else 
               @if($usuario->esMesero != 0) Mesero 
               @endif
               @if($usuario->esBartender != 0) Bartender
               @endif
               @if($usuario->esCajero != 0) Cajero
               @endif
             @endif
             @if($usuario->estado == 1) Habilitado
             @else Deshabilitado
             @endif"> 
        <div class="heading">
            <i class="fa fa-times pull-right"></i><i class="fa fa-eye  pull-right" data-toggle="modal" href="#myModal{{$usuario->id}}"></i>
            <a href="{{url('Auth/usuario/'.$usuario->id.'/edit')}}"><i class="fa fa-gear  pull-right"></i></a>
        </div>
        <div class="widget-container fluid-height clearfix ">
          <div class="profile-info clearfix padded3">
            <img width="70" height="70" class="social-avatar pull-left" src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
              <div class="profile-details">
                <strong><a class="user-name" >{{$usuario->nombrePersona}}</a></strong><br>
                  @if($usuario->esAdmin == 1) Administrador
                  @else 
                    @if($usuario->esMesero != 0) Mesero 
                    @endif
                    @if($usuario->esBartender != 0) Bartender
                    @endif
                    @if($usuario->esCajero != 0) Cajero
                    @endif
                  @endif
                <br>
                <em><i class="fa fa-list-alt "></i>{{$usuario->cedula}}</em>&nbsp&nbsp
                <em><i class="fa fa-phone "></i>{{$usuario->telefono}}</em>
              </div>
          </div>
          <div class="widget-content padded2 colorpocket">
            <div class="dg btn-group dropup">
              <button class="btn btn-pocket dropdown-toggle" data-toggle="dropdown">Control<span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                  <a href="#"><i class="fa fa-clock-o pull-left"></i>Horas Ingreso</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-bar-chart-o pull-left"></i>Estadisticas</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-money pull-left"></i>Salario</a>
                </li>
                <li>
                  <a href="{{route('Auth.usuario.cambiarEstado',$usuario->id) }}" onclick="return confirm('¿Estas seguro que deseas cambiar el estado de este suario?')">
                  @if($usuario->estado == 1) <i class="fa fa-toggle-on pull-left"></i>Desactivar
                  @else <i class="fa fa-toggle-off pull-left"></i> Activar
                  @endif</a>
                </li>
              </ul>
            </div>
              <button class="dg btn btn-pocket"><i class="fa fa-calendar-o"></i>Agenda</button>
              <button class="dg btn btn-pocket"><i class="fa fa-envelope-o"></i>Mensaje</button>
          </div>
        </div>
      </div>        
    @endforeach
  </div>
</div>
</div>

@foreach($usuarios as $usuario)
<!--modal ver más datos-->    
<div class="modal fade" id="myModal{{$usuario->id}}">
  <div class="modal-dialog">
    <div class="modal-content  col-lg-9">
      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
          <h4 class="modal-title">Información Del Empleado</h4>
      </div>
      <div class="modal-body">
        <!-- Login Screen -->
        <div class="login-wrapper">
            <div class=" row widget-content padded4">
                <img width="100" height="100" class="social-avatar pull-left"  src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">           
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" value="{{$usuario->nombrePersona}}" placeholder="Username" type="text" disabled>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                <input class="form-control" value="{{$usuario->username}}" disabled placeholder="Username" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control" value="{{$usuario->email}}" disabled placeholder="Email" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                <input class="form-control" value="{{$usuario->cedula}}" disabled placeholder="Identificacion" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                <input class="form-control" value="{{$usuario->sexo}}" disabled placeholder="sexo" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                <input class="form-control datepicker" value="{{$usuario->fechaNacimiento}}" disabled data-date-autoclose="true" placeholder="Fecha de Nacimiento" type="text">
              </div>
            </div>
            <div class="form-group">
              <h3>Permisos</h3>
                  @if($usuario->esAdmin == 1) Administrador
                  @else 
                    @if($usuario->esMesero != 0) Mesero 
                    @endif
                    @if($usuario->esBartender != 0) Bartender
                    @endif
                    @if($usuario->esCajero != 0) Cajero
                    @endif
                  @endif
            </div>
            <div class="form-group">
              <div class="text-left">
                @if($usuario->obsequio)
                  <span>Activo Para Obsequiar</span>
                @else
                  <span>No Está Activo Para Obsequiar</span>
                @endif
              </div>
            </div>      
              <a class="pull-right" href="#">Mirar Calendario De Trabajo</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- inidio de slider de agregar usuario -->
<div class="style-selector" >
  <div class="style-selector-container">
    <div class="row">
      <div class="">
        <div class="">
          <div class="heading">
            <i class="fa fa-shield"></i>Formulario Para Nuevo Usuario
          </div>
          <div class="widget-content padded">
            <form id="checkbox">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <fieldset>
            <div class="row">
              <div class="col-md-4">  
                <div class="form-group">
                  <label class="control-label col-md-2"></label>
                  <div class="col-md-9">
                    <div class="widget-content fileupload fileupload-new" data-provides="fileupload">
                      <div class="gallery-container fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                        <a class="gallery-item filter1 fancybox" href="#fancybox-example" rel="">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                        <div class="actions">
                           <i class="fa fa-pencil"></i>
                        </div></a>
                      </div>
                      <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar Imagen</span><span class="fileupload-exists">editar</span><input type="file" class="form-control" name="imagenPerfil"  id="imagenPerfil"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div  style="margin-top: 70%;"></div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input class="form-control" id="nombrePersona" name="nombrePersona" placeholder="Nombre Del Empleado" type="text">
                  </div>
                </div>
                <!--<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" placeholder="Contraseña" type="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input class="form-control" placeholder="Telefono de Contato" type="text">
                  </div>
                </div>-->
              </div>
              <div class="col-md-4 ">
                <!--<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    <input class="form-control" placeholder="Username" type="text">
                  </div>
                </div>-->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input class="form-control" placeholder="Email" id="email" name="email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input class="form-control" id="cedula" name="cedula" placeholder="Identificación" type="text">
                  </div>
                </div>
                <!--<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                    <input class="form-control" placeholder="Dirección De Recidencia" type="text">
                  </div>
                </div>-->
                <div class="form-group"> <!-- OJO esto dará error -->
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                    <select id="sexo"  name="sexo" class=" select2able"  style="weight: 100%;">
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                    <input data-date-format="yyyy/mm/dd" class="form-control datepicker" data-date-autoclose="true" placeholder="Fecha de Nacimiento" name="fechaNacimiento" id="fechaNacimiento" type="text">
                  </div>
                </div>
                <!--<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" type="number"><span class="input-group-addon">.00</span>          
                  </div>
                </div>-->
                <div class="text-center">
                  <label class="checkbox">{{ Form::checkbox('regalar') }}<span>Activar Para Obsequiar</span></label>
                </div>
              </div>  
              <div class="col-md-4">

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select id="selectPermisos" name="Permisos[]"class="form-control select2able" multiple="multiple">
                          <option value="Mesero">Mesero</option>
                          <option value="Bartender">Bartender</option>
                          <option value="Cajero">Cajero</option>
                          <option value="Administrador">Administrador</option>
                        </select>
                  </div>
                </div>
                <div class="form-group">
                  <input id="file-4" type="file" class="file" data-upload-url="#">
                </div>
              </div>
            </div>
            <div  class="col-md-3 col-md-offset-5">{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registrarUsuario', 'class'=>'btn btn-fill btn-block btn-info'], $secure = null)!!}
            </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- fin de slider de agregar usuario -->

  <div class="style-toggle closed">
    <span aria-hidden="true" class="fa fa-fw fa-plus-circle"></span>
  </div>
</div>
</div>
  {!!$usuarios->render() !!}
</div>
<!-- Para notificaciones con ajax -->
{!!Html::style('css/notificaciones/ns-default.css')!!}
{!!Html::style('css/notificaciones/ns-style-growl.css')!!}
{!!Html::script('javascripts/notificaciones/classie.js')!!}
{!!Html::script('javascripts/notificaciones/modernizr.custom.js')!!}
{!!Html::script('javascripts/notificaciones/notificationFx.js')!!}
<script type="text/javascript">
 $(document).ready(function(){

    $("#file-4").fileinput({
        uploadExtraData: {kvId: '10'}
    });
    $(".btn-warning").on('click', function () {
        var $el = $("#file-4");
        if ($el.attr('disabled')) {
            $el.fileinput('enable');
        } else {
            $el.fileinput('disable');
        }
    });
    $(".btn-info").on('click', function () {
        $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
    });

    cambiarCurrent("#usuario");

    //Filtros del isotope
    $('#filters a').click(function(){
      var $container = $('#social-container');
      var selector = $(this).attr('data-filter');
      $container.isotope({ filter: selector });
      return false;
    });


  });
function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};

/// Ajax para registrar un usuario
$("#registrarUsuario").click(function(){
    //Aquí buscamos todos los inputs que tengan una clase llamada; Check
    var a = document.querySelectorAll("input.Check:checked");
    var Permisos = Array.prototype.map.call(a,function(x){ return x.value; });
    // si tiene el permiso de obsequio
    var Obsequio = $(document.querySelectorAll("input.Obsequio:checked")[0]).val();
    var image = $('#imagenPerfil')[0].files[0];// la imagen de perfil
    var token = $("#token").val();
    var type = "POST";
    var selectPermisos = $('#selectPermisos').val();
    selectPermisos.forEach(function(element) {
        console.log(element);
    });
    /*var formData = {
            nombrePersona: $("#nombrePersona").val(),
            cedula: $('#cedula').val(),
            email: $('#email').val(),
            fechaNacimiento: $('#fechaNacimiento').val(),
            sexo: $('#sexo').val(),
            Permisos: Permisos,
            Obsequio: Obsequio,
            imagenPerfil: image
        };*/

    var formData = new FormData($('#checkbox')[0]);

    $.ajax({
        url: '{{url('Auth/registerUser')}}',
        headers: {'X-CSRF-TOKEN': token},
        type: type,
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) { //anunciar creado autor
           var usuarioNuevo = JSON.parse(data.user);
           console.log(usuarioNuevo);
           var permisoQueTiene= '';
           if(usuarioNuevo.esAdmin){
              permisoQueTiene += ' Administrador';
           }if(usuarioNuevo.esMesero){
              permisoQueTiene += ' Mesero';
           }if(usuarioNuevo.esBartender){
              permisoQueTiene += ' Bartender';
           }if(usuarioNuevo.esCajero){
              permisoQueTiene += ' Cajero';
           }
           var $link = $('<div class=" item row widget-container fluid-height"> <div class="heading"><i class="fa fa-times pull-right"></i><i class="fa fa-eye  pull-right" data-toggle="modal" href="#myModal'+usuarioNuevo.id+'"></i><a href="http://localhost/PocketByR/public/Auth/usuario/'+usuarioNuevo.id+'/edit"><i class="fa fa-gear  pull-right"></i></a></div><div class="widget-container fluid-height clearfix "><div class="profile-info clearfix padded3"><img width="70" height="70" class="social-avatar pull-left" src="http://localhost/PocketByR/public/images/admins/'+usuarioNuevo.imagenPerfil+'"><div class="profile-details"><strong><a class="user-name" >'+usuarioNuevo.nombrePersona+'</a></strong><br>'+permisoQueTiene+'<br><em><i class="fa fa-list-alt "></i>'+usuarioNuevo.cedula+'</em>&nbsp&nbsp<em><i class="fa fa-phone "></i>'+usuarioNuevo.telefono+'</em></div></div><div class="widget-content padded2 colorpocket"><div class="dg btn-group dropup"><button class="btn btn-pocket dropdown-toggle" data-toggle="dropdown">Control<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#"><i class="fa fa-clock-o pull-left"></i>Horas Ingreso</a></li><li><a href="#"><i class="fa fa-bar-chart-o pull-left"></i>Estadisticas</a></li><li><a href="#"><i class="fa fa-money pull-left"></i>Salario</a></li></ul></div><button class="dg btn btn-pocket"><i class="fa fa-calendar-o"></i>Agenda</button><button class="dg btn btn-pocket"><i class="fa fa-envelope-o"></i>Mensaje</button></div></div></div>');  
           $("#social-container").isotope('insert', $link);// añadir al isotope de usuarios
           $("#nombrePersona").val("");
           $("#cedula").val("");
           $("#email").val("");
           $("#fechaNacimiento").val("");
           /*document.getElementById('sexo').checked = false;
           document.getElementById('sexo1').checked = false;
           for (i=0;i<a.length;i++){
              a[i].checked=0 
           }
           for (i=0;i<document.querySelectorAll("input.Obsequio:checked").length;i++){
                document.querySelectorAll("input.Obsequio:checked")[i].checked = 0;
           }*/
            // cerrar la ventana de registro
            var ventana = $(".style-toggle");
            if ($(ventana).hasClass("open")) {
              $(ventana).removeClass("open").addClass("closed");
              return $(".style-selector").animate({
                "right": "-80%"
              }, 250);
            } 
        }, error: function(xhr,status, response) {
              var error = jQuery.parseJSON(xhr.responseText);  
                for(var k in error.message){
                    if(error.message.hasOwnProperty(k)){
                        error.message[k].forEach(function(val){
                            var notification = new NotificationFx({
                              message : val,
                              layout : 'growl',
                              effect : 'genie',
                              type : 'warning',
                            });
                            notification.show();
                        });
                    }
                }
        }
    });
});


</script>
@endsection
