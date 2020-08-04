
$("#btn_busqueda_xestadomun").click(function(){
	$("#cont_cont_aprend").empty();
	if($("#slt_municipio_planea").val() == 0){
		Mensaje.alerta("error","Seleccione municipio","");
	}else{
		if($("#slt_periodo_planeaxm").val() == 0){
			Mensaje.alerta("error","Seleccione periodo","");
		}else{
				$("#cont_cont_aprend").empty();
				Aprendizaje.obtener_tabla_xestadomunicipio();
		}
	}
});

var Aprendizaje = {

obtener_tabla_xestadomunicipio: () => {
	ruta = base_url+'Aprendamos/obtener_tabla_xidmunicipio_periodo';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {"idmunicipio": $("#slt_municipio_planea").val()},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando');
      },
      success: function (dato) {
        Mensaje.cerrar();
				$("#cont_cont_aprend").empty();
				$("#cont_cont_aprend").append(dato.str_vista);
      },
      error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
    });
},

}
