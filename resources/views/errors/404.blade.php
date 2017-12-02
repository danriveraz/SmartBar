<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      Pocket SMARTBAR
    </title>
    <link rel="shortcut icon" href={{ asset('images/icon.png') }}>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\bootstrap.min.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\font-awesome.min.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\hightop-font.css" media="all" rel="stylesheet" type="text/css"><link href="stylesheets\style.css" media="all" rel="stylesheet" type="text/css">
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
        No pordemos validar tu solicitud
      </h2>
      <a class="btn btn-lg btn-default-outline" href="{{url('/')}}"><i class="fa fa-home"></i>Retornar</a>
    </div>
    <!-- End Login Screen -->
  </body>
</html>