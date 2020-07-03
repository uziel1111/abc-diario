

var Aprendisaje = {
  obtener_grafica_xestadomunicipio: () => {
    ruta = base_url+'Info_escuela/obtener_grafica_x_campodisiplinario';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {
        idmunicipio: $("#slt_municipio_planea").val(), 
        nivel: $("#slt_nivel_planeaxm").val(), 
        periodo: $("#slt_periodo_planeaxm").val(), 
        campodisip: $("#slt_campod_planeaxm").val()
      },
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        // console.log(dato.datos);
        Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  }
}
