@extends('layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Modificar proveedor</h1>
    </div>
    <div class ="panel-body">
      {!! Form::open(['route' => ['proveedor.update',$proveedor],'method' => 'PUT']) !!}

        <div class="form-group">
          <label for="nombre" class="control-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" value="{{$proveedor->nombre}}"/>
        </div>
        <div class="form-group">
            <label for="direccion" class="control-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}"/>
        </div>
        <div class="form-group">
            <label for="telefono" class="control-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{$proveedor->telefono}}"/>
        </div>
        <div class="form-group">
          <br><button type="submit" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick = "return confirm ('¿Desea modificar este proveedor?')"><i class="fa fa-plus"></i> Editar proveedor
          </button>
        </div>
      {!! Form::close() !!}
  </div>
</div>
@endsection
