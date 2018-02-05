<style type="text/css">
  .PocketA {
  color: #E9E9E9; }
  .PocketA:hover {
    color: #FFFFFF;
    text-decoration: none; }
  .Deshabilitado{
    background: rgb(230, 230, 230) !important;
  }
</style>


@extends('Layout.app_administradores')
@section('content')

{!!Html::script('assetsNew\scripts/notify.min.js')!!} <!---->

<!--Barra de título y botones de busqueda-->
<div id="page-content">
  <div class="col-lg-12">
    <div class="row invoice-header">
      <div class="col-md-4">
        <div class=" btn1 pull-left">
          <!--<button class="btn btn-default-outline dropdown-toggle" data-toggle="dropdown">-->
          <a class=" dropdown-toggle" data-toggle="dropdown"><i class="pocketMorado fa fa-2x fa-sliders" ></i></a>
            <ul id="filters" class="dropdown-menu">
              <li>
                <a data-filter="*"><i class="fa fa-plus"></i>Todos</a>
              </li>
              <li>
                <a data-filter=".Habilitado"><i class="fa fa-check"></i>Habilitados</a>
              </li>
              <li>
                <a data-filter=".Deshabilitado"><i class="fa fa-times"></i>Deshabilitados</a>
              </li>
              <li>
                <a data-filter=".Administrador"><i class="fa fa-imdb"></i>Administradores</a>
              </li>
              <li>
                <a data-filter=".Bartender"><i class="fa fa-imdb"></i>Bartenders</a>
              </li>
              <li>
                <a data-filter=".Mesero"><i class="fa fa-houzz"></i>Meseros</a>
              </li>
              <li>
                <a data-filter=".Cajero"><i class="fa fa-wpbeginner pull-left"></i>Cajeros</a>
              </li>
            </ul>
        </div>
      </div>                
    </div>
  </div>
</div>
<!--Fin Barra de título y botones de busqueda-->




<!--Inicio de los items de usuarios -->
<div class="container-fluid main-content">
  <div class="social-wrapper">
    <div id="social-container"></div>

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



            <div class="widget-container fluid-height clearfix ">
              @if($usuario->estado == 1) 
                <div class="heading Habilitado">
                  <a href="{{url('Auth/usuario/'.$usuario->id.'/active')}}"><i   data-toggle="tooltip" data-placement="left" title="Deshabilitar" class="pocketMorado fa fa-times pull-right" ></i></a>
              @else 
                <div class="heading Deshabilitado">
                  <a href="{{url('Auth/usuario/'.$usuario->id.'/active')}}"><i   data-toggle="tooltip" data-placement="left" title="Habilitar" class="pocketMorado fa fa-check pull-right" ></i></a>
              @endif

              </div>
              
              <div class="profile-info clearfix padded3 @if($usuario->estado == 1) Habilitado
                                                        @else Deshabilitado
                                                        @endif" data-toggle="modal" href="#myModal{{$usuario->id}}">
                <div class="social-avatar">
                  <img width="70" height="70" class="avatar" src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
                </div>
                  <div class="profile-details">
                    <strong><a class="pocketMorado user-name" >{{$usuario->nombrePersona}}</a></strong><br>
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
                    <i class="fa fa-check-circle"></i>{{$usuario->salario}}
                  </div>
              </div>
              <div class="widget-content padded3 colorpocket">

            <div class="col-md-4 colorpocket"></div>
                <div class="col-md-8 colorpocket"> 

                  <div class="headingPocket">
                    <div data-toggle="modal" href="#ModalMsg{{$usuario->id}}">
                      <a class="PocketA"><i class="fa fa-comments pull-right"></i></a></div>
                      <a class="PocketA" href="{{ url('Agenda/') }}"><i class="fa fa-calendar-check-o pull-right"></i></a>
                      <a class="PocketA" href="{{url('Estadisticas/')}}"><i class="fa fa-bar-chart pull-right"></i></a>
                  </div>

                </div>  
              </div>
            </div>
          </div>
        @endforeach
      </div>
  </div>
</div>
<!--Fin de los items de usuarios -->

<!--Inicio modal ver más datos-->
@foreach($usuarios as $usuario)
<div class="modal fade" id="myModal{{$usuario->id}}">
  <div class="modal-body">
    <div class="col-lg-12" style="background-color:#FFFFFF">
      <div class="modal-header">
          <button aria-hidden="true" class=" close " data-dismiss="modal" type="button">&times;</button>
          <h4 class="modal-title text-center"> Editar Información Del Empleado</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="heading">
          <i class=" pocketMorado fa fa-shield"></i>
          &nbsp; Nuevo Empleado      
        </div>
          <!-- Login Screen -->
          {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
          {{ csrf_field() }}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-9">
                      <div class="widget-content ">
                        <div class="gallery-container">
                          <a class="gallery-item filter1 fancybox" href="#fancybox-example" rel="">
                          <img src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
                          <div class="actions">
                             <i class="fa fa-pencil"></i>
                          </div></a>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}" placeholder="Username" type="text" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    <input name="username" class="form-control" value="{{$usuario->username}}"  placeholder="Username" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input name="email" class="form-control" value="{{$usuario->email}}"  placeholder="Email" type="text">
                  </div>
                </div>
                <a class="pull-right" href="#">Mirar Calendario De Trabajo</a>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input name="cedula" class="form-control" value="{{$usuario->cedula}}"  placeholder="Identificacion" type="text">
                  </div>
                </div>
                <div class="form-group">
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
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                    <input  value="{{$usuario->fechaNacimiento}}" class="form-control datepicker" data-date-autoclose="true" placeholder="Fecha de Nacimiento" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span><input name="password" class="form-control" placeholder="Contraseña" type="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span><input name="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" type="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" type="number"><span class="input-group-addon">.00</span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select  name="Permisos[]"class="form-control select2able" multiple="multiple">
                      <option value="Administrador"
                        @if($usuario->esAdmin == 1)
                          selected="selected"
                        @endif
                      >Administrador</option>
                      <option value="Mesero" selected="selected"
                          @if($usuario->esMesero != 0)
                            selected="selected"
                          @endif
                      >Mesero</option>
                      <option value="Bartender"
                          @if($usuario->esBartender != 0)
                            selected="selected"
                          @endif
                      >Bartender</option>
                      <option value="Cajero"
                          @if($usuario->esCajero != 0)
                            selected="selected"
                          @endif
                      >Cajero</option>
                    </select>
                  </div>
                </div>
                <div class="text-center">
                  <label class="checkbox">{!! Form::checkbox('Obsequiar', 'Obsequiar', $usuario->obsequio) !!}<span>Activar Para Obsequiar</span></label>
                </div>
              </div>
              <div class="col-md-4" style="height: 300px;>
                <div class="form-group" >
                  <input  style="background-color: #4f0157;" type="file" class="file" data-upload-url="#">
                </div>
              </div>
            </div>
            <div class="row">
              <div  class="col-md-3 col-md-offset-5">
                <button class="btn btn-bitbucket" type="submit">
                  <i class="fa fa-send"></i>Guardar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Fin de modal ver más datos-->
<!--inicio modal mensajes-->
@foreach($usuarios as $usuario)
<div class="modal fade" id="ModalMsg{{$usuario->id}}">
  <div class="modal-body">
    <div class="col-lg-7" style="background-color:#FFFFFF">
      <div class="modal-header">
          <button aria-hidden="true" class=" close " data-dismiss="modal" type="button">&times;</button>
          <h4 class="modal-title text-center"> Mensaje para {{$usuario->nombrePersona}} </h4>

      </div>
      <div class="modal-body">
        {!! Form::open(['method' => 'POST', 'action' => 'MensajeController@store']) !!}
        <div class="row">
            <div class="col">
              <div class="col-md-5">
                <div class="form-group">
                  <div class="row">
                    <input name='id_receptor' type="hidden" class="form-control" value="{{$usuario->id}}">
                      <div class="col-md-9">
                        <div class="widget-content ">
                          <div class="gallery-container">
                            <a class="gallery-item filter1 fancybox" href="#" rel="">
                            <img src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
                            </a>
                         </div>
                        </div>
                    </div>
                  </div>
                </div>

                <!--<a class="pull-right" href="#">Mirar Calendario De Trabajo</a>-->
              </div>
              <div class="col">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                      <input name="asunto" class="form-control" type="text" placeholder="Asunto" required="true">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span><textarea name="descripcion" class="form-control"  placeholder="Mensaje..." required="true" style="margin=0px; width:300px; height:100px"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div  class="modal-footer">
                <button class="btn btn-bitbucket" type="submit">
                  <i class="fa fa-send"></i>Enviar mensaje
                </button>
              </div>
            </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endforeach
<!--Fin modal mensaje-->
<!-- inicio de slider de agregar usuario -->
<div class="style-selector" >
  <div class="style-selector-container">
    <div class="row">
      <div class="">
        <div class="">
          <div class="heading">
            <i class=" pocketMorado fa fa-shield"></i>&nbsp;Nuevo Empleado
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
                      <div class="gallery-container fileupload-new img-thumbnail" >
                        <div class="gallery-item filter1" rel="">
                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" >
                          <div class="actions">
                            <a onclick="$('#eliminarImagen').click()">
                              <i class="fa fa-trash-o"></i>
                            </a>
                            <a  id="modalImagen" href="{{asset("images/logo.png")}}" title="Sin imagen">
                              <img src="{{asset("images/logo.png")}}" hidden>
                              <i class="fa fa-search-plus"></i>
                            </a>
                            <a onclick="$('#imagenPerfil').click()">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="gallery-item fileupload-preview fileupload-exists img-thumbnail" >
                      </div>
                      <div hidden>
                        <span class=" btn-file" id="subirImagen">
                          <span class="fileupload-new"><i class="fa fa-pencil"></i></span>
                          <span class="fileupload-exists"><i class="fa fa-search-plus"></i></span>
                          <input type="file" class="form-control" name="imagenPerfil"  id="imagenPerfil">
                        </span>
                        <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" id="eliminarImagen"><i class="fa fa-trash-o"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div  style="margin-top: 61%;"></div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input class="form-control" id="nombrePersona" name="nombrePersona" placeholder="Nombre" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input class="form-control" placeholder="Teléfono" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input class="form-control" placeholder="Email" id="email" name="email" type="email">
                  </div>
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input class="form-control" id="cedula" name="cedula" placeholder="Identificación" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                    <input class="form-control" name="direccion" placeholder="Dirección" type="text">
                  </div>
                </div>
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
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select id="selectPermisosAjax" name="Permisos[]" class="form-control select2able" multiple="multiple">
                          <option value="Mesero">Mesero</option>
                          <option value="Bartender">Bartender</option>
                          <option value="Cajero">Cajero</option>
                          <option value="Administrador">Administrador</option>
                        </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input class="form-control" name="salario" placeholder="Salario Diario" type="number"><span class="input-group-addon">.00</span>
                  </div>
                </div>
                <div class="text-center">
                  <label class="checkbox">{{ Form::checkbox('regalar') }}<span>Obsequiar Productos</span></label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input id="file-4" name="hojaDeVida" type="file" class="file" data-upload-url="#">
                </div>
              </div>
            </div>
            <div  class="col-md-3 col-md-offset-5">
              <a id='registrarUsuario' class="btn btn-bitbucket" type="submit">
                <i class="fa fa-send"></i>Guardar
              </a>
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
{!!Html::script('javascripts/notificaciones/modernizr.custom.js')!!}
{!!Html::script('javascripts/notificaciones/notificationFx.js')!!}
<script type="text/javascript">


  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $(document).ready(function() { // función para elfancybox, o sea lo que carga la imagen en un modal
      $("#modalImagen").fancybox({
            helpers: {
                title : {
                    type : 'float'
                }
            }
        });

  });

 $(document).ready(function(){


    //Filtros del isotope
    $('#filters a').click(function(){
      var $container = $('#social-container');
      var selector = $(this).attr('data-filter');
      $container.isotope({ filter: selector });
      return false;
    });

    cambiarCurrent("#miPersonal");

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
    console.log(image)
    var token = $("#token").val();
    var type = "POST";
    var selectPermisos = $('#selectPermisosAjax').val();
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

          var cadenaToTag = '<div class=" item row widget-container fluid-height">'+
          '  <div class="widget-container fluid-height clearfix ">'+
          '      <div class="heading Habilitado">'+
          '        <a href="{{url("Auth/usuario")}}'+usuarioNuevo.id+'/active"><i data-toggle="tooltip" data-placement="left" title="Deshabilitar" class="pocketMorado fa fa-times pull-right" ></i></a>'+
          '      </div>'+
          '    <div class="profile-info clearfix padded3 Habilitado" data-toggle="modal" href="#myModal'+usuarioNuevo.id+'">'+
          '      <div class="social-avatar">'+
          '        <img width="70" height="70" class="avatar" src="{{asset("images/admins/")}}/'+usuarioNuevo.imagenPerfil+'">'+
          '      </div>'+
          '        <div class="profile-details">'+
          '          <strong><a class="pocketMorado user-name" >'+usuarioNuevo.nombrePersona+'</a></strong><br>'+permisoQueTiene+''+
          '          <i class="fa fa-check-circle"></i>'+usuarioNuevo.salario+''+
          '        </div>'+
          '    </div>'+
          '    <div class="widget-content padded3 colorpocket">'+
          '  <div class="col-md-4 colorpocket"></div>'+
          '      <div class="col-md-8 colorpocket"> '+
          '        <div class="headingPocket">'+
          '          <div data-toggle="modal" href="#ModalMsg'+usuarioNuevo.id+'">'+
          '            <a class="PocketA"><i class="fa fa-comments pull-right"></i></a></div>'+
          '            <a class="PocketA" href="{{ url("Agenda/") }}"><i class="fa fa-calendar-check-o pull-right"></i></a>'+
          '            <a class="PocketA" href="{{url("Estadisticas/")}}"><i class="fa fa-bar-chart pull-right"></i></a>'+
          '        </div>'+
          '      </div>  '+
          '    </div>'+
          '  </div>'+
          '</div>';
           var $link = $(cadenaToTag);
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
                          $.notify(val, "info");
                        });
                    }
                }
        }
    });
});


</script>
@endsection
