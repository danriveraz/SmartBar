@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
<div class="container main-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="widget-container fluid-height clearfix">
				<div class="widget-content padded clearfix">
					<table class="table table-bordered table-striped" id="dataTable1">
						<thead>
							<th>No.</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Opciones</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
			  </div>
			</div>
		</div>
	</div>
</div>
@endsection