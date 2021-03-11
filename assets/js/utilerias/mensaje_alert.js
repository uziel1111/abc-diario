let Mensaje = {

	cargando: (seccion) => {
		msj = Swal.fire({
			titleText: seccion,
			imageUrl: base_url + 'assets/img/loading-1.gif',
			showConfirmButton: false,
			allowOutsideClick: false,
			allowEscapeKey: false,
		});
	},//msj

	alerta: (icono, titulo, mensaje) => {
		msj = Swal.fire({
			title: titulo,
			text: mensaje,
			icon: icono,
			showConfirmButton: true
		});
	},//alerta

	error_ajax : (jqXHR, textStatus, errorThrown) => {
		console.log(jqXHR);
	    if (jqXHR.status === 0) {
	      	Mensaje.alerta("error","Not connect: Verify Network","");
	    } else if (jqXHR.status == 404) {
	      	Mensaje.alerta("error","Requested page not found [404]","");
	    } else if (jqXHR.status == 500) {
	      	Mensaje.alerta("error","Internal Server Error [500]","");
	    }else if (jqXHR.status == 408) {
	      	location.href = base_url+'Login';
	    } else if (textStatus === "parsererror") {
	      	Mensaje.alerta("error","Requested JSON parse failed","");
	    } else if (textStatus === "timeout") {
	      	Mensaje.alerta("error","Time out error","");
	    } else if (textStatus === "abort") {
	      	Mensaje.alerta("error","Ajax request aborted","");
	    } else {
	      	Mensaje.alerta("error","Uncaught Error: "+qXHR.responseText,"");
	    }

  	},//error_ajax

	cerrar: () => {
		swal.close();
	},//cerrar
}
