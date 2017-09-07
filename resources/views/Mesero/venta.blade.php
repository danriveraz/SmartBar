@extends('Layout.app_empleado')
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
{!!Html::style('stylesheets\mesero.css')!!}


<div class="col-sm-offset-2 col-sm-8">

  <a href="{{ route('mesero.index') }}" id="botonAtras" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Atras</a>

  <div class="panel-tittle" align="center" style ="text-transform: uppercase;">
      <h3><B>{{$mesa->nombreMesa}}</B></h3>
  </div>

  <div id="message">
    @if(Session::has('error_msg'))
      <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{Session::get('error_msg')}}
      </div>
    @endif
   </div>

  <div class="bs-example" id="contenedor" style="height: calc({{sizeOf($categorias)}} * 61px);">
      <div id="contenedorCategorias">
          @foreach($categorias as $categoria)
          <a href="#tabProductos{{$categoria->id}}" onclick="scrollZero()" data-toggle="tab" >
            <div id="categoria">
                  {{$categoria->nombre}}
            </div>
          </a>
          @endforeach
      </div>
      <div id="contenedorProductos">
          <div class="tab-content" id="productos">
            @foreach($categorias as $categoria)
              <div class="tab-pane" id="tabProductos{{$categoria->id}}">
                <table class="table table-striped" id="tablaProductos">
                  <thead>
                    @if($obsequiar == 1)
                    <th width="300px">Nombre</th>
          					<th width="150px">Detalles</th>
          					<th width="150px">Valor unitario</th>
                    <th width="100px">Obsequiar</th>
                    @else
                    <th width="250px">Nombre</th>
          					<th width="150px">Detalles</th>
          					<th width="150px">Valor unitario</th>
                    <th style="display: none;">Obsequiar</th>
                    @endif
                   </thead>
                   <tbody style="height: calc({{sizeOf($categorias)}} * 49px);">
                    @foreach($categoria->productos as $producto)
                      @if($obsequiar == 1)
                      <tr>
                        <td width="300px" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)">{{$producto->nombre}}</td>
                        <td width="150px">
                          <a class="btn btn btn-primary popover-trigger" data-html="true" data-content=
                          "<div>
                            <strong>Ingredientes:</strong>
                            @foreach($producto->contienen as $contiene)
                              <li>{{$contiene->insumo->nombre}}</li>
                            @endforeach
                            <strong>Receta:</strong>
                            <p>{{$producto->receta}}</p>
                          </div>"
                          data-placement="bottom" data-toggle="popover" >Receta</a>
                        </td>
                        <td width="150px" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)">{{$producto->precio}}</td>
                        <td width="100px">
                          <button class="btn btn-info" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 1)" >
                            <span class="glyphicon glyphicon-gift"></span>
                          </button>
                        </td>
                      </tr>
                      @else
                      <tr>
                        <td width="250px" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)">{{$producto->nombre}}</td>
                        <td width="150px">
                          <a class="btn btn btn-primary popover-trigger" data-html="true" data-content="
                          <div>
                            <strong>Ingredientes:</strong>
                            @foreach($producto->contienen as $contiene)
                              <li>{{$contiene->insumo->nombre}}</li>
                            @endforeach
                            <strong>Receta:</strong>
                            <p>{{$producto->receta}}</p>
                          </div>"
                          data-placement="bottom" data-toggle="popover">Receta</a>
                        </td>
                        <td width="150px" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)">{{$producto->precio}}</td>
                        <td style="display: none;">
                          <button class="btn btn-info" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 1)">
                            <span class="glyphicon glyphicon-gift"></span>
                          </button>
                        </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endforeach
          </div>
      </div>
  </div>

  <div class="panel-tittle" align="center" style ="text-transform: uppercase;">
      <h3><B>Pedido</B></h3>
  </div>

  @if(sizeOf($ventas) != 0)
    <table class="table table-striped" id="pedidoTabla" style="display: table; margin-top: 10px; margin-bottom: 30px;">
        <thead>
          <th style="display: none;">#</th>
          <th width="20px" style="display: none;">Cant.</th>
          <th width="150px" style="display: none;">Nombre</th>
          <th width="50px" style="display: none;">Valor unitario</th>
          <th width="100px" style="display: none;">Total</th>
        </thead>
        <tbody>

            @foreach($ventas as $venta)
              @if($venta->obsequio == 0)
                <tr id="p{{$venta->producto->id}}">
                  <td style="display: none;">{{$venta->producto->id}}</td>
                  <td id="c{{$venta->producto->id}}" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->cantidad}}</td>
                  <td onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->producto->nombre}}</td>
                  <td id="v{{$venta->producto->id}}" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->producto->precio}}</td>
                  <td id="t{{$venta->producto->id}}" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->producto->precio * $venta->cantidad}}</td>
                </tr>
              @else
                <tr id="p{{$venta->producto->id}}1">
                  <td style="display: none;" >{{$venta->producto->id}}</td>
                  <td id="c{{$venta->producto->id}}1" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->cantidad}}</td>
                  <td onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->producto->nombre}}</td>
                  <td id="v{{$venta->producto->id}}1" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">{{$venta->producto->precio}}</td>
                  <td id="t{{$venta->producto->id}}1" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})">Obsequio</td>
                </tr>
              @endif
            @endforeach
        </tbody>
    </table>
  @else
    <table class="table table-striped" id="pedidoTabla" style="display: none; margin-top: 10px; margin-bottom: 30px;">
        <thead>
          <th style="display: none;">#</th>
          <th width="20px" style="display: none;">Cant.</th>
          <th width="150px" style="display: none;">Nombre</th>
          <th width="50px" style="display: none;">Valor unitario</th>
          <th width="100px" style="display: none;">Total</th>
        </thead>
        <tbody>
        </tbody>
    </table>
  @endif

  <button onclick="enviarDatos({{$factura->id}}, {{$mesa->id}})" id="botonEnviar" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i> Ordenar</button>

</div>



{!!Html::script('javascripts\mesero.js')!!}

{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}


@endsection
