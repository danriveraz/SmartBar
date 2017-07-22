<?php $__env->startSection('content'); ?>
<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
<?php echo Html::style('stylesheets\font-awesome.min.css'); ?>

<?php echo Html::style('stylesheets\isotope.css'); ?>

<?php echo Html::style('stylesheets\fullcalendar.css'); ?>

<?php echo Html::style('stylesheets\mesero.css'); ?>


<?php echo Html::script('javascripts\bootstrap.min.js'); ?>

<?php echo Html::script('javascripts\jquery.bootstrap.wizard.js'); ?>

<?php echo Html::script('javascripts\fullcalendar.min.js'); ?>

<?php echo Html::script('javascripts\jquery.dataTables.min.js'); ?>

<?php echo Html::script('javascripts\jquery.easy-pie-chart.js'); ?>

<?php echo Html::script('javascripts\jquery.isotope.min.js'); ?>

<?php echo Html::script('javascripts\jquery.fancybox.pack.js'); ?>

<?php echo Html::script('javascripts\select2.js'); ?>

<?php echo Html::script('javascripts\jquery.sparkline.min.js'); ?>

<?php echo Html::script('javascripts\main.js'); ?>


<div class="col-sm-offset-1 col-sm-10">
  <?php if(Session::has('success_msg')): ?>
      <div class="alert alert-dismissable alert-success">
  			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  			<i class="glyphicon glyphicon-sucess"></i> <?php echo e(Session::get('success_msg')); ?>

      </div>
   <?php endif; ?>

  <div class="container-fluid main-content"><div class="social-wrapper">
  	<div id="social-container"></div>

  		<div id="hidden-items">
  		<?php foreach($mesas as $mesa): ?>
  		    <div class="item social-widget mesas">
  		      <i class="fa fa-glass"></i>
            <a href="<?php echo e(route('mesero.show', $mesa->id)); ?>">
              <div class="social-data" >
    		        <h1>
    		          <?php echo e($mesa->nombreMesa); ?>

    		        </h1>
    		      </div>
            </a>
  		    </div>
  		<?php endforeach; ?>

  		</div>
  	</div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>