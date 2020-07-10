$(function() {
	if($("#itxt_planea_event").val() == 'zona'){
		$( "#xzona-tab" ).trigger( "click" );
	}
});

$("#xzona-tab").click(function(e) {
	$("#div_contenedor_planea").hide();
	$("#div_planea_tabla").empty();
	$("#div_planea_nlogro_generico").empty();
    e.preventDefault();
    ruta = base_url + 'Planea/buscador_zona';
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
		$("#slt_modalidad_planeazn option[value='0'").prop("selected",true);
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