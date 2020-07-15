$("#filtros_zona_escolar").hide();

if ($("#dv_id_seccion").val()=='zona_escolar') {
	setTimeout(function () { $("input[name=busqueda_estadistica]").trigger("click"); }, 400);
}

$("input[name=busqueda_estadistica]").click(function () {
	if($('input:radio[name=busqueda_estadistica]:checked').val()=="municipio"){
		$("#filtros_municipio_estado").show();
		$("#filtros_zona_escolar").hide();
		$("#div_estadistica").empty();
		// $('#filtro_nivel').prop('disabled', true);
		// $('#filtro_sostenimiento').prop('disabled', true);
		// $('#filtro_modalidad').prop('disabled', true);
		$("#filtro_municipio option[value='0'").attr("selected",true);
		$("#filtro_nivel option[value='0'").attr("selected",true);
		$("#filtro_sostenimiento option[value='0'").attr("selected",true);
		$("#filtro_modalidad option[value='0'").attr("selected",true);
	}else{
		$("#filtros_zona_escolar").show();
		$("#filtros_municipio_estado").hide();
		$("#div_estadistica").empty();
	}
});


$("#btn_limpiar_municipio_estado").click(function () {
	$('#filtro_nivel').prop('disabled', true);
	$('#filtro_sostenimiento').prop('disabled', true);
	$('#filtro_modalidad').prop('disabled', true);
	$("#filtro_municipio option[value='0'").attr("selected",true);
	$("#filtro_nivel option[value='0'").attr("selected",true);
	$("#filtro_sostenimiento option[value='0'").attr("selected",true);
	$("#filtro_modalidad option[value='0'").attr("selected",true);
	$("#div_estadistica").empty();
});

$("#btn_buscar_municipio_estado").click(function () {
	Estadistica_general.resultado_estadistica_municipio($("#filtro_municipio").val(),$("#filtro_nivel").val(),$("#filtro_sostenimiento").val(),$("#filtro_modalidad").val(),$("#filtro_ciclo_escolar").val(),
	() =>{
		Miscelanea.goto_seccion($("#dv_id_subseccion").val());
	});
});
$("#filtro_municipio").change(function () {
	$("#filtro_nivel option[value='0'").attr("selected",true);
	$("#filtro_sostenimiento option[value='0'").attr("selected",true);
	$("#filtro_modalidad option[value='0'").attr("selected",true);
	// if($("#filtro_municipio").val()!=0){
	// 	Estadistica_general.niveles($("#filtro_municipio").val());
	// }else{
		Estadistica_general.niveles($("#filtro_municipio").val());
	// }
});

$("#filtro_nivel").change(function () {
	$("#filtro_sostenimiento option[value='0'").attr("selected",true);
	$("#filtro_modalidad option[value='0'").attr("selected",true);
	// if($("#filtro_nivel").val()!=0){
		Estadistica_general.sostenimientos($("#filtro_municipio").val(),$("#filtro_nivel").val());
	// }
});

$("#filtro_sostenimiento").change(function () {
	$("#filtro_modalidad option[value='0'").attr("selected",true);
	// if($("#filtro_sostenimiento").val()!=0){
		Estadistica_general.modalidades($("#filtro_sostenimiento").val(),$("#filtro_municipio").val(),$("#filtro_nivel").val());
	// }
});

$("#filtro_modalidad").change(function () {
		Estadistica_general.ciclo_est($("#filtro_sostenimiento").val(),$("#filtro_municipio").val(),$("#filtro_nivel").val(),$("#filtro_modalidad").val());
});


