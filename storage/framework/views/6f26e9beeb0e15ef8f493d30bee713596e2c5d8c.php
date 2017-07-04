<?php $__env->startSection('panel-title', 'modificar insumo'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Modificar insumo</h1>
    </div>
    <div class ="panel-body">
      <?php echo Form::open(['route' => ['auth.insumo.update',$insumo], 'method' => 'PUT']); ?>


        <div class="form-group">
          <label for="nombre" class="control-label">Nombre del insumo</label>
          <input type="text" name="nombre" class="form-control" value="<?php echo e($insumo->nombre); ?>"/>
        </div>

        <div class="form-grup">
            <label for="idProveedor" class="control-label">Proveedor</label>
            <?php echo Form::select('proveedores', $proveedores, null, ['class' => 'form-control']); ?>

        </div>
        <div class="form-grup">
            <label for="cantidadUnidad" class="control-label">Cantidad de unidades</label>
            <input type="number" name="cantidadUnidad" class="form-control" value="<?php echo e($insumo->cantidadUnidad); ?>"/>
        </div>
        <div class="form-grup">
            <label for="precioUnidad" class="control-label">Valor de venta</label>
            <input type="number" name="precioUnidad" class="form-control" value="<?php echo e($insumo->precioUnidad); ?>"/>
        </div>
        <div class="form-grup">
            <label for="valorCompra" class="control-label">Valor de compra</label>
            <input type="number" name="valorCompra" class="form-control" value="<?php echo e($insumo->valorCompra); ?>"/>
        </div>
        <div class="form-grup">
            <label for="cantidadMedida" class="control-label">Cantidad de medida</label>
            <input type="number" step="any" name="cantidadMedida" class="form-control" value="<?php echo e($insumo->cantidadMedida); ?>"/>
            <select name="medida"> 
                <option value="ml">ml</option> 
                <option value="cm3">cm3</option> 
                <option value="oz" <?php if($insumo->cantidadMedida !="0") echo "selected";?> >oz</option> 
            </select>
        </div>
        <br>
        <div class="form-grup">
            <label for="tipo" class="control-label">Tipo</label>
            <select name="Tipo">
                <option value="A la venta" <?php if($insumo->tipo =="A la venta") echo "selected";?>>A la venta</option>
                <option value="No a la venta" <?php if($insumo->tipo =="No a la venta") echo "selected";?>>No a la venta</option>
            </select>
        </div>
        <br>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default" onclick = "return confirm ('¿Desea modificar este insumo?')"><i class="fa fa-plus"></i> Editar insumo
          </button>
        </div>
      <?php echo Form::close(); ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>