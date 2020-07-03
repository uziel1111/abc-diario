let Asistencia = {

    get_datos_asistencia: () => {
        $.ajax({
            url: base_url + 'Info_escuela/busqueda_especifica',
            type: 'POST',
            dataType: 'json',
            data: {'cct':$("#cctinfo").val(), 'turno':$("#idturnoinfo").val()},
            beforeSend: function (xhr) {
                Mensaje.cargando('Cargando datos');
            },
            success: function (data) {
                Mensaje.cerrar();
                if (data.vacio == 'true') {
                  Mensaje.alerta("warning","La consulta no regreso resultados","");
                }
                else {
                  $("#conten_alumnos_info").empty();
                  $("#conten_grupos_info").empty();
                  $("#conten_docentes_info").empty();
                  Asistencia.grafica_grados(data.alumnos);
                  Asistencia.grafica_grupos(data.grupos);
                  Asistencia.grafica_docentes(data.docentes);
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
        var estadPrimaria = new Highcharts.chart('conten_alumnos_info', {
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
                name: 'Número de alumnos en',
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
        var estadPrimaria = new Highcharts.chart('conten_grupos_info', {
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
                name: 'Número de grupos en',
                colorByPoint: true,
                data: arreglo_grupos
            }]

        });

        $(".highcharts-background").css("fill", "#FFF");
    },//grafica_grupos
    grafica_docentes: (docentes) => {
    // console.log(docentes);
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
        var estadPrimaria = new Highcharts.chart('conten_docentes_info', {
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
    }


}
