@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
<link rel='stylesheet' href='assets-Internas\css\fullcalendar.css' />
<script src='assets-Internas\javascripts\jquery.min.js'></script>
<script src='assets-Internas\javascripts\moment.min.js'></script>
<script src='assets-Internas\javascripts\fullcalendar.js'></script>
<script src='assets-Internas\javascripts\es.js'></script>

<div class="modal-shiftfix">
	<div class="container main-content">
      	<div class="row">
      		<div class="col-lg-12">
      			<div class="widget-container fluid-height">
      				<div class="col-md-6 text-center" style="border-right: solid 2px rgba(210, 215, 217, 0.75);">
      				{!! Form::open(['method' => 'POST', 'action' => 'AgendaTrabajadoresController@store']) !!}
      					<div id="inicio">
							<div class="heading">
								<div class="col-xs-6 col-sm-6 col-lg-6 text-center">
								  <i class="glyphicon glyphicon-time"></i>{{$nombreEmpresa}}
								  <span id="nombre"></span>
								</div>
								@foreach($horarios as $key => $horario)
									<div class="col-xs-{{$espacio}} col-md-{{$espacio}} col-lg-{{$espacio}} text-center">
									  <label>
										  <input class="jornada" type="radio" value="{{$key+1}}" name="entities[0][0]">
										  <span></span>
									  </label><label>{{$horario->nombre}}</label>
									</div>
								@endforeach
							</div>
		               		<br>
      		     		</div>
						<div class="widget-container fluid-height">
							<div class="col-xs-6 col-sm-6 col-lg-6 text-center">
								@foreach($empleadosIzq as $key => $empleado)
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input type="radio" onclick="actualizar({{$numeracion[$key]}},{{$empleado}}, {{$extraoficiales}})" value="{{$empleado->id}}" name="entities[1][0]">
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
							<div class="col-xs-6 col-sm-6 col-lg-6 text-center">
								@foreach($empleadosDer as $empleado)
								<div class="widget-content padded">
									<div class="profile-info clearfix">
										<label class="pull-left">
											<input type="radio" onclick="actualizar({{$numeracion[$numEmpleadosIzq+$key]}}, {{$empleado}}, {{$extraoficiales}})" value="{{$empleado->id}}" name="entities[1][0]">
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
		                	<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="mainTable">
								<thead>
								    <tr>
								    	<th name="semana">#</th>
								        <th name="lun">LUN</th>
								        <th name="mar">MAR</th>
								        <th name="mir">MIE</th>
								        <th name="jue">JUE</th>
								        <th name="vie">VIE</th>
								        <th name="sab">SAB</th>
								        <th name="dom">DOM</th>
								    </tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>
											<label>
												<input name="entities[2][0][0]" type="hidden" value="no">
												<input name="entities[2][0][0]" type="checkbox" value="lun"><span id="lun"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][0][1]" type="hidden" value="no">
												<input name="entities[2][0][1]" type="checkbox" value="mar"><span id="mar"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][0][2]" type="hidden" value="no">
												<input name="entities[2][0][2]" type="checkbox" value="mir"><span id="mir"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][0][3]" type="hidden" value="no">
												<input name="entities[2][0][3]" type="checkbox" value="jue"><span id="jue"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][0][4]" type="hidden" value="no">
												<input name="entities[2][0][4]" type="checkbox" value="vie"><span id="vie"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][0][5]" type="hidden" value="no">
												<input name="entities[2][0][5]" type="checkbox" value="sab"><span id="sab"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][0][6]" type="hidden" value="no">
												<input name="entities[2][0][6]" type="checkbox" value="dom"><span id="dom"></span>
											</label>
											</td>
									</tr>
									<tr>
										<td>2</td>
										<td>
											<label>
												<input name="entities[2][1][0]" type="hidden" value="no">
												<input name="entities[2][1][0]" type="checkbox" value="lun"><span id="lun"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][1][1]" type="hidden" value="no">
												<input name="entities[2][1][1]" type="checkbox" value="mar"><span id="mar"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][1][2]" type="hidden" value="no">
												<input name="entities[2][1][2]" type="checkbox" value="mir"><span id="mir"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][1][3]" type="hidden" value="no">
												<input name="entities[2][1][3]" type="checkbox" value="jue"><span id="jue"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][1][4]" type="hidden" value="no">
												<input name="entities[2][1][4]" type="checkbox" value="vie"><span id="vie"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][1][5]" type="hidden" value="no">
												<input name="entities[2][1][5]" type="checkbox" value="sab"><span id="sab"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][1][6]" type="hidden" value="no">
												<input name="entities[2][1][6]" type="checkbox" value="dom"><span id="dom"></span>
											</label>
											</td>
									</tr>
									<tr>
										<td>3</td>
										<td>
											<label>
												<input name="entities[2][2][0]" type="hidden" value="no">
												<input name="entities[2][2][0]" type="checkbox" value="lun"><span id="lun"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][2][1]" type="hidden" value="no">
												<input name="entities[2][2][1]" type="checkbox" value="mar"><span id="mar"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][2][2]" type="hidden" value="no">
												<input name="entities[2][2][2]" type="checkbox" value="mir"><span id="mir"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][2][3]" type="hidden" value="no">
												<input name="entities[2][2][3]" type="checkbox" value="jue"><span id="jue"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][2][4]" type="hidden" value="no">
												<input name="entities[2][2][4]" type="checkbox" value="vie"><span id="vie"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][2][5]" type="hidden" value="no">
												<input name="entities[2][2][5]" type="checkbox" value="sab"><span id="sab"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][2][6]" type="hidden" value="no">
												<input name="entities[2][2][6]" type="checkbox" value="dom"><span id="dom"></span>
											</label>
											</td>
									</tr>
									<tr>
										<td>4</td>
										<td>
											<label>
												<input name="entities[2][3][0]" type="hidden" value="no">
												<input name="entities[2][3][0]" type="checkbox" value="lun"><span id="lun"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][3][1]" type="hidden" value="no">
												<input name="entities[2][3][1]" type="checkbox" value="mar"><span id="mar"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][3][2]" type="hidden" value="no">
												<input name="entities[2][3][2]" type="checkbox" value="mir"><span id="mir"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][3][3]" type="hidden" value="no">
												<input name="entities[2][3][3]" type="checkbox" value="jue"><span id="jue"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][3][4]" type="hidden" value="no">
												<input name="entities[2][3][4]" type="checkbox" value="vie"><span id="vie"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][3][5]" type="hidden" value="no">
												<input name="entities[2][3][5]" type="checkbox" value="sab"><span id="sab"></span>
											</label>
											</td>
											<td>
											<label>
												<input name="entities[2][3][6]" type="hidden" value="no">
												<input name="entities[2][3][6]" type="checkbox" value="dom"><span id="dom"></span>
											</label>
											</td>
									</tr>
								</tbody>
								</table>
							</div>
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
		                    <input type="hidden" id="globalVariable" value="{{$turnos}}">
		                    <input type="hidden" id="globalVariable2" value="{{$horarios}}">
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
										  <td id="diasLabor">
										  	0
										  </td>
										  <td id="valorDia">
										  	$0
										  </td>
										  <td id="valorTotal">
										  	$0
										  </td>
										</tr>
										<tr>
										  <td>
										    ADELANTOS
										  </td>
										  <td>
										  </td>
										  <td id="adelantos">
										    $0
										  </td>
										  <td id="totalAdelantos">
										    - $0
										  </td>
										</tr>
										<tr>
										  <td>
										    DESCUENTOS
										  </td>
										  <td>
										  </td>
										  <td id="descuentos">
										    $0
										  </td>
										  <td id="totalDescuentos">
										    - $0
										  </td>
										</tr>
										<tr>
										  <td>
										    BONIFICACIONES
										  </td>
										  <td>
										  </td>
										  <td id="bonificaciones">
										  </td>
										  <td id="totalBonificaciones">
										    + $0
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
										  <td id="totalFinal">
										    $0
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

	var colorPalette = ["#feb236", "#d64161", "#ff7b25", "#878f99", "#3e4444", "#82b74b", "#405d27", "#034f84", "#f7786b", "#c94c4c", 
						"#50394c", "#b2b2b2", "#f4e1d2", "#f18973", "#bc5a45", "#e06377", "#c83349", "#b8a9c9", "#622569"];
	var diasLaborados = [];

	var turnos = JSON.parse($('#globalVariable').val());
	var horarios = JSON.parse($('#globalVariable2').val());

	$( document ).ready(function() {	
	    $('#calendar').fullCalendar({
	    	timeFormat: 'h:mmA',
	    	viewRender: function(view, element) {
			    inicio = new Date(view.intervalStart);
			    mes = inicio.getMonth() + 1;
			    anio = inicio.getFullYear();
			    ultimoDia = new Date(anio, mes + 1, 0);
			    
			    eliminarEventos();
			    for (var i = 0; i < turnos.length; i++) {
			    	numeroDias = turnosUsuario(turnos[i], ultimoDia.getDate(), mes, anio, horarios);
			    	diasLaborados.push(numeroDias);
			    }
			}
	  	});
	});

	function actualizar(id, empleado, extraoficiales){

		var salario = empleado.salario;
		var empleadoId = empleado.id;
		var extraoficial = null;

		for (var i = 0; i < extraoficiales.length; i++){
			if(empleadoId == extraoficiales[i].idUsuario){
				extraoficial = extraoficiales[i];
			}
		}

		$('#mainTable').find('input[type="checkbox"]').prop('checked', false);
		var input = $('.jornada:radio:checked').val();
		if(input > 0){
			var turnosPorId = turnos[id];
			for (var i = 1; i <= turnosPorId.length - 1; i++) {
				for (var j = 1; j <= 7; j++) {
					var aux = nombreDia(turnosPorId[i-1], j);
					if(aux == input){
						$('#mainTable tr:eq('+i+') td:eq('+j+')').find('input[type="checkbox"]').prop('checked', true);
					}
				}
			}
			$('#diasLabor').html(diasLaborados[id]);
			var total = salario*diasLaborados[id];
			$('#valorDia').html("$" + salario);
			$('#valorTotal').html("+$" + total);

			if(extraoficial != null){
				$('#adelantos').html("$" + extraoficial.adelantos);
				$('#totalAdelantos').html("-$" + extraoficial.adelantos);
				$('#descuentos').html("$" + extraoficial.descuentos);
				$('#totalDescuentos').html("-$" + extraoficial.descuentos);
				$('#bonificaciones').html("$" + extraoficial.bonificaciones);
				$('#totalBonificaciones').html("+$" + extraoficial.bonificaciones);
				$('#totalFinal').html("$" + (total - extraoficial.descuentos - extraoficial.adelantos + extraoficial.bonificaciones));
			}else{
				$('#totalFinal').html("$" + total);
			}

		}else{
			alert("Elige una jornada y selecciona de nuevo a un empleado");
		}
	}

    function calendario(){
    	$('#salario').css('display', 'none');
    	$('#agenda').css('display', 'block');
    }

    function salario(){
    	$('#agenda').css('display', 'none');
    	$('#salario').css('display', 'block');
    }

    function diaSemana(dia,mes,anio){
	    var dt = new Date(anio, mes, dia, 12);
	    var dia = dt.getUTCDay();
	    return dia;
	};

	function numeroDia(d){
		var res = d.getDay();
		if(res === 0) {
			return 7
		};
		return res;
	}

	function nombreDia(arreglo, numero){
		var num = 0;
		if(numero == 7){
			num = arreglo.dom;
		}else if(numero == 1){
			num = arreglo.lun;
		}else if(numero == 2){
			num = arreglo.mar;
		}else if(numero == 3){
			num = arreglo.mie;
		}else if(numero == 4){
			num = arreglo.jue;
		}else if(numero == 5){
			num = arreglo.vie;
		}else if(numero == 6){
			num = arreglo.sab;
		}
		return num;
	}

	function turnosUsuario(turnos, numeroDias, mes, anio, horarios){
		var diasTrabajo = 0;

		for (var i = 1; i <= numeroDias; i++) {
			dt = new Date(anio, mes, i);
			numeroSemana = moment(dt).isoWeek();
			numeroSemanaMes = numeroSemana%4;
			diaSemana = numeroDia(dt);
			turno = nombreDia(turnos[numeroSemanaMes], diaSemana);
			titulo = turnos[turnos.length-1];
			deit = new Date(anio, mes, i);
			color = turnos[numeroSemanaMes].idUsuario;
			for (var j = 0; j < horarios.length; j++){
				if(turno == (j+1)){
					diasTrabajo++;
					if(horarios[j].horaInicio < 10){

						inicio = moment(deit).format('YYYY-MM-DD')+"T0"+horarios[j].horaInicio+":00:00";
					}else{
						inicio = moment(deit).format('YYYY-MM-DD')+"T"+horarios[j].horaInicio+":00:00";
					}

					if(horarios[j].horaFin < 10){
						fin = moment(deit).format('YYYY-MM-DD')+"T0"+horarios[j].horaFin+":00:00";
					}else{
						fin = moment(deit).format('YYYY-MM-DD')+"T"+horarios[j].horaFin+":00:00";
					}
					myevent = {title: titulo+"",start: inicio, end: fin, color: colorPalette[color-1], allDay: false};
					$('#calendar').fullCalendar( 'renderEvent', myevent, true);
				}
			}
		}

		return diasTrabajo;
	}

	function eliminarEventos(){
		$('#calendar').fullCalendar('removeEvents') ; 
	}

</script>
@endsection