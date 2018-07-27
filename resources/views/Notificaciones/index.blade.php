@extends('Layout.app_administradores')
@section('content')
{!!Html::style('assets-Internas/css/styleNotifi.css')!!}
<title>
  NOTIFICACIONES
</title>
<div style="background: #FCFCFC;">
  <div id="content" class="pmd-content inner-page">
    <div class="page-title" style="padding: 0 10px !important; padding-top: 30px !important;">
      <h1>Notificaciones del sistema</h1>
    </div>
		<div class="row">
		  <div class="col-lg-8 col-xs-8 col-sm-8 col-md-8 custom-col-8">
		    <div class="section section-custom" id="NotPrin">
				  <div class="section-inner">
				    <div class="row">
              <div class="page-content NotPrin">
            		<ul class="list-group pmd-list-twoline">
                  @foreach($notificaciones as $notificacion)
                  <form autocomplete="on" method="GET" action="{{route('notificacion.updateNotificacion',$notificacion)}}" id="formNotificaciones{{$notificacion->id}}" class="notificacion">
                    @if($notificacion->estado == "nueva")
  									<a class="list-group-item pmd-z-depth" type="submit"  onclick="document.getElementById('formNotificaciones{{$notificacion->id}}').submit();" style="background-color: #edf2fa">
                    @else
                    <a class="list-group-item pmd-z-depth" type="submit"  onclick="document.getElementById('formNotificaciones{{$notificacion->id}}').submit();">
                    @endif
  										<div class="media-left">
  									 		<div class="iconNot NotProfile"><i class="glyphicon glyphicon-bell"></i></div>
  										</div>
  										<div class="media-body">
                          <span class="list-group-item-heading">
                            <span>Notificación de {{$notificacion->ruta}}
                            </span>
                            @foreach($fecha2array as $fecha)
                              @if($fecha[0] == $notificacion->id)
                                @if($fecha[1] == 0)
                                  <small>Hoy</small>
                                @elseif($fecha[1] == 1)
                                  <small>Ayer</small>
                                @else
                                  <small>Hace {{$fecha[1]}} días</small>
                                @endif
                              @endif
                            @endforeach
                          </span>
                          <span class="list-group-item-date">
                            {{$notificacion->descripcion}}
                          </span>
                      </div>
  								  </a>
                  </form>
                  @endforeach
            		</ul>
        			</div>
  					</div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4 custom-col-4"></div>
		</div>
	</div>
</div>
@endsection