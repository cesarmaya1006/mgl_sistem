$(document).ready(function () {
    $("#config_empresa_id").on("change", function () {
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        var data = {
            id: id,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta.areasPadre.length > 0) {
                    var respuesta_html = "";
                    respuesta_html +='<option value="">Elija área</option>';
                    $.each(respuesta.areasPadre, function (index, item) {
                        respuesta_html +='<option value="'+item.id+'">'+item.area+'</option>';
                    });
                    $("#empresa_area_id").html(respuesta_html);
                    $("#caja_areas").removeClass("d-none");
                    $("#caja_area_nueva").removeClass("d-none");
                } else {
                    $("#caja_area_nueva").removeClass("d-none");
                }
            },
            error: function () {},
        });
    });
    $(".boton_cerrar_modal").on("click", function () {
        myModal.toggle();
    });
});
