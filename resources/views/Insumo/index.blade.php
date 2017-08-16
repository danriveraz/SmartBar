@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle" align="center">
      <h3>INVENTARIO</h3>
  </div>
  @include('flash::message')

  <a href="#addModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Nuevo insumo </a>
  <div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">

        {!! Form::open(['method' => 'POST', 'action' => 'InsumoController@store']) !!}

          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">

          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>

            <h4 class="modal-title">Nuevo Insumo</h4> 
          </div>
          <div class="modal-body">
              <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Atencion!</strong> Para un mejor control, se recomienda a&ntildeadir productos como limones o cerezas en unidad.
              </div>
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-group">
                    
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" placeholder="Nombre" required="true"/>
                </div>
              </div>
              <div class="form-group">
                    
                    <input type="text" name="marca" class="form-control" placeholder="Marca del insumo" placeholder="Marca"/>
                </div>
                <div class="form-group">
                    <label for="idProveedor" class="control-label">Proveedor</label>
                    {!! Form::select('proveedores', $proveedores, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    
                    <input type="number" min="0" name="cantidadUnidad" id="cantidadUnidad" class="form-control" required="false" placeholder="Cantidad">
                </div>
                <div class="form-group">
                    
                    <input type="number" step="any" min="0" name="valorCompra" class="form-control" required="true" placeholder="Costo" onkeypress="autocompletar(event,this)">
                </div>
                <div class="form-group">
                    
                    <input type="number" step="any" min="0" name="precioUnidad" class="form-control" required="true" placeholder="Venta" onkeypress="autocompletar(event,this)">
                </div>
                <div class="form-group">
                    
                    <input type="number" step="any" min="0" name="cantidadMedida" placeholde="Contenido"class="form-control" required="true" />
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
                    <label for="tipo" class="control-label">¿Vender por botella?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
          <option value="">Buscar por</option>
          <option value="1">A la venta</option> 
          <option value="0">Se venden en botella</option>
          <option value="0">Marca</option> 
          <option value="0">Proveedor</option> 
          <option value="0">Nuevos</option> 
          <option value="0">Mayor rotación</option> 
          <option value="0">Menor rotación</option> 
          <option value="0">Mayores unidades</option> 
          <option value="0">Menores unidades</option> 

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
    cambiarCurrent("#insumos");
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

  function autocompletar(e,element){
    if(e.which == 32){
      var valor = element.value*1000;
      element.value = valor;
    }
  }  

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
function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};
</script>

@endsection
