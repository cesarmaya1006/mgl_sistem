var Sistema = (function () {
    return {
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $("#" + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                errorElement: "span", //default input error message container
                errorClass: "help-block help-block-error", // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                highlight: function (element, errorClass, validClass) {
                    // hightlight error inputs
                    $(element).closest(".form-group").addClass("has-error"); // set error class to the control group
                },
                unhighlight: function (element) {
                    // revert the change done by hightlight
                    $(element).closest(".form-group").removeClass("has-error"); // set error class to the control group
                },
                success: function (label) {
                    label.closest(".form-group").removeClass("has-error"); // set success class to the control group
                },
                errorPlacement: function (error, element) {
                    if (
                        $(element).is("select") &&
                        element.hasClass("bs-select")
                    ) {
                        //PARA LOS SELECT BOOSTRAP
                        error.insertAfter(element); //element.next().after(error);
                    } else if (
                        $(element).is("select") &&
                        element.hasClass("select2-hidden-accessible")
                    ) {
                        element.next().after(error);
                    } else if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                },
                invalidHandler: function (event, validator) {
                    //display error alert on form submit
                },
                submitHandler: function (form) {
                    return true;
                },
            });
        },
        notificaciones: function (mensaje, titulo, tipo) {
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                timeOut: "5000",
            };
            if (tipo == "error") {
                toastr.error(mensaje, titulo);
            } else if (tipo == "success") {
                toastr.success(mensaje, titulo);
            } else if (tipo == "info") {
                toastr.info(mensaje, titulo);
            } else if (tipo == "warning") {
                toastr.warning(mensaje, titulo);
            } else if (tipo == "secondary") {
                toastr.secondary(mensaje, titulo);
            }
        },
    };
})();

function mayus(e) {
    e.value = e.value.toUpperCase();
}

$(".tabla-borrando").on("submit", ".form-eliminar", function () {
    event.preventDefault();
    const form = $(this);
    Swal.fire({
        title: "¿Está seguro que desea eliminar el registro?",
        text: "Esta acción no se puede deshacer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxRequest(form);
        }
    });
});

function ajaxRequest(form) {
    $.ajax({
        url: form.attr("action"),
        type: "POST",
        data: form.serialize(),
        success: function (respuesta) {
            if (respuesta.mensaje == "ok") {
                form.parents("tr").remove();
                Sistema.notificaciones(
                    "El registro fue eliminado correctamente",
                    "Sistema",
                    "success"
                );
            } else {
                Sistema.notificaciones(
                    "El registro no pudo ser eliminado, hay recursos usandolo",
                    "Sistema",
                    "error"
                );
            }
        },
        error: function () {},
    });
}

function menu_ul() {
    $("a.active").parent("ul.nav-treeview").css("display", "block");
}

