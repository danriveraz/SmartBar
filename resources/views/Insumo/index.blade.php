@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Lista de insumos</h1>
  </div>
  @include('flash::message')

  <a href="#addModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Agregar nuevo insumo </a>
  <div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">

        {!! Form::open(['method' => 'POST', 'action' => 'InsumoController@store']) !!}

          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">

          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>

            <h4 class="modal-title">
            Registro
            </h4>
          </div>
          <div class="modal-body">
              <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Atencion!</strong> Para el manejo de insumos como cerezas o limones se deben ingresar las unidades disponibles para así tener una mejor experiencia. Para ello la opción disponible es unidad.
              </div>
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" required="true"/>
                </div>
              </div>
              <div class="form-group">
                    <label for="marca" class="control-label">Marca</label>
                    <input type="text" name="marca" class="form-control" placeholder="Marca del insumo" />
                </div>
                <div class="form-group">
                    <label for="idProveedor" class="control-label">Proveedor</label>
                    {!! Form::select('proveedores', $proveedores, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="cantidadUnidad" class="control-label">Cantidad</label>
                    <input type="number" min="0" name="cantidadUnidad" id="cantidadUnidad" class="form-control" required="false">
                </div>
                <div class="form-group">
                    <label for="valorCompra" class="control-label">Valor de compra</label>
                    <input type="number" step="any" min="0" name="valorCompra" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="precioUnidad" class="control-label">Valor de venta</label>
                    <input type="number" step="any" min="0" name="precioUnidad" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
                    <input type="number" step="any" min="0" name="cantidadMedida" class="form-control" required="true"/>
                    <select name="medida" class="form-control" onchange="valor(this.value);"> 
                        <option value="ml">ml</option> 
                        <option value="cm3">cm3</option> 
                        <option value="oz">oz</option>
                        <option value="unidad">unidad</option>
                    </select>
                </div>
                <script type="text/javascript">
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
                </script>
                <div class="form-group">
                    <label for="tipo" class="control-label">Vender como producto?</label>
                    <label> <input type="checkbox" name="tipo" id="tipo" value="1" onchange="javascript:showContent()"/><span></span></label>
                </div>
                <div id="content" style="display: none;">
                    <label for="categorias" class="control-label">Categoría</label>
                    {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
                </div>
                <br>
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
            <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
          </div>
        {!! Form::close() !!}
 
    </div>
   </div>
  </div>
  <form id="busqueda" name="busqueda" class="navbar-form navbar-right" method="GET" 
  route="Insumo.listall">
    {{csrf_field()}}
    <div class="form-group" align="right">
      <input  id="nombreInput" type="text" name="nombreInput" class="form-control" aria-describedby="search"/>
      <button  href="inslistall?nombre=" id="buscarNombre" type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
      <div align="right">
        <select id="buscarTipo" name="buscarTipo" class="form-control">
          <option value="">Seleccione un tipo</option>
          <option value="1">A la venta</option> 
          <option value="0">No a la venta</option>   
        </select>
      </div>
    </div>
   </form>
   <div class="panel-body">
      <div id="list-ins"></div>
   </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    listprov();
  });

  var valor = function(x){
        if(x == 'unidad'){
          document.getElementById('cantidadUnidad').disabled=true;
          document.getElementById('cantidadUnidad').value = 1;
        }else{
          document.getElementById('cantidadUnidad').disabled=false;
          document.getElementById('cantidadUnidad').value = null;
        }
  };

  $(document).on("click", '#buscarNombre',function(e){
    e.preventDefault();
    var dato = $("#nombreInput").val();
    var tipo = $("#buscarTipo").val();
    var url = $(this).attr("href");
    var urlf = url+dato+'&tipo='+tipo;
    $.ajax({
      type:'get',
      url:urlf,
      success: function(data){
        $("#list-ins").empty().html(data);
      }
    });
  });

  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax({
      type:'get',
      url:url,
      success: function(data){
        $("#list-ins").empty().html(data);
      }
    });
  });

  var listprov = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('inslistall')}}',
      success:  function(data){
        $('#list-ins').empty().html(data);
      }
    });
  }

</script>

@endsection
