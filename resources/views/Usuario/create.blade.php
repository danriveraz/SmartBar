@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Usuario</h1>
  </div>
  <div class ="panel-body">
      <form action=" {{ route('auth.usuario.store') }}" method="POST">
        {{ csrf_field() }}
        <!--Nombre-->
        <div class="form-group">
          <label for="nombre" class="control-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre completo"/>
          <div class="bg-danger text-white">{{$errors->first('nombre')}}</div>
        </div>

        <!--Numero de identificacion-->
        <div class="form-grup">
          <label for="numeroIdentificacion" class="control-label">Número de identificación:</label>
          <input type="text" name="numeroIdentificacion" class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('numeroIdentificacion')}}</div>
        </div>

        <!--Contraseña-->
        <div class="form-grup">
          <label for="contraseña" class="control-label">Password:</label>
          <input type="password" name="contraseña" class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('contraseña')}}</div>
        </div>

        <!--Confirmar contraseña-->
        <div class="form-grup">
          <label for="contraseña_confirmation" class="control-label">Confirmar password:</label>
          <input type="password" name="contraseña_confirmation" class="form-control"/>
        </div>

        <!--Sexo-->
        <div class="form-grup">
          <br><label for="sexo" class="control-label">Sexo:</label>
          <input type="radio" name="sexo" value="Femenino"> <label>Femenino</label>
          <input type="radio" name="sexo" value="Masculino"> <label>Masculino</label>
          <div class="bg-danger text-white">{{$errors->first('sexo')}}</div>
        </div>

        <!--Fecha de nacimiento-->
        <div class="form-grup">
          <br><label for="fechaNacimiento" class="control-label">Fecha de nacimiento:</label>
          <input type="date" name="fechaNacimiento" class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('fechaNacimiento')}}</div>
        </div>

        <!--Tipos-->
        <div class="form-grup">
          <br><label class="control-label">Seleccione los roles que desempeñará:</label><br>
          <label for="mesero" class="control-label">Mesero:</label>
          <input type="hidden" value="0" name="tipoMesero" />
          <input type="checkbox" value="1" name="tipoMesero" /><br>
          <label for="bartender" class="control-label">Bartender:</label>
          <input type="hidden" value="0" name="tipoBartender" />
          <input type="checkbox" value="1" name="tipoBartender" /><br>
          <label for="cajero" class="control-label">Cajero:</label>
          <input type="hidden" value="0" name="tipoCajero" />
          <input type="checkbox" value="1" name="tipoCajero" />
        </div>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Registrar usuario
          </button>
        </div>

      </form>
  </div>
</div>
@endsection
