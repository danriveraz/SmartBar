<?php $__env->startSection('content'); ?>
<div class="text-info">
    <?php if(Session::has('message')): ?>
    <?php echo e(Session::get('message')); ?>

    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-title">
        <h1>Editar perfil</h1>
    </div>
        <form method="POST" enctype="multipart/form-data" action="<?php echo e(url('auth/updateProfile')); ?>">
                <?php echo e(csrf_field()); ?> 
            <div class="form-group">
                <label for="nombreEstablecimiento" class="control-label">Nombre establecimiento</label>
                <input type="text" name="nombreEstablecimiento" class="form-control" 
                value="<?php echo e(Auth::user()->nombreEstablecimiento); ?>" >
                <div class="text-danger"><?php echo e($errors->first('nombreEstablecimiento')); ?></div>
            </div>
            <div class="form-group">
                <label for="nombrePersona" class="control-label">Nombre completo</label>
                <input type="text" name="nombrePersona" class="form-control" 
                value="<?php echo e(Auth::user()->nombrePersona); ?>" >
                <div class="text-danger"><?php echo e($errors->first('nombrePersona')); ?></div>
            </div>
            <div class="form-group">
                <label for="pais" class="control-label">Pais</label>
                <input type="text" name="pais" class="form-control" 
                value="<?php echo e(Auth::user()->pais); ?>" >
                <div class="text-danger"><?php echo e($errors->first('pais')); ?></div>
            </div>
            <div class="form-group">
                <label for="departamento" class="control-label">Departamento</label>
                <input type="text" name="departamento" class="form-control" 
                value="<?php echo e(Auth::user()->departamento); ?>" >
                <div class="text-danger"><?php echo e($errors->first('departamento')); ?></div>
            </div>
            <div class="form-group">
                <label for="ciudad" class="control-label">Ciudad</label>
                <input type="text" name="ciudad" class="form-control" 
                value="<?php echo e(Auth::user()->ciudad); ?>" >
                <div class="text-danger"><?php echo e($errors->first('ciudad')); ?></div>
            </div>
            <div class="form-group">
                <label for="fechaNacimiento" class="control-label">Fecha nacimiento</label>
                <input type="date" name="fechaNacimiento" class="form-control " 
                value="<?php echo e(Auth::user()->fechaNacimiento); ?>" >
                <div class="text-danger"><?php echo e($errors->first('fechaNacimiento')); ?></div>
            </div>
            <div class="form-group">
                <label for="metodoPago" class="control-label">Metodo de pago</label>
                <select name="metodoPago" class="form-control">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="paypal">Paypal</option>
                    <option value="efecty">Efecty</option>
                </select>
                 <div class="text-danger"><?php echo e($errors->first('metodoPago')); ?></div>
            </div>
            <div class="form-group">
                <label for="sexo" class="control-label">Sexo</label>
                <select name="sexo" class="form-control" value="<?php echo e(Auth::user()->sexo); ?>">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            <div class="text-danger"><?php echo e($errors->first('sexo')); ?></div>
            </div>
            <div class="form-group">
            <label for="tipoRegimen" class="control-label">Tipo regimen</label>
                <select name="tipoRegimen" class="form-control">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="comun">Común</option>
                    <option value="simplificado">Simplificado</option>
                </select>
                <div class="text-danger"><?php echo e($errors->first('sexo')); ?></div>
            </div>
            <div class="form-group">
                <label for="telefono" class="control-label">Telefono</label>
                <input type="text" name="telefono" class="form-control" 
                value="<?php echo e(Auth::user()->telefono); ?>">
                <div class="text-danger"><?php echo e($errors->first('telefono')); ?></div>
            </div>
            <div class="form-group">
                <label for="baroRestaurante" class="control-label">Tipo negocio</label>
                <select name="baroRestaurante" class="form-control">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="bar">Bar</option>
                    <option value="restaurante">Restaurante</option>
                </select>
                <div class="text-danger"><?php echo e($errors->first('sexo')); ?></div>
            </div>
            <div class="form-group">
                <?php echo Form::label('imagenPerfil','Imagen perfil'); ?>

                <?php echo Form::file('imagenPerfil'); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('imagenNegocio','Imagen negocio'); ?>

                <?php echo Form::file('imagenNegocio'); ?>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"> Guardar
                </button>
            </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>