<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<h1>Bienvenid@ {{$data->nombrePersona}}</h1>

<div class="_rp_x5 ms-font-weight-regular ms-font-color-neutralDark" id="Item.MessageNormalizedBody" style="font-family: wf_segoe-ui_normal, &quot;Segoe UI&quot;, &quot;Segoe WP&quot;, Tahoma, Arial, sans-serif, serif, EmojiFont;">
	<div class="rps_8dd2">
<div>
	<div style="background-color:white; padding: 15px 0px 50px; margin: 0px; text-align: center; font-family: Arial, Helvetica, sans-serif, serif, EmojiFont;">
<br>
<a href="https://www.buscalibre.com" target="_blank" rel="noopener noreferrer"><img data-imagetype="External" src="{{asset('/images/Correo.jpeg')}}"></a> <br>
<br>

<br>
<div style="background-color:#F1F1F1; border:solid 1px #c0c0c0; margin:0 auto; padding:15px; width:90%">
<span>Para confirmar tu cuenta presiona el siguiente link:</span> <span style="font-size:14px">
<p><a href="{{url('/')}}/Auth/confirm/email/{{$data->email}}/confirm_token/{{$data->confirm_token}}">Confirmar mi cuenta</a></p>
</span></div>
<div style="margin:0 auto; width:90%; padding:15px">

</div>
<br>

</div>

</div>
</div></div> <div style="display: none;"></div> 

</body>
</html>