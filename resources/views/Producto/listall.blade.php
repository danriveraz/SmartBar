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
          <td align="right"><a href="{{route('producto.edit',$producto->id) }}" data-target="#editModal{{$producto->id}}" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
          <td align="right"><a href="{{ route('producto.insumoedit',$producto->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Insumos <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
        <div class="modal fade" id="editModal{{$producto->id}}" role="dialog">
            
        </div>
      @endforeach
    </tbody>
  </table>
  {!!$productos->appends(Request::all())->render() !!}

  