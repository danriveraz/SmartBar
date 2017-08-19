@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle" align="center">
      <h3><B>MIS PROVEEDORES</B></h3>
  </div>
  @include('flash::message')
  <form class="navbar-form navbar-left">
    <div class="form-group" align="left">
        <a href="#addModal" class="btn btn-default" data-toggle="modal">
            <i class="fa fa-plus"></i> Nuevo proveedor &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; 
        </a>
    </div>
  </form >
  <div id="busqueda" name="busqueda" class="navbar-form navbar-right">
    <div class="form-group" align="right">
      <div class="icon-addon addon-md">
          <input  id="nombreInput" type="text" size="40" maxlength="30" placeholder="Buscar..." class="form-control" />
          <label for="nombreInput" class="glyphicon glyphicon-search" rel="tooltip" title="nombreInput"></label>
      </div>
    </div>
  </div>

  <div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['method' => 'POST', 'action' => 'ProveedorController@store']) !!}
          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Nuevo proveedor
            </h4>
          </div>
          <div class="modal-body">
            <div class="" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del proveedor" required="true"/>
                </div>
                <div class="form-group">
                    <input type="text" name="direccion" placeholder="Dirección" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <input type="text" name="telefono" placeholder="Teléfono" class="form-control" value="(+57)" required="true">
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

  <div class="panel-body">
      <div id="list-prov"></div>
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    listprov();
    cambiarCurrent("#proveedor");
    $("#nombreInput").keyup(function(e){
        var dato = $("#nombreInput").val();
        var url = "provlistall?nombre=";
        var urlf = url+dato;
        sleep(100);
        $.ajax({
          type:'get',
          url:urlf,
          success: function(data){
            $("#list-prov").empty().html(data);
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
  
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax({
      type:'get',
      url:url,
      success: function(data){
        $("#list-prov").empty().html(data);
      }
    });
  });

  var listprov = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('provlistall')}}',
      success:  function(data){
        $("#list-prov").empty().html(data);
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
