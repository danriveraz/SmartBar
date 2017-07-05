<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-1 col-sm-10">
  <div class="panel-tittle">
      <h3>Mesas</h3>
  </div>

  <style>
    a{
      text-align: center;
    }
    a:hover {
    	cursor: pointer;
    	text-decoration: none;
    }
  </style>

    <nav>
    <?php foreach($mesas as $mesa): ?>
      <div class="col-md-3">
        <a href="<?php echo e(route('mesero.show',$mesa->id)); ?>">
          <div class="panel panel-default">
            <div class ="panel-body">
                <?php echo e($mesa->nombreMesa); ?>

            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
    </nav>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>