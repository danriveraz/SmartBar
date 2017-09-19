@extends('Layout.app')
@section('content')
@include('flash::message')
<h1>Ver horarios de entrada y salida del usuario</h1>
<h1>{{$usuario->nombrePersona}}</h1>
@foreach($usuario->registros as $registro)
	<p>
		{{$registro}}
	</p>
@endforeach

<h1>Agenda de trabajo</h1>
@foreach($usuario->AgendaTrabajadores as $horario)
	<td>
		{{$horario}}
	</td>
	<td>
		{!!link_to_route('AgendaTrabajadores.edit', $title = '', $parameters = $horario->id, $attributes = ['rel'=>'tooltip', 'title'=>'Editar', 'style'=>'border-style: none', 'class'=>'btn btn-info fa fa-edit fa-2x'])!!}
	</td>
	<td>
		{!!Form::open(['route'=> ['AgendaTrabajadores.destroy',$horario->id],'method'=>'DELETE'])!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!} 
	</td>
@endforeach
@endsection