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
        var data = {
            id: id,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                if (respuesta.cargos.length > 0) {
                    var respuesta_html = "";
                    respuesta_html +='<option value="">Elija cargo</option>';
                    $.each(respuesta.cargos, function (index, item) {
                        respuesta_html +='<option value="'+item.id+'">'+item.cargo+'</option>';
                    });
                    $("#empresa_cargo_id").html(respuesta_html);
                    $("#caja_cargos").removeClass("d-none");
                }
            },
            error: function () {},
        });
    });
    $("#empresa_cargo_id").on("change", function () {
        const id = $(this).val();
        if (id!=null) {
           $('#caja_usuario_nuevo').removeClass('d-none');
        } else {
            $('#caja_usuario_nuevo').addClass('d-none');
        }
    });
    $(".label_checkbox").change(function() {
        const valor = $(this).val();
        if(this.checked) {
            $('#label_checkbox'+valor).html('Si');
        }else{
            $('#label_checkbox'+valor).html('No');
        }
    });
    $("#usuario_tranv").change(function() {
        const valor = $(this).val();
        if(this.checked) {
            $('#id_tabla_transv').removeClass('d-none');
        }else{
            $('#id_tabla_transv').addClass('d-none');
            $('#body_usuario_tranv').find('input').prop( "checked", false );
        }
    });
});

function mostrar(){
    var archivo = document.getElementById("foto").files[0];
    var reader = new FileReader();
    if (archivo) {
      reader.readAsDataURL(archivo );
      reader.onloadend = function () {
        document.getElementById("fotoUsuario").src = reader.result;
      }
    }
  }
