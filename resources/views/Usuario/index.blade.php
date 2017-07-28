@extends('Layout.app')
@section('content')
<div class="container-fluid main-content">
  <div class="">
      <h1>Lista de usuarios</h1>
      @include('flash::message')
      <a href="{{ route('auth.usuario.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo usuario </a>
  </div>
  <div class="social-wrapper">
    <div id="social-container">
  @foreach($usuarios as $usuario)
<!-- Profile Widget -->
<div class="item widget-container fluid-height profile-widget">
  <div class="heading">
      <i class="fa fa-level-up"></i><a href="">Ver mas</a><i class="fa fa-times pull-right"></i><i class="fa fa-gear  pull-right"></i>
  </div>
  <div class="widget-content padded">
    <div class="profile-info clearfix">
      <img width="70" height="70" class="social-avatar pull-left" src="{{ asset( 'images/admins/'.$usuario->imagenPerfil) }}">
      <div class="profile-details">
        <a class="user-name" href="">{{$usuario->nombrePersona}}</a>
        <p>Datos del Empleado</p>
        <em><i class="fa fa-list-alt "></i>{{$usuario->cedula}}</em>
        <em><i class="fa fa-phone "></i>3012343457</em>
        <p>
          @if($usuario->esAdmin == 1) Administrador
          @else 
            @if($usuario->esMesero != 0) Mesero 
            @endif
            @if($usuario->esBartender != 0) Bartender
            @endif
            @if($usuario->esCajero != 0) Cajero
            @endif
          @endif
        </p>
      </div>
    </div>
    <div class="profile-stats">
      <div class="col-md-4">          
       <div class="btn-group dropup">
          <button class="btn btn-info">Control</button><button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li>
              <a href="#"><i class="fa fa-clock-o pull-left"></i>Horas Ingreso</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-bar-chart-o pull-left"></i>Estadisticas</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-money pull-left"></i>Salario</a>
            </li>
          </ul>
        </div>                      
      </div>
      
      <div class="col-md-4">           
        <button class="btn btn-info"><i class="fa fa-calendar-o"></i>Agenda</button>           
      </div>
      
      <div class="col-md-4">            
        <button class="btn btn-info"><i class="fa fa-envelope-o"></i>Mensaje</button>            
      </div>
      
    </div>
  </div>
</div>
<!-- end Profile Widget -->
          <!--
          <td><a href="{{ route('auth.usuario.edit',$usuario->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('auth.usuario.destroy',$usuario->id) }}" onclick="return confirm('¿Estas seguro que deseas eliminar este usuario?')"
             class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
          -->
      @endforeach
    </div>
  </div>



<!-- inidio de slider de agregar usuario -->
<div class="style-selector" >
<div class="style-selector-container">
  <div class="row">
    <div class="">
      <div class="widget-container">
        <div class="heading">
          <i class="fa fa-shield"></i>Formulario Para Nuevo Usuario      </div>
        <div class="widget-content padded">
          <form action="" id="validate-form" method="get">
            <fieldset>
              <div class="row">
                <div class="col-md-4">
                   
                   
                       <div class="form-group">
              <label class="control-label col-md-2"></label>
              <div class="col-md-9">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                  </div>
                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                  </div>
                </div>
              </div>
            </div>
            
             <div  style="margin-top: 73%;"></div>
                   <div class="form-group">
                    <label for="firstname">Nombre Del Empleado</label><input class="form-control" id="" name="" type="text">
                  </div> 
                   
                </div>
                <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="lastname">Cedula o Documento</label><input class="form-control" id="" name="" type="text">
                  </div>
                  <div class="form-group">
                    <label for="firstname">Email</label><input class="form-control" id="" name="" type="email">
                  </div>
                 
                  <div class="form-group">
                    <label for="password">Tipo De Empleado</label>
                    <!--
                    <select class="select2able">
                    <option value="Category 1">Mesero
                    <option value="Category 2">Cajero
                    <option value="Category 3">bartenderd
                    </select>
                    -->                  
                    <select class="select2able" multiple>
                        <option value="Category 1">Option 1</option>
                        <option value="Category 2">Option 2</option>
                        <option value="Category 3">Option 3</option>
                        <option value="Category 4">Option 4</option>
                    </select>
                    
                  </div>
                  <div class="form-group">
                    <label for="username">Fecha De Nacimiento</label><input class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="dd/mm/yyyy" type="text">
                  </div>
                </div>
                
                <div class="col-md-4">
                  
                    <div class="form-group">
                    <label for="email">Sexo</label> <select class="select2able"><option value="Category 1">Masculino<option value="Category 2">Femenino</select>
                  </div>
                  
                  <div class="form-group">
                    <label for="firstname">Dirección De Residencia</label><input class="form-control" id="" name="" type="text">
                  </div>
                  <div class="form-group">
                    <label for="firstname">Telefono</label><input class="form-control" data-inputmask="'mask': ['(999) 999-9999']" type="text" placeholder="Ingrese Numero de Telefono">
                  </div>
                  
                    <div class="form-group">
                    <label for="firstname">Salario X Dia</label><input class="form-control" id="" name="" type="number" placeholder="Ingrese El Salario A Pagar Al Empleador">
                  </div>                            
                </div>
                
                
              </div>
                         <div  class="col-md-3 col-md-offset-5"><input class="btn btn-primary" type="submit" value="Validate form"> </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="style-toggle closed">
    <span aria-hidden="true" class="fa fa-fw fa-plus-circle"></span>
  </div>
  </div>
</div>




  {!!$usuarios->render() !!}
</div>

@endsection
