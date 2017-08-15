<table class="table table-striped">
    <thead>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Categoria</th>
    </thead>
    <tbody>
      @foreach($productos as $producto)
        <tr id="{{$producto->id}}">
          <td>{{$producto->nombre}}</td>
          <td>{{$producto->precio}}</td>
          <td>{{$categorias[$producto->idCategoria]}}</td>
          <td align="right">
            <button data-target="#editModal{{$producto->id}}" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></button>
          </td>
          <td>
            <button class="btn btn-default" onclick="eliminar({{$producto->id}})" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>
          </td>
          <td align="right">
            <a href="{{ route('producto.insumoedit',$producto->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Inventario <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
        <div class="modal fade in" id="editModal{{$producto->id}}" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                {!! Form::open() !!}
                  <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                    <button aria-hidden="true" type="button"  class="close" data-dismiss="modal" style="color:white">&times;
                    </button>
                    <h4 class="modal-title">Editar</h4>
                  </div>
                  <div class="modal-body">
                    <div class="pre-scrollable" >
                      <div class="widget-content">
                        <div class="form-grup">                         
                          <input type="text" id="nombre{{$producto->id}}" name="nombreProducto" class="form-control" placeholder="Nombre del producto" value="{{$producto->nombre}}" placeholder="Nombre" />
                        </div>
                        <br>
                        <div class="form-grup">
                          <label for="categorias" class="control-label">Categor&iacutea</label>
                          {!! Form::select('categorias', $categorias, $producto->idCategoria, ['class' => 'form-control', 'id' => 'categoria'.$producto->id, 'onchange' => 'editarValor(this.value);']) !!}
                        </div>
                        <br>
                        <div class="form-grup">
                          
                          <input id="nPrecio{{$producto->id}}" type="number" step="any" name="nPrecio{{$producto->id}}" class="form-control" value="{{$producto->precio}}" placeholder="Precio" />
                        </div>
                        <br>
                        <div class="form-grup">
                          <label for="receta" class="control-label">Preparaci&oacuten</label>
                          <br>
                          <textarea name="receta" id="receta{{$producto->id}}" class="form-control">{{$producto->receta}}</textarea>
                        </div>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$producto->id}},{{$categorias}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                    <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
        </div>
      @endforeach
    </tbody>
  </table>
  {!!$productos->appends(Request::all())->render() !!}

<script>
  var routeModificar = "http://pocketdesigner.co/PocketByR/public//producto/modificar";
  var routeEliminar = "http://pocketdesigner.co/PocketByR/public//producto/eliminar";

  var editarValor = function(x){
    var p = 0;
    cats = eval(<?php echo json_encode($categorias);?>);
    for (var i=0; i< cats.length; i++){   
      if(x == cats[i].id){
        p = cats[i].precio;
      }   
    }
    document.getElementById('nPrecio{{$producto->id}}').value = p;
  };

  function modificar(idProducto,categorias){
    var nombre = $("#nombre"+idProducto).val();
    var categoria = $("#categoria"+idProducto).val();
    var precio = $("#nPrecio"+idProducto).val();
    var receta = $("#receta"+idProducto).val();
    $.ajax({
      url: routeModificar,
      type: 'GET',
      data: {
        id: idProducto,
        nombre: nombre,
        categoria: categoria,
        precio: precio,
        receta: receta
      },
      success: function(){
        $("#"+idProducto).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 3){
            $(this).text(categorias[categoria]);
          }else if(indextd == 2){
            $(this).text(precio);
          }
        });
      },
      error: function(data){
        alert('Error al modificar producto');
      }
    });       
  }

  function eliminar(idProducto){
    if(confirm('¿Desea eliminar este Producto?')){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          id: idProducto
        },
        success: function(){
            $("#"+idProducto).remove();
        },
        error: function(data){
          alert('No se puede eliminar el producto, ya que existe historial de ventas del mismo.');
        }
      });
    }
  }
</script>  