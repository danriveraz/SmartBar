@extends('Layout.app_administradores')
@section('content')
{!!Html::style('assets-Internas/css/styleNotifi.css')!!}

<div style="background: #FCFCFC;">
<!--content area start-->

<div id="content" class="pmd-content inner-page">
<div class="page-title" style="padding: 0 10px !important; padding-top: 30px !important;">
<h1>Notificaciones del sistema</h1>
</div>

		<div class="row">
		<div class="col-lg-8 col-xs-8 col-sm-8 col-md-8 custom-col-8">
		<div class="section section-custom" id="NotPrin">
				<!-- section content start-->
				<div class="section-inner">
					<div class="row">
                			<div class="page-content NotPrin">
            					<ul class="list-group pmd-list-twoline">
									<li class="list-group-item unread new-day pmd-z-depth" data-date="Enero del 2018">
										<div class="media-left">
									 		<div class="iconNot NotProfile"><i class="glyphicon glyphicon-bell"></i></div>
										</div>
										<div class="media-body">
                        <span class="list-group-item-heading"><span>Notificacion de Perfil</span><small> 1 day ago</small></span>
                        <span class="list-group-item-date">¡Recuerde llenar TODOS los campos de su perfil!</span>
                    </div>
								  	</li>
              						<li class="list-group-item pmd-z-depth">
										<div class="media-left">
									 		<div class="iconNot NotProfile"><i class="glyphicon glyphicon-bell"></i></div>
										</div>
										<div class="media-body">
                        <span class="list-group-item-heading"><span>Notificacion de Perfil</span><small> 1 day ago</small></span>
                        <span class="list-group-item-date">¡Recuerde llenar TODOS los campos de su perfil!</span>
                    </div>
             					 	</li>
              						<li class="list-group-item unread pmd-z-depth">
										<div class="media-left">
									 		<div class="iconNot NotProfile"><i class="glyphicon glyphicon-bell"></i></div>
										</div>
										<div class="media-body">
                        <span class="list-group-item-heading"><span>Notificacion de Perfil</span><small> 1 day ago</small></span>
                        <span class="list-group-item-date">¡Recuerde llenar TODOS los campos de su perfil!</span>
                    </div>
              						</li>

                    <li class="list-group-item unread new-day pmd-z-depth" data-date="Febrero del 2018">
											<div class="media-left">
										 		<div class="iconNot NotProfile"><i class="glyphicon glyphicon-bell"></i></div>
											</div>
											<div class="media-body">
	                        <span class="list-group-item-heading"><span>Notificacion de Perfil</span><small> 1 day ago</small></span>
	                        <span class="list-group-item-date">¡Recuerde llenar TODOS los campos de su perfil!</span>
	                    </div>
								  	</li>
              			<li class="list-group-item pmd-z-depth">
											<div class="media-left">
										 		<div class="iconNot NotProfile"><i class="glyphicon glyphicon-bell"></i></div>
											</div>
											<div class="media-body">
	                        <span class="list-group-item-heading"><span>Notificacion de Perfil</span><small> 1 day ago</small></span>
	                        <span class="list-group-item-date">¡Recuerde llenar TODOS los campos de su perfil!</span>
	                    </div>
             					 	</li>
            					</ul>
        					</div>
					</div>
				</div> <!-- section content end -->
			</div>
		</div>
		<div class="col-lg-4 col-xs-4 col-sm-4 col-md-4 custom-col-4">
		</div>
		</div>
	</div><!-- tab end -->
</div>
@endsection

<!--
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-container">
            <table class="table table-filter">
              <tbody>
                @foreach($notificaciones as $notificacion)
                <tr data-status="pagado">
                  <td></td>
                  <td>
                    <div class="media">
                      <div class="media-body">
                        {{$notificacion->descripcion}}
                      </div>
                    </div>
                  </td>
                  <td>
                    @if($notificacion->estado == 'nueva')
                    <div class="notifications label label-info">
                      Nuevo
                    </div>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
-->
