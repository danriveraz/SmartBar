  <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => ['proveedor.update',$proveedor->id],'method' => 'PUT']) !!}
          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Registro
            </h4>
          </div>
          <div class="modal-body">
            <div class="pre-scrollable" >
              <div class="widget-content">
                <div class="form-group">
                  <div class="form-group">
                    <label for="nombre" class="control-label">
                      Nombre
                    </label>
                      <input type="text" name="nombre" class="form-control" value="{{$proveedor->nombre}}"/>
                  </div>
                  <div class="form-group">
                    <label for="direccion" class="control-label">
                      Dirección
                    </label>
                    <input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}"/>
                  </div>
                  <div class="form-group">
                      <label for="telefono" class="control-label">Teléfono</label>
                      <input type="text" name="telefono" class="form-control" value="{{$proveedor->telefono}}"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
            <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
          </div>
         {!! Form::close() !!} 
    </div>
  </div>

