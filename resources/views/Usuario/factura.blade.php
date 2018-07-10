@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
@include('flash::message')
{!!Html::style('assetsNew/styles/cajero.css')!!}


<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<div class="container">                   
  <div class="row">
    <div class="col-lg-12">
    	<h1 align="center">Así se verá tu factura, ¡editala!</h1>
<!-- inicio-->
		<div class="receipt-content">
		  <div class="container bootstrap snippet">
		    <div class="row">
		      <div class="col-md-12">
		        <div class="invoice-wrapper">
		         {!! Form::open(['route' => ['Auth.usuario.editFactura',$user], 'method' => 'POST','enctype' => 'multipart/form-data', 'class' => 'input-append']) !!}
              	 {{ csrf_field() }}
			<!-- inicio de prueba -->
		        <div class="row">
		          <div class="col-md-3">
		            <div class="widget-content fileupload fileupload-new" data-provides="fileupload">
	                    <div class="gallery-container fileupload-new img-thumbnail">
	                      <div class="gallery-item filter1" rel="" style="border-radius: 50%; width: 150px; height: 150px;">
	                        @if($empresa->imagenPerfilNegocio!='')
	                          {!! Html::image('images/admins/'.$empresa->imagenPerfilNegocio,  'imagen de perfil', array('class' => 'img-responsive img-circle user-photo', 'id' => 'imagenPerfilNegocioCircular')) !!}
	                          <!-- clase circular -> , array('class' => 'img-responsive img-circle user-photo') -->
	                        @else
	                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
	                        @endif
	                        <div class="actions">
	                          <a  id="modalImagen" href="{{ asset ('images/admins/'.$empresa->imagenPerfilNegocio) }}" title="Imagen negocio">
	                            <img src="{{ asset ('images/admins/'.$empresa->imagenPerfilNegocio) }}" hidden>
	                            <i class="fa fa-search-plus"></i>
	                          </a>
	                          <a onclick="$('#imagenPerfil').click()">
	                            <i class="fa fa-pencil"></i>
	                          </a>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="gallery-item fileupload-preview fileupload-exists img-thumbnail" style="border-radius: 50%; width: 150px; height: 150px; background: #ffffff;">
	                      
	                    </div>
	                    <div hidden>
	                      <span class=" btn-file" id="subirImagenNegocio">
	                        <span class="fileupload-new"><i class="fa fa-pencil"></i></span>
	                        <span class="fileupload-exists"><i class="fa fa-search-plus"></i></span>
	                        <input type="file" class="form-control" name="imagenPerfilNegocio"  id="imagenPerfil">
	                      </span>
	                    </div>
	                  </div>
		          </div>
		          <div class="col-md-6">
		              <div class="factspace text-center">
		                <strong class=" text1">
		                  {{$user->EmpresaActual->nombreEstablecimiento}}
		                </strong>
		                <span class="spanR">Nit: {{$user->EmpresaActual->nit}}</span>
		                <p>
		                  {{$user->EmpresaActual->direccion}} {{$user->EmpresaActual->ciudad}} {{$user->EmpresaActual->departamento}} <br>
		                  {{$user->EmpresaActual->telefono}} <br>
		                </p>           
		              </div>
		          </div>
		          <div class="col-md-3">
		              <div class="factspace text-right" >
		                <strong class=" text1 text-danger" style="color: #2d0031;">
		                	@if($empresa->tipoRegimen == "comun")
		                		Factura No. #
		                    	0
		                    @else
		                    	Documento equivalente 
		                    	a la factura No # 0
		                    @endif
		                </strong>
		                <p>
		                    <strong>Mesa:</strong>
		                        # 
		                        <a class="recarga"  title="recargar" href="">
		                        	<span class="fa fa-fw fa-repeat" title="recargar"></span></a>
		                        <br>
		                    <span class="spanR" id="fecha"> 
		                    </span>
		                    <span class="label label-danger">Pendiente</span>
		                        </p>
		                   <div id="contenedorMesas">
		                </div>
		              </div>
		          </div>
		        </div>        
					<div class="divider factspace3"></div>
						<div class="row" id="toggle">
							<div class="col-md-12 text-center">
				  				<a class="invoice-client mrg10T pocketMorado" >Información deL Cliente:</a>
				              		<i class="pocketMorado fa fa-toggle-down"></i>
							</div>
						</div>
