@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle" align="center">
      <h3><b>MI INVENTARIO</b></h3>
  </div>
  @include('flash::message')
  <form class="navbar-form navbar-left">
    <div class="form-group" align="left">
        <a href="#addModal" class="btn btn-default" data-toggle="modal">
            <i class="fa fa-plus"></i> Nuevo insumo &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; 
        </a>
    </div>
  </form >
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
                    {!! Form::select('proveedores', $proveedores, null, ['class' => 'form-control', 'placeholder' => 'Proveedor', 'required' => 'true']) !!}
                </div>
                <div class="form-group">
                    <input type="number" step="any" min="0" name="valorCompra" class="form-control" required="true" placeholder="Costo" onkeypress="autocompletar(event,this)">
                </div>
                <div class="form-group">
                    
                    <input type="number" step="any" min="0" name="precioUnidad" class="form-control" required="true" placeholder="Venta" onkeypress="autocompletar(event,this)">
                </div>
                <div class="form-group">
                    <input type="number" step="any" min="0" id="cantidadMedida" name="cantidadMedida" placeholder="Contenido" class="form-control" required="true" />
                    <select name="medida" class="form-control" onchange="valor(this.value);"> 
                        <option value="ml">ml</option> 
                        <option value="cm3">cm3</option> 
                        <option value="oz">oz</option>
                        <option value="unidad">unidad</option>
                    </select>
                </div>
                <div class="form-group"> 
                    <input type="number" min="0" name="cantidadUnidad" id="cantidadUnidad" class="form-control" required="false" placeholder="Cantidad" >
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
  <div id="busqueda" name="busqueda" class="navbar-form navbar-right">
    <div class="form-group" align="right">
      <div class="icon-addon addon-md">
          <input  id="nombreInput" type="text" size="40" maxlength="30" placeholder="Buscar..." class="form-control" />
          <label for="nombreInput" class="glyphicon glyphicon-search" rel="tooltip" title="nombreInput"></label>
      </div>
    </div>
    <br>
    <br>
    <div align="right">
      <select id="buscarTipo" name="buscarTipo" class="form-control">
        <option value="">Buscar por</option>
        <option value="1">A la venta</option>
        <option value="0">No a la venta</option> 
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
   <div class="panel-body">
      <div id="list-ins"></div>
   </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    listprov();
    cambiarCurrent("#insumos");
    $("#nombreInput").keyup(function(e){
        var dato = $("#nombreInput").val();
        var url = "inslistall?nombre=";
        var tipo = $("#buscarTipo").val();
        var urlf = url+dato+'&tipo='+tipo;
        sleep(50);
        $.ajax({
          type:'get',
          url:urlf,
          success: function(data){
            $("#list-ins").empty().html(data);
          }
        });
    });
  });

  function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
      if ((new Date().getTime() - start) > milliseconds){
        break;
      }
    }
  }

  var valor = function(x){
        if(x == 'unidad'){
          document.getElementById('cantidadUnidad').style.display='none';
          document.getElementById('cantidadUnidad').value = 1;
          document.getElementById('cantidadMedida').placeholder ="Cantidad";
        }else{
          document.getElementById('cantidadUnidad').style.display='block';
          document.getElementById('cantidadUnidad').value = null;
          document.getElementById('cantidadMedida').placeholder ="Contenido";
        }
  };

  function autocompletar(e,element){
    if(e.which == 32){
      var valor = element.value*1000;
      element.value = valor;
    }
  }  

  $(document).on("change", '#buscarTipo',function(e){
    e.preventDefault();
    var dato = $("#nombreInput").val();
    var tipo = $("#buscarTipo").val();
    var url = "inslistall?nombre=";
    var urlf = url+dato+'&tipo='+tipo;
    sleep(50);
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
<style>
    .center-block {
        float: none;
        margin-left: auto;
        margin-right: auto;
    }
    
    .input-group .icon-addon .form-control {
        border-radius: 0;
    }
    
    .icon-addon {
        position: relative;
        color: rgb(79,0,85);
        display: block;
    }
    
    .icon-addon:after,
    .icon-addon:before {
        display: table;
        content: " ";
    }
    
    .icon-addon:after {
        clear: both;
    }
    
    .icon-addon.addon-md .glyphicon,
    .icon-addon .glyphicon, 
    .icon-addon.addon-md .fa,
    .icon-addon .fa {
        position: absolute;
        z-index: 2;
        left: 10px;
        font-size: 14px;
        width: 20px;
        margin-left: -2.5px;
        text-align: center;
        padding: 10px 0;
        top: 1px
    }
    
    .icon-addon.addon-lg .form-control {
        line-height: 1.33;
        height: 46px;
        font-size: 18px;
        padding: 10px 16px 10px 40px;
    }
    
    .icon-addon.addon-sm .form-control {
        height: 30px;
        padding: 5px 10px 5px 28px;
        font-size: 12px;
        line-height: 1.5;
    }
    
    .icon-addon.addon-lg .fa,
    .icon-addon.addon-lg .glyphicon {
        font-size: 18px;
        margin-left: 0;
        left: 11px;
        top: 4px;
    }
    
    .icon-addon.addon-md .form-control,
    .icon-addon .form-control {
        padding-left: 30px;
        float: left;
        font-weight: normal;
    }
    
    .icon-addon.addon-sm .fa,
    .icon-addon.addon-sm .glyphicon {
        margin-left: 0;
        font-size: 12px;
        left: 5px;
        top: -1px
    }
    
    .icon-addon .form-control:focus + .glyphicon,
    .icon-addon:hover .glyphicon,
    .icon-addon .form-control:focus + .fa,
    .icon-addon:hover .fa {
        color: rgb(79,0,85);
    }
  </style>

@endsection
