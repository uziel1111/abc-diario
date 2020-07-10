$("#filtroxcct").hide();

$("input[name=busqueda_escuela]").click(function () {
	if($('input:radio[name=busqueda_escuela]:checked').val()=="municipio_busqueda"){
		$("#filtros_xmunicipio").show();
		$("#filtroxcct").hide();
	}else{
		$("#filtroxcct").show();
		$("#filtros_xmunicipio").hide();
		$("#div_lista_escuelas").empty();
	}
});

$("#btn_limpiar_busqueda_general").click(function () {
	$("#filtro_municipio_busqueda option[value='0'").attr("selected",true);
	$("#filtro_nivel_busqueda option[value='0'").attr("selected",true);
	$("#filtro_sostenimiento_busqueda option[value='0'").attr("selected",true);
	$("#div_lista_escuelas").empty();
	$("nombre_cct").val("");
});
$("#btn_limpiar_busqueda_xcct").click(function () {
	$("#busquedaxcct").val("");
});

$("#busquedaxcct").keyup(function() {
  	if($("#busquedaxcct").val().length==8){
    	let valid = Busqueda_escuela.valida_cct('25'+$("#busquedaxcct").val());
    	// console.log(valid);
      	if(valid){
        	Busqueda_escuela.busqueda_xmunicipioxnivelxsostenimiento('','','','','25'+$("#busquedaxcct").val());
      	}else{
      		Mensaje.alerta("warning","","La CCT es incorrecta,ingrese una CCT valida");
      	}
  	}else if ($("#busquedaxcct").val().length>8) {
    	Mensaje.alerta("warning","","La longitud de la cct es incorrecta");
  	}
});

$("#btn_buscar_escuelas_xmunicipioxnivelxsostenimiento").click(function () {
	Busqueda_escuela.busqueda_xmunicipioxnivelxsostenimiento($("#filtro_municipio_busqueda").val(),$("#filtro_nivel_busqueda").val(),$("#filtro_sostenimiento_busqueda").val(),$("#nombre_cct").val(),'');
});


$("#btn_buscar_escuelas_xcct").click(function () {
	let valid = Busqueda_escuela.valida_cct('25'+$("#busquedaxcct").val());
      	if(valid){
        	Busqueda_escuela.busqueda_xmunicipioxnivelxsostenimiento('','','','','25'+$("#busquedaxcct").val());
      	}else{
      		Mensaje.alerta("warning","","La CCT es incorrecta,ingrese una CCT valida");
      	}

});

var Busqueda_escuela = {

  	busqueda_xmunicipioxnivelxsostenimiento: (municipio,nivel,sostenimiento,nombre_cct,clave_cct) => {
    	ruta = base_url + "Info_escuela/lista_escuelas";
	    $.ajax({
	      	url: ruta,
	      	type: 'POST',
	      	dataType: 'json',
	      	data: {municipio:municipio,nivel:nivel,sostenimiento:sostenimiento,nombre_cct:nombre_cct,cct:clave_cct},
	      	beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando busqueda de escuelas');
	      	},
	      	success: function (data) {
	      		Mensaje.cerrar();
	      		$("#div_lista_escuelas").empty();
	      		$("#div_lista_escuelas").append(data.vista);

	      	},
	      	error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
	    });

  	},
  	valida_cct: (clave) => {
  		let regex = /^([0-9]{2})([a-z]{3})([0-9]{4})([a-z]{1})$/i;
  		return regex.test(clave);
	}


};

$("#filtro_municipio_busqueda").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Info_escuela/obtener_idnivel_xmuni';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idmunicipio": $("#filtro_municipio_busqueda").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#filtro_nivel_busqueda").empty();
			$("#filtro_nivel_busqueda").append(dato.slc_nivel);
			$("#filtro_sostenimiento_busqueda").empty();
			$("#filtro_sostenimiento_busqueda").append(dato.slc_sost);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

});

$("#filtro_nivel_busqueda").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Info_escuela/obtener_idsost_xidnivel_xmuni';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idmunicipio": $("#filtro_municipio_busqueda").val(),"idnivel": $("#filtro_nivel_busqueda").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#filtro_sostenimiento_busqueda").empty();
			$("#filtro_sostenimiento_busqueda").append(dato.slc_sost);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

});
