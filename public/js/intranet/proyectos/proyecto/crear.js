$(document).ready(function () {
    $("#config_grupo_empresas_id").on("change", function () {
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
                if (respuesta.empresas.length > 0) {
                    var respuesta_html = "";
                    respuesta_html +='<option value="">Elija empresa</option>';
                    $.each(respuesta.empresas, function (index, item) {
                        respuesta_html +='<option value="'+item.id+'">'+item.nombres+'</option>';
                    });
                    $("#config_empresa_id").html(respuesta_html);
                    $("#caja_empresas").removeClass("d-none");
                }
            },
            error: function () {},
        });
    });

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
                }
            },
            error: function () {},
        });
    });
    $("#empresa_area_id").on("change", function () {
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        console.log(id);
        if (id!=null) {
           $('#caja_cargo_nuevo').removeClass('d-none');
        } else {
            $('#caja_cargo_nuevo').addClass('d-none');
        }
    });
});
