@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Editar usuario</h1>
  </div>

  <div class ="panel-body">
      {!! Form::open(['route' => ['Auth.usuario.update',$usuario], 'method' => 'PUT']) !!}
        {{ csrf_field() }}
        <!--Nombre-->
        <div class="form-group">
          <label for="nombrePersona" class="control-label">Nombre</label>
          <input type="text" name="nombrePersona" class="form-control" value="{{$usuario->nombrePersona}}"/>
          <div class="bg-danger text-white">{{$errors->first('nombrePersona')}}</div>
        </div>
        <!-- correo electronico -->
        <div class="form-group">
          <label for="email " class="control-label">Correo Electrónico</label>
          <input type="text" disabled class="form-control" value="{{$usuario->email}}"/>
        </div>
        <!--Numero de identificacion-->
        <div class="form-grup">
          <label for="cedula" class="control-label">Número de identificación:</label>
          <input type="text" name="cedula" class="form-control" value="{{$usuario->cedula}}"/>
          <div class="bg-danger text-white">{{$errors->first('cedula')}}</div>
        </div>

        <!--Contraseña-->
        <div class="form-grup">
          <label for="contraseña" class="control-label">Password:</label>
          <input type="password" name="password" class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('password')}}</div>
        </div>

        <!--Confirmar contraseña-->
        <div class="form-grup">
          <label for="contraseña_confirmation" class="control-label">Confirmar password:</label>
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

        <!--Tipos-->
        <div class="form-group">
          <div class="row">
            <label class="control-label">Seleccione los roles que desempeñará:</label>
          </div>
          <div class="row">
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
          </div>
          <div class="col-md-7">
        </div>

        </div>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default" onclick = "return confirm ('¿Desea modificar este Trabajador?')"><i class="fa fa-plus"></i> Editar
          </button>
          <a class="btn btn-error pull-right" href="{{url('Auth/usuario/'.$usuario->id.'/destroy')}}" onclick = "return confirm ('¿Está seguro de eliminar este Trabajador?')"><i class="fa fa-trash-o "></i> Eliminar
          </a>
        </div>


      {!! Form::close() !!}
  </div>
</div>
@if(Auth::User()->esAdmin)
  @endsection
@endif
