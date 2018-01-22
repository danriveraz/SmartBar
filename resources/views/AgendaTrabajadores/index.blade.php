@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
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
</style>
<div class="container main-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="widget-container fluid-height">
				<div class="col-md-6 text-center" style="border-right: solid 2px rgba(210, 215, 217, 0.75);">
					<div id="inicio">
		                <div class="heading">
		                	<div class="col-md-6 text-center">
								<i class="glyphicon glyphicon-time"></i> BLACK AND WHITE
								<span id="nombre"></span>
							</div>
							<div class="col-md-3 text-center">
								<label>
								    <input type="checkbox" name="dia" value="1"/>
									<span id="dia"></span>
								</label><label>DÍA</label>
							</div>
							<div class="col-md-3 text-center">
								<label>
								    <input type="checkbox" name="noche" value="0"/>
									<span id="noche"></span>
								</label><label>NOCHE</label>
							</div>
		                </div>
         				<br>
		            </div>
     				<div class="widget-container fluid-height">
     					<div class="col-md-6 text-center">
     						<div class="widget-content padded">
								<div class="profile-info clearfix">
									<label class="pull-left">
									    <input type="checkbox" name="usuario" value="1"/>
										<span id="usuario"></span>
									</label>
									<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
									<div class="profile-details">
										<a class="user-name" href="">Maria Diaz Diaz</a>
										<p>Administrador</p>
										<p>$1.000.000</p>
									</div>
								</div>
							</div>
							<div class="widget-content padded">
								<div class="profile-info clearfix">
									<label class="pull-left">
									    <input type="checkbox" name="usuario" value="1"/>
										<span id="usuario"></span>
									</label>
									<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
									<div class="profile-details">
										<a class="user-name" href="">Maria Diaz Diaz</a>
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
									    <input type="checkbox" name="usuario" value="1"/>
										<span id="usuario"></span>
									</label>
									<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
									<div class="profile-details">
										<a class="user-name" href="">Maria Diaz Diaz</a>
										<p>Administrador</p>
										<p>$1.000.000</p>
									</div>
								</div>
							</div>
							<div class="widget-content padded">
								<div class="profile-info clearfix">
									<label class="pull-left">
									    <input type="checkbox" name="usuario" value="1"/>
										<span id="usuario"></span>
									</label>
									<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
									<div class="profile-details">
										<a class="user-name" href="">Maria Diaz Diaz</a>
										<p>Administrador</p>
										<p>$1.000.000</p>
									</div>
								</div>
							</div>
     					</div>
     				</div>
					<br>
				</div>
				<div class="col-md-6">
					<div class="heading">
						<i class="fa fa-calendar fa-lg"> </i><i class="fa fa-clock-o fa-lg"> </i><i class="fa fa-money fa-lg"></i>
						<br>
					</div>
					<br>
					<div class="widget-content padded clearfix">
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
		                    </tr></thead>
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
@endsection