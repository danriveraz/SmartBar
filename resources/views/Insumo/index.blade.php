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
      <h1>Lista de insumos</h1>
  </div>
  @include('flash::message')

  <a href="#addModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Agregar nuevo insumo </a>
  <div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">

        {!! Form::open(['method' => 'POST', 'action' => 'insumoController@store']) !!}

          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">

          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>

            <h4 class="modal-title">
            Registro
            </h4>
          </div>
          <div class="modal-body">
              <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Atencion!</strong> Para el manejo de insumos como cerezas o limones se deben ingresar las unidades disponibles para así tener una mejor experiencia. Para ello la opción disponible es unidad.
              </div>
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" required="true"/>
                </div>
              </div>
              <div class="form-group">
                    <label for="marca" class="control-label">Marca</label>
                    <input type="text" name="marca" class="form-control" placeholder="Marca del insumo" required="false"/>
                </div>
                <div class="form-group">
                    <label for="idProveedor" class="control-label">Proveedor</label>
                    
                    {!! Form::select('proveedores', $proveedores, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
                    <input type="number" min="0" name="cantidadUnidad" class="form-control" required="false">
                </div>
                <div class="form-group">
                    <label for="valorCompra" class="control-label">Valor de compra</label>
                    <input type="number" step="any" min="0" name="valorCompra" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="precioUnidad" class="control-label">Valor de venta</label>
                    <input type="number" step="any" min="0" name="precioUnidad" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
                    <input type="number" step="any" min="0" name="cantidadMedida" class="form-control" required="true"/>
                    <select name="medida" class="form-control"> 
                        <option value="ml">ml</option> 
                        <option value="cm3">cm3</option> 
                        <option value="oz">oz</option>
                        <option value="unidad">unidad</option>
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
  <form class="navbar-form navbar-right" method="GET" route="'insumo.index'">
  {{csrf_field()}}
    <div class="form-group" align="right">
      {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
      <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
      <div align="right">
        <br>
        {!! Form::select('tipo', ['' => 'Seleccione un tipo','1' => 'A la venta','0' => 'No a la venta'], null, ['class' => 'form-control']) !!}
      </div>
    </div>
  </form>

  {!! Form::close() !!}
  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Marca</th>
      <th>Proveedor</th>
      <th>Unidades</th>
      <th>Valor compra</th>
      <th>Valor venta</th>
      <th>Onzas disponibles</th>
      <th>A la venta</th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr>
          <td>{{$insumo->id}}</td>
          <td>{{$insumo->nombre}}</td>
          <td>{{$insumo->marca}}</td>
          <td>{{$proveedores[$insumo->idProveedor]}}</td>
          <td>{{$insumo->cantidadUnidad}}</td>
          <td>{{$insumo->valorCompra}}</td>
          <td>{{$insumo->precioUnidad}}</td>
          <td>{{number_format($insumo->cantidadMedida,3)}}</td>
          <td align="center">
            <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/>
          </td>
          <td>
          <a href="{{route('insumo.edit', $insumo->id)}}" 
          data-target="#editModal{{$insumo->id}}" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
          </a>
          </td>
          <td>
            <a href="{{route('insumo.destroy', $insumo->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar este insumo?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>

        <div class="modal fade" id="editModal{{$insumo->id}}" role="dialog">
            
        </div>
      @endforeach
    </tbody>
  </table>
  
  {!!$insumos->appends(Request::all())->render() !!}

</div>
@endsection
