@extends('layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Modificar insumo</h1>
    </div>
    <div class ="panel-body">
      {!! Form::open(['route' => ['insumo.update',$insumo],'method' => 'PUT']) !!}

        <div class="form-group">
          <label for="nombre" class="control-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" value="{{$insumo->nombre}}"/>
        </div>
        <div class="form-group">
          <label for="marca" class="control-label">Marca</label>
          <input type="text" name="marca" class="form-control" value="{{$insumo->marca}}"/>
        </div>
        <div class="form-group">
            <label for="idProveedor" class="control-label">Proveedor</label>
            {!! Form::select('proveedores', $proveedores, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
            <input type="number" name="cantidadUnidad" class="form-control" value="{{$insumo->cantidadUnidad}}"/>
        </div>
        <div class="form-group">
            <label for="precioUnidad" class="control-label">Valor de venta</label>
            <input type="number" name="precioUnidad" class="form-control" value="{{$insumo->precioUnidad}}"/>
        </div>
        <div class="form-group">
            <label for="valorCompra" class="control-label">Valor de compra</label>
            <input type="number" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}"/>
        </div>
        <div class="form-group">
            <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
            <input type="number" step="any" name="cantidadMedida" class="form-control" value="{{$insumo->cantidadMedida}}"/>
            <select name="medida" class="form-control"> 
                <option value="ml">ml</option> 
                <option value="cm3">cm3</option> 
                <option value="oz" <?php if($insumo->cantidadMedida !="0") echo "selected";?> >oz</option> 
            </select>
        </div>
        <script type="text/javascript">
            function showContent() {
                element = document.getElementById("content");
                check = document.getElementById("tipo");
                if (check.checked) {
                    element.style.display='block';
                }
                else {
                    element.style.display='none';
                }
            }
        </script>
        <div class="form-group">
            <label for="tipo" class="control-label">Vender como producto?</label>
            <input type="checkbox" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?> onchange="javascript:showContent()" />
        </div>
        <div id="content" <?php if($insumo->tipo == "0") echo "hidden";?>>
            <label for="categorias" class="control-label">Categoría</label>
            {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
        </div>
        <br>
        <div class="form-group">
          <br><button type="submit" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick = "return confirm ('¿Desea modificar este insumo?')"><i class="fa fa-plus"></i> Editar insumo
          </button>
        </div>
      {!! Form::close() !!}
  </div>
</div>
@endsection
