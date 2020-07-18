/* jshint esversion: 6 */
$(function() {
	// setTimeout(function(){
	if($("#itxt_seccion_event").val() == 'escuela'){
		$("#tab_asistencia_info").trigger( "click" );
	}
	if($("#itxt_seccion_event").val() == 'rescuela'){
	 	$("#tab_permanencia_info").trigger( "click" );
	}
	if($("#itxt_seccion_event").val() == 'aprendizaje'){
	 	$("#tab_aprendizaje_info").trigger( "click" );
	}
	// }, 2000);

});

$("#tab_asistencia_info").click(function(e){
  e.preventDefault();
  // location.reload();
  Info_escuela.get_view_asistencia();
});

$("#tab_permanencia_info").click(function(e){
  e.preventDefault();
  // location.reload();
  Info_escuela.get_view_permanencia();
});

$("#tab_aprendizaje_info").click(function(e){
  e.preventDefault();
  // location.reload();
  Info_escuela.get_view_aprendizaje();
});

var Info_escuela = {
	limpia_contenedores: () => {
		$("#asistencia_info").empty();
		$("#permanencia_info").empty();
		$("#aprendizaje_info").empty();
	},
	get_view_asistencia: () => {
		Info_escuela.limpia_contenedores();
	    $.ajax({
	      url: base_url+'Info_escuela/get_asistencia',
	      type: 'POST',
	      dataType: 'json',
	      data: {'vista':'asistencia'},
	      beforeSend: function (xhr) {
	        Mensaje.cargando('Cargando vista');
	      },
	      success: function (data) {
	        Mensaje.cerrar();
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
		Info_escuela.limpia_contenedores();
	    $.ajax({
	      url: base_url+'Info_escuela/get_permanencia',
	      type: 'POST',
	      dataType: 'json',
	      data: {'vista':'permanencia','cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val(), 'idnivel':$("#idnivel").val()
	      },
	      beforeSend: function (xhr) {
	        Mensaje.cargando('Cargando vista');
	      },
	      success: function (data) {
	        Mensaje.cerrar();
	        $("#permanencia_info").append(data.vista);
					$("#containerRPB03ete_info").empty();
					$("#dv_info_graf_Retencion_info").empty();
					$("#dv_info_graf_aprobacion_info").empty();
					Permanencia.grafica_eficiencia_terminal(data.indicadores['eficiencia_terminal']);
					Permanencia.grafica_retencion(data.indicadores['retencion']);
					Permanencia.grafica_aprobacion(data.indicadores['aprobacion']);
	      },
	      error: function (jqXHR, textStatus, errorThrown) {
	        Mensaje.cerrar();
	        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	      }
	    });
	},
	get_view_aprendizaje: () => {
		Info_escuela.limpia_contenedores();
	    $.ajax({
	      url: base_url+'Info_escuela/get_aprendizaje',
	      type: 'POST',
	      dataType: 'json',
	      data: {'vista':'aprendizaje', 'idnivel':$("#idnivel").val()
	      },
	      beforeSend: function (xhr) {
	        Mensaje.cargando('Cargando vista');
	      },
	      success: function (data) {
	        Mensaje.cerrar();

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
