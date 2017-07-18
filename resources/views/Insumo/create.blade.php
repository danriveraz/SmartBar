@extends('layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Insumo</h1>
    </div>
    <div class ="panel-body">
        <form action=" {{ route('insumo.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" required="true"/>
                </div>
                <div class="form-group">
                    <label for="marca" class="control-label">Marca</label>
                    <input type="text" name="marca" class="form-control" placeholder="Marca del insumo" required="true"/>
                </div>
                <div class="form-group">
                    <label for="idProveedor" class="control-label">Proveedor</label>
                    
                    {!! Form::select('proveedores', $proveedores, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
                    <input type="number" name="cantidadUnidad" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="precioUnidad" class="control-label">Valor de venta</label>
                    <input type="number" name="precioUnidad" class="form-control" required="true">
                </div>
                 <div class="form-group">
                    <label for="valorCompra" class="control-label">Valor de compra</label>
                    <input type="number" name="valorCompra" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
                    <input type="number" step="any" name="cantidadMedida" class="form-control" required="true"/>
                    <select name="medida" class="form-control"> 
                        <option value="ml">ml</option> 
                        <option value="cm3">cm3</option> 
                        <option value="oz">oz</option> 
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
                    <input type="checkbox" name="tipo" id="tipo" value="1" onchange="javascript:showContent()" />
                </div>
                <div id="content" style="display: none;">
                    <label for="categorias" class="control-label">Categoría</label>
                    {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
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
