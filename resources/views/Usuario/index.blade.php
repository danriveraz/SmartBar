@extends('Layout.app_administradores')
@section('content')
{!!Html::script('assets-Internas/javascripts/notify.min.js')!!} <!---->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  .form-login{
  padding: 1em;
  min-width: 280px;
  }
</style>

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
                  <a href="{{url('Auth/usuario/'.$usuario->id.'/active')}}"><i title="Deshabilitar" class="pocketMorado fa fa-times pull-right" ></i></a>
                  <i data-toggle="modal" data-target="#myModal{{$usuario->id}}" class="pocketMorado fa fa-pencil-square-o pull-right" title="editar Empleado"></i>
              @else
                <div class="heading Deshabilitado">
                  <a href="{{url('Auth/usuario/'.$usuario->id.'/active')}}"><i title="Habilitar" class="pocketMorado fa fa-check pull-right" ></i></a>
                  <i data-toggle="modal" data-target="#myModal{{$usuario->id}}" class="pocketMorado fa fa-pencil-square-o pull-right" title="editar Empleado"></i>
              @endif

              </div>

              <div class="profile-info clearfix padded3 @if($usuario->estado == 1) Habilitado
                                                        @else Deshabilitado
                                                        @endif">
                <div class="social-avatar">
                  <img width="70" height="70" class="avatar" src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
                </div>
                  <div class="profile-details">
                    <strong><a class="pocketMorado user-name" >{{$usuario->nombrePersona}}</a></strong><br>
                      @if($usuario->esAdmin == 2) <strong  style="font-size: 16px !important">Administrador</strong>
                      @else
                        @if($usuario->esMesero != 0)
                          @if($usuario->esMesero != 1)
                            <strong style="font-size: 16px !important">Mesero</strong>
                          @else
                            Mesero
                          @endif
                        @endif
                        @if($usuario->esBartender != 0)
                          @if($usuario->esBartender != 1)
                            <strong style="font-size: 16px !important">Bartender</strong>
                          @else
                            Bartender
                          @endif
                        @endif
                        @if($usuario->esCajero != 0)
                          @if($usuario->esCajero != 1)
                            <strong style="font-size: 16px !important">Cajero</strong>
                          @else
                            Cajero
                          @endif
                        @endif
                      @endif
                    <br>
                    <i class="fa fa-check-circle"></i>&nbsp{{$usuario->salario}}
                  </div>
              </div>
              <div class="widget-content padded3 colorpocket">
                <div class="col-md-12">
                  <div class="col-md-4 colorpocket"></div>
                    <div class="col-md-8 colorpocket">
                      <div class="headingPocket">
                          <!-- <div data-toggle="modal" href="#ModalMsg{{$usuario->id}}">
                            <a class=""><i class="fa fa-comments pull-right"></i></a>
                          </div> -->
                          <!-- div para mensajes chat-->
                          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i style="float: center;" class="fa fa-comments pull-right" title="Mensaje" onclick="mensajes('mensaje'+{{$usuario->id}});"></i></a>
                            <div class="dropdown-menu form-login" role="menu" id="mensaje{{$usuario->id}}">
                              <div class="form-group">
                                  <label for="exampleInputEmail1" class="pocketMorado"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat Empleado</label>
                                  <textarea class="form-control"  placeholder="Escribir Mensaje..."></textarea>
                              </div>
                              <button type="submit" class="btn btn-pocket btn-block"><i class="fa fa-send"></i>Enviar</button>
                            </div>
                          <!-- Fin div para mensajes chat-->
                          <a href="{{ url('Agenda/') }}" title="Agenda"><i style="float: center;" class="fa fa-calendar-check-o pull-right"></i></a>
                          <a href="{{url('Estadisticas/')}}" title="Estadísticas"><i style="float: center;" class="fa fa-bar-chart pull-right"></i></a>
                      </div>
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
<div class="modal fade" id="myModal{{$usuario->id}}" role="dialog">
  <div class="modal-body modal-lg">
    <div class="modal-content" style="background-color:#FFFFFF">
      <div class="modal-header">
          <button aria-hidden="true" class=" close " data-dismiss="modal" type="button">&times;</button>
          <h4 class="modal-title text-center"> Editar Información Del Empleado</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Login Screen -->
          {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT','enctype' => 'multipart/form-data', 'class' => 'login-form']) !!}
          {{ csrf_field() }}
            <div class="row">
              <div class="col-md-4">
                    <div class="widget-content fileupload fileupload-new" data-provides="fileupload" style="text-align: center;">
                      <div class="gallery-container fileupload-new img-thumbnail">
                        <div class="gallery-item  img-thumbnail" style="line-height: 150px; border-radius: 50%; width: 150px; height: 150px;">
                          {!! Html::image('images/admins/'.$usuario->imagenPerfil,  'imagen de perfil', array('class' => 'img-responsive img-circle user-photo', 'id' => 'imagenPerfilUsuarioCircular')) !!}
                          <div class="actions">
                            <a  id="modalImagen" href="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}" title="Sin imagen">
                              <img src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}" hidden>
                              <i class="fa fa-search-plus"></i>
                            </a>
                            <a onclick="$('#imagenPerfil{{$usuario->id}}').click()">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="gallery-item fileupload-preview fileupload-exists img-thumbnail" style="border-radius: 50%; width: 150px; height: 150px; background: #ffffff;">
                      </div>
                      <div hidden>
                        <span class=" btn-file" >
                          <span class="fileupload-new"><i class="fa fa-pencil"></i></span>
                          <span class="fileupload-exists"><i class="fa fa-search-plus"></i></span>
                          <input type="file" class="form-control" name="imagenPerfil"  id="imagenPerfil{{$usuario->id}}">
                        </span>
                        <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" id="eliminarImagen{{$usuario->id}}"><i class="fa fa-trash-o"></i></a>
                      </div>
                    </div>
                    <div class="input-container">
                      <i class="fa fa-user"></i>
                      <input name="nombrePersona" class="input" value="{{$usuario->nombrePersona}}" placeholder="Username" type="text" >
                    </div>
                    <div class="input-container">
                      <i class="fa fa-map"></i>
                      <input class="input" value="{{$usuario->direccion}}" name="direccion" placeholder="Dirección" type="text">
                    </div>
                    <div class="input-container">
                      <i class="fa fa-address-card"></i>
                      <input name="cedula" class="input" value="{{$usuario->cedula}}"  placeholder="Identificacion" type="text">
                    </div>
                    <!-- <a class="pull-right" href="#">Mirar Calendario De Trabajo</a> -->
                  </div>
                  <div class="col-md-4">
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
                    <input data-date-format="yyyy/mm/dd" value="{{$usuario->fechaNacimiento}}" class="input" data-date-autoclose="true" placeholder="Fecha de Nacimiento" type="date" name="fechaNacimiento" >
                  </div>
                  <div class="input-container">
                    <i class="fa fa-key"></i>
                    <input class="input" name="contrasena" placeholder="Contraseña" type="password">
                  </div>
                  <div class="input-container">
                    <i class="fa fa-key"></i>
                    <input class="input" name="contrasen
                    na_confirmation" placeholder="Confirmar Contraseña" type="password">
                  </div>
                  <div class="input-container">
                    <i class="fa fa-money"></i>
                    <input class="input" value="{{$usuario->salario}}" name="salario" type="number">
                  </div>
                  <input type="text" name="permisoPrincipal" value="
                    @if($usuario->esAdmin == 2) Administrador
                    @elseif($usuario->esMesero == 2) Mesero
                    @elseif($usuario->esBartender == 2) Bartender
                    @elseif($usuario->esCajero == 2) Cajero
                    @endif
                  " hidden id="{{$usuario->id}}permisoPrincipal"><!-- oculto para permiso principal-->
                  <div class="input-container">
                    <i class="fa fa-users"></i>
                    <select id="selectPermisos{{$usuario->id}}" name="Permisos[]"class="form-control selectPermisos" multiple style="padding: 0px 0px; width: 80%">
                      <option value="Administrador"
                        @if($usuario->esAdmin != 0 )
                          selected="selected"
                        @endif
                      >Administrador</option>
                      <option value="Mesero" selected="selected"
                          @if($usuario->esMesero != 0 )
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
                  <script type="">//inicializar el select2 y el permiso principal
                    $(document).ready(function(){
                      var selectPermisos = $('#selectPermisos{{$usuario->id}}');
                      var arregloDePermisosOrdenados = [$("#{{$usuario->id}}permisoPrincipal").val().trim()];
                      selectPermisos.select2().on("change", function (e) {
                        var count = $(this).select2('data').length;
                        if( e.added ){
                          arregloDePermisosOrdenados.push(e.added.id);
                          console.log(arregloDePermisosOrdenados);
                        }else {
                          var index = arregloDePermisosOrdenados.indexOf(e.removed.id);
                          if (index > -1) {
                              arregloDePermisosOrdenados.splice(index, 1);
                          }
                          console.log(arregloDePermisosOrdenados);
                        }
                        $("#{{$usuario->id}}permisoPrincipal").val(arregloDePermisosOrdenados[0]);
                    });
                  });
                  </script>
              </div>
              <div class="col-md-4" style="height: 300px">
                <p class="lead" style="margin-bottom: 10px;">Sube la hoja de vida de tu <span class="text-success">Empleado</span></p>
                      <ul class="list-unstyled" style="line-height: 1.5">
                        <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Informacion ordenada e Inmediata</li>
                        <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Base de datos de empleados</li>
                        <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Facilidad encontrar personal</li>
                      </ul>
                <div class="input-container" >
                  <input id="{{$usuario->id}}hojaDeVida" name="hojaDeVida" style="background-color: #4f0157;" type="file"  data-upload-url="#">
                  <!-- <button id="{{$usuario->id}}hojaDeVida" name="hojaDeVida" style="font-weight: 400;" type="button" class="bfs btn btn-pocket" data-style="fileStyle-r" data-upload-url="#"><span class="fa fa-file-pdf-o" aria-hidden="true"></span>
                    Subir hoja de vida
                    </button> -->
                </div>
                @if($usuario->hojaDeVida)<!-- todo este script es para inicializar la subida de  la hoja de vida en el modal de editar el trabajador-->
                  <script >
                    $(document).ready(function () {// Para inicializar los que tienen hoja de vida
                      var urlhoja = '{{ asset( 'pdf/'.$usuario->hojaDeVida) }}';
                      $("#{{$usuario->id}}hojaDeVida").fileinput({
                          initialPreview: [urlhoja],
                          initialPreviewAsData: true,
                          initialPreviewConfig: [
                              {type: "pdf", size: 8000, caption: "{{$usuario->hojaDeVida}}", downloadUrl: urlhoja, width: "120px", key: 1}
                          ],
                          deleteUrl: "/site/file-delete",
                          overwriteInitial: false,
                          maxFileSize: 10000,
                          initialCaption: "Hoja de Vida"
                      });
                    });
                  </script>
                @else
                  <script >
                    $(document).ready(function () {// Para inicializar los que tienen hoja de vida
                      $("#{{$usuario->id}}hojaDeVida").fileinput({
                          initialPreviewAsData: true,
                          deleteUrl: "/site/file-delete",
                          overwriteInitial: false,
                          maxFileSize: 10000,
                          initialCaption: "Hoja de Vida"
                      });
                    });
                  </script>
                @endif
                <br>
                <div class="form-group">
                  <label class="checkbox">{!! Form::checkbox('Obsequiar', 'Obsequiar', $usuario->obsequio) !!}<span>Activar Para Obsequiar</span></label>
                </div>
                <br>
                <div  class="form-group">
                  <a id="registrarUsuario" class="btn btn-pocket" style="font-weight: 400;" type="submit">
                    <i class="fa fa-send"></i>Guardar Empleado
                  </a>
                </div>
              </div>
              </div>
            </div>
            <div class="row">

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
          <div class="widget-content padded">
            <form id="formslider" class="login-form">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <fieldset>
            <div class="row">
              <div class="col-md-4">
                    <div class="widget-content fileupload fileupload-new" data-provides="fileupload" style="text-align: center;">
                      <div class="gallery-container fileupload-new img-thumbnail">
                        <div class="gallery-item filter1" rel="" style="border-radius: 50%; width: 150px; height: 150px;">
                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" style="border-radius: 50%; width: 150px; height: 150px;">
                          <div class="actions">
                            <a onclick="$('#eliminarImagen').click()">
                              <i class="fa fa-trash-o"></i>
                            </a>
                            <a  id="modalImagen" href="{{asset('images/logo.png')}}" title="Sin imagen">
                              <img src="{{asset('images/logo.png')}}" hidden>
                              <i class="fa fa-search-plus"></i>
                            </a>
                            <a onclick="$('#imagenPerfil').click()">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="gallery-item fileupload-preview fileupload-exists img-thumbnail" style="border-radius: 50%; width: 150px; height: 150px;">
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
                <div class="input-container">
                  <i class="fa fa-address-book"></i>
                  <input class="input" id="nombrePersona" name="nombrePersona" placeholder="Nombre" type="text">
                </div>
                <div class="input-container">
                  <i class="fa fa-phone-square"></i>
                  <input class="input" placeholder="Teléfono" type="text">
                </div>
                <div class="input-container">
                  <i class="fa fa-envelope"></i>
                  <input class="input" placeholder="Email" id="email" name="email" type="email">
                </div>
              </div>
              <div class="col-md-4 ">
                  <div class="input-container">
                    <i class="fa fa-address-card"></i>
                    <input class="input" id="cedula" name="cedula" placeholder="Identificación" type="text">
                  </div>
                  <div class="input-container">
                    <i class="fa fa-map-marker"></i>
                    <input class="input" name="direccion" placeholder="Dirección" type="text">
                  </div>
                  <div class="input-container">
                    <i class="fa fa-venus-mars"></i>
                    <select id="sexo"  name="sexo" class="select"  style="weight: 100%; width: 50%">
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                  </div>
                  <div class="input-container">
                    <i class="fa fa-birthday-cake"></i>
                    <input data-date-format="yyyy/mm/dd" class="input"  placeholder="Fecha de Nacimiento" name="fechaNacimiento" id="fechaNacimiento" type="date">
                  </div>
                  <div class="input-container">
                    <i class="fa fa-money"></i>
                    <input class="input" name="salario" placeholder="Salario Diario" type="number">
                  </div>
                  <input type="text" name="permisoPrincipal" value="Mesero" hidden id="permisoPrincipal"><!-- oculto para permiso principal-->
                  <div class="input-container">
                     <i class="fa fa-users"></i>
                      <select id="selectPermisosAjax" name="Permisos[]" class="form-control selectPermisos" data-placeholder="Selecionar Roles...." multiple style="    padding: 0px 0px; width: 80%">
                        <option value="Mesero">Mesero</option>
                        <option value="Bartender">Bartender</option>
                        <option value="Cajero">Cajero</option>
                        <option value="Administrador">Administrador</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                <p class="lead" style="margin-bottom: 10px;">Sube la hoja de vida de tu <span class="text-success">Empleado</span></p>
                <ul class="list-unstyled" style="line-height: 1.5">
                  <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Informacion ordenada e Inmediata</li>
                  <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Base de datos de empleados</li>
                  <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Facilidad encontrar personal</li>
                </ul>
                <!-- <button style="font-weight: 400;" type="button" class="bfs btn btn-pocket" data-style="fileStyle-r"><span class="fa fa-file-pdf-o" aria-hidden="true"></span>
                  Subir hoja de vida
                </button>-->
                <br>
                <div class="form-group">
                  <input id="file-4" name="hojaDeVida" type="file" class="file" data-upload-url="#" accept="pdf/*">
                </div>
                <div class="input-container">
                  <label class="checkbox">
                    <input class="checkbox" name="regalar" value="1" type="checkbox">
                    <span>Activar para obsequiar Productos</span>
                  </label>
                </div>
                <br>
                <div  class="form-group">
                  <a id='registrarUsuario' class="btn btn-pocket" type="submit" style="font-weight: 400;">
                    <i class="fa fa-send"></i>
                    Guardar
                  </a>
                </div>
              </div>
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
  var auxMensajes = 1;

  var mensajes = function(id){
      if (auxMensajes ==1 ) {
        document.getElementById(id).style.display = "block";
        if (document.documentElement.clientWidth < 960) {
          document.getElementById(id).style.marginTop ="-50%";
        }else{
          document.getElementById(id).style.marginTop ="0%";
        }
        auxMensajes = 2;
      }else{
        document.getElementById(id).style.display = "none";
        auxMensajes = 1;
      }
  };


  $(document).ready(function () {// tooltip para colocar ayuda en los botones de habilitar y deshabilitar
    $('[data-toggle="tooltip"]').tooltip()

  });

  $(document).ready(function(){

    var selectPermisos = $('#selectPermisosAjax');
    var arregloDePermisosOrdenados = ["Mesero"];
    selectPermisos.select2().on("change", function (e) {
      var count = $(this).select2('data').length;
      if( e.added ){
        arregloDePermisosOrdenados.push(e.added.id);
      }else {
        var index = arregloDePermisosOrdenados.indexOf(e.removed.id);
        if (index > -1) {
            arregloDePermisosOrdenados.splice(index, 1);
        }
      }
      $("#permisoPrincipal").val(arregloDePermisosOrdenados[0]);
    });

  });

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
        uploadExtraData: {kvId: '10'},
        maxFileSize: 1
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
    /*
    //Aquí buscamos todos los inputs que tengan una clase llamada; Check
    var a = document.querySelectorAll("input.Check:checked");
    var Permisos = Array.prototype.map.call(a,function(x){ return x.value; });
    // si tiene el permiso de obsequio
    var Obsequio = $(document.querySelectorAll("input.Obsequio:checked")[0]).val();
    var image = $('#imagenPerfil')[0].files[0];// la imagen de perfil
    //console.log(image)
    var selectPermisos = $('#selectPermisosAjax').val();
    selectPermisos.forEach(function(element) {
        //console.log(element);
    });
      var formData = {
            nombrePersona: $("#nombrePersona").val(),
            cedula: $('#cedula').val(),
            email: $('#email').val(),
            fechaNacimiento: $('#fechaNacimiento').val(),
            sexo: $('#sexo').val(),
            Permisos: Permisos,
            Obsequio: Obsequio,
            imagenPerfil: image
        };*/

    var type = "POST";
    var token = $("#token").val();
    var formData = new FormData($('#formslider')[0]);

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

<script>
$('.stop-propagation').on('click', function (e) {
    e.stopPropagation();
});
</script>

<style type="text/css">
  #imagenPerfilUsuarioCircular{
    width: 150px;
    height: 150px;
  }
</style>
@endsection
