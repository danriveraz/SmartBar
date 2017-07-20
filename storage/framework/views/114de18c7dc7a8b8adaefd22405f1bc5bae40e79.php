<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Registro de producto</h1>
    </div>
    <div class ="panel-body">
        <?php echo Form::open(['route' => ['producto.update',$producto],'method' => 'PUT']); ?>

            <div class="form-grup">
                <label for="nombre" class="control-label">Nombre del Producto</label>
                <input type="text" name="nombreProducto" class="form-control" placeholder="Nombre del producto" value="<?php echo e($producto->nombre); ?>" />
            </div>
            <div class="form-grup">
                <label for="categorias" class="control-label">Categoría</label>
                <?php echo Form::select('categorias', $categorias, null, ['class' => 'form-control']); ?>

            </div>
            <div class="form-grup">
                <label for="precio" class="control-label">Precio</label>
                <input type="number" step="any" name="precio" class="form-control" value="<?php echo e($producto->precio); ?>" />
            </div>
            <br>
                <div class="form-grup">
                    <label for="receta" class="control-label">Receta</label>
                    <br>
                    <textarea name="receta" class="form-control"><?php echo e($producto->receta); ?></textarea>
                </div>
                <br>
            <br>
            <div class="form-grup">
                <button type="submit" class="btn btn-default" onclick = "return confirm ('¿Está seguro de registrar el producto?')">
                    <i class="fa fa-plus"></i> Modificar producto
                </button>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>