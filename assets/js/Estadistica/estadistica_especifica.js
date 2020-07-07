$(function () {
    obj_graficap = new Graficasm();
});
function Graficasm() {
    _thisgraficap = this;
}

$("#limpiar_filtros").click(function (e) {
    e.preventDefault();
    $("#ciclo_escolar").val(0);
    $("#turno_est_esp").val(0);
    $("#txt_cct_escuela").val('');
});

$("#buscar_filtros").click(function (e) {
    e.preventDefault();
    var idciclo = $("#ciclo_escolar").val();
    var cct = "25"+$("#txt_cct_escuela").val();
    var idturno = $("#turno_est_esp").val();
    if(cct != ''){
          if (idturno != null) {
              if(idciclo != null){
                Estadistica_especifica.get_datos(cct, idciclo,idturno);
              }
              else {
                Mensaje.alerta("warning","Especifique un ciclo escolar","");
              }
            }
          else {
            Mensaje.alerta("warning","Especifique un turno","");
          }
    }else{
        Mensaje.alerta("warning","Especifique una cct","");
    }
});

let Estadistica_especifica = {

    get_datos: (cct, idciclo, idturno) => {
        $.ajax({
            url: base_url + 'Estadistica/busqueda_especifica',
            type: 'POST',
            dataType: 'json',
            data: { idciclo: idciclo, cct: cct,idturno:idturno  },
            beforeSend: function (xhr) {
                Mensaje.cargando('Cargando datos para la cct: ' + cct );
            },
            success: function (data) {
                Mensaje.cerrar();
                if (data.vacio == 'true') {
                  Mensaje.alerta("warning","La consulta no regreso resultados","");
                }
                else {
                  $("#dv_info_graf_alumn").empty();
                  $("#dv_info_graf_grupos").empty();
                  $("#dv_info_graf_docen").empty();
                  $("#containerRPB03ete").empty();
                  $("#dv_info_graf_Retencion").empty();
                  Estadistica_especifica.grafica_grados(data.alumnos);
                  Estadistica_especifica.grafica_grupos(data.grupos);
                  Estadistica_especifica.grafica_docentes(data.docentes);
                  Estadistica_especifica.grafica_eficiencia_terminal(data.indicadores['eficiencia_terminal']);
                  Estadistica_especifica.grafica_retencion(data.indicadores['retencion']);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Mensaje.cerrar();
                Mensaje.error_ajax(jqXHR, textStatus, errorThrown);
            }
        });
    },
    grafica_grados: (grados) => {
        arreglo_alumnos = [];

        for (let i = 1; i < (7); i++) {
          arr_par = [i, parseInt(grados['alumnos'+i])];
            arreglo_alumnos.push(arr_par);
        }
        ta = 6;
        t_alumnos = parseInt(grados['t_alumnos']);

        Highcharts.theme = {
            colors: ['#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2', '#3C5AA2',
                '#3C5AA2', '#3C5AA2', '#3C5AA2'],
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

        // Codigo para graficar la seccion estadistica de la escuela
        // Create the chart
        var defaultSubtitle = "Total de alumnos: " + t_alumnos
        var estadPrimaria = new Highcharts.chart('dv_info_graf_alumn', {
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
                title: {
                    text: 'Grados'
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
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>'
            },

            series: [{
                name: 'Número de alumnos',
                colorByPoint: true,
                data: arreglo_alumnos
            }]

        });

        $(".highcharts-background").css("fill", "#FFF");
    },//grafica_grados
    grafica_grupos: (grupos) => {
        arreglo_grupos = [];
        for (let i = 1; i < (7); i++) {
            arr_par = [i, parseInt(grupos['grupos'+i])];
            arreglo_grupos.push(arr_par);
        }
        arreglo_grupos.push(['multi', parseInt(grupos['gruposmulti'])]);

        tg = 6;
        t_grupos = parseInt(grupos['t_grupos']);

        Highcharts.theme = {
            colors: ['#ECC462', '#ECC462', '#ECC462', '#ECC462', '#ECC462', '#ECC462', '#ECC462', '#ECC462', '#ECC462', '#ECC462',
                '#ECC462', '#ECC462', '#ECC462'],
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

        // Codigo para graficar la seccion estadistica de la escuela
        // Create the chart
        var defaultSubtitle = "Total de grupos: " + t_grupos
        var estadPrimaria = new Highcharts.chart('dv_info_graf_grupos', {
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
                text: 'Grupos'
            },
            subtitle: {
                text: defaultSubtitle
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Grados'
                }
            },
            yAxis: {
                title: {
                    text: 'Número de grupos'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>'
            },

            series: [{
                name: 'Número de grupos',
                colorByPoint: true,
                data: arreglo_grupos
            }]

        });

        $(".highcharts-background").css("fill", "#FFF");
    },//grafica_grupos
    grafica_docentes: (docentes) => {
        arreglo_docentes = [];
        // for (let i = 0; i < ((docentes.length) - 1); i++) {
        //     arr_par = [docentes[i].grado, parseInt(docentes[i].total)];
        //     arreglo_docentes.push(['Docentes', parseInt(docentes)]);
        // }
        arreglo_docentes.push(['Docentes', parseInt(docentes)]);
        td = 1;
        t_docentes = parseInt(docentes);


        Highcharts.theme = {
            colors: ['#D5831C', '#D5831C', '#D5831C', '#D5831C', '#D5831C', '#D5831C', '#D5831C', '#D5831C', '#D5831C', '#D5831C',
                '#D5831C', '#D5831C', '#D5831C'],
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

        // Codigo para graficar la seccion estadistica de la escuela
        // Create the chart
        var defaultSubtitle = "Total de docentes: " + t_docentes
        var estadPrimaria = new Highcharts.chart('dv_info_graf_docen', {
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
                text: 'Docentes'
            },
            subtitle: {
                text: defaultSubtitle
            },
            xAxis: {
                type: 'category',
                title: {
                    text: ''
                }
            },
            yAxis: {
                title: {
                    text: 'Número de docentes'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>'
            },

            series: [{
                name: 'Número de docentes',
                colorByPoint: true,
                data: arreglo_docentes
            }]

        });

        $(".highcharts-background").css("fill", "#FFF");
    },//graficadocentes
    grafica_eficiencia_terminal: (valor_et) => {
        // Dibujamos el radial progress bar para Eficiencia Terminal
        var bar = new ProgressBar.Circle(containerRPB03ete, {
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
                        circle.setText('<center> '+valor_et + '%<br>Eficiencia terminal<center>');
                    }
                    else {
                        circle.setText(value + '%');
                    }
                }

            }
        });
        bar.text.style.fontFamily = '"Arial", Helvetica, sans-serif';
        bar.text.style.fontSize = '2rem';

        bar.animate(Math.min(valor_et / 100, 1));  // Number from 0.0 to 1.0
    },//grafica_eficiencia_terminal
    grafica_retencion: (varix) => {
        // Dibujamos el radial progress bar para cobertura
        // var valor_et=80;
        var bar = new ProgressBar.Circle(dv_info_graf_Retencion, {
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
                        circle.setText(varix + '% <br><center>Retención</center>');
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
