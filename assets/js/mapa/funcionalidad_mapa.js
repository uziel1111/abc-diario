$("#slt_municipio_mapa").change(function() {
	Mapa.obtener_coordenadas_muni($("#slt_municipio_mapa").val());
	Mapa.obtener_Niveles();
});
$("#slt_nivel_mapa").change(function() {
	Mapa.obtener_sostenimientos();
});
$("#btn_buscar_mapa").click(function(){
	Mapa.obtener_marcadores_filtro();
});

var Mapa = {

obtener_Niveles: () => {
	ruta = base_url+'Mapa/obtener_niveles';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {idmunicipio: $("#slt_municipio_mapa").val()},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando niveles');
      },
      success: function (dato) {
        Mensaje.cerrar();
				$("#slt_nivel_mapa").empty();
				$("#slt_nivel_mapa").append(dato.options);
				$("#slt_sostenimiento_mapa").empty();
				$("#slt_sostenimiento_mapa").append(dato.options1);
      },
      error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
    });

},
obtener_sostenimientos: () => {
	ruta = base_url+'Mapa/obtener_sostenimientos';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {idmunicipio: $("#slt_municipio_mapa").val(),idnivel: $("#slt_nivel_mapa").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando sostenimientos');
    },
    success: function (dato) {
      Mensaje.cerrar();
			$("#slt_sostenimiento_mapa").empty();
			$("#slt_sostenimiento_mapa").append(dato.options);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
},
obtener_marcadores_filtro: () => {
	ruta = base_url+'Mapa/obtener_marcadores_filtro';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {idmunicipio: $("#slt_municipio_mapa").val(), idnivel: $("#slt_nivel_mapa").val(),
		idsostenimiento: $("#slt_sostenimiento_mapa").val(), nombre: $("#txt_nombre_escuela").val(), cct: $("#txt_cct_escuela").val()},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			var marcadores = dato.response;
			// console.log(marcadores);
			if (marcadores.length==0) {
				Mensaje.alerta("error","No se encontraron escuelas","");
			}
			else {
				if (marcadores.length<=6) {
					Mapa.pinta_en_mapa(marcadores, marcadores[0][1], marcadores[0][2]);
				}
				else {
					Mapa.pinta_en_mapa(marcadores, dato.coordenadas['lat'], dato.coordenadas['lon']);
				}
			}
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });

},
regresa_icon: (nivel) => {

	switch(nivel){
		case "1":
		return "marker3";
		break;
		case "2":
		return "marker4";
		break;
		case "3":
		return "marker5";
		break;
		case "4":
		return "marker6";
		break;
		case "5":
		return "marker7";
		break;
		case "6":
		return "marker1";
		break;
		case "7":
		return "marker8";
		break;
		case "8":
		return "marker2";
		break;
		case "9":
		return "marker9";
		break;
		case "10":
		return "marker11";
		break;

	}
},
cct_mismo_nivel: (idcfg) => {
	ruta = base_url+'Mapa/obtener_mismo_nivel';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idcfg": idcfg},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			var marcadores = dato.response;
			// console.log(marcadores.length);
			if (marcadores.length<=6) {
				Mapa.pinta_en_mapa(marcadores, marcadores[0][1], marcadores[0][2]);
			}
			else {
				Mapa.pinta_en_mapa(marcadores, dato.coordenadas['lat'], dato.coordenadas['lon']);
			}
			// Mapa.pinta_en_mapa(marcadores, dato.coordenadas['lat'], dato.coordenadas['lon']);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
},
cct_siguiente_nivel: (idcfg) => {
	ruta = base_url+'Mapa/obtener_siguiente_nivel';
  $.ajax({
    url: ruta,
    type: 'POST',
    dataType: 'json',
    data: {"idcfg": idcfg},
    beforeSend: function (xhr) {
      Mensaje.cargando('Cargando');
    },
    success: function (dato) {
      Mensaje.cerrar();
			var marcadores = dato.response;
			if (marcadores.length<=6) {
				Mapa.pinta_en_mapa(marcadores, marcadores[0][1], marcadores[0][2]);
			}
			else {
				Mapa.pinta_en_mapa(marcadores, dato.coordenadas['lat'], dato.coordenadas['lon']);
			}
			// Mapa.pinta_en_mapa(marcadores, dato.coordenadas['lat'], dato.coordenadas['lon']);
    },
    error: function (jqXHR, textStatus, errorThrown) {
			Mensaje.cerrar();
			Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
		}
  });
},
pinta_en_mapa: (marcadores, lat, lon) => {
	if (marcadores != '') {
		document.getElementById('contenedor_mapa_id').scrollIntoView();
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 13,
			center: new google.maps.LatLng(lat,lon),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		var infowindow = new google.maps.InfoWindow({
			maxWidth: 330
		});
	      var oms = new OverlappingMarkerSpiderfier(map); //Spiderfied it here
	      oms.addListener('click', function(marker, event) {
	      	infowindow.setContent(marker.desc);
	      	infowindow.open(map, marker);
	      });
	      oms.addListener('spiderfy', function(markers) {
	      	infowindow.close();
	      });

	      var marker, i;
				// console.log(marcadores);
	      for (i = 0; i < marcadores.length; i++) {
	      	var iconBase = base_url+'assets/img/markets/'+Mapa.regresa_icon(marcadores[i][4])+".png";
	      	marker = new google.maps.Marker({
	      		position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
	      		map: map,
	      		icon: iconBase,
	      	});

	           oms.addMarker(marker);  // <-- here attempted to add markers
	           google.maps.event.addListener(marker, 'click', (function(marker, i) {
	           	return function() {
	           		idcfg = "'"+marcadores[i][11]+"'";
								cct_mapa = "'"+marcadores[i][3]+"'";
	           		cct_turno_mapa = "'"+marcadores[i][3]+"','"+marcadores[i][6]+"'";
	           		var contentString = '<div class="card-map">';
	           		contentString +='<div class="cardmap-body">';
	           		contentString +='<h5 class="card-title fw-800">'+marcadores[i][0]+'</h5>';
	           		contentString +='<h6 class="card-subtitle mb-2 fw-800 text-muted">'+marcadores[i][3]+'</h6>';
	           		contentString +='<table class="table table-sm">';
	           		contentString +='<tbody>';
	           		contentString +='<tr>';
	           		contentString +='<td colspan="2"><span class="fw800" data-toggle="tooltip" data-placement="right" title="Municipio"><i class="fas fa-globe-americas"></i>: '+marcadores[i][5]+'</span></td>';
	           		contentString +='</tr>';
	           		contentString +='<tr>';
	           		contentString +='<td colspan="2"><span class="fw800" data-toggle="tooltip" data-placement="right" title="Localidad"><i class="fa fa-map-marker-alt"></i>: '+marcadores[i][8]+'</span></td>';
	           		contentString +='</tr>';
	           		contentString +='<tr>';
	           		contentString +='<td><span class="fw800" data-toggle="tooltip" data-placement="right" title="Nivel"><i class="fa fa-chalkboard-teacher"></i>: '+marcadores[i][7]+'</span></td>';
	           		contentString +='<td><span class="fw800" data-toggle="tooltip" data-placement="right" title="Sostenimiento"><i class="fa fa-hand-holding-usd"></i>: '+marcadores[i][10]+'</span></td>';
	           		contentString +='</tr>';
	           		contentString +='<tr>';
	           		contentString +='<td><span class="fw800" data-toggle="tooltip" data-placement="right" title="Turno"><i class="fa fa-clock"></i>: '+marcadores[i][6]+'</span></td>';
	           		contentString +='<td><span class="fw800" data-toggle="tooltip" data-placement="right" title="Zona"><i class="fa fa-crosshairs"></i>: '+marcadores[i][9]+'</span></td>';
	           		contentString +='</tr>';
	           		contentString +='</tbody>';
	           		contentString +='</table>';
	           		contentString +='<p class="text-center">';
	           		contentString +='<button class="btn btn-primary mr-5" onclick="Mapa.cct_mismo_nivel('+idcfg+')" data-toggle="tooltip" data-placement="top" title="Busca 5 escuelas del mismo nivel"><i class="far fa-clone"></i></button>';
								if (marcadores[i][7]!='SUPERIOR' && marcadores[i][7]!='CAPACITACION PARA EL TRABAJO' && marcadores[i][7]!='ESPECIAL') {
									contentString +='<button class="btn btn-primary mr-5" onclick="Mapa.cct_siguiente_nivel('+idcfg+')" data-toggle="tooltip" data-placement="top" title="Busca 5 escuelas del siguiente nivel"><i class="fa fa-share-square"></i></button>';
								}
								if (marcadores[i][7] != 'NO APLICA' && marcadores[i][7]!='SUPERIOR' && marcadores[i][7]!='CAPACITACION PARA EL TRABAJO' && marcadores[i][7]!='ESPECIAL') {
	           			contentString +='<button class="btn btn-primary mr-5" onclick="Mapa.obtener_info('+idcfg+')" data-toggle="tooltip" data-placement="top" title="Información de la escuela"><i class="fa fa-info-circle"></i></button>';
	           		}
	           		contentString +='</p>';
	           		contentString +='</div>';
	           		contentString +='</div>';
	           		infowindow.setContent(contentString);
	           		infowindow.open(map, marker);
	           	}
	           })(marker, i));

	       }
	   }else {
	   	//alert('No se encontraron escuelas');
			Mensaje.alerta("error","No se encontraron escuelas","");
	   	Mensaje.cerrar();
	   	initMap();
	   }
	},
	obtener_info: (idcfg) => {
		Mensaje.cargando('Cargando');
// console.log(idcfg);
		var form = document.createElement("form");
		var element1 = document.createElement("input");
		element1.type="hidden";
		element1.name="idcfg";
		element1.value= idcfg;

		form.name = "form_info";
		form.id = "form_info";
		form.method = "POST";
		form.action = base_url+"Info_escuela/info_escuela";
		form.appendChild(element1);

		document.body.appendChild(form);
		Mensaje.cerrar();
		form.submit();
	},
	obtener_coordenadas_muni: (idmunicipio) => {
		ruta = base_url+'Mapa/obtener_coordenadas_muni';
	  $.ajax({
	    url: ruta,
	    type: 'POST',
	    dataType: 'json',
	    data: {"idmunicipio": idmunicipio},
	    beforeSend: function (xhr) {
	      Mensaje.cargando('Cargando');
	    },
	    success: function (dato) {
	      Mensaje.cerrar();
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 12,
					center: new google.maps.LatLng(dato.coordenadas['lat'],dato.coordenadas['lon']),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});
	    },
	    error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
	  });
	}
}
