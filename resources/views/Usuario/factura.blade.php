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
		         {!! Form::open(['route' => ['Auth.usuario.editFactura',$user], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
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
           	</div>
           	<div class="total text-right">
              <p class="extra-notes">
                <strong>Notas Adicionales</strong>
                <textarea id="notas" name="notas" class="form-control" rows="2" cols="100" maxlength="140" placeholder="Pon tu mensaje aquí" style="resize: none;">{{$empresa->notas}} </textarea>
              </p>
              <div class="field">
                Subtotal <span id="subtotal">$0.00</span>
              </div>
              <div class="field">
                @if($user->EmpresaActual->tipoRegimen == "comun")
                Iva 19% <span id="iva" data-regimen="comun">$0.00</span>
                @else
                <span id="iva" data-regimen="simplificado"></span>
                @endif                
              </div>
              <div class="field grand-total"> 
                Total <span id="total" data-total="0">$0</span>
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