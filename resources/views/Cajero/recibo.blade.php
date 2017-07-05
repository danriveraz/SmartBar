@extends('Layout.app')
@section('content') 

<div class="col-sm-offset-3 col-sm-4">
	<div class="panel-tittle" align="center">
    <b>{{$mesas[0]->nombreMesa}}</b></div>
	</div>
  <div class="col-sm-offset-2 col-sm-7">
  <br><br>
	<table class="table table-hover">
    <thead>
      <th >Producto</th>
      <th width="50">Cantidad</th>
      <th width="110">Valor unitario</th>
      <th width="140">Valor Total</th>
      <th width="80">Pago</th>
    </thead>
    <tbody>
      <form action="{{url('cajero/recibo')}}" method="POST">
        @foreach($elementos as $elemento)
        <tr>
          <td> {{$elemento->nombre}} </td>
          <td> {{$elemento->cantidad}} </td>
          <td> $ <?php echo number_format($elemento->precio,0,",","."); ?>  </td>
          <td> $ <?php echo number_format(($elemento->precio*$elemento->cantidad),0,",","."); ?>  </td>
          <td > <input type="checkbox" name="productos[]" value="{{$elemento->id}}"> </td>
        </tr>
        @endforeach 
        <tr>
          <td></td><td></td><td></td><td>Precio a pagar</td><td><p id="precioAPagar"></p></td>
        </tr>
        <tr>
          <td></td><td></td><td></td><td>Total</td><td><p id="Total"></p></td>
        </tr>
      </form>
    </tbody>
     {!!$elementos->appends(Request::all())->render() !!}
  </table>
  </div>
</div>
@endsection