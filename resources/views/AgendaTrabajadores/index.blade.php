@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')

{!!Html::script('assetsNew\scripts\jquery-2.1.3.min.js')!!}
{!!Html::script('assetsNew\scripts\semantic.min.js')!!}
{!!Html::script('assetsNew\scripts\semantic.editableRecord.js')!!}
{!!Html::script('assetsNew\scripts\example.js')!!}

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

<div class="modal-shiftfix">
	<div class="container main-content">
      	<div class="row">
      		<div class="col-lg-12">
      			<div class="widget-container fluid-height">
      				<div class="col-md-6 text-center" style="border-right: solid 2px rgba(210, 215, 217, 0.75);">
      				{!! Form::open(['method' => 'POST', 'action' => 'AgendaTrabajadoresController@store']) !!}
      					<div id="inicio">
							<div class="heading">
								<div class="col-xs-6 col-md-6 text-center">
								  <i class="glyphicon glyphicon-time"></i> BLACK AND WHITE
								  <span id="nombre"></span>
								</div>
								<div class="col-xs-3 col-md-3 text-center">
								  <label>
								  <input type="checkbox" value="1" name="entities[0][0]">
								  <span id="dia"></span>
								  </label><label>Dia</label>
								</div>
								<div class="col-xs-3 col-md-3 text-center">
								  <label>
								  <input type="checkbox" value="2" name="entities[0][0]">
								  <span id="noche"></span>
								  </label><label>Noche</label>
								</div>
							</div>
		               		<br>
      		     		</div>
						<div class="widget-container fluid-height">
							<div class="col-md-6 text-center">
								@foreach($empleadosIzq as $empleado)
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input type="checkbox" value="{{$empleado->id}}" name="entities[1][0]">
											<span id="usuario"></span>
										</label>
										<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
										<div class="profile-details">
											<p class="user-name">{{$empleado->nombrePersona}}</p>
											@if($empleado->esMesero)
											<p>Mesero</p>
											@elseif($empleado->esBartender)
											<p>Bartender</p>
											@elseif($empleado->esCajero)
											<p>Cajero</p>
											@endif
											<p>${{$empleado->salario}}</p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="col-md-6 text-center">
								@foreach($empleadosDer as $empleado)
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input type="checkbox" value="{{$empleado->id}}" name="entities[1][0]">
											<span id="usuario"></span>
										</label>
										<img width="70" height="70" class="avatar pull-left" src="images\avatar-male.jpg">
										<div class="profile-details">
											<p class="user-name">{{$empleado->nombrePersona}}</p>
											@if($empleado->esMesero)
											<p>Mesero</p>
											@elseif($empleado->esBartender)
											<p>Bartender</p>
											@elseif($empleado->esCajero)
											<p>Cajero</p>
											@endif
											<p>${{$empleado->salario}}</p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>

      					<br>
                		<br>
		                <div class="semanas text-center">
		                  <table id="example1" class="ui table">
		                    <thead>
			                    <tr>
			                        <th data-type="checkbox" name="lun" data-checked="lun" data-unchecked="no">LUN</th>
			                        <th data-type="checkbox" name="mar" data-checked="mar" data-unchecked="no">MAR</th>
			                        <th data-type="checkbox" name="mir" data-checked="mie" data-unchecked="no">MIE</th>
			                        <th data-type="checkbox" name="jue" data-checked="jue" data-unchecked="no">JUE</th>
			                        <th data-type="checkbox" name="vie" data-checked="vie" data-unchecked="no">VIE</th>
			                        <th data-type="checkbox" name="sab" data-checked="sab" data-unchecked="no">SAB</th>
			                        <th data-type="checkbox" name="dom" data-checked="dom" data-unchecked="no">DOM</th>
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
		              	{!! Form::close() !!}
      				</div>

      				<div class="col-md-6"> 
		                <div class="headingPocket2">
		                    <a onclick="salario()"><i class=" pocketMorado fa-2x fa fa-money"></i></a>
		                    <a onclick="calendario()"><i class=" fa-2x fa fa-calendar"></i></a>
		                    <a><i class=" fa-2x fa fa-clock-o"></i></a>
		                </div>                       
      					<div id="salario" style="margin-top: 2px;" class="widget-content clearfix">
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
		                <div id="agenda" style="display: none;">
		                	<button id="today" style="display: none;"></button>
							<div class="widget-container fluid-height clearfix">
								<div id="calendar"></div>
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
      $('#calendar').fullCalendar({
        // put your options and callbacks here
    	})
    });

    function del(){
      rows-=1;
      if(rows < 4){
        $('.ui.positive.button').removeClass('disabled');
      }
    };

    function calendario(){
    	$('#salario').css('display', 'none');
    	$('#agenda').css('display', 'block');
    }
    function salario(){
    	$('#agenda').css('display', 'none');
    	$('#salario').css('display', 'block');
    }
</script>
@endsection