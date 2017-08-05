<table class="table table-hover" id="insumosDisponibles">
      <thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Tipo</th>
        <th>Cantidad de onzas</th>
        <th>
        
          <button type="submit" class="btn btn-dufault" onclick="adicionarTodo()">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"> Adicionar</span>
          </button>          
        </th>
      </thead>
      <tbody>
        @foreach($insumosDisponibles as $insumo)
          <tr>
            <td>{{$insumo->id}}</td>
            <td>{{$insumo->nombre}}</td>
            <td>{{$insumo->marca}}</td>
            <td align="center">
              <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/>
            </td>
            <td><input type="number"  id="{{$insumo->id}}" step="any" min="0.1" name="cantidad" class="form-control"></td>
            <td align="center">
              <button type="submit" class="btn btn-dufault" onclick="adicionarInsumo({{$insumo}})">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {!!$insumosDisponibles->appends(Request::all())->render() !!}