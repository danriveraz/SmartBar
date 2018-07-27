@extends('Layout.app_administradores')
@section('content')
<title>
  PRODUCTO
</title>
<div class="container main-content">
  <div class="page-title"></div>
  <div class="col-sm-12">
    <div id="list-productos"> </div>
  </div>
  <div class="style-selector" >
    <div class="style-selector-container">
      <div class="style-toggle1">
        <a class="table-actions pocketMorado" href="{{route('producto.contenido', 0)}}">
          <span class="pocketMorado fa fa-fw fa-plus-circle"></span>
        </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    listproductos();
  });

  var listproductos = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('prodlistall')}}',
      success:  function(data){
        $("#list-productos").empty().html(data);
      }
    });
  }
</script>
@endsection
