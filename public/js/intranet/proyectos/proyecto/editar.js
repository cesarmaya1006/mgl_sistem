$(document).ready(function () {
    //------------------------------------------------------------------------------------------------------------------------
    $("#adicion").on("change", function () {
        if ($(this).val()!=0) {
            $('#caja_justificacion').removeClass('d-none');
            $('#justificacion').attr("required", true);
        } else {
            $('#caja_justificacion').addClass('d-none');
            $('#justificacion').attr("required", false);
        }
    });
    //------------------------------------------------------------------------------------------------------------------------
});
