<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Proveedor</h1>
    </div>
    <div class ="panel-body">
        <form action=" <?php echo e(route('proveedor.store')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre del proveedor</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del proveedor" required="true"/>
                </div>
                <div class="form-group">
                    <label for="direccion" class="control-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" required="true">
                </div>
                <div class="form-group">
                    <label for="telefono" class="control-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" placeholder="+00 000 000 0000" required="true">
                </div>
                <div class="form-grup">
                    <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Registrar proveedor
                    </button>
                </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>