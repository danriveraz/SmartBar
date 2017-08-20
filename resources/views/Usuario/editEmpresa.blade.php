@extends('Layout.app');
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Editar Empresa: {{$empresa->nombreEstablecimiento}}</h1>
  </div>

  <div class ="panel-body">
      {!! Form::open(['route' => ['Auth.usuario.editEmpresa',$empresa], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <!--Imagen de la empresa-->
        <div class="form-group">
          <label class="control-label col-md-2"></label>
          <div class="col-md-9">
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                @if($empresa->AdminTotal->imagenNegocio!='')
                  {!! Html::image('images/admins/'.$empresa->AdminTotal->imagenNegocio , 'imagen del negocio') !!}
                @else
                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                @endif
              </div>
              <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
              <div>
                <span class="btn btn-default btn-file"><span class="fileupload-new">Cargar</span><span class="fileupload-exists">Cambiar</span><input type="file" class="form-control" name="imagenEstablecimiento" ></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Eliminar</a>
              </div>
            </div>
          </div>
        </div>
        <!--Nombre-->
        <div class="form-group">
          <label for="nombreEstablecimiento" class="control-label">Nombre De La Empresa:</label>
          <input type="text" name="nombreEstablecimiento" class="form-control" value="{{$empresa->nombreEstablecimiento}}"/>
          <div class="bg-danger text-white">{{$errors->first('nombreEstablecimiento')}}</div>
        </div>
        <!--Numero de Teléfono-->
        <div class="form-grup">
          <label for="telefono" class="control-label">Número de Teléfono:</label>
          <input type="text" name="telefono" class="form-control" value="{{$empresa->telefono}}"/>
          <div class="bg-danger text-white">{{$errors->first('telefono')}}</div>
        </div>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default" onclick = "return confirm ('¿Desea modificar Los datos de la empresa?')"><i class="fa fa-plus"></i> Guardar
          </button>
        </div>
      {!! Form::close() !!}
  </div>
</div>
@endsection

