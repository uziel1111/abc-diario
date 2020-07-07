
$("#tab_asistencia_info").click(function(e){
  e.preventDefault();
  Info_escuela.get_view_asistencia();
});

$("#tab_permanencia_info").click(function(e){
  e.preventDefault();
  Info_escuela.get_view_permanencia();
});

$("#tab_aprendizaje_info").click(function(e){
  e.preventDefault();
  Info_escuela.get_view_aprendizaje();
});

var Info_escuela = {
	limpia_contenedores: () => {
		$("#asistencia_info").empty();
		$("#permanencia_info").empty();
		$("#aprendizaje_info").empty();
	},
	get_view_asistencia: () => {
	    $.ajax({
	      url: base_url+'Info_escuela/get_asistencia',
	      type: 'POST',
	      dataType: 'json',
	      data: {'vista':'asistencia'
	      },
	      beforeSend: function (xhr) {
	        Mensaje.cargando('Cargando vista');
	      },
	      success: function (data) {
	        Mensaje.cerrar();
	        Info_escuela.limpia_contenedores();
	        $("#asistencia_info").append(data.vista);
	        Asistencia.get_datos_asistencia();
	      },
	      error: function (jqXHR, textStatus, errorThrown) {
	        Mensaje.cerrar();
	        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	      }
	    });
	},
	get_view_permanencia: () => {
	    $.ajax({
	      url: base_url+'Info_escuela/get_permanencia',
	      type: 'POST',
	      dataType: 'json',
	      data: {'vista':'permanencia'
	      },
	      beforeSend: function (xhr) {
	        Mensaje.cargando('Cargando vista');
	      },
	      success: function (data) {
	        Mensaje.cerrar();
	        Info_escuela.limpia_contenedores();
	        $("#permanencia_info").append(data.vista);
	      },
	      error: function (jqXHR, textStatus, errorThrown) {
	        Mensaje.cerrar();
	        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	      }
	    });
	},
	get_view_aprendizaje: () => {
	    $.ajax({
	      url: base_url+'Info_escuela/get_aprendizaje',
	      type: 'POST',
	      dataType: 'json',
	      data: {'vista':'aprendizaje'
	      },
	      beforeSend: function (xhr) {
	        Mensaje.cargando('Cargando vista');
	      },
	      success: function (data) {
	        Mensaje.cerrar();
	        Info_escuela.limpia_contenedores();
	        $("#aprendizaje_info").append(data.vista);
	        Aprendisaje.obtener_grafica_lyc();
	      },
	      error: function (jqXHR, textStatus, errorThrown) {
	        Mensaje.cerrar();
	        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	      }
	    });
	},
}