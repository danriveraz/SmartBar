<?php $__env->startSection('content'); ?>

	<!-- bootstrap-css -->
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--// bootstrap-css -->
	<link href="../css/style1.css" rel="stylesheet" type="text/css" media="all"/>


	<!-- fuentes google -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,700,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

	<!-- sript basico -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	 <!-- script para select estilo -->
	<script src="../js/jquery.magnific-popup.js" type="text/javascript"></script>
	<style type="text/css">
		#caja {
			background: #028ccc;
			-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		}
	</style>
</head>
<body> 
	<div class="welcome">
		<div class="container" margin-right="auto">
			<div class="col-sm-4"></div>
			<div class="col-sm-4" id="caja" align="center"><?php echo e($nombreMesa); ?></div>
			<div class="col-sm-4"></div>
			<br><br>	
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
			<form name="formulario" autocomplete="on" method="post" action="<?php echo e(url('bartender/')); ?>">
				<?php echo e(csrf_field()); ?>

				<?php foreach($pedidos as $pedido): ?>
					<table id="tabla" class="table table-bordered">
						<tbody>
							<tr>
								<td rowspan="2" align="center" valign="center" width="20">Cantidad:<br><?php echo e($pedido->cantidad); ?></td>
								<td align="center" valign="center"><?php echo e($pedido->categoria); ?></td>
								<td rowspan="2" align="center" valign="center" width="10">
									<br><input type="checkbox" name="pedidos[]" value="<?php echo e($pedido->id); ?>">
								</td>
							</tr>
							<tr>
								<td align="center" valign="center"><?php echo e($pedido->nombre); ?>	</td>
							</tr>	 
						</tbody>
					</table>
				<?php endforeach; ?>
					<input name="Ok" type="submit"  value="Ok" class="btn btn-dufault">
			</form>
			</div><div class="col-sm-4"></div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>