var Estadistica_general = {

  	niveles: (municipio) => {
    	ruta = base_url + "estadistica/niveles";
	    $.ajax({
	      	url: ruta,
	      	type: 'POST',
	      	dataType: 'json',
	      	data: {municipio:municipio},
	      	beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando niveles educativos');
	      	},
	      	success: function (data) {
	      		Mensaje.cerrar();
	      		$("#filtro_nivel").empty();
	      		$("#filtro_nivel").append("<option value='0'>Todos</option>");
	      		for (let i=0; i<data.niveles.length; i++) {
	      			$("#filtro_nivel").append("<option value='"+data.niveles[i]['idnivel']+"'>"+data.niveles[i]['nombre']+"</option>");
	      		}

						$("#filtro_ciclo_escolar").empty();
						if (data.ciclo.length==0) {
							$("#filtro_ciclo_escolar").append("<option value='0'>Sin datos</option>");
						}
						else {
							for (let i=0; i<data.ciclo.length; i++) {
		      			$("#filtro_ciclo_escolar").append("<option value='"+data.ciclo[i]['idciclo']+"'>"+data.ciclo[i]['ciclo']+"</option>");
		      		}
						}
	        	// $('#filtro_sostenimiento').prop('disabled', true);
				// $('#filtro_modalidad').prop('disabled', true);
				$("#filtro_sostenimiento option[value='0'").attr("selected",true);
				$("#filtro_modalidad option[value='0'").attr("selected",true);
	      	},
	      	error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
	    });

  	},//niveles

  	sostenimientos: (municipio,nivel) => {
    	ruta = base_url + "estadistica/sostenimientos";
	    $.ajax({
	        url: ruta,
	        type: 'POST',
	        dataType: 'json',
	        data: {nivel:nivel,municipio:municipio},
	        beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando sostenimiento');
	        },
	        success: function (data) {
	        	Mensaje.cerrar();
	        	$("#filtro_sostenimiento").empty();
	      		$("#filtro_sostenimiento").append("<option value='0'>Todos</option>");
	          	for (let i=0; i<data.sostenimientos.length; i++) {
	      			$("#filtro_sostenimiento").append("<option value='"+data.sostenimientos[i]['idsostenimiento']+"'>"+data.sostenimientos[i]['nombre']+"</option>");
	      		}
						$("#filtro_ciclo_escolar").empty();
						if (data.ciclo.length==0) {
							$("#filtro_ciclo_escolar").append("<option value='0'>Sin datos</option>");
						}
						else {
							for (let i=0; i<data.ciclo.length; i++) {
		      			$("#filtro_ciclo_escolar").append("<option value='"+data.ciclo[i]['idciclo']+"'>"+data.ciclo[i]['ciclo']+"</option>");
		      		}
						}
	      		// $('#filtro_modalidad').prop('disabled', true);
				$("#filtro_modalidad option[value='0'").attr("selected",true);
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	        	Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	    	}
	    });
 	},// sostenimientos

    modalidades: (sostenimiento,municipio,nivel) => {
     	ruta = base_url + "estadistica/modalidades";
	    $.ajax({
	        url: ruta,
	        type: 'POST',
	        dataType: 'json',
	        data: {sostenimiento:sostenimiento,municipio:municipio,nivel:nivel},
	        beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando modalidad');
	        },
	        success: function (data) {
	        	Mensaje.cerrar();
	        	$("#filtro_modalidad").empty();
	      		$("#filtro_modalidad").append("<option value='0'>Todos</option>");
	          	for (let i=0; i<data.modalidades.length; i++) {
	      			$("#filtro_modalidad").append("<option value='"+data.modalidades[i]['idmodalidad']+"'>"+data.modalidades[i]['nombre']+"</option>");
	      		}
						$("#filtro_ciclo_escolar").empty();
						if (data.ciclo.length==0) {
							$("#filtro_ciclo_escolar").append("<option value='0'>Sin datos</option>");
						}
						else {
							for (let i=0; i<data.ciclo.length; i++) {
		      			$("#filtro_ciclo_escolar").append("<option value='"+data.ciclo[i]['idciclo']+"'>"+data.ciclo[i]['ciclo']+"</option>");
		      		}
						}
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	        	Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	    	}
	    });
  	},//modalidades

		ciclo_est: (sostenimiento,municipio,nivel, modalidad) => {
     	ruta = base_url + "estadistica/ciclo_est";
	    $.ajax({
	        url: ruta,
	        type: 'POST',
	        dataType: 'json',
	        data: {sostenimiento:sostenimiento,municipio:municipio,nivel:nivel,modalidad:modalidad},
	        beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando modalidad');
	        },
	        success: function (data) {
	        	Mensaje.cerrar();
						$("#filtro_ciclo_escolar").empty();
						if (data.ciclo.length==0) {
							$("#filtro_ciclo_escolar").append("<option value='0'>Sin datos</option>");
						}
						else {
							for (let i=0; i<data.ciclo.length; i++) {
		      			$("#filtro_ciclo_escolar").append("<option value='"+data.ciclo[i]['idciclo']+"'>"+data.ciclo[i]['ciclo']+"</option>");
		      		}
						}
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	        	Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	    	}
	    });
  	},//ciclo_est

  	resultado_estadistica_municipio: (municipio,nivel,sostenimiento,modalidad,ciclo,callback) => {
     	ruta = base_url + "estadistica/obtener_estadistica_xmunicipio_edo";
	    $.ajax({
	        url: ruta,
	        type: 'POST',
	        dataType: 'json',
	        data: {sostenimiento:sostenimiento,municipio:municipio,nivel:nivel,modalidad:modalidad,ciclo:ciclo},
	        beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando estadística');
	        },
	        success: function (data) {
	        	Mensaje.cerrar();
	        	$("#div_estadistica").empty();
	        	$("#div_estadistica").append(data.vista);
						callback();
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	        	Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	    	}
	    });
  	}//

};
