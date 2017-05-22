@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Editar usuario</h1>
  </div>

  <div class ="panel-body">
      {!! Form::open(['route' => ['auth.usuario.update',$usuario], 'method' => 'PUT']) !!}

        <!--Nombre-->
        <div class="form-group">
          <label for="nombre" class="control-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" value="{{$usuario->nombre}}"/>
        </div>

        <!--Numero de identificacion-->
        <div class="form-grup">
          <label for="numeroIdentificacion" class="control-label">Número de identificación:</label>
          <input type="text" name="numeroIdentificacion" class="form-control" value="{{$usuario->numeroIdentificacion}}"/>
        </div>

        <!--Sexo-->
        <div class="form-grup">
          <br><label for="sexo" class="control-label">Sexo:</label>
          @if($usuario->sexo == "Femenino")
            <input type="radio" name="sexo" value="Femenino" checked="cheked"> <label>Femenino</label>
            <input type="radio" name="sexo" value="Masculino"> <label>Masculino</label>
          @else
            <input type="radio" name="sexo" value="Femenino"> <label>Femenino</label>
            <input type="radio" name="sexo" value="Masculino"  checked="cheked"> <label>Masculino</label>
          @endif
        </div>

        <!--Fecha de nacimiento-->
        <div class="form-grup">
          <br><label for="fechaNacimiento" class="control-label">Fecha de nacimiento:</label>
          <input type="date" name="fechaNacimiento" class="form-control"/ value={{$usuario->fechaNacimiento}}>
        </div>

        <!--Tipos-->
        <div class="form-grup">
          <br><label class="control-label">Seleccione los roles que desempeñará:</label><br>

          <label for="mesero" class="control-label">Mesero:</label>
          @if($usuario->tipoMesero == 1)
          <input type="checkbox" value="1" name="tipoMesero" checked="checked"/><br>
          @else
          <input type="checkbox" value="1" name="tipoMesero"/><br>
          @endif

          <label for="bartender" class="control-label">Bartender:</label>
          @if($usuario->tipoBartender == 1)
          <input type="checkbox" value="1" name="tipoBartender" checked="checked"/><br>
          @else
          <input type="checkbox" value="1" name="tipoBartender"/><br>
          @endif

          <label for="cajero" class="control-label">Cajero:</label>
          @if($usuario->tipoCajero == 1)
          <input type="checkbox" value="1" name="tipoCajero" checked="checked"/><br>
          @else
          <input type="checkbox" value="1" name="tipoCajero"/><br>
          @endif

        </div>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default" onclick = "return confirm ('¿Desea modificar este cliente?')"><i class="fa fa-plus"></i> Editar
          </button>
        </div>

      {!! Form::close() !!}
  </div>
</div>
@endsection
