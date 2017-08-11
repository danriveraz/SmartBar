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

{!!Html::script('javascripts\bootstrap.min.js')!!}
{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\fullcalendar.min.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.isotope.min.js')!!}
{!!Html::script('javascripts\jquery.fancybox.pack.js')!!}
{!!Html::script('javascripts\select2.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}
{!!Html::script('javascripts\main.js')!!}

@endsection
