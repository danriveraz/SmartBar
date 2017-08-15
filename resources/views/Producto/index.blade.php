@extends('Layout.app')
@section('content')


<div class="col-sm-offset-2 col-sm-8">
    <div class="panel-tittle" align="center">
        <h3> MIS PRODUCTOS </h3>
    </div>
    @include('flash::message')
    <a href="#addPModal" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i>Nuevo Producto 
    </a>

    <div class="modal fade" id="addPModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['method' => 'POST', 'action' => 'ProductoController@store']) !!}
          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Nuevo Producto
            </h4>
          </div>
          <div class="modal-body">
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-grup">
                    
                    <input type="text" name="nombreProducto" class="form-control" placeholder="Nombre" required="true" />
                    </div><br>
                <div class="form-grup">
                    
                    {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'onchange' => 'mostrarValor(this.value);']) !!}
                </div><br>
                <div class="form-grup">
                    
                    <input id="precio" value="" type="number" min="0" step="any" name="precio" class="form-control" required="true" placeholder="Precio" />
                </div>
                <br>
                <div class="form-grup">
                    <label for="receta" class="control-label">Receta</label>
                    <br>
                    <textarea name="receta" class="form-control"></textarea>
                </div>
                
              </div>
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" onclick = "return confirm ('¿Está seguro de registrar el producto?')" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
            
          </div>
        {!! Form::close() !!}
      </div>
     </div>
    </div>

    <div class="modal fade" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['method' => 'POST', 'action' => 'CategoriaController@store']) !!}
          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Nueva Categoria
            </h4>
          </div>
          <div class="modal-body">
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-grup">
                    
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="true" placeholder="Nombre" />
                </div>
                <br>
                <div class="form-grup">
                    
                    <input type="number" min="0" step="any" name="precio" class="form-control" placeholder="Precio" />
                </div>
              </div>
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
    route="producto.listall">
    <div class="form-group" align="right">
      <input  id="nombreInput" type="text" name="nombreInput" class="form-control" aria-describedby="search"/>
      
      
    <div align="right">
      <br>
      {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una categoría', 'id' => 'buscarCategoria']) !!}
       <td><a href="#addModal" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(187,187,187); color:white">A&ntildeadir categor&iacutea <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a> 
       </td>
      <td><a href="{{ route('categoria.index') }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
    </div>
  </div>
  </form>
  <div class="panel-body">
      <div id="list-prod"></div>
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    listprov();
    cambiarCurrent("#productos");
  });
  
  var mostrarValor = function(x){
        var p = 0;
        cats = eval(<?php echo json_encode($cats);?>);
        for (var i=0; i< cats.length; i++)
        {
            if(x == cats[i].id){
                p = cats[i].precio;
            }   
        }
        document.getElementById('precio').value=p;
    };

  $(document).on("click", '#buscarNombre',function(e){
    e.preventDefault();
    var dato = $("#nombreInput").val();
    var cat = $("#buscarCategoria").val();
    var url = $(this).attr("href");
    var urlf = url+dato+'&categorias='+cat;
    $.ajax({
      type:'get',
      url:urlf,
      success: function(data){
        $("#list-prod").empty().html(data);
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
        $("#list-prod").empty().html(data);
      }
    });
  });

  var listprov = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('prodlistall')}}',
      success:  function(data){
        $('#list-prod').empty().html(data);
      }
    });
  }

function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};
</script>
@endsection