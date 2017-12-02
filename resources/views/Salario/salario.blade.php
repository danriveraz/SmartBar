@extends('Layout.app')
@section('content')

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
  
