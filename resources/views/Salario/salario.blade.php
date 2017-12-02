@extends('Layout.app')
@section('content')
<!DOCTYPE html>
<html>
  <head>
    <title>
      hightop - Dashboard
    </title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css"><link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/hightop-font.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css"><link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/fullcalendar.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/select2.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/morris.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/timepicker.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/colorpicker.css" media="all" rel="stylesheet" type="text/css"><link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css"><link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/typeahead.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/summernote.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/social-buttons.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/dropzone.css" media="screen" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/nestable.css" media="screen" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/pygments.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/style.css" media="all" rel="stylesheet" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css">
    <link href="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css">
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript">
    </script><script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/raphael.min.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/selectivizr-min.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/fullcalendar.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/gcal.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.dataTables.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/datatable-editable.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/excanvas.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.isotope.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/isotope_extras.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/modernizr.custom.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/select2.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/styleswitcher.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/wysiwyg.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/typeahead.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/summernote.min.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.inputmask.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.validate.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap-fileupload.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap-datepicker.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap-colorpicker.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap-switch.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/typeahead.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/spin.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/ladda.min.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/moment.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/mockjax.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/bootstrap-editable.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/xeditable-demo-mock.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/xeditable-demo.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/address.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/daterange-picker.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/date.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/morris.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/skycons.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/fitvids.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.sparkline.min.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/dropzone.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/jquery.nestable.js" type="text/javascript"></script><script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/main.js" type="text/javascript"></script>
    <script src="../../../xampp/htdocs/PocketByR/pantallas principales/Plantilla para el Bar/javascripts/respond.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
      <!-- Navigation --><!-- End Navigation -->
      <div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            Salario </h1>
        </div>
        <div class="invoice">
          <div class="row">
            <div class="col-lg-12">
              <div class="row invoice-header">
                <div class="col-md-6 text-right">
                  <h2>
                    Enero 1, 2018
                  </h2>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="well">
              <h3>
                  Álvaro Díaz</h3>
                <p>
                  No. Identificación<br>
                  Telefono<br>
                  Dirección<br>
                  alvaro@gmail.com
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="well">
                <h3>&nbsp;</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                  <table class="table table-striped invoice-table">
                    <thead>
                    <th width="50"></th>
                      <th>
                        Product
                      </th>
                      <th width="70">
                        Qty
                      </th>
                      <th width="100">
                        Unit Price
                      </th>
                      <th width="100">
                        Total
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          #1
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                      <tr>
                        <td>
                          #2
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                      <tr>
                        <td>
                          #3
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                      <tr>
                        <td>
                          #4
                        </td>
                        <td>
                          Product Name
                        </td>
                        <td>
                          2
                        </td>
                        <td>
                          $50
                        </td>
                        <td>
                          $100
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td class="text-right" colspan="4">
                          <strong>Subtotal</strong>
                        </td>
                        <td>
                          $1,000
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="4">
                          <strong>Tax</strong>
                        </td>
                        <td>
                          $70
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="4">
                          <strong>Shipping</strong>
                        </td>
                        <td>
                          $30
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="4">
                          <h4 class="text-primary">
                            Total
                          </h4>
                        </td>
                        <td>
                          <h4 class="text-primary">
                            $1,100
                          </h4>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row"></div>
          <div class="row">
            <div class="col-lg-12">
              <a class="btn btn-primary pull-right" onclick="javascript:window.print();"><i class="fa fa-print"></i>Pagar</a>
            </div>
          </div>
        </div>
      </div>
  </div>
    <div class="style-selector"></div>
  </body>
</html>
