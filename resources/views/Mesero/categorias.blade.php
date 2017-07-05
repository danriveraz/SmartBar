@extends('Layout.app')
@section('content')

<div class="col-sm-offset-4 col-sm-6">
  <div class="panel-tittle">
      <h2>{{$mesa->nombreMesa}}</h2>
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
    @foreach($categorias as $categoria)
      <div class="col-md-8">
        <a href="{{ url('mesero/lista') }}" method="GET">
          <div class="panel panel-default">
            <div class ="panel-body">
                {{$categoria->nombre}}
            </div>
          </div>
        </a>
      </div>
    @endforeach
    </nav>
</div>

@endsection
