      //////////////////////////////////////////////////////////// Por Unidades de Análisis
      //////////////////////////////////////////////////////////// Por Unidades de Análisis
var Graficasm = {

  	graficoplanea_contenido: (arr_datos, periodoplanea,campodisip) => {
    amarillo = (arr_datos.length - 10);
    verde = amarillo + 5;
    var colores = ['#FF0000','#FF0000','#FF0000','#FF0000','#FF0000'];
    for (var i = 1; i <= arr_datos.length; i++) {

        if (i<=amarillo) {
            colores.push('#FF9900');
        }
        if (verde<=i) {
            colores.push('#3CB371');
        }
    }
    arr_datos.sort(function (a, b) {
        return (a.porcen_alum_respok - b.porcen_alum_respok)
    });
      Highcharts.theme = {
            colors: colores,
            chart: {
                backgroundColor: {
                    linearGradient: [0, 0, 0, 0],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(255, 255, 255)']
                    ]
                },
                width: ($(document).width()/10)*5,
                height: ($(document).width()/10)*15
            },
            title: {
                style: {
                    color: '#000',
                    font: 'bold 18px'
                }
            },
            subtitle: {
                style: {
                    color: 'blue'
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

      var arr_datos_aux = new Array();;
      for (var i = 0; i < arr_datos.length; i++){
         arr_datos_aux.push({'id_cont': arr_datos[i]['id_contenido'],'name': arr_datos[i]['contenidos'],'y': parseFloat(arr_datos[i]['porcen_alum_respok']),'drilldown': arr_datos[i]['total_reac_xct']});
      }

      // Apply the theme
      Highcharts.setOptions(Highcharts.theme);
      // Codigo para graficar la seccion estadistica de la escuela
      var estadPreescolar = new Highcharts.chart('div_graficas_masivo', {
          lang: {
              //drillUpText: '◁ Regresar a {series.name}'
          },
          credits: {
              enabled: false
          },
          chart: {
              type: 'bar'
          },
          title: {
              text: '<b style="font-size: 18px;">PLANEA '+periodoplanea+' '+((campodisip=1)?'Lenguaje y comunicación':'Matemáticas')+'</b>'
          },
          subtitle: {
              text: '<b style="font-size: 14px;"> Total de alumnos evaluados: '+new Intl.NumberFormat("en-IN").format(parseInt(arr_datos[0]['alumnos_evaluados']))+'</b>'
          },
          xAxis: {
              type: 'category'
          },
          yAxis: {
              title: {
                  text: '<div style="font-size: 1.1vh;">Porcentaje de alumnos con respuestas correctas</div>'
              }
          },
          legend: {
              enabled: false
          },
          plotOptions: {
              series: {
                events: {
                  click: function (event) {
                    // nada...
                  }
          },
                  borderWidth: 0,
                  dataLabels: {
                      enabled: true,
                      format: '{point.y:.1f}%'
                  }
              },

              // agregamos a la columna la propiedad para el clik y enviar el nombre a una función
              bar :{
                   point:{
                       events:{
                           click:function(){
                              Graficasm.obtener_reactivos_xcontenido_tematico(this.name,this.id_cont);
                           }
                       }
                   }
               }
              //
          },

          tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><b>{point.y}%</b><br>',
            pointFormat: '<span style="font-size:11px">Total de preguntas en el contenido temático: </span><b>{point.drilldown}</b><br><span style="color:{point.color}">{point.name}</span>'
          },

          series: [{
              name: 'Porcentaje de alumnos con respuestas correctas: ',
              colorByPoint: true,
              data: arr_datos_aux
          }],

      });

      $(".highcharts-background").css("fill","#FFF");

  },
	obtener_reactivos_xcontenido_tematico: (nombre,id_cont) => {
       ruta = base_url+'Planea/planea_xcont_xmunicipio';
       $.ajax({
         url: ruta,
         type: 'POST',
         dataType: 'json',
         data: {'id_cont':id_cont},
         beforeSend: function (xhr) {
           Mensaje.cargando('Cargando niveles');
         },
         success: function (dato) {
           Mensaje.cerrar();
           var result = dato.graph_cont_reactivos_xcctxcont;
           var html = "<div style='text-align:left !important;'>";
           if (result.length==0) {
           }
           else {
             html += "    <div class='container'>";
             for (var i = 0; i < result.length; i++) {
               html += "    <div class='row'>";
               html += "      <div class='col-2'>";
               html += "      <h5><span class='h3 badge badge-secondary text-white'>"+result[i]['n_reactivo']+"</span></h5>";
               html += "      </div>";
               html += "      <div class='col-10'>";
               if (result[i]['url_apoyo']!=null) {
                 html += "      <center><a style='color:blue;' href='#' onclick=Graficasm.apoyo_reactivo('"+base_url+"assets/"+result[i]['url_apoyo']+"')>Texto/imagen (apoyo)</a></center>";
               }
               html += "      </div>";
               html += "    </div>";
               html += "    <div class='row'>";
               html += "      <div class='col-12'>";
               html += "<img style='cursor: zoom-in;' onclick=Graficasm.modal_reactivo('"+base_url+"assets/"+result[i]['url_reactivo']+"') class='img-fluid' src='"+base_url+"assets/"+result[i]['url_reactivo']+"' class='img-responsive center-block' />";
               html += "      </div>";
               html += "    </div>";
               html += "    <div class='row'>";
               html += "      <div class='col-md-3 col-sm-12'>";
               html += "      </div>";
               html += "      <div class='col-md-3 col-sm-12'>";
               html += "      </div>";
               html += "      <div class='col-md-3 col-sm-12'>";
               html += "      </div>";
               html += "      <div class='col-md-3 col-sm-12'>";
               html += "      </div>";
               html += "    </div>";

               html += "    <div class='row'>";
							 html += "      <div class='col-md-3 col-sm-12'>";

               html += "      </div>";
               html += "      <div class='col-md-3 col-sm-12'>";
               html += "      <center>";
               if (result[i]['url_argumentacion']!="") {
                 html += "  <button title='Explicación de respuesta correcta' type='button' class='btn btn-info btn-block' onclick=Graficasm.argumento_reactivo('"+base_url+"assets/"+result[i]['url_argumentacion']+"')>Argumento</button>";
               }
               html += "      </center>";
               html += "      </div>";
               html += "      <div class='col-md-3 col-sm-12'>";
               html += "      <center>";
               if (result[i]['url_especificacion']!="") {
               html += "      <button title='Explicación de la formulación de la pregunta' type='button' class='btn btn-info btn-block' onclick=Graficasm.especificacion_reactivo('"+base_url+"assets/"+result[i]['url_especificacion']+"')>Especificación</button>";
               }
               html += "      </center>";
               html += "      </div>";

               html += "      <div class='col-md-3 col-sm-12'>";

               html += "      </div>";

               html += "      </div>";
               html += "    </div>";
             }
             html += "    </div>";
           }


           $('#modal_visor_reactivos .modal-body #div_reactivos').empty();
           $('#modal_visor_reactivos .modal-body #div_reactivos').html(html);

           $("#modal_reactivos_title").empty();
           $("#modal_reactivos_title").html("Contenido temático: "+nombre);

           $("#modal_visor_reactivos").modal("show");
         },
         error: function (jqXHR, textStatus, errorThrown) {
     			Mensaje.cerrar();
     			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
     		}
       });
		 },
	 	apoyo_reactivo: (path_apoyo) => {
             var html = "<div style='text-align:left !important;'>";
               html += "<table class='table table-condensed'>";
               html += "<tbody> ";
               html += "    <tr>";
               html += "      <td><center>";
                 html += "<img style='width: 100%;' src='"+path_apoyo+"' class='img-responsive center-block' />";
                 html += "      </center></td>";
                 html += "    </tr>";
             html += "</tbody>";
               html += "</table>";

               html += "</div>";

             $('#modal_visor_apoyos_reactivos .modal-body #div_listalinks').empty();
             $('#modal_visor_apoyos_reactivos .modal-body #div_listalinks').html(html);


             $("#modal_visor_apoyos_reactivos").modal("show");
         },
			 	modal_reactivo: (path_react) => {
             var html = "<div style='text-align:left !important;'>";
               html += "<table class='table table-condensed'>";
               html += "<tbody> ";
               html += "    <tr>";
               html += "      <td><center>";
                 html += "<img style='width: 100%;' src='"+path_react+"' class='img-responsive center-block' />";
                 html += "      </center></td>";
                 html += "    </tr>";
             html += "</tbody>";
               html += "</table>";

               html += "</div>";

             $('#modal_visor_reactivos_zom .modal-body #div_listalinks').empty();
             $('#modal_visor_reactivos_zom .modal-body #div_listalinks').html(html);


             $("#modal_visor_reactivos_zom").modal("show");
         },
			 	argumento_reactivo: (url_argumento) => {
           var html = "<div style='text-align:left !important;'><ul>";
             html += "<table class='table table-condensed'>";
             html += "<tbody> <center>";


             html += "</center></tbody>";
             html += "</table>";

             html += "</div>";

             $('#modal_visor_pdfc2 .modal-header #exampleModalLabel').empty();
             $('#modal_visor_pdfc2 .modal-header #exampleModalLabel').html("");

           $('#modal_visor_pdfc2 .modal-body #div_listalinks').empty();
           $('#modal_visor_pdfc2 .modal-body #div_listalinks').html(html);

           Miscelanea.showPDF("modal_visor_pdfc2", url_argumento);
           $("#modal_visor_pdfc2").modal("show");

            // window.open("http://www.sarape.gob.mx/assets/docs/info/arg_r1_lyc_17_sec.pdf", "_blank");
         },
			 	especificacion_reactivo: (url_especificacion) => {
             var html = "<div style='text-align:left !important;'><ul>";
               html += "<table class='table table-condensed'>";
               html += "<tbody> <center>";
               html += "</center></tbody>";
               html += "</table>";

               html += "</div>";

               $('#modal_visor_pdfc3 .modal-header #exampleModalLabel').empty();
               $('#modal_visor_pdfc3 .modal-header #exampleModalLabel').html("");

             $('#modal_visor_pdfc3 .modal-body #div_listalinks').empty();
             $('#modal_visor_pdfc3 .modal-body #div_listalinks').html(html);

             Miscelanea.showPDF("modal_visor_pdfc3", url_especificacion);
             $("#modal_visor_pdfc3").modal("show");
             // window.open("http://www.sarape.gob.mx/assets/docs/info/esp_r1_lyc_17_sec.pdf", "_blank");
         }

}
