<div class="modal-dialog">
    <div class="modal-content">
        {!! Form::open(['route' => ['producto.update',$producto->id],'method' => 'PUT']) !!}
            <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                <button aria-hidden="true" type="button"  class="close" data-dismiss="modal" style="color:white">&times;
                </button>
                <h4 class="modal-title">
                  Editar
                </h4>
            </div>
            <div class="modal-body" id="form">
                <div class="pre-scrollable" >
                    <div class="widget-content">
                     <div class="form-grup">
                        <label for="nombre" class="control-label">Nombre del Producto</label>
                        <input type="text" name="nombreProducto" class="form-control" placeholder="Nombre del producto" value="{{$producto->nombre}}" />
                    </div>
                    <br>
                    <div class="form-grup">
                        <label for="categorias" class="control-label">Categoría</label>
                        {!! Form::select('categorias', $categorias, $producto->idCategoria, ['class' => 'form-control', 'onchange' => 'editarValor(this.value);']) !!}
                    </div>
                    <br>             
                    <div class="form-grup">
                        <label for="precio" class="control-label">Precio</label>
                        <input id="nPrecio{{$producto->id}}" type="number" step="any" name="nPrecio{{$producto->id}}" class="form-control" value="{{$producto->precio}}" />
                    </div>
                    <br>
                    <script type="text/javascript">
                      var editarValor = function(x){
                        var p = 0;
                        cats = eval(<?php echo json_encode($cats);?>);
                        for (var i=0; i< cats.length; i++)
                        {   
                          if(x == cats[i].id){
                          p = cats[i].precio;
                          }   
                        }
                        document.getElementById('nPrecio{{$producto->id}}').value = p;
                      };
                    </script>
                        <div class="form-grup">
                            <label for="receta" class="control-label">Receta</label>
                            <br>
                            <textarea name="receta" class="form-control">{{$producto->receta}}</textarea>
                        </div>
                        <br>
                    <br> 
                  </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" onclick = "return confirm ('¿Está seguro de registrar el producto?')" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >
                Guardar
            </button>
            <button class="btn btn-default-outline" data-dismiss="modal" type="button">
                Cerrar
            </button>
        </div>
        {!! Form::close() !!} 
    </div>
</div>