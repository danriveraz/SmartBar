@extends('Layout.app')
@section('content')

<div class="container-fluid main-content">
  <div class="panel-tittle" align="center">
      <h3><B>MI PERSONAL</B></h3>
      @include('flash::message')
      <a href="{{ route('Auth.usuario.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Nuevo Empleado </a>
  </div>
  <div class="social-wrapper">
    <div class="row" id="filters">
      <h4>Filtros:</h4>
      <a href="" class="btn btn-default" data-filter="*">Mostrar Todos</a>
      <a href="" class="btn btn-default" data-filter=".Administrador">Administradores</a>
      <a href="" class="btn btn-default" data-filter=".Mesero">Meseros</a>
      <a href="" class="btn btn-default" data-filter=".Bartender">Bármanes</a>
      <a href="" class="btn btn-default" data-filter=".Cajero">Cajeros</a>
      <a href="" class="btn btn-default" data-filter=".Habilitado">Habilitados</a>
      <a href="" class="btn btn-default" data-filter=".Deshabilitado">Deshabilitados</a>
    </div>
    <div id="social-container">
  @foreach($usuarios as $usuario)
<!-- Profile Widget -->
<div class=" item row 
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
          @endif
">
<div clas="col-md-4">
<div class=" widget-container fluid-height profile-widget">
  <div class="heading">
      <i class="fa fa-level-up"></i><a href="{{url('Auth/usuario/'.$usuario->id.'/edit')}}">Ver mas <i class="fa fa-gear  pull-right"></i></a>
  </div>
  <div class="widget-content padded">
    <div class="profile-info clearfix">
      <img width="70" height="70" class="social-avatar pull-left" src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
      <div class="profile-details">
        <a class="user-name" href="">{{$usuario->nombrePersona}}</a>
        <p>Datos del Empleado</p>
        <em><i class="fa fa-list-alt "></i>{{$usuario->cedula}}</em>
        <em><i class="fa fa-phone "></i>3012343457</em>
        <p >
          @if($usuario->esAdmin == 1) Administrador
          @else 
            @if($usuario->esMesero != 0) Mesero 
            @endif
            @if($usuario->esBartender != 0) Bartender
            @endif
            @if($usuario->esCajero != 0) Cajero
            @endif
          @endif
        </p>
      </div>
    </div>
    <div class="profile-stats">
      <div class="col-md-4">          
       <div class="btn-group dropup">
          <button class="btn btn-info">Control</button><button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
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
      </div>
      
      <div class="col-md-4">           
        <button class="btn btn-info"><i class="fa fa-calendar-o"></i>Agenda</button>           
      </div>
      
      <div class="col-md-4">            
        <button class="btn btn-info"><i class="fa fa-envelope-o"></i>Mensaje</button>            
      </div>
    </div>
  </div>
<!-- end Profile Widget -->
          <!--
          <td><a href="{{ route('Auth.usuario.edit',$usuario->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('Auth.usuario.destroy',$usuario->id) }}" onclick="return confirm('¿Estas seguro que deseas eliminar este usuario?')"
             class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
          -->
    </div>
    </div>
    </div>
    @endforeach
  </div>
</div>



<!-- inidio de slider de agregar usuario -->
<div class="style-selector" >

