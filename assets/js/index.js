$(document).ready(function ($) {
Index.irArriba();
});
$("#estadistica_general").click(function(e) {
    e.preventDefault();
    // alert("en estadistica general");
    Index.estadistica_general();

});

$("#estadistica_especifica").click(function(e) {
    e.preventDefault();
    Index.estadistica_especifica();

});


var Index = {

    estadistica_general: () => {

        ruta = base_url + "estadistica/estadistica_general";
        $.ajax({
            url: ruta,
            type: 'POST',
            dataType: 'json',
            data: {},
            beforeSend: function(xhr) {

            },
            success: function(data) {
                $("#div_temporal").empty();
                $("#div_temporal").append(data.vista);
            },
            error: function(jqXHR, textStatus, errorThrown) {

            }
        });

    }, //estadistica_general
    estadistica_especifica: () => {
            ruta = base_url + "estadistica/estadistica_especifica";

            $.ajax({
                url: ruta,
                type: 'POST',
                dataType: 'json',
                data: {},
                beforeSend: function(xhr) {

                },
                success: function(data) {
                    $("#div_temporal").empty();
                    $("#div_temporal").append(data.vista);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });
        }, //estadistica_especifica

        irArriba: () => {
      	  	$('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },1000); });
      	  	$(window).scroll(function(){
      	    	if($(this).scrollTop() > 0){ $('.ir-arriba').slideDown(600); }else{ $('.ir-arriba').slideUp(600); }
      	  	});
      	  	$('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'1000px' },1000); });
      	}

};
