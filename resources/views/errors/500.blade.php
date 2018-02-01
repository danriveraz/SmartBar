<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      Pocket SMARTBAR
    </title>
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css">
    {!!Html::style('stylesheets\bootstrap.min.css')!!}
    {!!Html::style('stylesheets\font-awesome.min.css')!!}
    {!!Html::style('stylesheets\hightop-font.css')!!}
    {!!Html::style('stylesheets\style.css')!!}
  </head>
  <body class="fourofour" style="background-color:#2d0031">
    <!-- Login Screen -->
    <div class="fourofour-container">
      <h1>
        <i class="fa fa-unlink"></i>
      </h1>
      <h2>
        <b>Oops! Acceso denegado!</b>
        <br>
        No podemos validar tu solicitud
      </h2>
      <a class="btn btn-lg btn-default-outline" href="{{url('/')}}"><i class="fa fa-home"></i>Retornar</a>
    </div>
    <!-- End Login Screen -->
  </body>
</html>