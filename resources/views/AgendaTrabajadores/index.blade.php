@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
<link href="assetsNew/styles/semantic.min.css" rel="stylesheet" type="text/css">
<script src="assetsNew/scripts/semantic.min.js"></script>
<script src="assetsNew/scripts/semantic.editableRecord.js"></script>
<script src="assetsNew/scripts/example.js"></script>
       
<style type="text/css">
	.avatar {
	    border-radius: 50%;
	}
	.widget-content{
		width: 100%;
		margin-top: 15px;
	}
	#inicio{
		border-bottom: solid 2px rgba(210, 215, 217, 0.75);
	}
  .semanas{
    padding-right: 10px;
  }
</style>

<div class="modal-shiftfix">
	<div class="container main-content">
      	<div class="row">
      		<div class="col-lg-12">
      			<div class="widget-container fluid-height">
      				<div class="col-md-6 text-center" style="border-right: solid 2px rgba(210, 215, 217, 0.75);">
      					<div id="inicio">
							<div class="heading">
								<div class="col-xs-6 col-md-6 text-center">
								  <i class="glyphicon glyphicon-time"></i> BLACK AND WHITE
								  <span id="nombre"></span>
								</div>
								<div class="col-xs-3 col-md-3 text-center">
								  <label>
								  <input checked="" name="optionsRadios1" type="radio" value="option1">
								  <span id="dia"></span>
								  </label><label>Dia</label>
								</div>
								<div class="col-xs-3 col-md-3 text-center">
								  <label>
								  <input checked="" name="optionsRadios1" type="radio" value="option2">
								  <span id="noche"></span>
								  </label><label>Noche</label>
								</div>
							</div>
		               		<br>
      		     		</div>
						<div class="widget-container fluid-height">
							<div class="col-md-6 text-center">
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input checked="" name="optionsRadios2" type="radio" value="option1">
											<span id="usuario"></span>
										</label>
										<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
										<div class="profile-details">
											<p class="user-name">Maria Diaz Diaz</p>
											<p>Administrador</p>
											<p>$1.000.000</p>
										</div>
									</div>
								</div>
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input checked="" name="optionsRadios2" type="radio" value="option1">
											<span id="usuario"></span>
										</label>
										<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
										<div class="profile-details">
											<p class="user-name">Maria Diaz Diaz</p>
											<p>Administrador</p>
											<p>$1.000.000</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input checked="" name="optionsRadios2" type="radio" value="option1">
											<span id="usuario"></span>
										</label>
										<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
										<div class="profile-details">
											<p class="user-name">Maria Diaz Diaz</p>
											<p>Administrador</p>
											<p>$1.000.000</p>
										</div>
									</div>
								</div>
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input checked="" name="optionsRadios2" type="radio" value="option1">
											<span id="usuario"></span>
										</label>
										<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
										<div class="profile-details">
											<p class="user-name">Maria Diaz Diaz</p>
											<p>Administrador</p>
											<p>$1.000.000</p>
										</div>
									</div>
								</div>
							</div>
						</div>
      					<br>
                		<br>
		                <div class="semanas text-center">
		                  <table id="example1" class="ui table">
		                    <thead>
			                    <tr>
			                        <th data-type="checkbox" name="lun">LUN</th>
			                        <th data-type="checkbox" name="mar">MAR</th>
			                        <th data-type="checkbox" name="mir">MIE</th>
			                        <th data-type="checkbox" name="jue">JUE</th>
			                        <th data-type="checkbox" name="vie">VIE</th>
			                        <th data-type="checkbox" name="sab">SAB</th>
			                        <th data-type="checkbox" name="dom">DOM</th>
			                    </tr>
		                    </thead>
		                    <tbody>
		                    </tbody>
		                  </table>
		                  <br>
		                  <br>
		                  <button id class="btn btn-bitbucket">
		                    <i class="fa fa-check"></i>GUARDAR
		                  </button>
		                </div>
      				</div>

      				<div class="col-md-6"> 
		                <div class="headingPocket2">
		                    <a><i class=" pocketMorado fa-2x fa fa-money"></i></a>
		                    <a><i class=" fa-2x fa fa-calendar"></i></a>
		                    <a><i class=" fa-2x fa fa-clock-o"></i></a>
		                </div>                       
      					<div style="margin-top: 2px;" class="widget-content clearfix">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr><th width="40%">
										  Producto
										</th>
										<th width="20%">
										  Cantidad
										</th>
										<th width="20%">
										  Precio Unit
										</th>
										<th width="20%">
										  Total
										</th>
										</tr>
										</thead>
									<tbody>
										<tr>
										  <td>
										    DIAS LABORADOS
										  </td>
										  <td>
										    2
										  </td>
										  <td>
										    $50
										  </td>
										  <td>
										    + $100
										  </td>
										</tr>
										<tr>
										  <td>
										    ADELANTOS
										  </td>
										  <td>
										  </td>
										  <td>
										    $50
										  </td>
										  <td>
										    - $50
										  </td>
										</tr>
										<tr>
										  <td>
										    DESCUENTOS
										  </td>
										  <td>
										  </td>
										  <td>
										    $50
										  </td>
										  <td>
										    - $50
										  </td>
										</tr>
										<tr>
										  <td>
										    BONIFICACIONES
										  </td>
										  <td>
										  </td>
										  <td>
										  </td>
										  <td>
										    + $100
										  </td>
										</tr>
										<tr>
										  <td>
										  </td>
										  <td>
										  </td>
										  <td>
										 	  TOTAL
										  </td>
										  <td>
										    $100
										  </td>
										</tr>
									</tbody>
								</table>
		                 	</div>
		                </div>
		                <div class="widget-content padded clearfix">
							<div class="row">
								<div class="col-md-4 text-center">
									<select class="form-control" style="font-family: 'FontAwesome', 'Arial';">
									<option value="">&#xf073; Semanal</option>
									<option value="">&#xf073; Quincenal</option>
									<option value="">&#xf073; Mensual</option>
								  </select>
								</div>
								<div class="col-md-5 text-center">
									<button class="btn btn-bitbucket">PAGO AUTOMATICO
									</button>
								</div>
								<div class="col-md-3 text-center">
									<button class="btn btn-bitbucket">
									<i class="fa fa-check"></i>PAGAR
									</button>
								</div>
							</div>
		                </div>
      				</div>
      			</div>
      		</div>
      	</div>
     </div>
</div>

<script>
    var rows = 0;
    $(document).ready(function(){
      $('.ui.positive.button').on('click', function(){
        rows+=1;
        if(rows == 4){
          $('.ui.positive.button').addClass('disabled');
        }
      });
      $('.ui.positive.button').click();
    });

    function del(){
      rows-=1;
      if(rows < 4){
        $('.ui.positive.button').removeClass('disabled');
      }
    };
</script>
@endsection