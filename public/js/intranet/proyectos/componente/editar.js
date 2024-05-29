$(document).ready(function () {
    $("#checkAdcionar").change(function() {
        if(this.checked) {
            $('#caja_adiciones').removeClass('d-none');
            $('#adicion').attr('required', true);
            $('#justificacion').attr('required', true);
        }else{
            $('#caja_adiciones').addClass('d-none');
            $('#adicion').attr('required', false);
            $('#justificacion').attr('required', false);
        }
    });
});
