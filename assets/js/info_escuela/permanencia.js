
$("#btn_buscar_permanencia").click(function(e){
	e.preventDefault();
	if($("#itxt_ciclo_info").val()!=''){
		if($("#itxt_periodo_info").val()!=''){
			Permanencia.get_datos_permanencia();
		}else{
				Mensaje.alerta("warning","Riesgo de Abandono Escolar","Seleccione un periodo");
			}
	}else{
			Mensaje.alerta("warning","Riesgo de Abandono Escolar","Seleccione un ciclo");
		}

});

var Permanencia = {

    get_datos_permanencia: () => {
        $.ajax({
            url: base_url + 'Info_escuela/get_datos_permanencia',
            type: 'POST',
            dataType: 'json',
            data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val(),
            'ciclo': $("#itxt_ciclo_info").val(), 'periodo': $("#itxt_periodo_info").val(), 'idnivel': $("#idnivel").val()},
            beforeSend: function (xhr) {
                Mensaje.cargando('Cargando datos');
            },
            success: function (data) {
                Mensaje.cerrar();
	      		$("#div_riesgo_info").empty();
	      		$("#div_tabla_riesgo_grafica_pie_info").empty();
	      		$("#div_tabla_riesgo_grafica_barras_info").empty();
	      		Permanencia.grafica(data.muy_alto,data.alto,data.medio,data.bajo);
	      		Permanencia.grafica_barras_riesgo(data.array_muy_alto,data.array_alto,data.total_alumnos,$("#idnivel").val());
            $("#containerRPB03ete_info").empty();
            $("#dv_info_graf_Retencion_info").empty();
            $("#dv_info_graf_aprobacion_info").empty();
            Permanencia.grafica_eficiencia_terminal(data.indicadores['eficiencia_terminal']);
            Permanencia.grafica_retencion(data.indicadores['retencion']);
            Permanencia.grafica_aprobacion(data.indicadores['aprobacion']);
	      		let tabla='<table width="100%" class="table table-bordered">';
					tabla+=	'<tbody>';
					tabla+= '<tr style="background-color:#f8f9fa;">';
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
	      		$("#div_tabla_riesgo_grafica_pie_info").append(tabla);
	      		let tabla2='<table WIDTH="100%" class="table table-bordered">';
  					tabla2+='<tbody>';
    				tabla2+='<tr style="background-color:#E6E7E9;">';
      				tabla2+='<td colspan="1" style="text-align:center;">Grados</td>';
      				tabla2+='<td style="text-align:center;">1<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">2<sup>o</sup></td>';
      				tabla2+='<td style="text-align:center;">3<sup>o</sup></td>';
							if ($("#idnivel").val()==2) {
	      				tabla2+='<td style="text-align:center;">4<sup>o</sup></td>';
	      				tabla2+='<td style="text-align:center;">5<sup>o</sup></td>';
	      				tabla2+='<td style="text-align:center;">6<sup>o</sup></td>';
							}
    				tabla2+='</tr><tr>';
      				// tabla2+='<td width="20px" style="background-color:#F5842A;">&nbsp;</td>';
      				tabla2+='<td style="text-align:center;"><i style="color: #ee7521;" class="fa fa-square" aria-hidden="true"></i>Alto</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[0]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[1]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_alto[2]+'</td>';
							if ($("#idnivel").val()==2) {
	      				tabla2+='<td style="text-align:center;">'+data.array_alto[3]+'</td>';
	      				tabla2+='<td style="text-align:center;">'+data.array_alto[4]+'</td>';
	      				tabla2+='<td style="text-align:center;">'+data.array_alto[5]+'</td>';
							}
    				tabla2+='</tr><tr>';
      				// tabla2+='<td width="20px" style="background-color:#D1232A;">&nbsp;</td>';
      				tabla2+='<td style="text-align:center;"><i style="color: #cd1719;" class="fa fa-square" aria-hidden="true"></i>Muy alto</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[0]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[1]+'</td>';
      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[2]+'</td>';
							if ($("#idnivel").val()==2) {
	      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[3]+'</td>';
	      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[4]+'</td>';
	      				tabla2+='<td style="text-align:center;">'+data.array_muy_alto[5]+'</td>';
							}
    				tabla2+='</tr>';
  					tabla2+='</tbody>';
					tabla2+='</table>';
				$("#div_tabla_riesgo_grafica_barras_info").append(tabla2);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Mensaje.cerrar();
                Mensaje.error_ajax(jqXHR, textStatus, errorThrown);
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
      riesgo_abandono= new Highcharts.chart('div_riesgo_info', {
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
			$(".highcharts-background").css("fill", "#FFF");
				 riesgo_abandono.setSize(
					 this.offsetWidth,
					 300,
					false
				 );
    },
    grafica_barras_riesgo: (array_muy_alto,array_alto,total_alumnos,nivel) => {
			if (nivel==3) {
				array_muy_alto.splice(3,3);
				array_alto.splice(3,3);
			}
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
        var distribucion_xgrado = new Highcharts.chart('div_riesgo_grafica_barras_info', {
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
                categories: ((nivel==3)?['1°', '2°', '3°']:['1°', '2°', '3°', '4°', '5°', '6°']),
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
				$(".highcharts-background").css("fill", "#FFF");
				distribucion_xgrado.setSize(
					this.offsetWidth,
					300,
				 false
				);

    },//grafica_riesgo_barras
    grafica_eficiencia_terminal: (valor_et) => {
        // Dibujamos el radial progress bar para Eficiencia Terminal
        var bar = new ProgressBar.Circle(containerRPB03ete_info, {
            color: '#888888',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 2.5,
            easing: 'easeInOut',
            duration: 7400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#D6DADC', width: 2.5 },
            to: { color: '#ECC462', width: 4 },
            // Set default step function for all animate calls
            step: function (state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                if (circle.value() == 1.0) {
                    var value = Math.round(circle.value() * 100);
                }
                else {
                    var value = circle.value() * 100;
                    value = value.toFixed(2);
                }
                if (value === 0) {
                    circle.setText('');
                } else {
                    if (value > 1) {
                        circle.setText('<center> '+valor_et + '%<br>Eficiencia terminal<center>');
                    }
                    else {
                        circle.setText(value + '%');
                    }
                }

            }
        });
        bar.text.style.fontFamily = '"Arial", Helvetica, sans-serif';
        bar.text.style.fontSize = '1rem';
				bar.text.style.left = '27%';

        bar.animate(Math.min(valor_et / 100, 1));  // Number from 0.0 to 1.0
    },//grafica_eficiencia_terminal
    grafica_retencion: (varix) => {
        // Dibujamos el radial progress bar para cobertura
        // var valor_et=80;
        var bar = new ProgressBar.Circle(dv_info_graf_Retencion_info, {
            color: '#888888',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 2.5,
            easing: 'easeInOut',
            duration: 7400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#D6DADC', width: 2.5 },
            to: { color: '#ECC462', width: 4 },
            // Set default step function for all animate calls
            step: function (state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                if (circle.value() == 1.0) {
                    var value = Math.round(circle.value() * 100);
                }
                else {
                    var value = circle.value() * 100;
                    value = value.toFixed(2);
                }
                if (value === 0) {
                    circle.setText('');
                } else {
                    if (value > 1) {
                        circle.setText(varix + '% <br><center>Retención</center>');
                    }
                    else {
                        circle.setText(value + '%');
                    }
                }

            }
        });
        bar.text.style.fontFamily = '"Arial", Helvetica, sans-serif';
        bar.text.style.fontSize = '1rem';
				bar.text.style.left = '27%';

        bar.animate(Math.min(varix / 100, 1));  // Number from 0.0 to 1.0
    },//grafica_retencion

    grafica_aprobacion: (varix) => {
       // varix = parseFloat(calculo);
        var bar = new ProgressBar.Circle(dv_info_graf_aprobacion_info, {
            color: '#888888',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 2.5,
            easing: 'easeInOut',
            duration: 7400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#D6DADC', width: 2.5 },
            to: { color: '#ECC462', width: 4 },
            // Set default step function for all animate calls
            step: function (state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                if (circle.value() == 1.0) {
                    var value = Math.round(circle.value() * 100);
                }
                else {
                    var value = circle.value() * 100;
                    value = value.toFixed(2);
                }
                // alert(value);
                if (value === 0) {
                    circle.setText('');
                } else {
                    if (value > 1) {
                        circle.setText(varix + '% <br><center>Aprobación</center>');
                    }
                    else {
                        circle.setText(value + '% <br><center>Aprobación</center>');
                    }
                }

            }
        });
        bar.text.style.fontFamily = '"Arial", Helvetica, sans-serif';
        bar.text.style.fontSize = '1rem';
				bar.text.style.left = '27%';
        bar.animate(Math.min(varix / 100, 1));  // Number from 0.0 to 1.0
    }//grafica_aprovacion
}
