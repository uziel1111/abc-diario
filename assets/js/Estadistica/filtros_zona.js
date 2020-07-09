$("#btn_limpiar_zona_escolar").click(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	$("#filtro_nivel_zona option[value='0'").prop("selected",true);
	$("#filtro_modalidad_zona option[value='0'").prop("selected",true);
	$("#filtro_num_zona option[value='0'").prop("selected",true);
	$("#filtro_ciclo_escolar_zona option[value='0'").prop("selected",true);

	$('#filtro_modalidad_zona').prop('disabled', true);
	$('#filtro_num_zona').prop('disabled', true);
	$('#filtro_ciclo_escolar_zona').prop('disabled', true);

	$("#div_estadistica").empty();
});

$("#filtro_nivel_zona").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Estadistica/obtener_modalidad_xidnivel_zona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idnivel": $("#filtro_nivel_zona").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#filtro_modalidad_zona").empty();
			$("#filtro_modalidad_zona").append(dato.str_select);
			$('#filtro_modalidad_zona').prop('disabled', false);
			$('#filtro_num_zona').prop('disabled', true);
			$('#filtro_ciclo_escolar_zona').prop('disabled', true);
			$("#div_estadistica").empty();
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

});

$("#filtro_modalidad_zona").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Estadistica/obtener_nzona_xidnivelxidmodalidad_zona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idnivel": $("#filtro_nivel_zona").val(),"idmodalidad": $("#filtro_modalidad_zona").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#filtro_num_zona").empty();
			$("#filtro_num_zona").append(dato.str_select);
			$('#filtro_num_zona').prop('disabled', false);
			$('#filtro_ciclo_escolar_zona').prop('disabled', true);
			$("#div_estadistica").empty();
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
});

$("#filtro_num_zona").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Estadistica/obtener_ciclo_xidnivelxidmodalidadxnzona_zona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idnivel": $("#filtro_nivel_zona").val(),"idmodalidad": $("#filtro_modalidad_zona").val(),"numzona": $("#filtro_num_zona").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#filtro_ciclo_escolar_zona").empty();
			$("#filtro_ciclo_escolar_zona").append(dato.str_select);
			$('#filtro_ciclo_escolar_zona').prop('disabled', false);
			$("#div_estadistica").empty();
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
});
$("#btn_buscar_zona_escolar").click(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	if ($("#filtro_nivel_zona").val()!=null) {
		if ($("#filtro_modalidad_zona").val()!=null) {
			if ($("#filtro_num_zona").val()!=null) {
				if ($("#filtro_ciclo_escolar_zona").val()!=null) {
					Estadistica_zona.resultado_estadistica_zona($("#filtro_nivel_zona").val(),$("#filtro_modalidad_zona").val(),$("#filtro_num_zona").val(),$("#filtro_ciclo_escolar_zona").val(),
					() =>{
						Miscelanea.goto_seccion($("#dv_id_subseccion").val());
					});
				}
				else {
					Mensaje.alerta("error","Seleccione ciclo escolar","");
				}
			}
			else {
				Mensaje.alerta("error","Seleccione número de zona escolar","");
			}
		}
		else {
			Mensaje.alerta("error","Seleccione modalidad","");
		}
	}
	else {
		Mensaje.alerta("error","Seleccione nivel","");
	}
});
