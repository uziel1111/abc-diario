
$("#btn_limpiar_municipio_estado_riesgo").click(function () {
	$("#filtro_municipio_riesgo option[value='0'").attr("selected",true);
	$("#filtro_nivel_riesgo option[value='0'").attr("selected",true);
	$("#div_riesgo").empty();
  $("#div_riesgo_grafica_barras").empty();
	$("#div_tabla_riesgo_grafica_pie").empty();
	$("#div_tabla_riesgo_grafica_barras").empty();

});


$("#btn_buscar_municipio_estado_riesgo").click(function () {
	if($("#filtro_nivel_riesgo").val()!=0){
		let ciclo_corto=$('select[id="filtro_ciclo_escolar_riesgo"] option:selected').text();
		Riesgo.obtener_riesgo_xmunicipioxnivelxcicloxperiodo($("#filtro_municipio_riesgo").val(),$("#filtro_nivel_riesgo").val(),ciclo_corto,$("#filtro_periodo_riesgo").val());
	}else{
		Mensaje.alerta("warning","Riesgo de Abandono Escolar","Seleccione un nivel");
	}
});

var Riesgo = {

  	obtener_riesgo_xmunicipioxnivelxcicloxperiodo: (municipio,nivel,ciclo,periodo) => {
    	ruta = base_url + "Riesgo_abandono/obtener_riesgo_xmunicipioxnivelxcicloxperiodo";
	    $.ajax({
	      	url: ruta,
	      	type: 'POST',
	      	dataType: 'json',
	      	data: {municipio:municipio,nivel:nivel,ciclo:ciclo,periodo:periodo},
	      	beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando resultado');
	      	},
	      	success: function (data) {
	      		Mensaje.cerrar();
	      		$("#div_riesgo").empty();
	      		$("#div_tabla_riesgo_grafica_pie").empty();
	      		$("#div_tabla_riesgo_grafica_barras").empty();
	      		Riesgo.grafica(data.muy_alto,data.alto,data.medio,data.bajo);
	      		Riesgo.grafica_barras_riesgo(data.array_muy_alto,data.array_alto,data.total_alumnos);
	      		let tabla='<table width="100%" class="table table-bordered">';
					tabla+=	'<tbody>';
					tabla+= '<tr style="background-color:##f8f9fa;">';
					tabla+=	'<td style="text-align:center;">Total</td>';
					tabla+= '<td colspan="1" style="text-align:center;"><i style="color: #cd1719;" class="fa fa-square" aria-hidden="true"></i>Muy alto</td>';
					tabla+= '<td colspan="1" style="text-align:center;"><i style="color: #ee7521;" class="fa fa-square" aria-hidden="true"></i>Alto</td>';
					tabla+= '<td colspan="1" style="text-align:center;"><i style="color: #ffed00;" class="fa fa-square" aria-hidden="true"></i>Medio</td>';
					tabla+= '<td colspan="1" style="text-align:center;"><i style="color: #dadada;" class="fa fa-square" aria-hidden="true"></i>Bajo</td>';
					tabla+= '</tr>';
					tabla+= '<tr>';
					tabla+= '<td style="text-align:center;">'+data.total_alumnos_riesgo+'</td>';
					// tabla+= '<td width="20px" style="background-color:#cd1719;"></td>';
					tabla+= '<td style="text-align:center;">'+data.muy_alto+'</td>';
					// tabla+= '<td width="20px" style="background-color:#ee7521;"></td>';
					tabla+= '<td style="text-align:center;">'+data.alto+'</td>';
					// tabla+= '<td width="20px" style="background-color:#ffed00;"></td>';
					tabla+= '<td style="text-align:center;">'+data.medio+'</td>';
					// tabla+= '<td width="20px" style="background-color:#dadada;"></td>';
					tabla+= '<td style="text-align:center;">'+data.bajo+'</td>';
					tabla+=	 '</tr>';
					tabla+=	 '</tbody>';
					tabla+=	'</table>';
	      		$("#div_tabla_riesgo_grafica_pie").append(tabla);
	      		let tabla2='<table WIDTH="100%" class="table table-bordered">';
  					tabla2+='<tbody>';
    				tabla2+='<tr style="background-color:#E6E7E9;">';
      				tabla2+='<td colspan="1" style="text-align:center;">Grados</td>';
      				tabla2+='<td style="text-align:center;">1<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">2<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">3<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">4<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">5<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">6<sup>o</sup></td>';
    				tabla2+='</tr><tr>';
      				// tabla2+='<td width="20px" style="background-color:#F5842A;">&nbsp;</td>';
      				tabla2+='<td style="text-align:center;"><i style="color: #ee7521;" class="fa fa-square" aria-hidden="true"></i>Alto</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[0]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[1]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[2]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[3]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[4]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[5]+'</td>';
    				tabla2+='</tr><tr>';
      				// tabla2+='<td width="20px" style="background-color:#D1232A;">&nbsp;</td>';
							tabla2+='<td style="text-align:center;"><i style="color: #cd1719;" class="fa fa-square" aria-hidden="true"></i>Muy alto</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[0]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[1]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[2]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[3]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[4]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[5]+'</td>';
    				tabla2+='</tr>';
  					tabla2+='</tbody>';
					tabla2+='</table>';
				$("#div_tabla_riesgo_grafica_barras").append(tabla2);
	      	},
	      	error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
	    });

  	},

  	grafica: (muy_alto,alto,medio,bajo) => {

      Highcharts.theme = {
          colors: ['#cd1719','#ee7521','#ffed00','#dadada'],
          chart: {
              backgroundColor: {
                  linearGradient: [0, 0, 500, 500],
                  stops: [
                      [0, 'rgb(255, 255, 255)'],
                      [1, 'rgb(240, 240, 255)']
                  ]
              },
          },
          title: {
              style: {
                  color: '#000',
                  font: 'bold 12px'
              }
          },
          subtitle: {
              style: {
                  color: '#666666',
                  font: 'bold 12px'
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

      // Build the chart
      riesgo_abandono= new Highcharts.chart('div_riesgo', {
          credits: {
              enabled: false
          },
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: '<b style="font-size: 2.3vw;"><br>Riesgo de Abandono</b>'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  },
                  showInLegend: false /*Ocultamos o Muy ALto  o Alto o Medio o Bajo*/
              }
          },
          series: [{
              name: 'Porcentaje',
              colorByPoint: true,
              data: [{
                  name: 'Muy alto',
                  y: muy_alto,
                  sliced: true,
                  selected: true
              }, {
                  name: 'Alto',
                  y: alto
              }, {
                  name: 'Medio',
                  y: medio
              }, {
                  name: 'Bajo',
                  y: bajo
              }]
          }]
      });

    },
    grafica_barras_riesgo: (array_muy_alto,array_alto,total_alumnos) => {
        Highcharts.theme = {
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
                    font: 'bold 18px'
                }
            },
            subtitle: {
                style: {
                    color: 'blue',
                    font: 'bold 20px'
                }
            },

            legend: {
                itemStyle: {
                    font: '9pt',
                    color: 'black'
                },
                itemHoverStyle: {
                    color: 'gray'
                }
            }
        };

        // Apply the theme
        Highcharts.setOptions(Highcharts.theme);

        var defaultSubtitle = "Total de alumnos riesgo de abandono: " + total_alumnos
        var distribucion_xgrado = new Highcharts.chart('div_riesgo_grafica_barras', {
            lang: {
                drillUpText: ''
            },
            credits: {
                enabled: false
            },
            chart: {
                type: 'column',
                events: {

                }
            },
            title: {
                text: 'Alumnos'
            },
            subtitle: {
                text: defaultSubtitle
            },
            xAxis: {
                type: 'category',
                categories: ['1°', '2°', '3°','4°','5°','6°'],
                title: {
                    text: 'Alumnos'
                }
            },
            yAxis: {
                title: {
                    text: 'Número de alumnos'
                }

            },
            legend: {
                enabled: false
            },
            // plotOptions: {
            //     series: {
            //         borderWidth: 0,
            //         dataLabels: {
            //             enabled: true,
            //             format: '{point.y}'
            //         }
            //     }
            // },

            tooltip: {
                // headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}<b>{point.y} alumno(s)</b></span>'
            },

            series: [{
            	colors: ['#D1232A','#D1232A', '#D1232A', '#D1232A', '#D1232A','#D1232A'],
              data: array_muy_alto
            },{
            	colors: ['#F5842A','#F5842A','#F5842A', '#F5842A', '#F5842A','#F5842A'],
            	data: array_alto
            }]

        });


    },//grafica_riesgo_barras

};
