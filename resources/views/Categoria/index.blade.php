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
      <h1>Lista categorías</h1>
  </div>
  @include('flash::message')
  <a href="#addModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Agregar nueva categoría </a>

  <div class="modal fade" id="addModal" >
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

  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
        <tr>
          <td>{{$categoria->id}}</td>
          <td>{{$categoria->nombre}}</td>

          <td align="right"><a href="{{route('categoria.edit', $categoria->id) }}" class="btn btn-default" data-toggle="modal" data-target="#editModal{{$categoria->id}}" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{route('categoria.destroy', $categoria->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar esta categoría?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>
        <div class="modal fade" id="editModal{{$categoria->id}}" role="dialog" >
    
        </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection