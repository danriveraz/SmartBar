@extends('Layout.app')
@section('content')

<div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['method' => 'POST', 'action' => 'categoriaController@store']) !!}
          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Registro
            </h4>
          </div>
          <div class="modal-body">
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre de la categoría</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="true"/>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
            <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
          </div>
        {!! Form::close() !!}
    </div>
   </div>
  </div>

<div class="col-sm-offset-2 col-sm-8">
    <div class="panel-tittle">
        <h1>Lista de productos</h1>
    </div>
    @include('flash::message')
    <a href="{{ route('producto.create') }}" class="btn btn-default"><i class="fa fa-plus"></i>Agregar nuevo producto 
    </a>
    {!! Form::model(Request::all(), ['route' => ['producto.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
    <div class="form-group" align="right">
      {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
      <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>

    <div align="right">
      <br>
      {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
       <td><a href="#addModal" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar nueva categoría</a> 
       </td>
      <td><a href="{{ route('categoria.index') }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
    </div>
  </div>
  {!! Form::close() !!}
  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Categoria</th>
    </thead>
    <tbody>
      @foreach($productos as $producto)
        <tr>
          <td>{{$producto->id}}</td>
          <td>{{$producto->nombre}}</td>
          <td>{{$producto->precio}}</td>
          <td>{{$categorias[$producto->idCategoria]}}</td>
          <td align="right"><a href="{{ route('producto.edit',$producto->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
          <td align="right"><a href="{{ route('producto.insumoedit',$producto->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Insumos <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$productos->appends(Request::all())->render() !!}
</div>
@endsection