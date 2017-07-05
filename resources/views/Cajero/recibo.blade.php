@extends('Layout.app')
@section('content')
    
<div class="col-sm-offset-3 col-sm-4">
	<div class="panel-tittle" align="center">
    <b>{{$mesas[0]->nombreMesa}}</b></div>
	</div>
  <div class="col-sm-offset-2 col-sm-7">
	<table class="table table-hover">
    <thead>
      <th >Producto</th>
      <th width="50">Cantidad</th>
      <th width="110">Valor unitario</th>
      <th width="100">Valor Total</th>
    </thead>
    <tbody>
      <form action="{{url('cajero/recibo')}}" method="POST">
        @foreach($elementos as $elemento)
        <tr>
          <td> {{$elemento->nombre}} </td>
          <td> {{$elemento->cantidad}} </td>
        </tr>
        @endforeach 
      </form>
    </tbody>
     {!!$elementos->appends(Request::all())->render() !!}
  </table>
  </div>
</div>
@endsection