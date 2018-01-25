@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')

<div class="container main-content">
  <div class="page-title"></div>
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="widget-content padded clearfix">
          <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
              <th width="10%">Nombre</th>
              <th width="4%">Opciones</th>
            </thead>
            <tbody>
              @foreach($productos as $producto)
                <tr id="{{$producto->id}}">
                  <td id="{{$producto->id}}" class="seleccionar">{{$producto->nombre}}</td>
                  <td>
                    <div>
                      <a class="table-actions pocketMorado" href="">
                        <i class="fa fa-book" data-toggle="modal" href="#modalReceta{{$producto->id}}"  title="Preparación"  onclick="ingredientes({{$producto->id}})"></i>
                      </a>
                      <a class="table-actions pocketMorado" href="{{route('producto.contenido', $producto->id)}}">
                        <i class="fa fa-pencil" title="Editar"></i>
                      </a>
                      <a class="table-actions pocketMorado" href="" onclick="eliminar({{$producto->id}})">
                        <i class="fa fa-trash-o" title="Eliminar"></i>
                      </a>
                    </div>
                  </td>
                  <div class="modal fade" id="modalReceta{{$producto->id}}">
                    <div class="dialog1 modal-dialog">
                      <div class="col-lg-12" style="background-color:#FFFFFF">
                        <div class="modal-header">
                          <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                          <h4 class="modal-title text-center">Preparación</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="widget-content ">
                              <form action="" id="validate-form" method="get">
                                <fieldset>
                                  <div class="row">
                                    <div class="col-md-5">                 
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
                                              <img src="images/bar.png" alt="First Slide">
                                            </div>
                                            <div class="item">
                                              <img src="images/slider-recetas/Alexander.png" alt="Second Slide">
                                            </div>
                                            <div class="item">
                                              <img src="images/slider-recetas/Bacardi Red.png" alt="Third Slide">
                                            </div>
                                          </div>
                                          <!-- Carousel controls 
                                          <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                          </a>
                                          <a class="carousel-control right" href="#myCarousel" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                          </a> -->
                                        </div>
                                      </div>
                                    </div>
                                    <!-- segunda columna-->
                                    <div class="col-md-7">
                                      <div class=" bs-example">
                                        <h3><a class="pocketMorado">{{$producto->nombre}}</a></h3>
                                        <div class="true"  id="ingredientes{{$producto->id}}">
                                          
                                        </div>
                                        <div class="">
                                          <strong><a class="pocketMorado">Elaboración</a><br></strong>
                                            {{$producto->receta}}<br>
                                          <a class="pocketMorado"><b>Copa o Vaso:</b> Margarita</a><br>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- fin de segunda columna-->
                                  </div>
                                </fieldset>
                              </form>
                            </div>
                          </div>
                          <!-- End modal producto -->
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>                
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
        <div class="style-toggle1">
          <a class="table-actions pocketMorado" href="{{route('producto.contenido', 0)}}">
            <span class="pocketMorado fa fa-fw fa-plus-circle"></span>
          </a>
        </div>
      </div>
    </div>
  <!-- fin cambios pocket -->
</div>
						</tbody>
					</table>
			  </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var routeIngredientes = "http://localhost/PocketByR/public/producto/ingredientes";

  function ingredientes(idProducto){
    if(document.getElementById("ingredientes"+idProducto).className == "true"){
      $.ajax({
        url: routeIngredientes,
        type: 'GET',
        data: {
          id: idProducto
        },
        success: function(data){
          var contiene = $.parseJSON(data);
          var lista = "";
          for (var i = 0; i < contiene.length; i++) {
            lista += '<i class="padded5 fa fa-caret-right"></i><a class="padded pocketMorado">'
                  + contiene[i][0]
                  + ' oz de '
                  + contiene[i][1]
                  + '</a><br>';
          }
          lista += '<br>';
          $("#ingredientes"+idProducto).before(lista);
          document.getElementById("ingredientes"+idProducto).className = "false";
        },
        error: function(data){
          
        }
      });
    }
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
  </style><style>
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