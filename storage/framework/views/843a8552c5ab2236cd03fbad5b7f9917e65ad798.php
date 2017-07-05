<?php $__env->startSection('content'); ?>


<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all"/>

<link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>

<!-- fuentes google -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,700,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

<!-- sript basico -->
<script type="text/javascript" src="js/jquery.min.js"></script>
 <!-- script para select estilo -->
 <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>


<script type="text/javascript">
	$(document).ready(function() {	
	    function update(){
	         $("#listaPedidos").load('bartender/tabla');
	    } 	
	    setInterval(update,1000);
	});
</script>
</head>
<body onload="ready();">

     
	<div class="welcome">
		<div class="container">
			<div class="panel-tittle">
				<h1>Mesas con pedidos pendientes</h1>
			</div>
			<div class="welcome-grids"></div>
			<br><br>
			<div class="col-sm-4"></div>
				<div id="listaPedidos" class="col-sm-4">
				<br><br> 
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>