<!-- fin de inicio de barra para cliente -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="col-md-4 text-center">
                <div class="heading" style="color:#9F9F9F;">
                  <i class="fa fa-houzz"></i>Mesero:<span id="mesero">         
                    </span>
                </div>
          		<div class="factspace3"></div>
              </div>
              <div class="col-md-4 text-center">
                <div class="heading"  style="color:#9F9F9F;">
                  <i class="fa fa-imdb"></i>Bartender:<span id="bartender"> 
                  </span>
                </div>
          	  <div class="factspace3"></div>
              </div>
              <div class="col-md-4 text-center">
                <div class="heading"  style="color:#9F9F9F;">
                  <i class="fa fa-imdb"></i>Cajero:<span id="cajero">  
                    </span>
                </div>
          	  	<div class="factspace3"></div>
              	</div>
              </div>
            </div>
        </div>
        <div class="line-items">      
          <div class="col-lg-12 ">
            <div class="headers clearfix">
              <div class="row">
                <div class="col-xs-5">Producto</div>
                <div class="FactPocket col-xs-2 text-center">Cantidad</div>
                <div class="FactPocket col-xs-2 text-center">Pago</div>
                <div class="FactPocket col-xs-2 text-center">A Pagar</div>
                <div class="FactPocket col-xs-2 text-center">V. Unitario</div>
                <div class="FactPocket col-xs-2 text-center">Total</div>
              </div>
            </div>
            <div class="items" id="tabla">
            	<div class="row">
	                <div class="col-xs-5">Producto 1</div>
	                <div class="FactPocket col-xs-2 text-center">1</div>
	                <div class="FactPocket col-xs-2 text-center">0</div>
	                <div class="FactPocket col-xs-2 text-center">100</div>
	                <div class="FactPocket col-xs-2 text-center">100</div>
	                <div class="FactPocket col-xs-2 text-center">100</div>
	        	</div>
	        	<div class="row">
	                <div class="col-xs-5">Producto 2</div>
	                <div class="FactPocket col-xs-2 text-center">2</div>
	                <div class="FactPocket col-xs-2 text-center">1</div>
	                <div class="FactPocket col-xs-2 text-center">400</div>
	                <div class="FactPocket col-xs-2 text-center">200</div>
	                <div class="FactPocket col-xs-2 text-center">200</div>
	        	</div>
	        	<div class="row">
	                <div class="col-xs-5">Producto 3</div>
	                <div class="FactPocket col-xs-2 text-center">4</div>
	                <div class="FactPocket col-xs-2 text-center">4</div>
	                <div class="FactPocket col-xs-2 text-center">2000</div>
	                <div class="FactPocket col-xs-2 text-center">500</div>
	                <div class="FactPocket col-xs-2 text-center">0</div>
	        	</div>
           	</div>
           	<div class="total text-right">
              <p class="extra-notes">
                <strong>Notas Adicionales</strong>
                <textarea id="notas" name="notas" class="form-control" rows="2" cols="100" maxlength="140" placeholder="Pon tu mensaje aquí" style="resize: none;">{{$empresa->notas}} </textarea>
              </p>
              <div class="field">
                Subtotal <span id="subtotal">$300</span>
              </div>
              <div class="field">
              	<div class="login-form" id="field">
              		<input autocomplete="off" class="input" name="iva" id="iva" placeholder="Iva" data-items="8"  value="Iva" disabled style="width: 10%;"/>
              		<input autocomplete="off" class="input" name="valorIva" id="valorIva" value="{{$empresa->iva}}%" placeholder="0%" data-items="8" style="width: 5%;"/>
              		<button id="b1" class="add-more btn btn-pocket" type="button" style="padding: 1px 7px; width: 3%;">+</button>              		
              	</div>
              	<div class="login-form" id="divImpuesto1">
              		<!-- IMPUESTO 1 -->
              		@if($empresa->impuesto1 == "")
	              		<input autocomplete="off" class="input" name="impuesto2" id="impuesto2" placeholder="Impuesto 1" data-items="8"  value="{{$empresa->impuesto1}}" style="width: 10%; margin-top: 1%; display: none;"/>
	              		<input autocomplete="off" class="input" name="valorImpuesto2" id="valorImpuesto2" value="{{$empresa->valorImpuesto1}}%" placeholder="0%" data-items="8" style="width: 5%; display: none;"/>
	              		<button id="rm2" class="btn btn-danger remove-me" type="button" style="padding: 1px 7px; width: 3%; display: none;">-</button>
	              	@else
	              		<input autocomplete="off" class="input" name="impuesto2" id="impuesto2" placeholder="Impuesto 1" data-items="8"  value="{{$empresa->impuesto1}}" style="width: 10%; margin-top: 1%;"/>
	              		<input autocomplete="off" class="input" name="valorImpuesto2" id="valorImpuesto2" value="{{$empresa->valorImpuesto1}}%" placeholder="0%" data-items="8" style="width: 5%;"/>
	              		<button id="rm2" class="btn btn-danger remove-me" type="button" style="padding: 1px 7px; width: 3%;">-</button>
	              	@endif
              	</div>
              	<div class="login-form" id="divImpuesto2">
              		<!-- IMPUESTO 2 -->
              		@if($empresa->impuesto2 == "")
	              		<input autocomplete="off" class="input" name="impuesto3" id="impuesto3" placeholder="Impuesto 2" data-items="8"  value="{{$empresa->impuesto2}}" style="width: 10%; margin-top: 1%; display: none;"/>
	              		<input autocomplete="off" class="input" name="valorImpuesto3" id="valorImpuesto3" value="{{$empresa->valorImpuesto2}}%" placeholder="0%" data-items="8" style="width: 5%; display: none;"/>
	              		<button id="rm3" class="btn btn-danger remove-me" type="button" style="padding: 1px 7px; width: 3%; display: none;">-</button>
	              	@else
	              		<input autocomplete="off" class="input" name="impuesto3" id="impuesto3" placeholder="Impuesto 2" data-items="8"  value="{{$empresa->impuesto2}}" style="width: 10%; margin-top: 1%;"/>
	              		<input autocomplete="off" class="input" name="valorImpuesto3" id="valorImpuesto3" value="{{$empresa->valorImpuesto2}}%" placeholder="0%" data-items="8" style="width: 5%;"/>
	              		<button id="rm3" class="btn btn-danger remove-me" type="button" style="padding: 1px 7px; width: 3%;">-</button>
	              	@endif
              	</div>
              </div>
              <div class="field"> 
                Total <span id="total">$300</span>
              </div>
            </div>
		  </div>
          <div class="factspace1"></div>
          <div class="row" >
            <div class="col-lg-12" >             
	            <div class="col-md-4"  > 
	                <div class="form-group" style="padding-top: 25px;" >
	                  <div class="input-group" >
	                    <span class="input-group-addon" title="Propina sugerida"><i class="fa fa-money"></i></span>
	                    <input class="form-control" name="propinaSugerida" placeholder="Propina sugerida" type="text" value="{{$empresa->propina}}%" id="propinaSugerida">
	                  </div>
	                </div>            
	            </div>
	            <div class="col-md-4" > 
	                <div class="form-group">
	                  <div class="input-group" style="padding-top: 25px; ">
	                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
	                    <input class="form-control" placeholder="Efectivo" type="text" id="efectivo" disabled>
	                  </div>
	                </div>            
	            </div>
           	 	<div class="col-md-4"> 
	                <div class="form-group" style="padding-top: 25px;">
	                  <div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>
	                    <input class="form-control" id="cambio" disabled="" placeholder="Cambio" type="text" disabled>
	                  </div>
	                </div>            
            	</div>
	            @if($empresa->tipoRegimen == "comun")
                <br>
                <div class="text-center">
	            	<strong  style="text-align: center;">Resolución DIAN: {{$empresa->nresolucionFacturacion}} de {{$empresa->fechaResolucion}} del No. {{$empresa->nInicio}} hasta {{$empresa->nFinal}}
	            	</strong>
	            </div>
                @endif
	        </div>
            <div style="text-align: center; margin-top: 2%;" >
              	<button class="btn btn-bitbucket">
                  Guardar
                </button>
              </div>
          	</div>          
	    </div>
	    {!! Form::close() !!}
      </div>
    </div>
  </div>
  <div class="footer">
	Copyright © 2018. Pocket Smartbar
  </div>
 </div>
 </div>
 </div>
