var Sistema = function () {
    return {
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $('#' + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                highlight: function (element, errorClass, validClass) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                errorPlacement: function (error, element) {
                    if ($(element).is('select') && element.hasClass('bs-select')) { //PARA LOS SELECT BOOSTRAP
                        error.insertAfter(element); //element.next().after(error);
                    } else if ($(element).is('select') && element.hasClass('select2-hidden-accessible')) {
                        element.next().after(error);
                    } else if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit

                },
                submitHandler: function (form) {
                    return true;
                }
            });
        },
        notificaciones: function (mensaje, titulo, tipo) {
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: '5000'
            };
            if (tipo == 'error') {
                toastr.error(mensaje, titulo);
            } else if (tipo == 'success') {
                toastr.success(mensaje, titulo);
            } else if (tipo == 'info') {
                toastr.info(mensaje, titulo);
            } else if (tipo == 'warning') {
                toastr.warning(mensaje, titulo);
            } else if (tipo == 'secondary') {
                toastr.secondary(mensaje, titulo);
            }
        },
    }
}();

function mayus(e) {
    e.value = e.value.toUpperCase();
}




    $(".tabla-borrando").on('submit', '.form-eliminar', function() {
        event.preventDefault();
        const form = $(this);
        Swal.fire({
            title: '¿Está seguro que desea eliminar el registro?',
            text: "Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
                ajaxRequest(form);
            }
          });


    });

    function ajaxRequest(form) {
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(respuesta) {
                if (respuesta.mensaje == "ok") {
                    form.parents('tr').remove();
                    Sistema.notificaciones('El registro fue eliminado correctamente', 'Sistema', 'success');
                } else {
                    Sistema.notificaciones('El registro no pudo ser eliminado, hay recursos usandolo', 'Sistema', 'error');
                }
            },
            error: function() {

            }
        });
    }

    function menu_ul(){
        $( "a.active" ).parent( "ul.nav-treeview" ).css("display", "block");
    }

    $(document).ready(function() {
        $(".tabla-borrando").on('submit', '.form-eliminar', function() {
            event.preventDefault();
            const form = $(this);
            Swal.fire({
                title: '¿Está seguro que desea eliminar el registro?',
                text: "Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Borrar!',
                cancelButtonText: 'Cancelar'
              }).then((result) => {
                if (result.isConfirmed) {
                    ajaxRequest(form);
                }
              });


        });

        function ajaxRequest(form) {
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(respuesta) {
                    if (respuesta.mensaje == "ok") {
                        form.parents('tr').remove();
                        Sistema.notificaciones('El registro fue eliminado correctamente', 'Sistema', 'success');
                    } else {
                        Sistema.notificaciones('El registro no pudo ser eliminado, hay recursos usandolo', 'Sistema', 'error');
                    }
                },
                error: function() {

                }
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
                    title:$('#titulo_tabla').val(),
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
                    title:$('#titulo_tabla').val(),
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
    });

