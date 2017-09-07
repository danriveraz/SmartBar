@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle" align="center">
      <h3><B>MI PERSONAL</B></h3>
  </div>
  <div class ="panel-body">
      {!!Form::open(['route'=>'Auth.usuario.store', 'method'=>'POST', 'files' => true])!!}
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-6">
             <div class="form-group">
                  <label class="control-label"></label>
                  <div class="col-md-12">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                      </div>
                      <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar Imagen</span><span class="fileupload-exists">editar</span><input type="file" class="form-control" name="imagenPerfil"  id="imagenPerfil"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
          <div class="col-md-6">
            <!--Nombre-->
            <div class="form-group">
              <input type="text" name="nombrePersona" class="form-control" placeholder="Nombre completo" placeholder="Nombre" />
              <div class="bg-danger text-white">{{$errors->first('nombrePersona')}}</div>
            </div>

            <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Correo electrónico" placeholder="E-mail" />
              <div class="bg-danger text-white">{{$errors->first('email')}}</div>
            </div>

            <!--Numero de identificacion-->
            <div class="form-grup">
              
              <input type="text" name="cedula" class="form-control" placeholder="Identificación" />
              <div class="bg-danger text-white">{{$errors->first('cedula')}}</div>
            </div> <br>
          </div>
        </div>

        <!--Sexo-->
        <div class="form-grup">
          <br>
          <div class="row">
            <label for="sexo" class="control-label col-md-2">Sexo:</label>
            <div class="col-md-7">
              <label class="radio-inline">
                <input type="radio" name="sexo" value="Femenino"><span>Femenino</span>
              </label>
              <label class="radio-inline">
                <input type="radio" name="sexo" value="Masculino"><span>Masculino</span></label>
              </label>
              <div class="bg-danger text-white">{{$errors->first('sexo')}}</div>
            </div>
          </div>
        </div>


        <!--Fecha de nacimiento-->
        <div class="form-grup">
          <br><label for="fechaNacimiento" class="control-label">Fecha de nacimiento:</label>
          <input type="text" name="fechaNacimiento" data-date-autoclose="true" class="form-control datepicker"/>
          <div class="bg-danger text-white">{{$errors->first('fechaNacimiento')}}</div>
        </div><br>

        <!--Tipos-->
        <div class="form-group">
          <div class="row">
            <label class="control-label">Permisos:</label>
          </div>
          <div class="row">
          </div>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Mesero', 0, ['data-toggle'=>'checkbox']) !!}
              <span>Mesero</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Bartender', 0, ['data-toggle'=>'checkbox']) !!}<span>Bartender</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Cajero', 0, ['data-toggle'=>'checkbox']) !!}<span>Cajero</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Administrador', 0, ['data-toggle'=>'checkbox']) !!}<span>Administrador</span>
            </label>
            <label class="checkbox-inline">
              {!! Form::checkbox('Permisos[]', 'Obsequio', 0, ['data-toggle'=>'checkbox']) !!}<span>Obsequiar</span>
            </label>
          </div>
          <div class="col-md-7">
        </div>

        <div class="form-grup">
          <br><button type="submit" class="btn btn-default"></i> Guardar
          </button>
        </div>

      {!!Form::close()!!}
  </div>
</div>
@endsection
