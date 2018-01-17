@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
<style type="text/css">
	td.details-control {
    background: url('../resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../resources/details_close.png') no-repeat center center;
}
</style>
<div class="container main-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="widget-container fluid-height clearfix">
				<div class="widget-content padded clearfix">
					<table  class="table table-bordered table-striped" id="dataTable1">
						<thead>
							<th></th>
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
		                    	<tr data-info="1">
		                    		<td class="details-control">clic</td>
		                    		<td>{{$factura->idBar}}</td>
		                    		<td>
		                    			<?php  $date = new DateTime($factura->fecha);
                       					echo $date->format('d M Y'); ?>
									</td>
									<td>
										<?php  $date = new DateTime($factura->fecha);
                       					echo $date->format('g:i A'); ?>
									</td>
		                    		<td>{{$factura->mesa->nombreMesa}}</td>
		                    		<td>{{$factura->ventasHechas[0]->mesero->nombrePersona}}</td>
		                    		<td>{{$factura->ventasHechas[0]->bartender->nombrePersona}}</td>
		                    		<td>{{$factura->ventasHechas[0]->cajero->nombrePersona}}</td>
		                    		<td>
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
	function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 

$(document).ready(function() {
     
    $('#dataTable1 tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
 		 alert(tr.child.isShown());
       /*if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            alert(tr.data("info"));
        }
        else {
        	alert(tr.data("info"));
            // Open this row
            row.child( format(tr.data("info")) ).show();
            tr.addClass('shown');
        }*/
    } );
} );

</script>
@endsection