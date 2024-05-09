$(document).ready(function () {
    //------------------------------------------------------------------------------------------------------------------------
    $('#btn_sumar_doc').on("click", function () {
        const cant_documentos_ini = parseInt($('#cant_documentos').val());
        const cant_documentos_fin = cant_documentos_ini + 1;
        $('#cant_documentos').val(cant_documentos_fin);
        $('#bloqueDoc_base').clone().prop("id", "bloqueDoc_"+ cant_documentos_fin).appendTo('#caja_documentos');
        $('#bloqueDoc_'+ cant_documentos_fin).removeClass('d-none').addClass('bloqueDoc');
        $('#bloqueDoc_'+ cant_documentos_fin).find('span').attr("onclick","eliminar_bloqueDoc_base("+cant_documentos_fin+")");
        $('#bloqueDoc_'+ cant_documentos_fin).find('span').removeClass('d-none');

    });
    //------------------------------------------------------------------------------------------------------------------------
    $('.col_eliminar_input').on("click", function () {
        console.log('sipi');
        $(this).parent('.bloqueDoc_base').remove();
    });
    //------------------------------------------------------------------------------------------------------------------------
});

function eliminar_bloqueDoc_base(id){
    $('#bloqueDoc_' + id).remove();
}
