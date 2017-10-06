@extends('Layout.app')
@section('content')
<div class="container main-content">
  <div class="page-title">
    <h2 class="">
      <B> Mi Inventario </B>
    </h2>
  </div>
  @include('flash::message')
  <!-- <div id="busqueda" name="busqueda" class="navbar-form navbar-right">
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
      </select>
    </div>
  </div>-->

   <div class="panel-body">
      <div id="list-ins"></div>
   </div>

  <!-- inicio cambios pocket -->
  <div class="style-selector" >
      <div class="style-selector-container">
    <!-- inidio de slider de agregar usuario -->
        <div class="row">
          <div class="">
            <div class="">
              <div class="heading">
                <i class="fa fa-shield"></i>&nbsp;Nuevo Insumo</div>
              <div class="widget-content padded">
                {!! Form::open(['method' => 'POST', 'action' => 'InsumoController@store']) !!}
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
                          <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                          <input type="text" name="marca" class="form-control" placeholder="Marca" placeholder="Marca"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-500px"></i></span>
                          {!! Form::select('proveedores', $proveedores, null, ['class' => 'select2able', 'placeholder' => 'Proveedor', 'required' => 'true']) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="number" step="any" min="0" name="valorCompra" class="form-control" required="true" placeholder="Costo" onkeyup="autocompletar(event,this,0)">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tipo" class="control-label"> ¿Vender por botella?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <label> 
                        <input type="checkbox" name="tipo" id="stipo" value="1" onchange="showContent('')"/>
                          <span></span>
                        </label>
                      </div>
                      <div class="form-group">
                        <div id="scontent" style="display: none;">
                          <label for="categorias" class="control-label">Categoría</label>
                            {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="number" step="any" min="0" name="precioUnidad" class="form-control" required="true" placeholder="Venta" onkeyup="autocompletar(event,this,1)">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-eyedropper"></i></span>
                          <input type="number" step="any" min="0" id="cantidadMedida" name="cantidadMedida" placeholder="Contenido" class="form-control" required="true" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-hourglass-half"></i></span>
                          <select name="medida" class="select2able" onchange="valor(this.value);"> 
                            <option value="ml">ml</option> 
                            <option value="cm3">cm3</option> 
                            <option value="oz">oz</option>
                            <option value="unidad">unidad</option>
                          </select>
                        </div>
                      </div>
                      <div id="divcantidad" class="form-group">
                        <div class="input-group">
                          <span id="iconCantidad" class="input-group-addon"><i class="fa fa-superscript"></i></span>
                          <input type="number" min="0" name="cantidadUnidad" id="cantidadUnidad" class="form-control" required="false" placeholder="Cantidad" >
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

  function showContent(idInsumo) {
    element = document.getElementById("scontent"+idInsumo);
    check = document.getElementById("stipo"+idInsumo);
    if (check.checked) {
      element.style.display='block';
    }
    else {
      element.style.display='none';
    }
  }
  
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
      document.getElementById('divcantidad').style.display='none';
      document.getElementById('cantidadUnidad').value = 1;
      document.getElementById('cantidadMedida').placeholder ="Cantidad";
    }else{
      document.getElementById('divcantidad').style.display='block';
      document.getElementById('cantidadUnidad').value = null;
      document.getElementById('cantidadMedida').placeholder ="Contenido";
    }
  };

  var cont = [true,true,false,false];

  function autocompletar(e,element,index){
    var valor = parseInt(e.key);
    if(valor >= 0 && valor <= 9){
      if(element.value.length != 1 && element.value != 0){
        if(cont[index]){
          var texto = parseInt(element.value)/1000;
          element.value = parseInt(((texto + valor)*1000)-valor);
        }
      }else{
        element.value = parseInt(valor*1000);
        cont[index] = true;
      }
    }else if(e.which == 8 && cont[index]){
      element.value = parseInt(element.value)/100;
      cont[index] = false;
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

<!-- Style para el slider del registro / modificación -->
<style type="text/css">
  .carousel{
      background: #2f4357;
      margin-top: 20px;
  }
  .carousel .item{
      min-height: 280px; /* Prevent carousel from being distorted if for some reason image doesn't load */
  }
  .carousel .item img{
      margin: 0 auto; /* Align slide image horizontally center */
  }
  .bs-example{
    margin: 20px;
  }
</style>

<style type="text/css">
  ::-webkit-scrollbar { 
    display: none; 
}
#content browser {
  overflow:-moz-scrollbars-none;
 overflow:-moz-hidden-unscrollable;
}
</style>
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
