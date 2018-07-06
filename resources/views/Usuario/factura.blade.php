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
		                <div id="imagenResolucion" align="center" style="display: none;">
		                	<div class="form-group" style="width: 60%;">
			                  <div class="input-group" style="padding-top: 25px; ">
			                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
			                    <input class="form-control" id="resolucion" name="resolucion" placeholder="Resolución de facturación" type="text" id="regimen" name="regimen" value="{{$empresa->nresolucionFacturacion}}">
			                  </div>
			                </div>
			                <div class="input-group" style="width: 60%;">
				                <label class="input-group-btn">
				                    <span class="btn btn-primary">
				                        Subir imagen <input type="file" name="imgRes" id="imgRes" style="display: none;" multiple>
				                    </span>
				                </label>
				                <input type="text" class="form-control" readonly>
				            </div>
		                </div>            
		              </div>
		          </div>
		          <div class="col-md-3">
		              <div class="factspace text-right" >
		                <strong class=" text1 text-danger" style="color: #2d0031;">
		                  Factura No. #
		                    0
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
<!--  prueba-->

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
              		<input autocomplete="off" class="input" name="impuesto" id="field1" placeholder="Iva" data-items="8" style="width: 10%;"/>
              		<input autocomplete="off" class="input" name="valor" id="valor1" placeholder="19%" data-items="8" style="width: 5%;"/>
              		<button id="b1" class="add-more btn btn-pocket" type="button" style="padding: 1px 7px; width: 3%;">+</button>
              	</div>
              </div>
              <div class="field">
                @if($user->EmpresaActual->tipoRegimen == "comun")
                Iva 19% <span id="iva" data-regimen="comun">$0.00</span>
                @else
                <span id="iva" data-regimen="simplificado"></span>
                @endif                
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
	                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
	                    <input class="form-control" name="propinaSugerida" placeholder="Propina sugerida %" type="text" value="{{$empresa->propina}}" id="propinaSugerida">
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
	            </div>
	            <div style="text-align: center; margin-top: 12%;" >
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
        $resolucion = document.getElementById("resolucion").value;
        if($propina == 0 || $propina == ""){
        	document.getElementById("propinaSugerida").value = null;
        }
        if($resolucion == 0 || $resolucion == ""){
        	document.getElementById("resolucion").value = null;
        }

        //SCRIPTS PARA IMPUESTOS
        var next = 1;
        var auxNext = 1;
	    $(".add-more").click(function(e){
	    	if(next < 3){
	    		e.preventDefault();
		        var addto = "#valor" + (auxNext);
		        var addRemove = "#valor" + (auxNext);
		        var addAdd = "#valor" + (auxNext);

		        next = next + 1;
		        auxNext = auxNext + 1;
		        var newIn = '<input autocomplete="off" placeholder="Impuesto" class="input" id="field' + next + '" name="field' + auxNext + '" type="text" style="width: 10%; margin-top: 1%;">';
		        var newVal = '<input autocomplete="off" placeholder="0%" class="input" id="valor' + next + '" name="valor' + auxNext + '" type="text" style="width: 5%; margin-top: 1%;">';
		        var newInput = $(newIn);
		        var newInputVal = $(newVal);

		        var removeBtn = '<button id="remove' + (auxNext - 1) + '" class="btn btn-danger remove-me" style="padding: 1px 7px; width: 3%; margin-top: 1%;" type="button">-</button></div><div id="field">';

		        var addBtn = '<button id="b' + (auxNext) + '" class="add-more btn btn-pocket" type="button" style="padding: 1px 7px; width: 3%; margin-top: 1%;">+</button></div><div id="field">';

		        var removeButton = $(removeBtn);
		        var addButton = $(addBtn);

		        $(addto).after(newInputVal);
		        $(addto).after(newInput);

		        if((auxNext - 1) > 1){
		        	$(addRemove).after(removeButton); 
		        }else{
		        	$(addAdd).after(addButton);
		        }
		        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
			    $("#count").val(next); 
		        
	            $('.remove-me').click(function(e){
	            	next = next - 1;
	            	auxNext = next + 1;
	                e.preventDefault();
	                var fieldNum = this.id.charAt(this.id.length-1);
	                var fieldID = "#field" + fieldNum;
	                var valorID = "#valor" + fieldNum;
	                repite = true;
	                $(this).remove();
	                $(fieldID).remove();
	                $(valorID).remove();
	            });
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
</style>

@endsection