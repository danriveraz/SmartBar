@extends(Auth::User()->esAdmin ? 'Layout.app_administradoresOptimizado' : 'Layout.app_empleado')
@section('content')


 {!!Html::style('stylesheets\datatables.css')!!}
  {!!Html::script("javascripts\select2.js")!!}
  {!!Html::script("javascripts\datatable-editable.js")!!}
  {!!Html::script("javascripts\jquery.dataTables.js")!!}
  {!!Html::script("javascripts\bootstrap.min.js")!!}<!-- ya esta -->
  {!!Html::script("javascripts\jquery.bootstrap.wizard.js")!!}
  {!!Html::script("javascripts\jquery.dataTables.min.js")!!}
  {!!Html::script("javascripts/fullcalendar.min.js")!!}
  {!!Html::script("javascripts\jquery.easy-pie-chart.js")!!}<!-- ya esta -->
  {!!Html::script("javascripts\jquery.isotope.min.js")!!}
  {!!Html::script("javascripts\jquery.fancybox.pack.js")!!}
  {!!Html::script("javascripts\jquery.inputmask.min.js")!!}
  {!!Html::script("javascripts\jquery.validate.js")!!}
  {!!Html::script("javascripts\bootstrap-timepicker.js")!!}
  {!!Html::script("javascripts\bootstrap-colorpicker.js")!!}
  {!!Html::script("javascripts\ladda.min.js")!!}
  {!!Html::script("javascripts\mockjax.js")!!}
  {!!Html::script("javascripts\daterange-picker.js")!!}
  {!!Html::script("javascripts\date.js")!!}  
  {!!Html::script("javascripts/fitvids.js")!!}
  {!!Html::script("javascripts\jquery.sparkline.min.js")!!}<!-- ya esta -->
  {!!Html::script("javascripts\dropzone.js")!!}
  {!!Html::script("javascripts\jquery.nestable.js")!!}
  {!!Html::script('javascripts\main.js')!!}<!-- ya esta -->
  
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
	var JSONclientes = eval(<?php echo json_encode($clientes); ?>);   	

//<a class="popover-trigger" readonly value="0"  data-content="Cantidad de productos que pertenecen a esta categoría" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color: #5A5A5A;">0</a>
	function format ( d ) {
   	var datos = "";
   	var color = " style='color:black;'";
   	var cliente = [];
   	var idCliente = 0;
	for(i = 0; i < JSONproductos.length; i++){
 		if(JSONproductos[i][0] == d){
			if(JSONproductos[i][4]== "Cancelado"){
				idCliente = JSONproductos[i][6];
				datos+='<tr style="text-align: center; color:red;" class="fila"><td><a class="popover-trigger" readonly  data-content="<div'+color+'>Este pedido fue cancelado</div>" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color:red;">'+JSONproductos[i][1]+'</a></td><td>'+JSONproductos[i][2] +'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3])+'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3]*JSONproductos[i][1])+'</td></tr>';
			}else if(JSONproductos[i][5] == 1){
				datos+='<tr style="text-align: center; color:#32bf32;" class="fila"><td><a class="popover-trigger" readonly  data-content="<div'+color+'>Este producto fue obsequiado</div>" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color:#32bf32;">'+JSONproductos[i][1]+'</a></td><td>'+JSONproductos[i][2] +'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3])+'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3]*JSONproductos[i][1])+'</td></tr>';
			}else{
				datos+='<tr style="text-align: center;"><td>'+JSONproductos[i][1]+'</td><td>'+JSONproductos[i][2] +'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3])+'</td><td>$'+Intl.NumberFormat().format(JSONproductos[i][3]*JSONproductos[i][1])+'</td></tr>';
			}
		}
   	}
   	for(i = 0; i < JSONclientes.length; i++){
   		cliente[0]= "-";
   		cliente[1]= "-";
   		cliente[2]= "-";
   		cliente[3]= "-";
   		cliente[4]= "-";
   		cliente[5]= "-";
	   	if(JSONclientes[i][0] == idCliente){
	 			cliente[0]= JSONclientes[i][1];
	 			cliente[1]= JSONclientes[i][2];
	 			cliente[2]= JSONclientes[i][3];
	 			cliente[3]= JSONclientes[i][4];
	 			cliente[4]= JSONclientes[i][5];

	 	}
	 }
    return    '<div class="col-md-6"  style="padding-left: 50px; padding-top:15px;"> <div class="heading"><i class="fa fa-tags"></i>'+
    			'Información de factura </div>'+
                '<div class="widget-content padded"><dl><div class="row">'+
				'<div class="col-md-6">'+
					'<dt>Nombre</dt><dd>'+cliente[0]+'</dd>'+
                   '<dt>Direccion</dt><dd>'+cliente[4]+'</dd></div>'+
              	'<div class="col-md-6" style="padding-left:35px;">'+
                    '<dt>Nit</dt><dd>'+cliente[1]+'</dd><dt>Telefono</dt><dd>'+cliente[2]+'</dd>'+
                '</div></div><dt>Email</dt><dd>'+cliente[3]+'</dd>'+
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