</div>                    

<!-- fin -->
    </div>
  </div>
</div>

<script type="text/javascript">
	var JSONempresa = eval(<?php echo json_encode($empresa); ?>);

	$(document).ready(function(){
		$("#modalImagen").fancybox({
            helpers: {
                title : {
                    type : 'float'
                }
            }
        });
        if (JSONempresa.tipoRegimen == "comun") {
        	document.getElementById("imagenResolucion").style.display = 'block';
        }

        $propina = document.getElementById("propinaSugerida").value;
        if($propina == 0 || $propina == ""){
        	document.getElementById("propinaSugerida").value = null;
        }

        var contador = 1;
        var impuesto1 = document.getElementById("impuesto2").value;
        var impuesto2 = document.getElementById("impuesto3").value;

        if(impuesto1 != ""){
        	contador = 2;
        }else if(impuesto2 != ""){
        	if(impuesto1 == ""){
        		contador = 1;
        	}else{
        		contador = 3;
        	}
        }

	    $(".add-more").click(function(e){
	    	if(contador < 3){
	    		if(contador == 1){
	    			if(impuesto1 == ""){
		    			document.getElementById("impuesto2").style.display ='initial';
		    			document.getElementById("valorImpuesto2").style.display ='initial';
		    			document.getElementById("rm2").style.display ='initial';
		    			if(impuesto2 != ""){
		    				contador = 3;
		    				console.log("impuesto 2 != 0: " + contador);
		    			}else{
		    				console.log("impuesto1 = 2: " + contador);
		    				contador = 2;
		    			}
		    		}
	    		}else{
	    			if(impuesto2 == ""){
			    		document.getElementById("impuesto3").style.display ='initial';
			    		document.getElementById("valorImpuesto3").style.display ='initial';
			    		document.getElementById("rm3").style.display ='initial';
			    	}
			    	contador = 3;
			    	console.log("impuesto2, contador = 3: " + contador);
	    		}
	    	}
	    });

	    $(".remove-me").click(function(e){
            var fieldNum = this.id.charAt(2);
            var fieldID = "impuesto" + fieldNum;
            var fieldVAL = "valorImpuesto" + fieldNum;

            document.getElementById(this.id).style.display ='none';

			document.getElementById(fieldID).style.display ='none';
			document.getElementById(fieldID).value ='';

			document.getElementById(fieldVAL).style.display ='none';
			document.getElementById(fieldVAL).value ='';

			impuesto1 = document.getElementById("impuesto2").value;
			impuesto2 = document.getElementById("impuesto3").value;

			if(impuesto1 == ""){
				contador = 1;
			}else if(impuesto2 == ""){ 
				contador = 2;
			}else if(impuesto1 != ""){
				contador = 2;
				console.log("remover, contador = 2: " + contador);
			}else if(impuesto2 != ""){
				contador = 1;
				console.log("remover, contador = 1: " + contador);
			}
	    });

	});

	$(function() {
  	// We can attach the `fileselect` event to all file inputs on the page
	  $(document).on('change', ':file', function() {
	    var input = $(this),
	        numFiles = input.get(0).files ? input.get(0).files.length : 1,
	        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	    input.trigger('fileselect', [numFiles, label]);
	  });

	  // We can watch for our custom `fileselect` event like this
	  $(document).ready( function() {
	      $(':file').on('fileselect', function(event, numFiles, label) {

	          var input = $(this).parents('.input-group').find(':text'),
	              log = numFiles > 1 ? numFiles + ' files selected' : label;

	          if( input.length ) {
	              input.val(log);
	          } else {
	          	
	          }

	      });
	  });
  
});
</script>

<style type="text/css">
	#imagenPerfilNegocioCircular{
    	width: 150px;
    	height: 150px;
  	}

  	#iva:disabled{
		background-color: #fff;  
		color: #111;
	}
</style>

@endsection