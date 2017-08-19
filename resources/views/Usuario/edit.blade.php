@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
@section('content')
<div class="col-sm-offset-3 col-sm-6">
 <div class="panel-tittle" align="center">
      <h3><B>EDITAR USUARIO</B></h3>
  </div>

  <div class ="panel-body">
      {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <!--Imagen de la empresa-->
        <div class="row ">
          <div class="col-md-6">
            <div class="form-group">
              
              <div class="text-center">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                    @if($usuario->imagenPerfil!='')
                      {!! Html::image('images/admins/'.$usuario->imagenPerfil , 'imagen de perfil') !!}
                    @else
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                    @endif
                  </div>
                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar imagen</span><span class="fileupload-exists">Cambiar</span><input type="file" class="form-control" name="imagenPerfil" ></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
                  </div>
                </div>
              </div>
              <div class="bg-danger text-white">{{$errors->first('imagenPerfil')}}</div>
            </div>
          </div>
          <div class="col-md-6">
            <!--Nombre-->
            <div class="form-group">
              <label for="nombrePersona" class="control-label">Nombre</label>
              <input type="text" name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}"/>
              <div class="bg-danger text-white">{{$errors->first('nombrePersona')}}</div>
            </div>
            <!--Username-->
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="text" name="username" class="form-control" value="{{$usuario->username}}"/>
              <div class="bg-danger text-white">{{$errors->first('username')}}</div>
            </div>
            <!-- correo electronico -->
            <div class="form-group">
              <label for="email " class="control-label">Email</label>
              <input type="text" disabled class="form-control" value="{{$usuario->email}}"/>
            </div>
          </div>
        </div>
        <!--Numero de identificacion-->
        <div class="form-grup">
          <label for="cedula" class="control-label">Identificación:</label>
          <input type="text" name="cedula" class="form-control" value="{{$usuario->cedula}}"/>
          <div class="bg-danger text-white">{{$errors->first('cedula')}}</div>
        </div>
        <!--Numero telefónico-->
        <div class="form-grup">
          <label for="telefono" class="control-label">Teléfono:</label>
          <input type="text" name="telefono" class="form-control" value="{{$usuario->telefono}}"/>
          <div class="bg-danger text-white">{{$errors->first('telefono')}}</div>
        </div>

        <!--Contraseña-->
        <div class="form-grup">
          <label for="contraseña" class="control-label">Contraseña:</label>
          <input type="password" name="password" class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('password')}}</div>
        </div>

        <!--Confirmar contraseña-->
        <div class="form-grup">
          <label for="contraseña_confirmation" class="control-label">Confirmar Contraseña:</label>
          <input type="password" name="password_confirmation" class="form-control"/>
        </div>

        <!--Sexo-->
        <div class="form-grup">
          <br>
          <div class="row">
            <label for="sexo" class="control-label col-md-2">Sexo:</label>
            <div class="col-md-7">
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


        <!--Fecha de nacimiento-->
        <div class="form-grup">
          <br><label for="fechaNacimiento" class="control-label">Fecha de nacimiento:</label>
          <input type="date" name="fechaNacimiento" value='{{$usuario->fechaNacimiento}}' class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('fechaNacimiento')}}</div>
        </div>

        @if(Auth::User()->esAdmin)
          <!--Tipos--><br>
          <div class="form-group">
            <div class="row">
              <label class="control-label">Permisos:</label>
            </div>
              <label class="checkbox-inline">
                {!! Form::checkbox('Permisos[]', 'Mesero', $usuario->esMesero, ['data-toggle'=>'checkbox']) !!}
                <span>Mesero</span>
              </label>
              <label class="checkbox-inline">
                {!! Form::checkbox('Permisos[]', 'Bartender', $usuario->esBartender, ['data-toggle'=>'checkbox']) !!}<span>Bartender</span>
              </label>
              <label class="checkbox-inline">
                {!! Form::checkbox('Permisos[]', 'Cajero', $usuario->esCajero, ['data-toggle'=>'checkbox']) !!}<span>Cajero</span>
              </label>
              <label class="checkbox-inline">
                {!! Form::checkbox('Permisos[]', 'Administrador', $usuario->esAdmin, ['data-toggle'=>'checkbox']) !!}<span>Administrador</span>
              </label>
            <div class="bg-danger text-white">{{$errors->first('Permisos')}}</div>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
              {!! Form::checkbox('Obsequiar', 'Obsequiar', $usuario->obsequio, ['data-toggle'=>'checkbox']) !!}<span>Obsequiar</span>
            </label>
          </div>
          <div class="form-grup">
        @endif
          
          <div class="modal-footer">
            <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick = "return confirm ('¿Desea modificar este Trabajador?')">Guardar</button>
          </div>

        </div>


      {!! Form::close() !!}
  </div>
</div>
@if(Auth::User()->esAdmin)
  @endsection
@endif
