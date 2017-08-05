<table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Marca</th>
      <th>Proveedor</th>
      <th>Unidades</th>
      <th>Valor compra</th>
      <th>Valor venta</th>
      <th>Onzas/Unidades disponibles</th>
      <th>A la venta</th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr id="{{$insumo->id}}">
          <td>{{$insumo->id}}</td>
          <td>{{$insumo->nombre}}</td>
          <td>{{$insumo->marca}}</td>
          <td>{{$proveedores[$insumo->idProveedor]}}</td>
          <td>{{$insumo->cantidadUnidad}}</td>
          <td>{{$insumo->valorCompra}}</td>
          <td>{{$insumo->precioUnidad}}</td>
          <td>{{number_format($insumo->cantidadMedida,3)}}</td>
          <td align="center">
            <label> <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/><span></span></label>
          </td>
          <td>
          <button data-target="#editModal{{$insumo->id}}" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
          </button>
          </td>
          <td>
            <button class="btn btn-default" onclick="eliminar({{$insumo->id}})" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>
          </td>
        </tr>

        <div class="modal fade in" id="editModal{{$insumo->id}}" role="dialog">
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
                    <div class="form-group">
                      <label for="nombre" class="control-label">Nombre</label>
                      <input type="text" id="nombre{{$insumo->id}}" name="nombre" class="form-control" value="{{$insumo->nombre}}"/>
                    </div>
                    <div class="form-group">
                      <label for="marca" class="control-label">Marca</label>
                      <input type="text" id="marca{{$insumo->id}}" name="marca" class="form-control" value="{{$insumo->marca}}"/>
                    </div>
                    <div class="form-group">
                      <label for="idProveedor" class="control-label">Proveedor</label>
                      {!! Form::select('proveedores', $proveedores, $insumo->idProveedor, ['class' => 'form-control', 'id'=>'proveedores'.$insumo->id]) !!}
                    </div>
                    <div class="form-group">
                      <label for="cantidadUnidad" class="control-label">Cantidad</label>
                      <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" class="form-control" value="{{$insumo->cantidadUnidad}}"/>
                    </div>
                    <div class="form-group">
                      <label for="valorCompra" class="control-label">Valor de compra</label>
                      <input type="number" id="compra{{$insumo->id}}" step="any" min="0" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}"/>
                    </div>
                    <div class="form-group">
                      <label for="precioUnidad" class="control-label">Valor de venta</label>
                      <input type="number" id="venta{{$insumo->id}}" step="any" min="0" name="precioUnidad" class="form-control" value="{{$insumo->precioUnidad}}"/>
                    </div>
                    <div class="form-group">
                      <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
                      <input type="number" id="cantMedida{{$insumo->id}}" min="0" step="any" name="cantidadMedida" class="form-control" value="{{$insumo->cantidadMedida}}"/>
                      <select name="medida" id="medida{{$insumo->id}}" class="form-control" onchange="editValor(this.value,{{$insumo->id}});"> 
                        <option value="ml">ml</option> 
                        <option value="cm3">cm3</option> 
                        <option value="oz" <?php if($insumo->cantidadMedida !="0") echo "selected";?> >oz</option>
                        <option value="unidad">unidad</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tipo" class="control-label">Vender como producto?</label>
                      <label> <input type="checkbox" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?> onchange="javascript:showContent()" disabled="disabled" /><span></span></label>
                    </div>
                    <div id="content" <?php if($insumo->tipo == "0") echo "hidden";?>>
                      <label for="categorias" class="control-label">Categoría</label>
                      {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'disabled'=>'disabled' ]) !!}
                    </div>
                    <br>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$insumo->id}},{{$proveedores}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
              </div>
            {!! Form::close() !!} 
          </div>
        </div>
      </div>
    @endforeach
  </tbody>
</table>
{!!$insumos->appends(Request::all())->render() !!}

<script>
  var routeModificar = "http://localhost/PocketByR/public/insumo/modificar";
  var routeEliminar = "http://localhost/PocketByR/public/insumo/eliminar";  

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

  var editValor = function(x,id){
    if(x == 'unidad'){
      document.getElementById('unidades'+id).value = 1;
      document.getElementById('unidades'+id).disabled=true;
     }else{
      document.getElementById('unidades'+id).disabled=false;
      document.getElementById('unidades'+id).value = null;
    }
  };

  function modificar(idInsumo,proveedores){
    var nombre = $("#nombre"+idInsumo).val();
    var marca = $("#marca"+idInsumo).val();
    var proveedor = $("#proveedores"+idInsumo).val();
    var unidades = $("#unidades"+idInsumo).val();
    var compra = $("#compra"+idInsumo).val();
    var venta = $("#venta"+idInsumo).val();
    var cantMedida = $("#cantMedida"+idInsumo).val();
    var medida = $("#medida"+idInsumo).val();

    if(marca==''){
      marca = 'Sin marca';
    }

    $.ajax({
      url: routeModificar,
      type: 'GET',
      data: {
        id: idInsumo,
        nombre: nombre,
        marca: marca,
        proveedor: proveedor,
        unidades: unidades,
        compra: compra,
        venta: venta,
        cantMedida: cantMedida,
        medida: medida
      },
      success: function(data){
        $("#"+idInsumo).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(marca);
          }else if(indextd == 3){
            $(this).text(proveedores[proveedor]);
          }else if(indextd == 4){
            $(this).text(unidades);
          }else if(indextd == 5){
            $(this).text(compra);
          }else if(indextd == 6){
            $(this).text(venta);
          }else if(indextd == 7){
            $(this).text(cantMedida);
          }
        });
      },
      error: function(data){
        alert('Error al modificar insumo');
      }
    });
  }

  function eliminar(idInsumo){
    if(confirm('¿Desea eliminar este insumo?')){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          id: idInsumo
        },
        success: function(){
            $("#"+idInsumo).remove();
        },
        error: function(data){
          alert('No se puede eliminar el insumo, porque es ingrediente de un producto.');
        }
      });
    }
  }
</script>
