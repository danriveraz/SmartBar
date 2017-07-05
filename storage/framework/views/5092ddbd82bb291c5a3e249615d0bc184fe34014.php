<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-4 col-sm-6">
  <div class="panel-tittle">
      <h2><?php echo e($mesa->nombreMesa); ?></h2>
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
    <?php foreach($categorias as $categoria): ?>
      <div class="col-md-8">
        <a href="<?php echo e(url('mesero/lista')); ?>" method="GET">
          <div class="panel panel-default">
            <div class ="panel-body">
                <?php echo e($categoria->nombre); ?>

            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
    </nav>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>