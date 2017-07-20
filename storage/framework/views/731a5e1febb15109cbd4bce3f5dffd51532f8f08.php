<?php $__env->startSection('panel-title', 'crear categoría'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Registrar nueva categoría</h1>
    </div>
    <div class ="panel-body">
        <form action=" <?php echo e(route('categoria.store')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre de la categoría</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="true"/>
                </div>
                
                <br>
                <div class="form-grup">
                    <button type="submit" class="btn btn-default"><i class="fa fa-plus">
                    </i> Registrar categoría</button>
                </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>