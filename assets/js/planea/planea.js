
$("#slt_municipio_planea").change(function(){
	Planea.obtener_niveles_xidmunicipio();
	$("#div_graficas_masivo").empty();
	$(".div_grafiaca_txt").attr("hidden",true);
});
$("#slt_nivel_planeaxm").change(function(){
	Planea.obtener_perido_xidmunicipio_xidnivel();
	$("#div_graficas_masivo").empty();
	$(".div_grafiaca_txt").attr("hidden",true);
});

$("#btn_busqueda_xestadomun").click(function(){
	$("#div_graficas_masivo").empty();
	$(".div_grafiaca_txt").attr("hidden",true);
	if($("#slt_nivel_planeaxm").val() == 0){
		Mensaje.alerta("error","Seleccione nivel","");
	}else{
		if($("#slt_periodo_planeaxm").val() == 0){
			Mensaje.alerta("error","Seleccione periodo","");
		}else{
			if($("#slt_campod_planeaxm").val() == 0){
				Mensaje.alerta("error","Seleccione campo disciplinario","");
			}else{
				$("#div_graficas_masivo").empty();
				$('.div_grafiaca_txt').removeAttr('hidden');
				Planea.obtener_grafica_xestadomunicipio();
			}
		}
	}
});

$("#btn_busqueda_xestadozona").click(function(){
  $("#div_graficas_masivo").empty();
	$(".div_grafiaca_txt").attr("hidden",true);
  if($("#slt_nivel_planeazn").val() == null){
    Mensaje.alerta("error","Seleccione nivel","");
  }else{
		if ($("#slt_modalidad_planeazn").val() == null) {
			  Mensaje.alerta("error","Seleccione sostenimiento","");
		}
		else {
			if ($("#slt_zona_planeazn").val() == null) {
				  Mensaje.alerta("error","Seleccione zona","");
			}
			else {
				if($("#slt_periodo_planeazn").val() == null){
		      Mensaje.alerta("error","Seleccione periodo","");
		    }else{
		      if($("#slt_campod_planeazn").val() == null){
		        Mensaje.alerta("error","Seleccione campo disciplinario","");
		      }else{
						$("#div_graficas_masivo").empty();
						$('.div_grafiaca_txt').removeAttr('hidden');
		        Planea.obtener_grafica_xestadozona();
		      }
		    }
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
				$(".div_grafiaca_txt").attr("hidden",true);
        $('#buscador_zona').empty();
        $('#buscador_zona').append(dato.filtros);
				$("#slt_modalidad_planeazn option[value='-1'").prop("selected",true);
				$('#slt_modalidad_planeazn').prop('disabled', true);
				$("#slt_zona_planeazn option[value='0'").prop("selected",true);
				$('#slt_zona_planeazn').prop('disabled', true);
				$("#slt_periodo_planeazn option[value='0'").prop("selected",true);
				$('#slt_periodo_planeazn').prop('disabled', true);
				$("#slt_campod_planeazn option[value='0'").prop("selected",true);
				$('#slt_campod_planeazn').prop('disabled', true);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
});

$("#slt_nivel_planeazn").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Planea/obtener_modalidad_xidnivel_zona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idnivel": $("#slt_nivel_planeazn").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#div_graficas_masivo").empty();
			$("#slt_modalidad_planeazn").empty();
			$("#slt_modalidad_planeazn").append(dato.str_select);
			$('#slt_modalidad_planeazn').prop('disabled', false);
			$(".div_grafiaca_txt").attr("hidden",true);
			$("#slt_zona_planeazn option[value='0'").prop("selected",true);
			$('#slt_zona_planeazn').prop('disabled', true);
			$("#slt_periodo_planeazn option[value='0'").prop("selected",true);
			$('#slt_periodo_planeazn').prop('disabled', true);
			$("#slt_campod_planeazn option[value='0'").prop("selected",true);
			$('#slt_campod_planeazn').prop('disabled', true);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

});

$("#slt_modalidad_planeazn").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Planea/obtener_zona_xidnivel_modalidad_zona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idnivel": $("#slt_nivel_planeazn").val(),"idmodalidad": $("#slt_modalidad_planeazn").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#div_graficas_masivo").empty();
			$(".div_grafiaca_txt").attr("hidden",true);
			$("#slt_zona_planeazn").empty();
			$("#slt_zona_planeazn").append(dato.str_select);
			$('#slt_zona_planeazn').prop('disabled', false);
			$("#slt_periodo_planeazn option[value='0'").prop("selected",true);
			$('#slt_periodo_planeazn').prop('disabled', true);
			$("#slt_campod_planeazn option[value='0'").prop("selected",true);
			$('#slt_campod_planeazn').prop('disabled', true);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

});

$("#slt_zona_planeazn").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	ruta = base_url+'Planea/obtener_periodo_xidnivel_modalidad_zona';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idnivel": $("#slt_nivel_planeazn").val(),"idmodalidad": $("#slt_modalidad_planeazn").val(),"zona": $("#slt_zona_planeazn").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#div_graficas_masivo").empty();
			$(".div_grafiaca_txt").attr("hidden",true);
			$("#slt_periodo_planeazn").empty();
			$("#slt_periodo_planeazn").append(dato.str_select);
			$('#slt_periodo_planeazn').prop('disabled', false);
			$("#slt_periodo_planeazn option[value='0'").prop("selected",true);
			$("#slt_campod_planeazn option[value='0'").prop("selected",true);
			$('#slt_campod_planeazn').prop('disabled', true);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

});

$("#slt_periodo_planeazn").change(function (e) {
	e.preventDefault();
	e.stopImmediatePropagation();
	$("#div_graficas_masivo").empty();
	$(".div_grafiaca_txt").attr("hidden",true);
	$('#slt_campod_planeazn').prop('disabled', false);
	$("#slt_campod_planeazn option[value='0'").prop("selected",true);
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
				$("#div_graficas_masivo").empty();
				$(".div_grafiaca_txt").attr("hidden",true);
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
			$("#div_graficas_masivo").empty();
			$(".div_grafiaca_txt").attr("hidden",true);
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
  var div = "div_graficas_masivo";
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
			Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip, div);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
},
obtener_grafica_xestadozona: () => {
  ruta = base_url+'Planea/obtener_grafica_xestadozona';
  var div = "div_graficas_masivo";
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {nivel: $("#slt_nivel_planeazn").val(), modalidad: $("#slt_modalidad_planeazn").val(), zona: $("#slt_zona_planeazn").val(), periodo: $("#slt_periodo_planeazn").val(), campodisip: $("#slt_campod_planeazn").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando...');
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
}
}
