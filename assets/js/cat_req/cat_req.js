function ver_documento(folio) {
	// $("#modal-documento").modal('show');
	ruta = base_url+'Cat_req/ver_documento';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {folio: folio},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando.');
      },
      success: function (dato) {
        Mensaje.cerrar();
				$("#urldoc").attr("src",dato.source);
				$("#modal-documento").modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
    });
}

function ver_detalle(folio) {
	ruta = base_url+'Cat_req/ver_detalle';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {folio: folio},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando.');
      },
      success: function (dato) {
        Mensaje.cerrar();
				$("#detallesModal").empty();
				$("#detallesModal").append(dato.string);
				$("#modal-detalle").modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
    });
}

function ver_contacto(folio) {
	ruta = base_url+'Cat_req/ver_contacto';
    $.ajax({
      url: ruta,
      type: 'POST',
      dataType: 'json',
      data: {folio: folio},
      beforeSend: function (xhr) {
        Mensaje.cargando('Cargando.');
      },
      success: function (dato) {
        Mensaje.cerrar();
				$("#contacto_cont").empty();
				$("#contacto_cont").append(dato.string);
				$("#modal-contacto").modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown) {
				Mensaje.cerrar();
				Mensaje.error_ajax(jqXHR,textStatus, errorThrown);
			}
    });
}
