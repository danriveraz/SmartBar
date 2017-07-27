@extends('Layout.app')
@section('content')


{!!Html::style('stylesheets\font-awesome.min.css')!!}
{!!Html::style('stylesheets\isotope.css')!!}
{!!Html::style('stylesheets\fullcalendar.css')!!}
{!!Html::style('stylesheets\style.css')!!}

{!!Html::script('javascripts\bootstrap.min.js')!!}
{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\fullcalendar.min.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.fancybox.pack.js')!!}
{!!Html::script('javascripts\select2.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}
{!!Html::script('javascripts\main.js')!!}

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Lista de proveedores</h1>
  </div>
  @include('flash::message')
  <a href="#addModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Agregar nuevo proveedor </a>

  <div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['method' => 'POST', 'action' => 'proveedorController@store']) !!}
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
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del proveedor" required="true"/>
                </div>
                <div class="form-group">
                    <label for="direccion" class="control-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="telefono" class="control-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" placeholder="+00 000 000 0000" required="true">
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

  {!! Form::model(Request::all(), ['route' => ['proveedor.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
  <div class="form-group" align="right">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
   <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
  </div>
  {!! Form::close() !!}
  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Dirección</th>
      <th>Telefono</th>
    </thead>
    <tbody>
      @foreach($proveedores as $proveedor)
        <tr>
          <td>{{$proveedor->id}}</td>
          <td>{{$proveedor->nombre}}</td>
          <td>{{$proveedor->direccion}}</td>
          <td>{{$proveedor->telefono}}</td>
          <td align="right"><a href="{{ route('proveedor.edit',$proveedor->id) }}" data-toggle="modal" class="btn btn-default" data-target="#editModal{{$proveedor->id}}" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{route('proveedor.destroy', $proveedor->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar este proveedor?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>

          </td>
        </tr>
        <div class="modal fade in" id="editModal{{$proveedor->id}}" role="dialog" >
    
        </div>
        
      @endforeach
    </tbody>
  </table>
  {!!$proveedores->appends(Request::all())->render() !!}
</div>
@endsection