@extends('layout.app')
@section('panel-title', 'crear categoría')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Registrar nueva categoría</h1>
    </div>
    <div class ="panel-body">
        <form action=" {{ route('auth.categoria.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre de la categoría</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="true"/>
                </div>
                
                <br>
                <div class="form-grup">
                    <button type="submit" class="btn btn-default"><i class="fa fa-plus">
                    </i> Registrar categoría</button>
                </div>
        </form>
    </div>
</div>
@endsection