<div class="style-selector-container">
  <div class="row">
    <div class="">
      <div class="widget-container">
        <div class="heading">
          <i class="fa fa-shield"></i>Nuevo Usuario      </div>
        <div class="widget-content padded">
         <form id="checkbox">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <fieldset>
              <div class="row">
                <div class="col-md-4">
                   
            <div class="form-group">
              <label class="control-label col-md-2"></label>
              <div class="col-md-9">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                  </div>
                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar Imagen</span><span class="fileupload-exists">editar</span><input type="file" class="form-control" name="imagenPerfil"  id="imagenPerfil"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
                  </div>
                </div>
              </div>
            </div>
            
             <div  style="margin-top: 73%;"></div>

                   
                </div>
                <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="nombrePersona">Nombre</label><input class="form-control" id="nombrePersona" name="nombrePersona" type="text">
                  </div> 

                  <div class="form-group">
                    <label for="email">Email</label><input class="form-control" id="email" name="email" type="email">
                  </div>
                 

                <div class="row">
                  <label for="sexo" class="control-label col-md-2">Sexo:</label>
                  <div class="col-md-7">
                    <label class="radio-inline">
                      <input type="radio" id="sexo" name="sexo" value="Femenino"><span>Femenino</span>
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id="sexo1" name="sexo" value="Masculino"><span>Masculino</span></label>
                    </label>
                    <div class="bg-danger text-white">{{$errors->first('sexo')}}</div>
                  </div>
                </div>

                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="número de identificación">Número de identificación</label>
                    <input class="form-control" id="cedula" name="cedula" type="text" placeholder="Identificación">
                  </div>

                  <div class="form-group">
                    <label for="fechaNacimiento">Fecha De Nacimiento</label>
                    <input class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="dd/mm/yyyy" type="text" name="fechaNacimiento" id="fechaNacimiento">
                  </div>
                  <!--<div class="form-group">
                    <label for="password">Password:</label><input class="form-control" type="password" name="password" id="password">
                  </div>
                  
                  <div class="form-group">
                    <label for="contraseña_confirmation">Confirmar password:</label><input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                  </div>-->
                  
                  <!--Tipos-->
                  <div class="form-group">
                    <div class="row">
                      <label class="control-label">Permisos:</label>
                    </div>
                    <div class="row">
                    </div>
                      <label class="checkbox-inline">
                        {!! Form::checkbox('Permisos[]', 'Mesero', 0, ['data-toggle'=>'checkbox', 'class' => 'Check']) !!}
                        <span>Mesero</span>
                      </label>
                      <label class="checkbox-inline">
                        {!! Form::checkbox('Permisos[]', 'Bartender', 0, ['data-toggle'=>'checkbox', 'class' => 'Check']) !!}<span>Bartender</span>
                      </label>
                      <label class="checkbox-inline">
                        {!! Form::checkbox('Permisos[]', 'Cajero', 0, ['data-toggle'=>'checkbox', 'class' => 'Check']) !!}<span>Cajero</span>
                      </label>
                      <label class="checkbox-inline">
                        {!! Form::checkbox('Permisos[]', 'Administrador', 0, ['data-toggle'=>'checkbox', 'class' => 'Check']) !!}<span>Administrador</span>
                      </label>
                      <label class="checkbox-inline">
                        {!! Form::checkbox('Permisos[]', 'Obsequio', 0, ['data-toggle'=>'checkbox', 'class' => 'Obsequio']) !!}<span>Obsequiar</span>
                      </label>
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
           var $link = $('<div class="item row '+permisoQueTiene+'"><div clas="col-md-4"><div class=" widget-container fluid-height profile-widget"><div class="heading"><i class="fa fa-level-up"></i><a href="http://localhost/PocketByR/public/Auth/usuario/1/edit">Ver mas <i class="fa fa-gear  pull-right"></i></a></div><div class="widget-content padded"><div class="profile-info clearfix"><img width="70" height="70" class="social-avatar pull-left" src="http://localhost/PocketByR/public/images/admins/perfil.jpg"><div class="profile-details"><a class="user-name" href="">'+ usuarioNuevo.nombrePersona +'</a><p>Datos del Empleado</p><em><i class="fa fa-list-alt "></i>'+ usuarioNuevo.cedula +'</em><em><i class="fa fa-phone "></i>3012343457</em><p>'+permisoQueTiene+'</p></div></div><div class="profile-stats"><div class="col-md-4"><div class="btn-group dropup"><button class="btn btn-info">Control</button><button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#"><i class="fa fa-clock-o pull-left"></i>Horas Ingreso</a></li><li><a href="#"><i class="fa fa-bar-chart-o pull-left"></i>Estadisticas</a></li><li><a href="#"><i class="fa fa-money pull-left"></i>Salario</a></li></ul></div></div><div class="col-md-4"><button class="btn btn-info"><i class="fa fa-calendar-o"></i>Agenda</button></div><div class="col-md-4"><button class="btn btn-info"><i class="fa fa-envelope-o"></i>Mensaje</button></div></div></div></div></div></div>');  
           $("#social-container").isotope('insert', $link);// añadir al isotope de usuarios
           $("#nombrePersona").val("");
           $("#cedula").val("");
           $("#email").val("");
           $("#fechaNacimiento").val("");
           document.getElementById('sexo').checked = false;
           document.getElementById('sexo1').checked = false;
           for (i=0;i<a.length;i++){
              a[i].checked=0 
           }
           for (i=0;i<document.querySelectorAll("input.Obsequio:checked").length;i++){
                document.querySelectorAll("input.Obsequio:checked")[i].checked = 0;
           }
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
