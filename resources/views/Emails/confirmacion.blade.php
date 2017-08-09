<h1>Bienvenid@ {{$data->nombrePersona}}</h1>
<a href="{{url('/')}}/Auth/confirm/email/{{$data->email}}/confirm_token/{{$data->confirm_token}}">Confirmar mi cuenta</a>