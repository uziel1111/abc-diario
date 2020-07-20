
var visible_collaps = false;
$("#btn_planea_info_mate").click(function(){
  if(visible_collaps == false){
    visible_collaps = true;
    Aprendisaje.obtener_grafica_mate();
  }

});
var visible_collaps_nlogro = false;
$("#btn_planea_info_nlogro").click(function(){
  if(visible_collaps_nlogro == false){
    visible_collaps_nlogro = true;
    Aprendisaje.obtener_info_nlogro();
  }

});
var visible_collaps_eficiencia = false;
$("#btn_planea_info_ete").click(function(){
  if(visible_collaps_eficiencia == false){
    visible_collaps_eficiencia = true;
    Aprendisaje.obtener_info_ete();
  }

});
var Aprendisaje = {
  obtener_grafica_lyc: () => {
    ruta = base_url+'Info_escuela/obtener_grafica_x_campodisiplinario';
    var div = "div_planea_lyc_info";
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val(),
        'campodisip': 1
      },
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        // console.log(dato.datos);
        Graficasm.graficoplanea_contenido(dato.datos, dato.periodoplanea, dato.campodisip,div);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  },

  obtener_grafica_mate: () => {
    ruta = base_url+'Info_escuela/obtener_grafica_x_campodisiplinario';
    var div = "div_planea_mate_info";
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val(),
        'campodisip': 2
      },
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

  obtener_info_nlogro: () => {
    ruta = base_url+'Info_escuela/obtener_info_nlogro';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val()},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        $("#div_planea_info_nlogro_tabla").empty();
        $("#div_planea_info_nlogro_tabla").append(dato.vista);
        Aprendisaje.grafica_info_nlogro(dato.datos, 'div_planea_info_nlogro_lyc', 'div_planea_info_nlogro_mate');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  },

  obtener_info_ete: () =>{
    ruta = base_url+'Info_escuela/ete_info';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val()},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
        $("#conten_planea_ciclo").empty();
        var texto = "PLANEA "+ dato.periodo;
        $("#conten_planea_ciclo").append(texto);
        Aprendisaje.grafica_ete(dato.ete);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  },

  grafica_info_nlogro: (arr_datos, id_dv_mat, id_dv_lyc) => {

    if (arr_datos.length<1) {
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
      $('#'+id_dv_lyc).empty();
        var chartlyc = new Highcharts.chart(id_dv_lyc, {
            credits: {
                enabled: false
            },
            chart: {
                type: 'column'
            },
            title: {
                text: '<b style="font-size: 2.3vh;">Lenguaje y Comunicación</b>'
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
                name: 'Leng. y comunicación',
                data: [parseFloat(arr_datos[0]['ni_lyc']), parseFloat(arr_datos[0]['nii_lyc']), parseFloat(arr_datos[0]['nii_lyc']), parseFloat(arr_datos[0]['niv_lyc'])]
            }, {
                name: 'Leng. y comunicación',
                data: [parseFloat(arr_datos[1]['ni_lyc']), parseFloat(arr_datos[1]['nii_lyc']), parseFloat(arr_datos[1]['nii_lyc']), parseFloat(arr_datos[1]['niv_lyc'])]
            },]
        });
      // Dibujamos un grafico tipo pie-drilldown planea 2016
      // Create the chart
      var defaultTitle="Resultados PLANEA "+arr_datos[1]['periodo'];
      var defaultSubtitle="Haz clic para ver los porcentajes por área.";
      $('#'+id_dv_mat).empty();
      var chartmat = new Highcharts.chart(id_dv_mat, {
          credits: {
              enabled: false
          },
          chart: {
              type: 'column'
          },
          title: {
              text: '<b style="font-size: 2.3vh;">Matemáticas</b>'
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
              name: 'Matemáticas',
              data: [parseFloat(arr_datos[0]['ni_mat']), parseFloat(arr_datos[0]['nii_mat']), parseFloat(arr_datos[0]['nii_mat']), parseFloat(arr_datos[0]['niv_mat'])]
          }, {
              name: 'Matemáticas',
              data: [parseFloat(arr_datos[1]['ni_mat']), parseFloat(arr_datos[1]['nii_mat']), parseFloat(arr_datos[1]['nii_mat']), parseFloat(arr_datos[1]['niv_mat'])]
          }]
      });
      $(".highcharts-background").css("fill","#FFF");
            chartlyc.setSize(
              this.offsetWidth,
              300,
             false
            );
            chartmat.setSize(
              this.offsetWidth,
              300,
             false
            );
    }
  },

  grafica_ete: (varix) => {
        // Dibujamos el radial progress bar para cobertura
        // var valor_et=80;
        var bar = new ProgressBar.Circle(div_ete_info, {
            color: '#888888',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 8,
            trailWidth: 5,
            easing: 'easeInOut',
            duration: 7400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#D6DADC', width: 5 },
            to: { color: '#ECC462', width: 8 },
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
                        circle.setText(varix+ '%');
                    }
                    else {
                        circle.setText(value + '%');
                    }
                }

            }
        });
        bar.text.style.fontFamily = '"Arial", Helvetica, sans-serif';
        bar.text.style.fontSize = '2rem';

        bar.animate(Math.min(varix / 100, 1));  // Number from 0.0 to 1.0
    }//grafica_retencion

}
