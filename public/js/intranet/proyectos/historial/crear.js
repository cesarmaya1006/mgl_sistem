$(document).ready(function () {
    $("#add_documentos").change(function() {
        const valor = $(this).val();
        const cant_documentos_ini = parseInt($('#cant_documentos').val());
        const cant_documentos_fin = cant_documentos_ini + 1;
        if(this.checked) {
            $('#cant_documentos').val(cant_documentos_fin);
            if (cant_documentos_ini == 0) {
                $('#bloqueDoc_base').clone().prop("id", "bloqueDoc_"+ cant_documentos_fin).appendTo('#caja_documentos');
                $('#bloqueDoc_'+ cant_documentos_fin).removeClass('d-none').addClass('bloqueDoc');
                $('#bloqueDoc_'+ cant_documentos_fin).find('span').remove();
            }
            $('.caja_documentos').removeClass('d-none');
            $('#caja_btn_sumar_doc').removeClass('d-none');

        }else{
            $('.bloqueDoc').remove();
            $('#cant_documentos').val('0')
            $('.caja_documentos').addClass('d-none');
            $('#caja_btn_sumar_doc').addClass('d-none');
        }
    });
    //------------------------------------------------------------------------------------------------------------------------
    $('#btn_sumar_doc').on("click", function () {
        const cant_documentos_ini = parseInt($('#cant_documentos').val());
        const cant_documentos_fin = cant_documentos_ini + 1;
        $('#cant_documentos').val(cant_documentos_fin);
        $('#bloqueDoc_base').clone().prop("id", "bloqueDoc_"+ cant_documentos_fin).appendTo('#caja_documentos');
        $('#bloqueDoc_'+ cant_documentos_fin).removeClass('d-none').addClass('bloqueDoc');
        $('#bloqueDoc_'+ cant_documentos_fin).find('span').attr("onclick","eliminar_bloqueDoc_base("+cant_documentos_fin+")");

    });
    //------------------------------------------------------------------------------------------------------------------------
    $('.col_eliminar_input').on("click", function () {
        console.log('sipi');
        $(this).parent('.bloqueDoc_base').remove();
    });
    //------------------------------------------------------------------------------------------------------------------------
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    $("#costo").on("change", function () {
        const disponible_componentes = parseFloat(
            $("#disponible_componente").val()
        );
        if (parseFloat($(this).val()) > disponible_componentes) {
            $(this).val(parseFloat(disponible_componentes).toFixed(2));
            Toast.fire({
                icon: "error",
                title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
            });
        }
    });

    $("#costo").on("keyup", function () {
        const disponible_componentes = parseFloat(
            $("#disponible_componente").val()
        );
        if (parseFloat($(this).val()) > disponible_componentes) {
            $(this).val(parseFloat(disponible_componentes).toFixed(2));
            Toast.fire({
                icon: "error",
                title: "Supera el maximo del presupuesto disponible.",
                html: "<p>$ "+ parseFloat(disponible_componentes).toFixed(2) + "</p>",
            });
        }
    });
    //------------------------------------------------------------------------------------------------------------------------

});

function eliminar_bloqueDoc_base(id){
    $('#bloqueDoc_' + id).remove();
}
