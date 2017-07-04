<?php $__env->startSection('content'); ?>
<div class="text-info">
    <?php if(Session::has('message')): ?>
    <?php echo e(Session::get('message')); ?>

    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-title">
        <h1>Perfil</h1>
    </div>
    <div class="panel-body"> 
        <div class="panel panel-default">
            <div class="panel-body"> 
                <label for="perfil" class="control-label">Foto de perfil</label>
                <img src="\PocketByR\public\images\admins\<?php echo e(Auth::user()->imagenPerfil); ?>"  title="Imagen de pefil" width="30%" height="80%" class="img-responsive" alt="Foto de perfil">
            </div>
            <div class="panel-body">
                <label for="negocio" class="control-label">Foto de negocio</label>
                <img src="\PocketByR\public\images\admins\<?php echo e(Auth::user()->imagenNegocio); ?>" aling="center"  width="30%" class="img-responsive" alt="Foto de perfil">
            </div>
        </div>
    <div class="panel-footer"></div>
    </div>
        <form action="<?php echo e(url('auth/editProfile')); ?>">
                <?php echo e(csrf_field()); ?> 
            <div class="form-group">
                <label for="nombreEstablecimiento" class="control-label">Nombre establecimiento</label>
                <input type="text" name="nombreEstablecimiento" class="form-control" 
                value="<?php echo e(Auth::user()->nombreEstablecimiento); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <label for="nombrePersona" class="control-label">Nombre completo</label>
                <input type="text" name="nombrePersona" class="form-control" 
                value="<?php echo e(Auth::user()->nombrePersona); ?>" disabled="true">
            </div>
            <div class="form-group">
                <label for="pais" class="control-label">Pais</label>
                <input type="text" name="pais" class="form-control" 
                value="<?php echo e(Auth::user()->pais); ?>"  disabled="true">
            </div>
            <div class="form-group">
                <label for="departamento" class="control-label">Departamento</label>
                <input type="text" name="departamento" class="form-control" 
                value="<?php echo e(Auth::user()->departamento); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <label for="ciudad" class="control-label">Ciudad</label>
                <input type="text" name="ciudad" class="form-control" 
                value="<?php echo e(Auth::user()->ciudad); ?>" disabled="true">
            </div>
            <div class="form-group">
                <label for="fechaNacimiento" class="control-label">Fecha nacimiento</label>
                <input type="date" name="fechaNacimiento" class="form-control " 
                value="<?php echo e(Auth::user()->fechaNacimiento); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <label for="metodoPago" class="control-label">Metodo de pago</label>
                <input type="text" name="metodoPago" class="form-control " 
                value="<?php echo e(Auth::user()->metodoPago); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <label for="sexo" class="control-label">Sexo</label>
               <input type="text" name="sexo" class="form-control " 
                value="<?php echo e(Auth::user()->sexo); ?>" disabled="true" >
            </div>
            <div class="form-group">
            <label for="tipoRegimen" class="control-label">Tipo regimen</label>
                <input type="text" name="tipoRegimen" class="form-control " 
                value="<?php echo e(Auth::user()->tipoRegimen); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <label for="telefono" class="control-label">Telefono</label>
                <input type="text" name="telefono" class="form-control" 
                value="<?php echo e(Auth::user()->telefono); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <label for="baroRestaurante" class="control-label">Tipo negocio</label>
                <input type="text" name="baroRestaurante" class="form-control " 
                value="<?php echo e(Auth::user()->baroRestaurante); ?>" disabled="true" >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Editar perfil
                </button>
            </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>