@extends('Layout.app_empleado')
@section('content')

{!!Html::style('stylesheets\mesero.css')!!}

<div class="col-sm-offset-2 col-sm-8">
  @if(Session::has('success_msg'))
      <div class="alert alert-dismissable alert-success">
  			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  			<i class="glyphicon glyphicon-sucess"></i> {{Session::get('success_msg')}}
      </div>
  @endif

  @if(sizeOf($mesasDisponibles) > 0)
    <div id="contenedorMesas" style="float:left; width: calc(100% / {{$cantidad}});">
      <div id="estadoMesa">
        <h3>
          MESAS DISPONIBLES
        </h3>
      </div>
      <div class="container-fluid main-content"><div class="social-wrapper">
      <div id="social-container">
        @foreach($mesasDisponibles as $mesaDisponible)
          <div class="item social-widget" nombre="mesa" id="{{$mesaDisponible->id}}">
            <div id="mesaDisponible"></div>
            <a href="{{ route('mesero.show', $mesaDisponible->id) }}">
              <div class="social-data" >
                <h1>
                  {{$mesaDisponible->nombreMesa}}
                </h1>
              </div>
            </a>
          </div>
        @endforeach
      </div>
      </div></div>
    </div>
  @endif
  @if(sizeOf($mesasOcupadas) > 0)
    <div id="contenedorMesas" style="float:left; width: calc(100% / {{$cantidad}});">
      <div id="estadoMesa">
        <h3>
          MESAS OCUPADAS
        </h3>
      </div>
      <div class="container-fluid main-content"><div class="social-wrapper">
      <div id="social-container">
        @if($cantidad == 3)
          @foreach($mesasOcupadas as $mesaOcupada)
            <div class="item social-widget" nombre="mesa" id="{{$mesaOcupada->id}}" style="margin-left:18%;">
              <div id="mesaOcupada"></div>
              <a href="{{ route('mesero.show', $mesaOcupada->id) }}">
                <div class="social-data" >
                  <h1>
                    {{$mesaOcupada->nombreMesa}}
                  </h1>
                </div>
              </a>
            </div>
          @endforeach
        @else
          @foreach($mesasOcupadas as $mesaOcupada)
            <div class="item social-widget" nombre="mesa" id="{{$mesaOcupada->id}}">
              <div id="mesaOcupada"></div>
              <a href="{{ route('mesero.show', $mesaOcupada->id) }}">
                <div class="social-data" >
                  <h1>
                    {{$mesaOcupada->nombreMesa}}
                  </h1>
                </div>
              </a>
            </div>
          @endforeach
        @endif
      </div>
      </div></div>
    </div>
  @endif
  @if(sizeOf($mesasReservadas) > 0)
    <div id="contenedorMesas" style="float:left; width: calc(100% / {{$cantidad}});">
      <div id="estadoMesa">
        <h3>
          MESAS RESERVADAS
        </h3>
      </div>
      <div class="container-fluid main-content"><div class="social-wrapper">
      <div id="social-container">
        @if($cantidad == 3)
          @foreach($mesasReservadas as $mesaReservada)
            <div class="item social-widget" nombre="mesa" id="{{$mesaReservada->id}}" style="margin-left:18%;">
              <div id="mesaReservada"></div>
              <a href="{{ route('mesero.show', $mesaReservada->id) }}">
                <div class="social-data" >
                  <h1>
                    {{$mesaReservada->nombreMesa}}
                  </h1>
                </div>
              </a>
            </div>
          @endforeach
        @else
          @foreach($mesasReservadas as $mesaReservada)
            <div class="item social-widget" nombre="mesa" id="{{$mesaReservada->id}} ">
              <div id="mesaReservada"></div>
              <a href="{{ route('mesero.show', $mesaReservada->id) }}">
                <div class="social-data" >
                  <h1>
                    {{$mesaReservada->nombreMesa}}
                  </h1>
                </div>
              </a>
            </div>
          @endforeach
        @endif
      </div>
      </div></div>
    </div>
  @endif
</div>

<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">

{!!Html::style('stylesheets\font-awesome.min.css')!!}
{!!Html::style('stylesheets\isotope.css')!!}
{!!Html::style('stylesheets\fullcalendar.css')!!}

<script>
  $("div[nombre|='mesa']").click(function(){
    var idDiv = $(this).attr("id");
    window.location = "http://localhost/PocketByR/public/mesero/"+idDiv;
  });
</script>

@endsection
