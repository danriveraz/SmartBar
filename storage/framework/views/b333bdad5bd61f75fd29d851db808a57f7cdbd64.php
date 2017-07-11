<?php $__env->startSection('panel-title', 'crear insumo'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Insumo</h1>
    </div>
    <div class ="panel-body">
        <form action=" <?php echo e(route('auth.insumo.store')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre del insumo</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" required="true"/>
                </div>
                <div class="form-grup">
                    <label for="idProveedor" class="control-label">Proveedor</label>
                    <?php echo Form::select('proveedores', $proveedores, null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-grup">
                    <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
                    <input type="number" name="cantidadUnidad" class="form-control" required="true">
                </div>
                <div class="form-grup">
                    <label for="precioUnidad" class="control-label">Valor de venta</label>
                    <input type="number" name="precioUnidad" class="form-control" required="true">
                </div>
                 <div class="form-grup">
                    <label for="valorCompra" class="control-label">Valor de compra</label>
                    <input type="number" name="valorCompra" class="form-control" required="true">
                </div>
                <div class="form-grup">
                    <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
                    <input type="number" step="any" name="cantidadMedida" class="form-control" required="true"/>
                    <select name="medida"> 
                        <option value="ml">ml</option> 
                        <option value="cm3">cm3</option> 
                        <option value="oz">oz</option> 
                    </select>
                </div>
                <br>
                <div class="form-grup">
                    <label for="tipo" class="control-label">Tipo</label>
                    <select name="Tipo">
                        <option value="A la venta">A la venta</option>
                        <option value="No a la venta">No a la venta</option>
                    </select>
                </div>
                <br>
                <div class="form-grup">
                    <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Registrar insumo
                    </button>
                </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>