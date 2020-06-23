let Mensaje = {

	cargando: (seccion) => {

		msj = Swal.fire({
			//title: seccion,
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
			showConfirmButton: false,
			timer: 1000,
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

	respuesta: (icono, mensaje) => {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			allowOutsideClick: false,
			onOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		})

		Toast.fire({
			icon: icono,
			title: mensaje,
		})
	},//respuesta

	opciones: (icono, titulo, mensaje, btn_ok, funcion) => {
		msj = Swal.fire({
			title: titulo,
			text: mensaje,
			icon: icono,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: btn_ok,
			cancelButtonText: 'Cancelar',
			allowOutsideClick: false,
		}).then((result) => {
			if (result.value) {
				eval(funcion);
			}
		});
	},//opciones


	cerrar: () => {
		swal.close();
	},//cerrar
}
