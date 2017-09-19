@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle" align="center">
      <h3><B>{{$agenda->user->nombrePersona}}</B></h3>
  </div>
  <div class ="panel-body">
      {!!Form::model($agenda,['route'=> ['AgendaTrabajadores.update',$agenda->id ], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        <!--Fecha de nacimiento-->
        <div class="form-grup">
          <br><label for="fechaTrabajo" class="control-label">Fecha de agendar trabajo:</label>
          <input value="{{$agenda->fechaTrabajo}}" required type="date" name="fechaTrabajo" class="form-control"/>
          <div class="bg-danger text-white">{{$errors->first('fechaTrabajo')}}</div>
        </div><br>

        <div class="form-grup">
          <br><button type="submit" class="btn btn-default"></i> Guardar
          </button>
        </div>

      {!!Form::close()!!}
  </div>
</div>
@endsection