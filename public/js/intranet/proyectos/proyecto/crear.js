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

    if ($('#config_empresa_id_2').length) {
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
                if (respuesta.lideres.length > 0) {
                    var respuesta_html = "";
                    respuesta_html +='<option value="">Seleccione un Lider</option>';
                    $.each(respuesta.lideres, function (index, item) {
                        respuesta_html +='<option value="' + item.id + '">'+ item.nombres + ' ' + item.apellidos + ' ( ' + item.empleado.cargo.cargo + ' )';
                        if (id!= item.empleado.cargo.area.empresa.id) {
                            respuesta_html+= ' - ' + item.empleado.cargo.area.empresa.nombres;
                        }
                        respuesta_html+= '</option>';
                    });
                    $("#lider_id").html(respuesta_html);
                }
            },
            error: function () {},
        });
      }

    $("#config_empresa_id").on("change", function () {
        $("#lider_id").html('<option value="">Seleccione un Lider</option>');
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
                if (respuesta.lideres.length > 0) {
                    var respuesta_html = "";
                    respuesta_html +='<option value="">Seleccione un Lider</option>';
                    $.each(respuesta.lideres, function (index, item) {
                        respuesta_html +='<option value="' + item.id + '">'+ item.nombres + ' ' + item.apellidos + ' ( ' + item.empleado.cargo.cargo + ' )';
                        if (id!= item.empleado.cargo.area.empresa.id) {
                            respuesta_html+= ' - ' + item.empleado.cargo.area.empresa.nombres;
                        }
                        respuesta_html+= '</option>';
                    });
                    $("#lider_id").html(respuesta_html);
                }
            },
            error: function () {},
        });
    });
});
