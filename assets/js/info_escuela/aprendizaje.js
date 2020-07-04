$(function () {
    // obj_graficap = new Graficasm();
});
var visible_collaps = false;
var visible_collaps_nlogro = false;
$("#btn_planea_info_mate").click(function(){
  if(visible_collaps == false){
    visible_collaps = true;
    Aprendisaje.obtener_grafica_mate();
  }

});
$("#btn_planea_info_nlogro").click(function(){
  if(visible_collaps_nlogro == false){
    visible_collaps_nlogro = true;
    Aprendisaje.obtener_info_nlogro();
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
        // console.log(dato.datos);
        Aprendisaje.grafica_info_nlogro();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Mensaje.cerrar();
        Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
      }
    });
  },

  grafica_info_nlogro: (arr_datos, id_dv_mat, id_dv_lyc) => {
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
    var defaultTitle="Resultados PLANEA 2015 " ;
    var defaultSubtitle="Haz clic para ver los porcentajes por área.";
    // var drilldownTitle = "Matemáticas";
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
              data: [lyc1_15, lyc2_15, lyc3_15, lyc4_15]
          }, {
              name: 'Leng. y comunicación',
              data: [lyc1_16, lyc2_16, lyc3_16, lyc4_16]
          },]
      });
    // Dibujamos un grafico tipo pie-drilldown planea 2016
    // Create the chart
    var defaultTitle="Resultados PLANEA 2016 ";
    var defaultSubtitle="Haz clic para ver los porcentajes por área.";
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
            data: [mat1_15, mat2_15, mat3_15, mat4_15]
        }, {
            name: 'Matemáticas',
            data: [mat1_16, mat2_16, mat3_16, mat4_16]
        }]
    });
    $(".highcharts-background").css("fill","#FFF");
  }

}
