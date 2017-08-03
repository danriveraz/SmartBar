<table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Precio</th>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
        <tr>
          <td>{{$categoria->id}}</td>
          <td>{{$categoria->nombre}}</td>
          <td>{{$categoria->precio}}</td>
          <td align="right"><a href="{{route('categoria.edit', $categoria->id) }}" class="btn btn-default" data-toggle="modal" data-target="#editModal{{$categoria->id}}" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{route('categoria.destroy', $categoria->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar esta categoría?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>
        <div class="modal fade" id="editModal{{$categoria->id}}" role="dialog" >
    
        </div>
      @endforeach
    </tbody>
</table>
{!!$categorias->appends(Request::all())->render() !!}