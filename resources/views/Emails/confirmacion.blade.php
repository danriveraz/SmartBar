<h1>Bienvenid@ {{$data->nombrePersona}}</h1>

<p>
	Su Usuario para el acceso a la plataforma es: {{$data->username}} <br>
</p>

<a href="{{url('/')}}/Auth/confirm/email/{{$data->email}}/confirm_token/{{$data->confirm_token}}">
Confirmar mi cuenta</a>
<img src="{{asset('/images/Correo.jpeg')}}">