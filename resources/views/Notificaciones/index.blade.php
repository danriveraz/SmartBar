@extends('Layout.app_administradores')
@section('content')
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
@endsection