$(document).ready(function () {
    $('a.active').parents('li').addClass('menu-open');

    $(".tabla-borrando").on("submit", ".form-eliminar", function () {
        event.preventDefault();
        const form = $(this);
        Swal.fire({
            title: "¿Está seguro que desea eliminar el registro?",
            text: "Esta acción no se puede deshacer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borrar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxRequest(form);
            }
        });
    });

    function ajaxRequest(form) {
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            success: function (respuesta) {
                if (respuesta.mensaje == "ok") {
                    form.parents("tr").remove();
                    Sistema.notificaciones(
                        "El registro fue eliminado correctamente",
                        "Sistema",
                        "success"
                    );
                } else {
                    Sistema.notificaciones(
                        "El registro no pudo ser eliminado, hay recursos usandolo",
                        "Sistema",
                        "error"
                    );
                }
            },
            error: function () {},
        });
    }

    $(".tabla_data_table").DataTable({
        lengthMenu: [10, 15, 25, 50, 75, 100],
        pageLength: 15,
        dom: "lBfrtip",
        buttons: [
            "excel",
            {
                extend: "pdfHtml5",
                orientation: "landscape",
                pageSize: "A1",
                defaultStyle: {
                    fontSize: 10,
                },
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ resultados",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_",
            sInfoEmpty:
                "Mostrando resultados del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
        },
    });

    $(".tabla_data_table_xl").DataTable({
        lengthMenu: [10, 15, 25, 50, 75, 100],
        pageLength: 15,
        dom: "lBfrtip",
        buttons: [
            "excel",
            {
                extend: "pdfHtml5",
                orientation: "landscape",
                pageSize: "A1",
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ resultados",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_",
            sInfoEmpty:
                "Mostrando resultados del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
        },
    });

    $(".tabla_data_table_l").DataTable({
        lengthMenu: [10, 15, 25, 50, 75, 100],
        pageLength: 15,
        dom: "lBfrtip",
        buttons: [
            "excel",
            {
                extend: "pdfHtml5",
                orientation: "landscape",
                pageSize: "Legal",
                title: $("#titulo_tabla").val(),
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ resultados",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_",
            sInfoEmpty:
                "Mostrando resultados del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
        },
    });

    $(".tabla_data_table_m").DataTable({
        lengthMenu: [10, 15, 25, 50, 75, 100],
        pageLength: 15,
        dom: "lBfrtip",
        buttons: [
            "excel",
            {
                extend: "pdfHtml5",
                pageSize: "Legal",
                title: $("#titulo_tabla").val(),
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ resultados",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_",
            sInfoEmpty:
                "Mostrando resultados del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
        },
    });

    $(".tabla_data_table_s").DataTable({
        lengthMenu: [10, 15, 25, 50, 75, 100],
        pageLength: 15,
        dom: "lBfrtip",
        buttons: [
            "excel",
            {
                extend: "pdfHtml5",
                orientation: "landscape",
                pageSize: "letter",
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ resultados",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_",
            sInfoEmpty:
                "Mostrando resultados del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
        },
    });

    $(".tabla_data_table_xs").DataTable({
        lengthMenu: [10, 15, 25, 50, 75, 100],
        pageLength: 15,
        dom: "lBfrtip",
        buttons: [
            "excel",
            {
                extend: "pdfHtml5",
                pageSize: "letter",
            },
        ],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ resultados",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_",
            sInfoEmpty:
                "Mostrando resultados del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
        },
    });

    //--------------------------------------------------------------------------------------------
    $("#id_body_dark_mode").change(function () {
        var valor_dark = "";
        if (this.checked) {
            valor_dark = "si";
        } else {
            valor_dark = "no";
        }
        const data_url = $("#ruta_body_dark_mode").attr("data_url");
        var data = {
            body_dark_mode: valor_dark,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                Sistema.notificaciones(
                    respuesta.respuesta,
                    "Sistema",
                    respuesta.tipo
                );
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------------------------
    $(".check_apariencia").change(function () {
        var valor_fijo = "";
        if (this.checked) {
            valor_fijo = "si";
        } else {
            valor_fijo = "no";
        }
        const data_url = $("#id_cambio_check_ruta").attr("data_url");
        const bd_variable = $(this).attr("bd_variable");
        var data = {
            valor_fijo: valor_fijo,
            bd_variable: bd_variable,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                Sistema.notificaciones(
                    respuesta.respuesta,
                    "Sistema",
                    respuesta.tipo
                );
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------------------------
    $("#fondo_barra_sup").on("change", function () {
        $(this).removeClass();
        var color = "bg-" + $(this).val().toLowerCase();
        $(this).addClass("custom-select mb-3 text-light border-0 " + color);
        if (color == "bg-light") {
            $("#menu_superior")
                .removeClass()
                .addClass(
                    "main-header navbar navbar-expand navbar-white navbar-light"
                );
                color = 'navbar-light';
        }else if(color == "bg-warning"){
            $("#menu_superior")
                .removeClass()
                .addClass(
                    "main-header navbar navbar-expand navbar-white navbar-light " + color
                );
        }
         else {
            $("#menu_superior")
                .removeClass()
                .addClass(
                    "main-header navbar navbar-expand navbar-white navbar-dark " + color
                );
        }
        const data_url = $("#ruta_fondo_barra_sup").attr("data_url");
        const bd_valor = color;
        var data = {
            bd_valor: bd_valor
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function(respuesta) {
                Sistema.notificaciones(respuesta.respuesta, 'Sistema', respuesta.tipo);
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------------------------

    $("#fondo_barra_lat").on("change", function () {
        const color = "bg-" + $(this).val().toLowerCase();
        color_fondo_hijos(color);
        $(this)
            .removeClass()
            .addClass("custom-select mb-3 text-light border-0 " + color);
            const data_url = $("#ruta_fondo_barra_lat").attr("data_url");
            const bd_valor = color;
            var data = {
                bd_valor: bd_valor
            };
            $.ajax({
                url: data_url,
                type: "GET",
                data: data,
                success: function(respuesta) {
                    Sistema.notificaciones(respuesta.respuesta, 'Sistema', respuesta.tipo);
                },
                error: function () {},
            });
    });

    sidebar_collapse();
    sidebar_mini_md_checkbox_input();
    sidebar_mini_xs_checkbox_input();
    flat_sidebar_checkbox_input();
    color_fondo_hijos($("#fondo_barra_lat_input").val());
    $('#fondo_barra_sup').removeClass().addClass('custom-select mb-3 text-light border-0 ' + $("#fondo_barra_sup_input").val().toLowerCase().replace("navbar", 'bg'));
    $("#fondo_barra_sup").find("." + $("#fondo_barra_sup_input").val().toLowerCase().replace("navbar", 'bg')).prop("selected", true);
    $("#fondo_barra_lat").removeClass().addClass("custom-select mb-3 text-light border-0 " + $("#fondo_barra_lat_input").val().toLowerCase());
    $("#fondo_barra_lat").find("." + $("#fondo_barra_lat_input").val().toLowerCase()).prop("selected", true);
});

function sidebar_collapse() {
    if ($("#sidebar_collapse_input").val() == "si") {
        $("body").addClass("sidebar-collapse");
        $(window).trigger("resize");
    } else {
        $("body").removeClass("sidebar-collapse");
        $(window).trigger("resize");
    }
}
function sidebar_mini_md_checkbox_input() {
    if ($("#sidebar_mini_md_checkbox_input").val() == "si") {
        $("body").addClass("sidebar-mini-md");
    } else {
        $("body").removeClass("sidebar-mini-md");
    }
}
function sidebar_mini_xs_checkbox_input() {
    if ($("#sidebar_mini_xs_checkbox_input").val() == "si") {
        $("body").addClass("sidebar-mini-xs");
    } else {
        $("body").removeClass("sidebar-mini-xs");
    }
}
function flat_sidebar_checkbox_input() {
    if ($("#sidebar_mini_xs_checkbox_input").val() == "si") {
        $(".nav-sidebar").addClass("nav-flat");
    } else {
        $(".nav-sidebar").removeClass("nav-flat");
    }
}
function color_fondo_hijos(color) {
    var hijos = $(".main-sidebar").find("a");
    switch (color) {
        case "bg-primary":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-olive bg-primary"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-olive elevation-4 bg-primary"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-warning":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-lightblue bg-warning"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-lightblue elevation-4 bg-warning"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "black");
            });
            break;
        case "bg-info":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-navy bg-info"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-navy elevation-4 bg-info"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-danger":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-navy bg-danger"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-navy elevation-4 bg-danger"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-success":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-navy bg-success"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-navy elevation-4 bg-success"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-indigo":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-info bg-indigo"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-info elevation-4 bg-indigo"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-lightblue":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-primary bg-lightblue"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-primary elevation-4 bg-lightblue"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-navy":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-info bg-navy"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-info elevation-4 bg-navy"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-purple":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar elevation-4 sidebar-no-expand sidebar-light-danger bg-purple"
                    );
            } else {
                $(".main-sidebar")
                    .removeClass()
                    .addClass(
                        "main-sidebar sidebar-light-danger elevation-4 bg-purple"
                    );
            }
            hijos.each(function () {
                $(this).css("color", "white");
            });
            break;
        case "bg-light":
            if ($(".main-sidebar").hasClass("sidebar-no-expand")) {
                $(".main-sidebar").removeClass().addClass("main-sidebar elevation-4 sidebar-no-expand sidebar-light-info");
            } else {
                $(".main-sidebar").removeClass().addClass("main-sidebar elevation-4 sidebar-light-info");
            }
            $('.sidebar').removeClass().addClass('sidebar os-host os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition os-theme-dark');
            hijos.each(function () {
                $(this).css("color", "black");
            });
            break;
        default:
            break;
    }
}


