function cambio(slide, direccion){
  if(direccion == 0){
    switch (slide) {
      case 0:
        $("#modal1").modal("hide");
        $("#modal2").modal("show");
        break;
      case 1:
        $("#modal2").modal("hide");
        $("#modal3").modal("show");
        break;
      case 2:
        $("#modal3").modal("hide");
        $("#modal4").modal("show");
        break;
      case 3:
        $("#modal4").modal("hide");
        $("#modal5").modal("show");
        break;
      case 4:
        $("#modal5").modal("hide");
        $("#modal6").modal("show");
        break;
      case 5:
        $("#modal6").modal("hide");
        $("#modal7").modal("show");
        break;
      case 6:
        $("#modal7").modal("hide");
        $("#modal8").modal("show");
        break;
      case 7:
        $("#modal8").modal("hide");
        $("#modal9").modal("show");
    }
  }else{
    switch (slide) {
      case 0:
        $("#modal2").modal("hide");
        $("#modal1").modal("show");
        break;
      case 1:
        $("#modal3").modal("hide");
        $("#modal2").modal("show");
        break;
      case 2:
        $("#modal4").modal("hide");
        $("#modal3").modal("show");
        break;
      case 3:
        $("#modal5").modal("hide");
        $("#modal4").modal("show");
        break;
      case 4:
        $("#modal6").modal("hide");
        $("#modal5").modal("show");
        break;
      case 5:
        $("#modal7").modal("hide");
        $("#modal6").modal("show");
        break;
      case 6:
        $("#modal8").modal("hide");
        $("#modal7").modal("show");
        break;
      case 7:
        $("#modal9").modal("hide");
        $("#modal8").modal("show");
    }        
  }
}

function finTutorial(){
  $.ajax({
    url: "http://localhost/Smartbar/public/usuario/tutorial",
    type: 'GET',
    data: {},
    success: function(){},
    error: function(data){}
  }); 
}