$(document).ready(function () {
    //==========================================================================
    $('#botonEstado_id').on( "click", function() {
        const url_t = $(this).attr('data_url');
        var est = 0;
        if ($(this).attr('data_estado')=='1') {
            est = 0;
        } else {
            est = 1;
        }
        const data_estado = est;

        var data = {
                    data_estado: data_estado,
                    _token: $("input[name=_token]").val(),
                    };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                if (respuesta.mensaje == "Activada") {
                    $('#botonEstado_id').removeClass('btn-secondary');
                    $('#botonEstado_id').addClass('btn-success');
                    $('#botonEstado_id').attr('data_estado',1);
                    $("#botonEstado_id").html('Grupo Empresarial Activo');

                    Sistema.notificaciones('El grupo empresarial se activo de manera correcta', 'Sistema', 'success');
                } else {
                    $('#botonEstado_id').removeClass('btn-success');
                    $('#botonEstado_id').addClass('btn-secondary');
                    $('#botonEstado_id').attr('data_estado',0);
                    $("#botonEstado_id").html('Grupo Empresarial Inactivo');

                    Sistema.notificaciones('El grupo empresarial se inactivo de manera correcta', 'Sistema', 'warning');
                }
                $('#identificacion').focus();
            },
            error: function() {

            }
        });
    });
    //==========================================================================
   //==========================================================================
   $('#botonEstado_id').on( "click", function() {
    const url_t = $(this).attr('data_url');
    var est = 0;
    if ($(this).attr('data_estado')=='1') {
        est = 0;
    } else {
        est = 1;
    }
    const data_estado = est;

    var data = {
                data_estado: data_estado,
                _token: $("input[name=_token]").val(),
                };
    $.ajax({
        url: url_t,
        type: 'GET',
        data: data,
        success: function(respuesta) {
            if (respuesta.mensaje == "Activada") {
                $('#botonEstado_id').removeClass('btn-secondary');
                $('#botonEstado_id').addClass('btn-success');
                $('#botonEstado_id').attr('data_estado',1);
                $("#botonEstado_id").html('Grupo Empresarial Activo');

                Sistema.notificaciones('El grupo empresarial se activo de manera correcta', 'Sistema', 'success');
            } else {
                $('#botonEstado_id').removeClass('btn-success');
                $('#botonEstado_id').addClass('btn-secondary');
                $('#botonEstado_id').attr('data_estado',0);
                $("#botonEstado_id").html('Grupo Empresarial Inactivo');

                Sistema.notificaciones('El grupo empresarial se inactivo de manera correcta', 'Sistema', 'warning');
            }
            $('#identificacion').focus();
        },
        error: function() {

        }
    });
});
//==========================================================================
});
