@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
<div class="container main-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="widget-container fluid-height clearfix">
				<div class="widget-content padded clearfix">
					<table  class="table table-bordered table-striped" id="dataTable1">
						<thead>
							<th>No.</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Mesa</th>
							<th>Mesero</th>
							<th>Bartender</th>
							<th>Cajero</th>
							<th>Total</th>
						</thead>
						<tbody>
							@foreach($facturas as $factura)
		                    	<tr data-info="{{$factura->id}}">
		                    		<td class="details-control">{{$factura->idBar}}</td>
		                    		<td class="details-control">
		                    			<?php  $date = new DateTime($factura->fecha);
                       					echo $date->format('d M Y'); ?>
									</td>
									<td class="details-control">
										<?php  $date = new DateTime($factura->fecha);
                       					echo $date->format('g:i A'); ?>
									</td>
		                    		<td class="details-control">{{$factura->mesa->nombreMesa}}</td>
		                    		<td class="details-control">{{$factura->ventasHechas[0]->mesero->nombrePersona}}</td>
		                    		<td class="details-control">{{$factura->ventasHechas[0]->bartender->nombrePersona}}</td>
		                    		<td class="details-control">{{$factura->ventasHechas[0]->cajero->nombrePersona}}</td>
		                    		<td class="details-control">
		                    			$<?php echo number_format($factura->total,0,",","."); ?>
		                    		</td>
		                    	</tr> 
	                        @endforeach
						</tbody>
					</table>
			  </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	//#32bf32
	var JSONproductos = eval(<?php echo json_encode($productos); ?>);   	

//<a class="popover-trigger" readonly value="0"  data-content="Cantidad de productos que pertenecen a esta categoría" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color: #5A5A5A;">0</a>
	function format ( d ) {
   	var datos = "";
   	var color = " style='color:black;'";
   		for(i = 0; i < JSONproductos.length; i++){
   	 		if(JSONproductos[i][0] == d){
	   			if(JSONproductos[i][4]== "Cancelado"){
	   				datos+='<tr style="text-align: center; color:red;" class="fila"><td><a class="popover-trigger" readonly  data-content="<div'+color+'>Este pedido fue cancelado</div>" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color:red;">'+JSONproductos[i][1]+'</a></td><td>'+JSONproductos[i][2] +'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3])+'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3]*JSONproductos[i][1])+'</td></tr>';
	   			}else if(JSONproductos[i][5] == 1){
	   				datos+='<tr style="text-align: center; color:#32bf32;" class="fila"><td><a class="popover-trigger" readonly  data-content="<div'+color+'>Este producto fue obsequiado</div>" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color:#32bf32;">'+JSONproductos[i][1]+'</a></td><td>'+JSONproductos[i][2] +'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3])+'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3]*JSONproductos[i][1])+'</td></tr>';
	   			}else{
	   				datos+='<tr style="text-align: center;"><td>'+JSONproductos[i][1]+'</td><td>'+JSONproductos[i][2] +'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3])+'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3]*JSONproductos[i][1])+'</td></tr>';
	   			}
   		}
   	}
    return    '<div class="col-md-6"  style="padding-left: 50px; padding-top:15px;"> <div class="heading"><i class="fa fa-tags"></i>'+
    			'Información de factura </div>'+
                '<div class="widget-content padded"><dl><div class="row">'+
				'<div class="col-md-6">'+
					'<dt>Nombre</dt><dd>Diergo Alejandro Fajardo</dd>'+
                   '<dt>Direccion</dt><dd>Calle 6 No 22-35 B/saman del norte</dd></div>'+
              	'<div class="col-md-6" style="padding-left:35px;">'+
                    '<dt>Nit</dt><dd>1116256943-9</dd><dt>Telefono</dt><dd>3012638327</dd>'+
                '</div></div><dt>Direccion</dt><dd>Calle 6 No 22-35 B/saman del norte</dd>'+
                  '</dl></div></div>'+
          	'</div><div class="col-md-6" style="padding-rigth: 25px; padding-top:25px;"><table class="table table-bordered table-striped"><thead>'+
        '<tr>'+
            '<th style="text-align: center;">Cantidad</th>'+
            '<th style="text-align: center;">Nombre</th>'+
            '<th style="text-align: center;">Unidad</th>'+
            '<th style="text-align: center;">Total</th>'+
        '</thead>'+datos +'</table></div>';

}

//</div>

$("body").on("mouseenter",".fila",function(event){
	var num = 1;
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
      if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
        $(this).find( "a" ).click();
      }else{
        $(this).find( "a" ).click();
        $(this).find( "a" ).click();
      }
});

$("body").on("mouseleave",".fila",function(event){
	var num = 2;
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
      if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
        $(this).find( "a" ).click();
      }else{
        $(this).find( "a" ).click();
        $(this).find( "a" ).click();
      }
});

$(document).ready(function() {
     
    $('#dataTable1 tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var table = $('#dataTable1').DataTable();
        var row = table.row(tr);
        //alert(tr.data("info"));
       if (tr.hasClass("shown")) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child( format(tr.data("info")) ).show();
            tr.addClass('shown');
             $('[data-toggle="popover"]').popover();
        }
    } );
} );

</script>
@endsection