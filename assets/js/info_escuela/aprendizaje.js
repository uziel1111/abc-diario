$(function () {
    // obj_graficap = new Graficasm();
});
var visible_collaps = false;
var visible_collaps_nlogro = false;
$("#btn_planea_info_mate").click(function(){
  if(visible_collaps == false){
    visible_collaps = true;
    Aprendisaje.obtener_grafica_mate();
  }

});
$("#btn_planea_info_nlogro").click(function(){
  if(visible_collaps_nlogro == false){
    visible_collaps_nlogro = true;
    Aprendisaje.obtener_info_nlogro();
  }

});
var Aprendisaje = {
  obtener_grafica_lyc: () => {
    ruta = base_url+'Info_escuela/obtener_grafica_x_campodisiplinario';
    var div = "div_planea_lyc_info";
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val(),
        'campodisip': 1
      },
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        // console.log(dato.datos);
        Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip,div);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  },

  obtener_grafica_mate: () => {
    ruta = base_url+'Info_escuela/obtener_grafica_x_campodisiplinario';
    var div = "div_planea_mate_info";
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val(),
        'campodisip': 2
      },
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        // console.log(dato.datos);
        Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip, div);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  },

  obtener_info_nlogro: () => {
    ruta = base_url+'Info_escuela/obtener_info_nlogro';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val()},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        // console.log(dato.datos);

      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  }
}
