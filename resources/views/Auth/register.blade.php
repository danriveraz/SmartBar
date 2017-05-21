@extends('layout.app')

@section('content')
<h1>Formulario de registro</h1>

<div class="text-info">
	@if(Session::has('message'))
	{{Session::get('message')}}
	@endif
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	
<div class="col-sm-offset-3 col-sm-6">
	<div class="panel-title">
		<h1>Registro</h1>
	</div>
	<div class="panel-body"> 
		<form action="{{url('auth/register')}}" method="POST">
			{{ csrf_field() }}

			<!--Nombre establecimiento-->
			 <div class='form-group'>
		        <label for="nombreEstablecimiento">Nombre del establecimiento:</label>
		        <input type="text" name="nombreEstablecimiento" class="form-control" value="{{ old('nombreEstablecimiento') }}" />
		        <div class="text-danger">{{$errors->first('nombreEstablecimiento')}}</div>
		    </div>

			<!--Nombre-->
			 <div class='form-group'>
		        <label for="name">Nombre:</label>
		        <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
		        <div class="text-danger">{{$errors->first('name')}}</div>
		    </div>

			<!--Cedula-->
			 <div class='form-group'>
		        <label for="cedula">Cédula:</label>
		        <input type="number" name="cedula" class="form-control" value="{{ old('cedula') }}" />
		        <div class="text-danger">{{$errors->first('cedula')}}</div>
		    </div>
				
			<!--Sexo-->
			<div class="form-group">
				<label for="sexo" class="control-label">Sexo</label>
				<select name="sexo" class="form-control">
					<option value="" disabled selected>Seleccione...</option>
					<option value="masculino">Masculino</option>
					<option value="femenino">Femenino</option>
				</select>
				 <div class="text-danger">{{$errors->first('sexo')}}</div>
			</div>

			<!--Correo-->
			 <div class="form-group">
		        <label for="email">Email:</label>
		        <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
		        <div class="text-danger">{{$errors->first('email')}}</div>
		    </div>

			<!--Telefono-->
			 <div class='form-group'>
		        <label for="telefono">Telefono:</label>
		        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" />
		        <div class="text-danger">{{$errors->first('telefono')}}</div>
		    </div>
			
		  <div class="form-group">
		        <label for="password">Password:</label>
		        <input type="password" class="form-control" name="password" />
		        <div class="text-danger">{{$errors->first('password')}}</div>
		    </div>

		    <div class="form-group">
		        <label for="password_confirmation" class="control-label">Confirmar Password:</label>
		        <input type="password" class="form-control" name="password_confirmation" />
		    </div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Registrarse
				</button>
			</div>

		</form>
	</div>
</div>

@endsection
