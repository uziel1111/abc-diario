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
        } //estadistica_especifica

};