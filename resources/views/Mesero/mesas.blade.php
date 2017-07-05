@extends('Layout.app')
@section('content')
<div class="col-sm-offset-1 col-sm-10">
  <div class="panel-tittle">
      <h3>Mesas</h3>
  </div>

  <style>
    a{
      text-align: center;
    }
    a:hover {
    	cursor: pointer;
    	text-decoration: none;
    }
  </style>

    <nav>
    @foreach($mesas as $mesa)
      <div class="col-md-3">
        <a href="{{ route('mesero.show',$mesa->id) }}">
          <div class="panel panel-default">
            <div class ="panel-body">
                {{$mesa->nombreMesa}}
            </div>
          </div>
        </a>
      </div>
    @endforeach
    </nav>
</div>
@endsection
