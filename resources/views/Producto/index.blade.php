@extends('Layout.app_administradores')
@section('content')

<div class="container main-content">
        <div class="page-title"> <p>
        </p> </div>
        <!-- DataTables Example -->
        <div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="widget-content padded clearfix">
        <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
              <th width="10%">Nombre</th>
              <th width="10%">Precio</th>
              <th width="18%">Categoria</th>
              <th width="4%">Opciones</th>
            </thead>
            <tbody>
              @foreach($productos as $producto)
                <tr id="{{$producto->id}}">
                  <td id="{{$producto->id}}" class="seleccionar">{{$producto->nombre}}</td>
                  <td id="{{$producto->id}}" class="seleccionar">{{$producto->precio}}</td>
                  <td id="{{$producto->id}}" class="seleccionar">{{$categorias[$producto->idCategoria]}}</td>
                  <td>
                    <div>
                      <a class="table-actions pocketMorado" href="">
                        <i class="fa fa-book" data-toggle="modal" href="#myModal"  title="Preparación"></i>
                      </a>
                      <a class="table-actions pocketMorado" href="">
                        <i class="fa fa-pencil" title="Editar"></i>
                      </a>
                      <a class="table-actions pocketMorado" href="">
                        <i class="fa fa-trash-o" title="Eliminar"></i>
                      </a>
                      <a class="table-actions pocketMorado" href="">
                        <i class="fa fa-500px" title="Tienda"></i>
                      </a>
                        
                        </div>
                  </td>
                </tr>
                <!--Modal para editar -->
              <div class="modal fade" id="editModal{{$producto->id}}" role="dialog">
                <div class=" modal-body">
                  <div class="" style="background-color:#FFFFFF">
                    <div class="modal-header">
                      <button aria-hidden="true" class=" close " data-dismiss="modal" type="button">&times;</button>
                       <h4 class="modal-title text-center">
                         Editar Producto
                       </h4>
                      </div>
                    <div class="modal-body">
                    <!-- Login Screen -->
                    <div class="row">
                      <div class="widget-content padded">
                        {!! Form::open() !!}
                          <fieldset>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="bs-example">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>   
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="/examples/images/slide1.png" alt="First Slide">
                                        </div>
                                        <div class="item">
                                            <img src="/examples/images/slide2.png" alt="Second Slide">
                                        </div>
                                        <div class="item">
                                            <img src="/examples/images/slide3.png" alt="Third Slide">
                                        </div>
                                    </div>
                                    <!-- Carousel controls 
                                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                    -->
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4 ">
                                  <div class=" bs-example">
                                    
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class=" bs-example">
                                    
                                  </div>
                                  <div class="modal-footer" style="text-align: center;">
                                    <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$producto->id}},{{$categorias}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >
                                    Guardar
                                    </button>
                                  </div>                
                                </div> 
                              </div>
                            </fieldset>
                          {!! Form::close() !!} 
                        </div>
                      </div>
                      <!-- End Login Screen -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- fin de modal para editar-->  
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  {!!$productos->appends(Request::all())->render() !!}
        <!-- end DataTables Example -->

        <!-- inicio cambios pocket -->
  <div class="style-selector" >
      <div class="style-selector-container">
    <!-- inidio de slider de agregar usuario -->
        <div class="row">
          <div class="">
            <div class="">
              <div class="heading">
                <i class="fa fa-shield"></i>&nbsp;Nuevo Producto</div>
              <div class="widget-content padded">
                {!! Form::open(['method' => 'POST', 'action' => 'ProductoController@store']) !!}
                  <fieldset>
                    <div class="row">
                      <div class="col-md-4">
                      <div class="bs-example">
                          <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <!-- Carousel indicators -->
                              <ol class="carousel-indicators">
                                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                  <li data-target="#myCarousel" data-slide-to="1"></li>
                                  <li data-target="#myCarousel" data-slide-to="2"></li>
                              </ol>   
                              <!-- Wrapper for carousel items -->
                              <div class="carousel-inner">
                                  <div class="item active">
                                      <img src="/examples/images/slide1.png" alt="First Slide">
                                  </div>
                                  <div class="item">
                                      <img src="/examples/images/slide2.png" alt="Second Slide">
                                  </div>
                                  <div class="item">
                                      <img src="/examples/images/slide3.png" alt="Third Slide">
                                  </div>
                              </div>
                              <!-- Carousel controls 
                              <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                                  <span class="glyphicon glyphicon-chevron-left"></span>
                              </a>
                              <a class="carousel-control right" href="#myCarousel" data-slide="next">
                                  <span class="glyphicon glyphicon-chevron-right"></span>
                              </a>
                              -->
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 ">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <input type="text" name="nombre" class="form-control" placeholder="Nombre" placeholder="Nombre" required="true"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="number" name="precio" class="form-control" placeholder="Precio"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-list"></i></span>
                          {!! Form::select('categorias', $categorias, null, ['class' => 'select2able', 'placeholder' => 'Categorias', 'required' => 'true']) !!}
                        </div>
                      </div>
                    </div>
                    <div  class="text-center">
                      <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >
                          Guardar
                      </button>
                    </div>      
                  </div> 
                </div>
              </fieldset>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- fin de slider de agregar usuario -->
    <div class="style-toggle closed">
      <span aria-hidden="true" class="pocketMorado fa fa-fw fa-plus-circle"></span>
    </div>
  </div>
</div>  
<!-- fin cambios pocket -->
      </div>
    </div>

<script>
  var routeModificar = "http://localhost/PocketByR/public//producto/modificar";
  var routeEliminar = "http://localhost/PocketByR/public//producto/eliminar";

  var editarValor = function(x, idProducto){
    var p = 0;
    cats = eval(<?php echo json_encode($cats);?>);
    for (var i=0; i< cats.length; i++){   
      if(x == cats[i].id){
        p = cats[i].precio;
      }   
    }
    document.getElementById("nPrecio"+idProducto).value = p;
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
          if(indextd == 0){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(categorias[categoria]);
          }else if(indextd == 1){
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
  $(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    var palabra = "#editModal";
    var id = palabra.concat(idElegido);
    $(id).modal();
});
</script>  

<script type="text/javascript">
  
  $(document).ready(function(){
    listprov();
    cambiarCurrent("#miCarta");
    var p = 0;
    cats = eval(<?php echo json_encode($cats);?>);
    p = cats[0].precio;
    document.getElementById('precio').value=p;

    $("#nombreInput").keyup(function(e){
        e.preventDefault();
        var dato = $("#nombreInput").val();
        var url = "prodlistall?nombre=";
        var cat = $("#buscarCategoria").val();
        var urlf = url+dato+'&categorias='+cat;
        sleep(100);
        $.ajax({
          type:'get',
          url:urlf,
          success: function(data){
            $("#list-prod").empty().html(data);
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

  $(document).on("change", '#buscarCategoria',function(e){
    e.preventDefault();
        var dato = $("#nombreInput").val();
        var url = "prodlistall?nombre=";
        var cat = $("#buscarCategoria").val();
        var urlf = url+dato+'&categorias='+cat;
        sleep(100);
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