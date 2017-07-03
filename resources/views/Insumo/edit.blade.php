@extends('layout.app')
@section('panel-title', 'modificar insumo')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Modificar insumo</h1>
    </div>
    <div class ="panel-body">
      {!! Form::open(['route' => ['auth.insumo.update',$insumo], 'method' => 'PUT']) !!}

        <div class="form-group">
          <label for="nombre" class="control-label">Nombre del insumo</label>
          <input type="text" name="nombre" class="form-control" value="{{$insumo->nombre}}"/>
        </div>

        <div class="form-grup">
            <label for="idProveedor" class="control-label">Proveedor</label>
            <input type="text" name="idProveedor" class="form-control" value="{{$insumo->idProveedor}}"/>
        </div>
        <div class="form-grup">
            <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
            <input type="number" name="cantidadUnidad" class="form-control" value="{{$insumo->cantidadUnidad}}"/>
        </div>
        <div class="form-grup">
            <label for="precioUnidad" class="control-label">Valor de venta</label>
            <input type="number" name="precioUnidad" class="form-control" value="{{$insumo->precioUnidad}}"/>
        </div>
        <div class="form-grup">
            <label for="valorCompra" class="control-label">Valor de compra</label>
            <input type="number" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}"/>
        </div>
        <div class="form-grup">
            <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
            <input type="number" step="any" name="cantidadMedida" class="form-control" value="{{$insumo->cantidadMedida}}"/>
            <select name="medida"> 
                <option value="ml">ml</option> 
                <option value="cm3">cm3</option> 
                <option value="oz" <?php if($insumo->cantidadMedida !="0") echo "selected";?> >oz</option> 
            </select>
        </div>
        <br>
        <div class="form-grup">
            <label for="tipo" class="control-label">Tipo</label>
            <select name="Tipo">
                <option value="cerveza" <?php if($insumo->tipo =="venta") echo "selected";?>>A la venta</option>
                <option value="licor" <?php if($insumo->tipo =="noVenta") echo "selected";?>>No a la venta</option>
            </select>
        </div>
        <br>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default" onclick = "return confirm ('¿Desea modificar este insumo?')"><i class="fa fa-plus"></i> Editar insumo
          </button>
        </div>
      {!! Form::close() !!}
  </div>
</div>
@endsection
