<?php $__env->startSection('content'); ?>

<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
<?php echo Html::style('stylesheets\font-awesome.min.css'); ?>

<?php echo Html::style('stylesheets\isotope.css'); ?>

<?php echo Html::style('stylesheets\fullcalendar.css'); ?>

<?php echo Html::style('stylesheets\style.css'); ?>



<?php echo Html::script('javascripts\bootstrap.min.js'); ?>

<?php echo Html::script('javascripts\jquery.bootstrap.wizard.js'); ?>

<?php echo Html::script('javascripts\fullcalendar.min.js'); ?>

<?php echo Html::script('javascripts\jquery.dataTables.min.js'); ?>

<?php echo Html::script('javascripts\jquery.easy-pie-chart.js'); ?>

<?php echo Html::script('javascripts\jquery.isotope.min.js'); ?>

<?php echo Html::script('javascripts\jquery.fancybox.pack.js'); ?>

<?php echo Html::script('javascripts\select2.js'); ?>

<?php echo Html::script('javascripts\jquery.sparkline.min.js'); ?>

<?php echo Html::script('javascripts\main.js'); ?>



<div class="container-fluid main-content"><div class="social-wrapper">
  <div id="social-container">

    <div id="hidden-items"> 
    <?php foreach($facturas as $factura): ?>
        <div class="item social-widget pedido" nombre="pedidoMesa" id="<?php echo e($factura->mesa->id); ?>">
          <i class="fa fa-glass"></i>
          <div class="social-data">
            <h1>
              <?php echo e($factura->mesa->nombreMesa); ?>

            </h1>
            <?php
              $posiciones = explode(" ", $factura->fecha);
              $hora = explode(":", $posiciones[1]);
            ?>
            <?php echo e($hora[0]); ?>:<?php echo e($hora[1]); ?><br><?php echo e($posiciones[0]); ?> 
          </div>
        </div>
        <a class="btn btn-primary btn" data-toggle="modal" href="#myModal<?php echo e($factura->mesa->id); ?>" id="boton<?php echo e($factura->mesa->id); ?>" hidden="true"></a>
    <?php endforeach; ?>   
    </div>
  </div>
  </div>
 

 <?php foreach($facturas as $factura): ?>
  <div class="modal fade" id="myModal<?php echo e($factura->mesa->id); ?>">
    <div class="modal-dialog">
      <div class="modal-content">
      <form name="formulario" autocomplete="on" method="post" action="<?php echo e(url('bartender/')); ?>">
            <?php echo e(csrf_field()); ?>

        <div class="modal-header">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
          <h4 class="modal-title">
            <?php echo e($factura->mesa->nombreMesa); ?>

          </h4>
        </div>
        <div class="modal-body">
            <div class="widget-container scrollable list task-widget">
            <div class="heading">
                Pedidos
              </div>
            <div class="widget-content">
              <table class="table table-hover">
               <thead>
                  <th>Cant.</th>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th><i class="fa fa-check"></i></th>
                </thead>
              <?php foreach($factura->ventas as $venta): ?>
               <tr>
                  <td><?php echo e($venta->cantidad); ?></td>
                  <td><?php echo e($venta->producto->nombre); ?></td>
                  <td><?php echo e($venta->producto->categoria->nombre); ?></td>
                  <td><input type="checkbox" name="pedidos[]" value="<?php echo e($venta->id); ?>"" width="25" height="25"></td>
                </tr>
              <?php endforeach; ?> 
              </table>
            </div>
            </div>
            </div>
        <div class="modal-footer">
          <button class="btn btn-primary" >Guardar</button>
          <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?> 
 

</div>
<script type="text/javascript">
    $("div[nombre|='pedidoMesa']").click(function(){
      var idElegido = $(this).attr("id");
      var palabra = "#boton";
      var id = palabra.concat(idElegido);
      $(id).trigger('click');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>