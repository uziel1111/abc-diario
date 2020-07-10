$(function() {
// jQuery("#div_contenedor_planea").hide();
});
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
	// jQuery("#div_contenedor_planea").hide();
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
        // $("#div_contenedor_planea").show();
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
		// jQuery("#div_contenedor_planea").show();
		Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip, div);
		$("#div_planea_tabla").empty();
		$("#div_planea_tabla").append(dato.vista);
		Planea.grafica_info_nlogro(dato.datosgraf, 'div_planea_nlogro_lyc', 'div_planea_nlogro_mate');
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
      Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip, div);
      $("#div_planea_tabla").empty();
	  $("#div_planea_tabla").append(dato.vista);
	  Planea.grafica_info_nlogro(dato.datosgraf, 'div_planea_nlogro_generico', dato.campodisip);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      Mensaje.cerrar();
      Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
    }
  });
},

grafica_info_nlogro: (arr_datos, id_div_contenedor, campo_dis) => {

    Highcharts.theme = {
        colors: ['#ECC462','#D5831C','#935116','#CCCC00','#FF9900','#3C5AA2'],
        chart: {
            backgroundColor: {
                linearGradient: [0, 0, 0, 0],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(255, 255, 255)']
                ]
            },
        },
        title: {
            style: {
                color: '#000',
                font: 'bold 16px'
            }
        },
        subtitle: {
            style: {
                color: '#666666',
                font: 'bold 14px'
            }
        },
        legend: {
            itemStyle: {
                font: '9pt',
                color: 'black'
            },
            itemHoverStyle:{
                color: 'gray'
            }
        }
    };
    // Apply the theme
    Highcharts.setOptions(Highcharts.theme);
    // Dibujamos un grafico tipo pie-drilldown planea 2015
    // Creamos la gráfica
    var defaultTitle="Resultados PLANEA "+arr_datos[0]['periodo'] ;
    var defaultSubtitle="Haz clic para ver los porcentajes por área.";
    if(campo_dis == 1){
    	var titulo = "Lenguaje y Comunicación";
    	var campos = [parseFloat(arr_datos[0]['ni_lyc']), parseFloat(arr_datos[0]['nii_lyc']), parseFloat(arr_datos[0]['nii_lyc']), parseFloat(arr_datos[0]['niv_lyc'])];
    }else{
    	var titulo = "Matemáticas";
    	var campos = [parseFloat(arr_datos[0]['ni_mat']), parseFloat(arr_datos[0]['nii_mat']), parseFloat(arr_datos[0]['nii_mat']), parseFloat(arr_datos[0]['niv_mat'])];
    }
    $('#'+id_div_contenedor).empty();
      var chartgenerico = new Highcharts.chart(id_div_contenedor, {
          credits: {
              enabled: false
          },
          chart: {
              type: 'column'
          },
          title: {
              text: '<b style="font-size: 2.3vh;">'+titulo+'</b>'
          },
          legend: {
              enabled: false
          },
          subtitle: {
          },
          xAxis: {
              categories: [
                  'I <br> Insuficiente',
                  'II <br> Elemental',
                  'III <br> Bueno',
                  'IV <br>Excelente'
              ],
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Nivel de logro (%)'
              }
          },
          plotOptions: {
              series: {
                  borderWidth: 0,
                  dataLabels: {
                      enabled: true,
                      format: '{point.y:.1f}%'
                  }
              },
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          series: [{
              name: titulo,
              data: campos
          }]

      });

      $(".highcharts-background").css("fill","#FFF");
          chartgenerico.setSize(
              ($(document).width()/10)*5,
              400,
             false
          );

  }
}
