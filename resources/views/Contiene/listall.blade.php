<table class="table table-hover" id="insumosDisponibles">
      <thead>
        <th style="display: none;">#</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>A la venta</th>
        <th>Cantidad</th>
        <th>Medida</th>
        <th>
        
          <button type="submit" class="btn btn-dufault" style="BACKGROUND-COLOR: rgb(187,187,187); color:white" onclick="adicionarTodo()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> A&ntildeadir seleccionados
          </button>          
        </th>
      </thead>
      <tbody>
        @foreach($insumosDisponibles as $insumo)
          <tr>
            <td style="display: none;">{{$insumo->id}}</td>
            <td>{{$insumo->nombre}}</td>
            <td>{{$insumo->marca}}</td>
            <td align="center">
              <label> <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/><span></span></label>
            </td>
            <td><input type="number" onkeypress="tecla(event,{{$insumo}})" id="{{$insumo->id}}" step="any" min="0.1" name="cantidad" class="form-control"></td>
            <td>
              {!! Form::select('medida', ['0'=>'oz','2'=>'ml','3'=>'cm3','1'=>'unidad'], $insumo->medida, ['class'=>'form-control', 'id'=>'medida'.$insumo->id]) !!}
            </td>
            <td align="center">
              <button type="submit" class="btn btn-dufault" onclick="adicionarInsumo({{$insumo}})" style="BACKGROUND-COLOR: rgb(187,187,187); color:white">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button>
            </td>
            <td align="center">
              <button type="submit" class="btn btn-dufault" onclick="modificarInsumo({{$insumo}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
              </button>
            </td>            
          </tr>
        @endforeach
      </tbody>
    </table>
    {!!$insumosDisponibles->appends(Request::all())->render() !!}