<?php $__env->startSection('content'); ?>

<div class="modal fade in" id="addModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['method' => 'POST', 'action' => 'categoriaController@store']); ?>

          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Registro
            </h4>
          </div>
          <div class="modal-body">
            <div class="pre-scrollable" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-grup">
                    <label for="nombre" class="control-label">Nombre de la categoría</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="true"/>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
            <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
          </div>
        <?php echo Form::close(); ?>

    </div>
   </div>
  </div>

<div class="col-sm-offset-2 col-sm-8">
    <div class="panel-tittle">
        <h1>Lista de productos</h1>
    </div>
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <a href="<?php echo e(route('producto.create')); ?>" class="btn btn-default"><i class="fa fa-plus"></i>Agregar nuevo producto 
    </a>
    <?php echo Form::model(Request::all(), ['route' => ['producto.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

    <div class="form-group" align="right">
      <?php echo Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']); ?>

      <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>

    <div align="right">
      <br>
      <?php echo Form::select('categorias', $categorias, null, ['class' => 'form-control']); ?>

       <td><a href="#addModal" class="btn btn-default" data-toggle="modal" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar nueva categoría</a> 
       </td>
      <td><a href="<?php echo e(route('categoria.index')); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
    </div>
  </div>
  <?php echo Form::close(); ?>

  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Categoria</th>
    </thead>
    <tbody>
      <?php foreach($productos as $producto): ?>
        <tr>
          <td><?php echo e($producto->id); ?></td>
          <td><?php echo e($producto->nombre); ?></td>
          <td><?php echo e($producto->precio); ?></td>
          <td><?php echo e($categorias[$producto->idCategoria]); ?></td>
          <td align="right"><a href="<?php echo e(route('producto.edit',$producto->id)); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
          <td align="right"><a href="<?php echo e(route('producto.insumoedit',$producto->id)); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Insumos <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $productos->appends(Request::all())->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>