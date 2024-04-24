$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

    $(":input").parent().children("label").addClass("requerido");
    $("#presupuesto").on("change", function () {
        const disponible_componentes = parseFloat(
            $("#disponible_componentes").val()
        );
        if (parseFloat($(this).val()) > disponible_componentes) {
            $(this).val(disponible_componentes);
            Toast.fire({
                icon: "error",
                title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
            });
        }
    });
    $("#presupuesto").on("keyup", function () {
        const disponible_componentes = parseFloat(
            $("#disponible_componentes").val()
        );
        if (parseFloat($(this).val()) > disponible_componentes) {
            $(this).val(disponible_componentes);
            Toast.fire({
                icon: "error",
                title: "Supera el maximo del presupuesto disponible.",
                html: "<p>$ "+ parseFloat(disponible_componentes).toFixed(2) + ".</p>",
            });
        }
    });
});
