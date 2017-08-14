@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Usuario</h1>
  </div>
  <div class ="panel-body">
      <form action=" {{ route('Auth.usuario.store') }}" method="POST">
        {{ csrf_field() }}
        <!--Nombre-->
        <div class="form-group">
          <label for="nombrePersona" class="control-label">Nombre</label>
          <input type="text" name="nombrePersona" class="form-control" placeholder="Nombre completo"/>
          <div class="bg-danger text-white">{{$errors->first('nombrePersona')}}</div>
        </div>

        <div class="form-group">
          <label for="email " class="control-label">Correo Electrónico</label>
          <input type="text" name="email" class="form-control" placeholder="Correo electrónico"/>
          <div class="bg-danger text-white">{{$errors->first('email')}}</div>
        </div>

        <!--Numero de identificacion-->
        <div class="form-grup">
          <label for="cedula" class="control-label">Número de identificación:</label>
          <input type="text" name="cedula" class="form-control"/>
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
          <div class="bg-danger text-white">{{$errors->first('password_confirmation')}}</div>
        </div>

        <!--Sexo-->
        <div class="form-grup">
          <br>
          <div class="row">
            <label for="sexo" class="control-label col-md-2">Sexo:</label>
            <div class="col-md-7">
              <label class="radio-inline">
                <input type="radio" name="sexo" value="Femenino"><span>Femenino</span>
              </label>
              <label class="radio-inline">
                <input type="radio" name="sexo" value="Masculino"><span>Masculino</span></label>
              </label>
              <div class="bg-danger text-white">{{$errors->first('sexo')}}</div>
            </div>
          </div>
        </div>


        <!--Fecha de nacimiento-->
        <div class="form-grup">
          <br><label for="fechaNacimiento" class="control-label">Fecha de nacimiento:</label>
          <input type="date" name="fechaNacimiento" class="form-control"/>
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
              {!! Form::checkbox('Permisos[]', 'Mesero', 0, ['data-toggle'=>'checkbox']) !!}
              <span>Mesero</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Bartender', 0, ['data-toggle'=>'checkbox']) !!}<span>Bartender</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Cajero', 0, ['data-toggle'=>'checkbox']) !!}<span>Cajero</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Administrador', 0, ['data-toggle'=>'checkbox']) !!}<span>Administrador</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Obsequio', 0, ['data-toggle'=>'checkbox']) !!}<span>Obsequiar</span>
            </label>
          </div>
          <div class="col-md-7">
        </div>

        <div class="form-grup">
          <br><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Registrar usuario
          </button>
        </div>

      </form>
  </div>
</div>
@endsection
