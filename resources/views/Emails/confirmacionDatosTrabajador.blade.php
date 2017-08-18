<h1>Bienvenid@ {{$data['user']->nombrePersona}}</h1>

<p>
	Su Usuario para el acceso a la plataforma es: {{$data['user']->username}} <br>
	Su Contraseña para el acceso a la plataforma es: {{$data['contrasena']}} <br>
</p>

<a href="{{url('/')}}/Auth/login}}">Iniciar sesión</a>