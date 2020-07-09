var Estadistica_zona = {


  	resultado_estadistica_zona: (idnivel,idmodalidad,numzona,idciclo,callback) => {
     	ruta = base_url + "estadistica/obtener_estadistica_xzona";
	    $.ajax({
	        url: ruta,
	        type: 'POST',
	        dataType: 'json',
	        data: {idnivel:idnivel,idmodalidad:idmodalidad,numzona:numzona,idciclo:idciclo},
	        beforeSend: function (xhr) {
	        	Mensaje.cargando('Cargando estadística');
	        },
	        success: function (data) {
	        	Mensaje.cerrar();
	        	$("#div_estadistica").empty();
	        	$("#div_estadistica").append(data.vista);
            callback();
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	        	Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
	    	}
	    });
  	}//

};
