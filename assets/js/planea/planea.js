
$("#slt_municipio_planea").change(function(){
	Planea.obtener_niveles_xidmunicipio();
});
$("#slt_nivel_planeaxm").change(function(){
	Planea.obtener_perido_xidmunicipio_xidnivel();
});

$("#btn_busqueda_xestadomun").click(function(){
	$("#div_graficas_masivo").empty();
	if($("#slt_nivel_planeaxm").val() == 0){
		Mensaje.alerta("error","Seleccione nivel","");
	}else{
		if($("#slt_periodo_planeaxm").val() == 0){
			Mensaje.alerta("error","Seleccione periodo","");
		}else{
			if($("#slt_campod_planeaxm").val() == 0){
				Mensaje.alerta("error","Seleccione campo disciplinario","");
			}else{
				Planea.obtener_grafica_xestadomunicipio();
			}
		}
	}
});

$("#btn_busqueda_xestadozona").click(function(){
  $("#div_graficas_masivo").empty();
  if($("#slt_nivel_planeazn").val() == 0){
    Mensaje.alerta("error","Seleccione nivel","");
  }else{
    if($("#slt_periodo_planeazn").val() == 0){
      Mensaje.alerta("error","Seleccione periodo","");
    }else{
      if($("#slt_campod_planeazn").val() == 0){
        Mensaje.alerta("error","Seleccione campo disciplinario","");
      }else{
        Planea.obtener_grafica_xestadozona();
      }
    }
  }
});

$("#xzona-tab").click(function(e) {
    e.preventDefault();
    ruta = base_url + 'Planea/bucador_zona';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando...');
      },
      success: function (dato) {
        Mensaje.cerrar();
        $("#div_graficas_masivo").empty();
        $('#buscador_zona').empty();
        $('#buscador_zona').append(dato.filtros);

      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
});

var Planea = {

obtener_perido_xidmunicipio_xidnivel: () => {
	ruta = base_url+'Planea/obtener_perido_xidmunicipio_xidnivel';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {"idmunicipio": $("#slt_municipio_planea").val(), "idnivel":$("#slt_nivel_planeaxm").val()},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
				$("#slt_periodo_planeaxm").empty();
				$("#slt_periodo_planeaxm").append(dato.options);
      },
      error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
    });
},
obtener_niveles_xidmunicipio: () => {
	ruta = base_url+'Planea/obtener_niveles_xidmunicipio';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {idmunicipio: $("#slt_municipio_planea").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando niveles');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#slt_nivel_planeaxm").empty();
			$("#slt_nivel_planeaxm").append(dato.options);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
},
obtener_grafica_xestadomunicipio: () => {
	ruta = base_url+'Planea/obtener_grafica_xestadomunicipio';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {idmunicipio: $("#slt_municipio_planea").val(), nivel: $("#slt_nivel_planeaxm").val(), periodo: $("#slt_periodo_planeaxm").val(), campodisip: $("#slt_campod_planeaxm").val()},
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
},
obtener_grafica_xestadozona: () => {
  ruta = base_url+'Planea/obtener_grafica_xestadozona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {nivel: $("#slt_nivel_planeazn").val(), sostenimiento: $("#slt_sostenimiento_planeazn").val(), zona: $("#slt_zona_planeazn").val(), periodo: $("#slt_periodo_planeazn").val(), campodisip: $("#slt_campod_planeazn").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando...');
    },
    success: function (dato) {
      Mensaje.cerrar();
      console.log(dato);
      Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      Mensaje.cerrar();
      Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
    }
  });
}
}
