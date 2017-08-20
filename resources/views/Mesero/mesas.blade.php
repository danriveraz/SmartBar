@extends('Layout.app_empleado')
@section('content')

{!!Html::style('stylesheets\mesero.css')!!}

<div class="col-sm-offset-1 col-sm-10">
  @if(Session::has('success_msg'))
      <div class="alert alert-dismissable alert-success">
  			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  			<i class="glyphicon glyphicon-sucess"></i> {{Session::get('success_msg')}}
      </div>
   @endif

  <div class="container-fluid main-content"><div class="social-wrapper">
  	<div id="social-container"></div>

  		<div id="hidden-items">
  		@foreach($mesas as $mesa)
  		    <div class="item social-widget">
            @if($mesa->estado == 'Disponible')
              <div id="mesaDisponible"></div>
            @elseif($mesa->estado == 'Ocupada')
              <div id="mesaOcupada"></div>
            @else
              <div id="mesaReservada"></div>
            @endif
            <a href="{{ route('mesero.show', $mesa->id) }}">
              <div class="social-data" >
    		        <h1>
    		          {{$mesa->nombreMesa}}
    		        </h1>
    		      </div>
            </a>
  		    </div>
  		@endforeach
  		</div>
  	</div>
  </div>
</div>

<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">

{!!Html::style('stylesheets\font-awesome.min.css')!!}
{!!Html::style('stylesheets\isotope.css')!!}
{!!Html::style('stylesheets\fullcalendar.css')!!}



@endsection
