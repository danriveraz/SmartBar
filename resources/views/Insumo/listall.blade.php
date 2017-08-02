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