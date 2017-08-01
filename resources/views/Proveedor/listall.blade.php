
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