<table class="table table-hover" id="insumosDisponibles">
      <thead>
        <th style="visibility: hidden;">#</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>A la venta</th>
        <th>Cantidad</th>
        <th>Medida</th>
        <th>
        
          <button type="submit" class="btn btn-dufault" onclick="adicionarTodo()">A&ntildeadir seleccionados 
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
          </button>          
        </th>
      </thead>
      <tbody>
        @foreach($insumosDisponibles as $insumo)
          <tr>
            <td style="visibility: hidden;">{{$insumo->id}}</td>
            <td>{{$insumo->nombre}}</td>
            <td>{{$insumo->marca}}</td>
            <td align="center">
              <label> <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/><span></span></label>
            </td>
            <td><input type="number" onkeypress="tecla(event,{{$insumo}})" id="{{$insumo->id}}" step="any" min="0.1" name="cantidad" class="form-control"></td>
            <td>
              {!! Form::select('medida', ['1'=>'oz','2'=>'ml','3'=>'cm3','4'=>'unidad'], null, ['class'=>'form-control', 'id'=>'medida'.$insumo->id]) !!}
            </td>
            <td align="center">
              <button type="submit" class="btn btn-dufault" onclick="adicionarInsumo({{$insumo}})">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button>
            </td>
            <td align="center">
              <button type="submit" class="btn btn-dufault" onclick="modificarInsumo({{$insumo}})">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
              </button>
            </td>            
          </tr>
        @endforeach
      </tbody>
    </table>
    {!!$insumosDisponibles->appends(Request::all())->render() !!}