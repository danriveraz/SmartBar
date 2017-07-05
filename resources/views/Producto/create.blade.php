@extends('layout.app')
@section('panel-title', 'crear producto')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Registro de producto</h1>
    </div>
    <div class ="panel-body">
        <form action=" {{ route('auth.producto.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre del Producto</label>
                    <input type="text" name="nombreProducto" class="form-control" placeholder="Nombre del producto" required="true"/>
                </div>
                <div class="form-grup">
                    <label for="tipo" class="control-label">Categoría</label>
                    {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-grup">
                    <label for="precio" class="control-label">Precio</label>
                    <input type="number" step="any" name="precio" class="form-control" required="true"/>
                </div>
                <br>
                <div class="form-grup">
                    <button type="submit" class="btn btn-default" onclick = "return confirm ('¿Está seguro de registrar el producto?')"><i class="fa fa-plus"></i> Asignar insumos
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection