<!DOCTYPE html>
@extends('Layout.app')
@section('content')

  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
      <div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            Agenda
          </h1>
        </div>
        <div class="row">
          <div class="col-md-9">
            <div class="widget-container fluid-height clearfix">
              <div class="widget-content padded">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3 visible-md visible-lg">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="fa fa-calendar"></i>Proximos eventos
              </div>
              <div class="widget-content padded">
                <div id="external-events">
                  <form>
                    <input class="input form-control" id="event_title" placeholder="Titulo de evento..." type="text" value=""><select class="select2able chosen_select" data-placeholder="Select Label..." id="event_priority"><option value="default">Por defecto<option value="success">Prioritario<option value="info">Informativo<option value="warning">Aviso<option value="important">Importante</select>
                    <div class="space12"></div>
                    <a class="btn btn-default" href="javascript:;" id="event_add">Crear evento</a>
                  </form>
                  <div id="event_box"></div>
                  <label class="checkbox" for="drop-remove"><input id="drop-remove" type="checkbox"><span> Eliminar despues del evento</span></label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style-selector">
      <div class="style-selector-container">
        <h2>
          Estilo de diseño
        </h2>
        <select name="layout"><option value="fluid">Fluido<option value="boxed">Encuadre</select>
        <h2>
          Estilo de navegacion
        </h2>
        <select name="nav"><option value="top">Arriba<option value="left">Izquierda</select>
        <h2>
          Opcion de color
        </h2>
        <ul class="color-options clearfix">
          <li>
            <a class="blue" href="javascript:chooseStyle('none', 30)"></a>
          </li>
          <li>
            <a class="green" href="javascript:chooseStyle('green-theme', 30)"></a>
          </li>
          <li>
            <a class="orange" href="javascript:chooseStyle('orange-theme', 30)"></a>
          </li>
          <li>
            <a class="magenta" href="javascript:chooseStyle('magenta-theme', 30)"></a>
          </li>
          <li>
            <a class="gray" href="javascript:chooseStyle('gray-theme', 30)"></a>
          </li>
        </ul>
        <h2>
          Patrones de fondo
        </h2>
        <ul class="pattern-options clearfix">
          <li>
            <a class="active" href="#" id="bg-1"></a>
          </li>
          <li>
            <a href="#" id="bg-2"></a>
          </li>
          <li>
            <a href="#" id="bg-3"></a>
          </li>
          <li>
            <a href="#" id="bg-4"></a>
          </li>
          <li>
            <a href="#" id="bg-5"></a>
          </li>
        </ul>
        <div class="style-toggle closed">
          <span aria-hidden="true" class="hightop-gear"></span>
        </div>
      </div>
    </div>
  </body>
</html>
