@extends('Layout.app')
@section('content')
<div class="col-sm-offset-2 col-sm-8">
	<div class="panel-tittle">
			<h1>Lista de facturas</h1>
	</div>

	<form class="navbar-form navbar-form" method="POST" action="{{url('cajero/')}}">
	{{csrf_field()}}
			<div class="navbar-text navbar-right">
					<input type="text" name="nombre" class="form-control" placeholder="Buscar">
					<button type="submit" class="btn btn-dufault">Buscar</button>
			</div>
			<div class="navbar-header">
				<b>Ver todas las facturas  &ensp;&ensp;</b>
				<input type="checkbox" name="verFacturas">
			</div>
	</form>
</div>
<div class="col-sm-offset-2 col-sm-8">
	<table id="tabla" class="table table-hover">
    <thead>
      <th>Mesa</th>
      <th width="250">Fecha</th>
      <th width="20">Detalles</th>
    </thead>
    <tbody>
      @foreach($mesas as $mesa)
      <form action="{{url('cajero/recibo')}}" method="POST">
        {{csrf_field()}}
      <tr class="mesaSeleccionada" valor="{{$mesa->nombreMesa}}" name = "{{$mesa->idFactura}}">
      	<td>
      		{{$mesa->nombreMesa}}
      	</td>
      	<td>
      		{{$mesa->fecha}}
      	</td>
      	<td>
      		@if($mesa->estado == 'En proceso')
      			<input type="text" name="id" value="{{$mesa->id}}" hidden=""h>
      			<button name="" class="btn btn-warning">
      				<span class="	glyphicon glyphicon-zoom-in"></span></a>
      			</button> 
      		@endif
          </td>
      </tr>
      </form>
      @endforeach 
    </tbody>
  </table>
</div>
@endsection