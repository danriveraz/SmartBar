@extends('layout.app')
@section('panel-title', 'crear insumo')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Insumo</h1>
    </div>
    <div class ="panel-body">
        <form action=" {{ route('insumo.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre del insumo</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" required="true"/>
                </div>
                <div class="form-grup">
                    <label for="idProveedor" class="control-label">Proveedor</label>
                    <input type="text" name="idProveedor" class="form-control" required="true">
                </div>
                <div class="form-grup">
                    <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
                    <input type="number" name="cantidadUnidad" class="form-control" required="true">
                </div>
                <div class="form-grup">
                    <label for="precioUnidad" class="control-label">Valor de venta</label>
                    <input type="number" name="precioUnidad" class="form-control" required="true">
                </div>
                 <div class="form-grup">
                    <label for="valorCompra" class="control-label">Valor de compra</label>
                    <input type="number" name="valorCompra" class="form-control" required="true">
                </div>
                <div class="form-grup">
                    <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
                    <input type="number" name="cantidadMedida" class="form-control" required="true">
                </div>
                <br>
                <div class="form-grup">
                    <label for="tipo" class="control-label">Tipo</label>
                    <select name="Tipo">
                        <option value="tipo 1">Tipo 1</option>
                        <option value="tipo 2">Tipo 2</option>
                    </select>
                </div>
                <br>
                 <div class="form-grup">
                    <label for="categoria" class="control-label">Categoria</label>
                    <select name="Categoria">
                        <option value="categoria 1">Categoria 1</option>
                        <option value="categoria 2">Categoria 2</option>
                    </select>
                </div>
                <br>
                <div class="form-grup">
                    <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Registrar insumo
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection
