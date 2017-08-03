@extends('layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Registro de producto</h1>
    </div>
    <div class ="panel-body">
        {!! Form::open(['route' => ['producto.update',$producto],'method' => 'PUT']) !!}
            <div class="form-grup">
                <label for="nombre" class="control-label">Nombre del Producto</label>
                <input type="text" name="nombreProducto" class="form-control" placeholder="Nombre del producto" value="{{$producto->nombre}}" />
            </div>
            <div class="form-grup">
                <label for="categorias" class="control-label">Categoría</label>
                {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'onchange' => 'mostrarValor(this.value);']) !!}
            </div>
            <div class="form-grup">
                <label for="precio" class="control-label">Precio</label>
                <input id="precio" type="number" step="any" name="precio" class="form-control" value="{{$producto->precio}}" />
            </div>
            <br>
                <div class="form-grup">
                    <label for="receta" class="control-label">Receta</label>
                    <br>
                    <textarea name="receta" class="form-control">{{$producto->receta}}</textarea>
                </div>
                <br>
            <br>
            <div class="form-grup">
                <button type="submit" class="btn btn-default" onclick = "return confirm ('¿Está seguro de registrar el producto?')">
                    <i class="fa fa-plus"></i> Modificar producto
                </button>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">

    var mostrarValor = function(x){
        var p = 0;
        cats = eval(<?php echo json_encode($cats);?>);
        for (var i=0; i< cats.length; i++)
        {
            if(x == cats[i].id){
                p = cats[i].precio;
            }   
        }
        document.getElementById('precio').value=p;
    };

</script>

@endsection