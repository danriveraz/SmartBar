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
		                    	<tr data-info="1">
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
	function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td> assas'+'</td>'+
            '<td>Full name:</td>'+
            '<td> assas'+'</td>'+
            '<td>Full name:</td>'+
            '<td> assas'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td> assa'+'</td>'+
            '<td>Extension number:</td>'+
            '<td> assa'+'</td>'+
            '<td>Extension number:</td>'+
            '<td> assa'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 

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
            row.child( format(1) ).show();
            tr.addClass('shown');
        }
    } );
} );

</script>
@endsection