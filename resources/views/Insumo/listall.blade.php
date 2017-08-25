<table class="table table-striped">
    <thead>
      <th>Unid</th>
      <th>Nombre</th>
      <th>Marca</th>
      <th>Proveedor</th>
      <th>Compra</th>
      <th>Venta</th>
      <th>Disponible</th>
      <th>Medida</th>
      <th width="20"></th>
      <th width="20"></th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr id="{{$insumo->id}}">
          <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->cantidadUnidad}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->nombre}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->marca}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{{$proveedores[$insumo->idProveedor]}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->valorCompra}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->precioUnidad}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{{number_format($insumo->cantidadMedida,3)}}</td>
          <td id="{{$insumo->id}}" class="seleccionar">{!! Form::select('medida', ['0'=>'oz','1'=>'unidad'], $insumo->medida, ['class'=>'form-control', 'disabled'=>'disabled', 'id'=>'filaMedida'.$insumo->id]) !!}</td>
          <td id="{{$insumo->id}}" class="seleccionar">
            <span  id="span{{$insumo->id}}" aria-hidden="true" 
              <?php if($insumo->tipo == "1") echo "class='glyphicon glyphicon-ok'" ;?>
              <?php if($insumo->tipo == "0") echo "class='glyphicon glyphicon-remove'" ;?>
            ></span>
          </td>
          <td>
            <button class="btn btn-default" onclick="eliminar({{$insumo->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
                      <label for="valorCompra" class="control-label">Costo</label>
                      <input type="number" id="compra{{$insumo->id}}" step="any" min="0" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}" onkeypress="autocompletar(event,this)"/>
                    </div>
                    <div class="form-group">
                      <label for="precioUnidad" class="control-label">Venta</label>
                      <input type="number" id="venta{{$insumo->id}}" step="any" min="0" name="precioUnidad" class="form-control" value="{{$insumo->precioUnidad}}" onkeypress="autocompletar(event,this)"/>
                    </div>
                    <div class="form-group">
                      <label id="label{{$insumo->id}}" for="cantidadMedida" class="control-label"><?php if($insumo->medida == "0"){echo "Contenido";}else{echo "Cantidad";} ?></label>
                      <input type="number" id="cantMedida{{$insumo->id}}" min="0" step="any" name="cantidadMedida" class="form-control" value="{{$insumo->cantidadMedida}}"/>
                      <select name="medida" id="medida{{$insumo->id}}" class="form-control" onchange="editValor(this.value,{{$insumo->id}});"> 
                        <option value="2">ml</option> 
                        <option value="3">cm3</option> 
                        <option value="0" <?php if($insumo->medida =="0") echo "selected";?>>oz</option>
                        <option value="1" <?php if($insumo->medida =="1") echo "selected";?>>unidad</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="cantidadUnidad" class="control-label">Cantidad</label>
                      <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" class="form-control" value="{{$insumo->cantidadUnidad}}" <?php if($insumo->medida == "1") echo'style="display:none;"' ?>/>
                    </div>
                    <div class="form-group">
                      <label for="tipo" class="control-label">¿Vender en botella?</label>
                      <label> &ensp;&ensp;&ensp;&ensp;<input type="checkbox" name="tipo" id="tipo{{$insumo->id}}" <?php if($insumo->tipo == "1") echo "checked";?> onchange="showContent({{$insumo->id}})" /><span></span></label>
                    </div>
                    <div id="content{{$insumo->id}}" <?php if($insumo->tipo == "0") echo "hidden";?>>
                      <label for="categorias" class="control-label">Categor&iacutea</label>
                      {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'id'=>'categoria'.$insumo->id]) !!}
                    </div>
                    <br>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$insumo->id}},{{$proveedores}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                
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
  var routeEliminar = "http://pocketdesigner.co/PocketByR/public/insumo/eliminar";

  var editValor = function(x,id){
    if(x == '1'){
      document.getElementById('unidades'+id).style.display='none';
      document.getElementById('unidades'+id).value = 1;
      $("#label"+id).text('Cantidad');
     }else{

      document.getElementById('unidades'+id).style.display='block';
      $("#label"+id).text('Contenido');
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
    var check = document.getElementById("tipo"+idInsumo);
    var categoria = $("#categoria"+idInsumo).val();
    var tipo = '0';

    if(check.checked){
      tipo = '1';
    }

    if(marca==''){
      marca = 'Sin marca';
    }

    if(medida == '2' || medida == '3'){
      var cantidad = parseFloat(cantMedida)/30;
      cantMedida = cantidad;
      medida = '0';
    }
    else if(medida == '1'){
      unidades = 1;
    }
    else{
      medida = '0';
    }

    cantMedida = parseFloat(cantMedida).toFixed(3);

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
        medida: medida,
        tipo: tipo,
        categoria: categoria
      },
      success: function(){
        if(tipo == '1'){
          document.getElementById('span'+idInsumo).className = "glyphicon glyphicon-ok";
        }else{
          document.getElementById('span'+idInsumo).className = "glyphicon glyphicon-remove";
        }        
        $("#"+idInsumo).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(marca);
          }else if(indextd == 3){
            $(this).text(proveedores[proveedor]);
          }else if(indextd == 0){
            $(this).text(unidades);
          }else if(indextd == 4){
            $(this).text(compra);
          }else if(indextd == 5){
            $(this).text(venta);
          }else if(indextd == 6){
            $(this).text(cantMedida);
          }
        });
        $("#filaMedida"+idInsumo).val(medida);
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
  $(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    var palabra = "#editModal";
    var id = palabra.concat(idElegido);
    $(id).modal();
  });
</script>
