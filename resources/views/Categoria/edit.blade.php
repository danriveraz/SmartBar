  <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => ['categoria.update',$categoria],  'method' => 'PUT']) !!}
          <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">
            Editar categoría
            </h4>
          </div>
          <div class="modal-body">
            <div class="" >
            <div class="widget-content">
              <div class="form-group">
                <div class="form-group">
                  <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{$categoria->nombre}}" required="true" />
                </div>
                <div class="form-grup">
                    <input type="number" placeholder="Precio" min="0" step="any" name="precio" class="form-control" value="{{$categoria->precio}}"/>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
          </div>
        {!! Form::close() !!}
    </div>
  </div>

