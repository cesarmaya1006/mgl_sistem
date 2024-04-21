$(document).ready(function () {
    $('#flush-collapseCalendario').addClass('collapse');
    const proyectosModal = new bootstrap.Modal(document.getElementById("proyectosModal"));
    $(".link_item_card").on("click", function () {
        const data_id = $(this).attr("data_id");
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
                var respuesta_html = "";

                $.each(respuesta.proyectos, function (index, proyecto) {
                    respuesta_html += '<tr>';
                    respuesta_html +='<td style="white-space:nowrap;">' + proyecto.id + '</td>';
                    respuesta_html +='<td style="white-space:nowrap;">';
                    respuesta_html +='<button class="btn btn-link" style="text-decoration: none;" >' + proyecto.titulo + '</button >';
                    respuesta_html +='<br>';
                    respuesta_html +='<small class="ml-4">Creado ' + proyecto.fec_creacion + '</small>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td style="white-space:nowrap;">';
                    respuesta_html +='<img alt="Avatar" class="table-avatar" title="' + proyecto.lider.nombres + ' ' + proyecto.lider.apellidos + '" src="' + $('#folder_imagenes_usuario').val() + '/' + proyecto.lider.foto + '">';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="d-flex justify-content-around" style="white-space:nowrap;">';
                    respuesta_html +='<ul class="list-inline">';
                    $.each(proyecto.miembros_proyecto, function (index, miembro_equipo){
                        respuesta_html +='<li class="list-inline-item">';
                        if (proyecto.lider.id != miembro_equipo.id ) {
                            respuesta_html +='<img alt="Avatar" class="table-avatar" title="' + miembro_equipo.nombres + ' ' + miembro_equipo.apellidos + '" src="' + $('#folder_imagenes_usuario').val() + '/' + miembro_equipo.foto + '">';
                        }

                        respuesta_html +='</li>';
                    });

                    respuesta_html +='</ul>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="text-center" style="white-space:nowrap;">';
                    var d1 = new Date(proyecto.fec_creacion);
                    var d2 = new Date();
                    var diff = d2.getTime() - d1.getTime();
                    var daydiff = diff / (1000 * 60 * 60 * 24);
                    respuesta_html += Math.round(daydiff)  + ' días';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project_progress">';
                    respuesta_html +='    <div class="progress progress-sm">';
                    respuesta_html +='        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="' + proyecto.progreso + '" aria-volumemin="0" aria-volumemax="100" style="width: ' + proyecto.progreso + '%"></div>';
                    respuesta_html +='    </div>';
                    respuesta_html +='    <small>' + parseInt(proyecto.progreso).toFixed(2) + ' %</small>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project-state" style="white-space:nowrap;">';
                    respuesta_html +='    <span class="badge ';
                    switch (proyecto.estado) {
                        case 'activo':
                            respuesta_html +='badge-success';
                            break;

                        case 'extendido':
                            respuesta_html +='badge-danger';
                            break;

                        case 'cerrado':
                            respuesta_html +='badge-secondary';
                            break;
                        default:
                            respuesta_html +='badge-info';
                            break;
                    }
                    respuesta_html +='">' + proyecto.estado + '</span>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project-actions text-right">';
                    respuesta_html +='    <a ';
                    respuesta_html +='        href="' + $('#input_getdetalleproyecto').val().replace('detalle/1','detalle/'+proyecto.id)  + '" class="btn btn-primary btn-sm pl-3 pr-3"';
                    respuesta_html +='        data_id="' + proyecto.id + '"';
                    respuesta_html +='        style="font-size: 0.8em;"';
                    respuesta_html +=     '>';
                    respuesta_html +='            <iclass="fas fa-folder mr-1"></i>Ver</a>';
                    respuesta_html +='</td>';
                    respuesta_html += "</tr>";
                });

                $("#tbody_proyectos").html(respuesta_html);
            },
            error: function () {},
        });
        proyectosModal.show();
    });
    $(".boton_cerrar_modal").on("click", function () {
        proyectosModal.toggle();
    });
    //===================================================================================================
    const proyectosModalUsuario = new bootstrap.Modal(document.getElementById("proyectosModalUsuario"));
    $("#tarjetaProyectosUsuario").on("click", function () {
        const data_url = $(this).attr("data_url");
        const data_url2 = $(this).attr("data_url2");
        const id = $(this).val();
        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                var respuesta_html = "";
                $.each(respuesta.proyectos, function (index, proyecto) {
                    respuesta_html += '<tr>';
                    respuesta_html +='<td style="white-space:nowrap;">' + proyecto.id + '</td>';
                    respuesta_html +='<td style="white-space:nowrap;">';
                    respuesta_html +='<a href="'+  data_url2.replace("/gestion/1", '/gestion/' + proyecto.id ) +'" class="btn btn-link" style="text-decoration: none;" >' + proyecto.titulo + '</a>';
                    respuesta_html +='<br>';
                    respuesta_html +='<small class="ml-4">Creado ' + proyecto.fec_creacion + '</small>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td style="white-space:nowrap;">';
                    respuesta_html +='<img alt="Avatar" class="table-avatar" title="' + proyecto.lider.nombres + ' ' + proyecto.lider.apellidos + '" src="' + $('#folder_imagenes_usuario').val() + '/' + proyecto.lider.foto + '">';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="d-flex justify-content-around" style="white-space:nowrap;">';
                    respuesta_html +='<ul class="list-inline">';
                    $.each(proyecto.miembros_proyecto, function (index, miembro_equipo){
                        respuesta_html +='<li class="list-inline-item">';
                        if (proyecto.lider.id != miembro_equipo.id ) {
                            respuesta_html +='<img alt="Avatar" class="table-avatar" title="' + miembro_equipo.nombres + ' ' + miembro_equipo.apellidos + '" src="' + $('#folder_imagenes_usuario').val() + '/' + miembro_equipo.foto + '">';
                        }

                        respuesta_html +='</li>';
                    });

                    respuesta_html +='</ul>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="text-center" style="white-space:nowrap;">';
                    var d1 = new Date(proyecto.fec_creacion);
                    var d2 = new Date();
                    var diff = d2.getTime() - d1.getTime();
                    var daydiff = diff / (1000 * 60 * 60 * 24);
                    respuesta_html += Math.round(daydiff)  + ' días';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project_progress">';
                    respuesta_html +='    <div class="progress progress-sm">';
                    respuesta_html +='        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="' + proyecto.progreso + '" aria-volumemin="0" aria-volumemax="100" style="width: ' + proyecto.progreso + '%"></div>';
                    respuesta_html +='    </div>';
                    respuesta_html +='    <small>' + parseInt(proyecto.progreso).toFixed(2) + ' %</small>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project-state" style="white-space:nowrap;">';
                    respuesta_html +='    <span class="badge ';
                    switch (proyecto.estado) {
                        case 'activo':
                            respuesta_html +='badge-success';
                            break;

                        case 'extendido':
                            respuesta_html +='badge-danger';
                            break;

                        case 'cerrado':
                            respuesta_html +='badge-secondary';
                            break;
                        default:
                            respuesta_html +='badge-info';
                            break;
                    }
                    respuesta_html +='">' + proyecto.estado + '</span>';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project-actions text-right">';
                    respuesta_html +='    <a ';
                    respuesta_html +='        href="' + $('#input_getdetalleproyecto').val().replace('detalle/1','detalle/'+proyecto.id)  + '" class="btn btn-primary btn-sm pl-3 pr-3"';
                    respuesta_html +='        data_id="' + proyecto.id + '"';
                    respuesta_html +='        style="font-size: 0.8em;"';
                    respuesta_html +=     '>';
                    respuesta_html +='            <iclass="fas fa-folder mr-1"></i>Ver</a>';
                    respuesta_html +='</td>';
                    respuesta_html += "</tr>";
                });

                $("#tbody_proyectos_usuario").html(respuesta_html);
            },
            error: function () {},
        });
        proyectosModalUsuario.show();
    });

    $(".boton_cerrar_modal_pro_usu").on("click", function () {
        proyectosModalUsuario.toggle();
    });

    //===================================================================================================
    const tareasModalUsuario = new bootstrap.Modal(document.getElementById("tareasModalUsuario"));
    $(".tarjetaTareasUsuario").on("click", function () {
        const data_url = $(this).attr("data_url");
        const data_url2 = $(this).attr("data_url2");
        const id = $(this).val();
        $("#tbody_tareas_usuario").html('');
        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                console.log(respuesta);
                var respuesta_html = "";
                $.each(respuesta.tareas, function (index, tarea) {
                    respuesta_html += '<tr onclick="window.location=\''+  data_url2.replace("/gestion/1", '/gestion/' + tarea.id ) +'\'" style="cursor: pointer;">';
                    respuesta_html +='<td style="white-space:nowrap;">' + tarea.id + '</td>';
                    respuesta_html +='<td style="white-space:nowrap;">' + tarea.titulo + '</td>';
                    respuesta_html +='<td class="text-center" style="white-space:nowrap;">';
                    var d1 = new Date(tarea.fec_creacion);
                    var d2 = new Date();
                    var diff = d2.getTime() - d1.getTime();
                    var daydiff = diff / (1000 * 60 * 60 * 24);
                    respuesta_html += Math.round(daydiff)  + ' días';
                    respuesta_html +='</td>';
                    respuesta_html +='<td class="project_progress">';
                    respuesta_html +='    <div class="progress progress-sm">';
                    respuesta_html +='        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="' + tarea.progreso + '" aria-volumemin="0" aria-volumemax="100" style="width: ' + tarea.progreso + '%"></div>';
                    respuesta_html +='    </div>';
                    respuesta_html +='    <small>' + parseInt(tarea.progreso).toFixed(2) + ' %</small>';
                    respuesta_html +='</td>';
                    respuesta_html += "</tr>";
                });

                $("#tbody_tareas_usuario").html(respuesta_html);
            },
            error: function () {},
        });
        tareasModalUsuario.show();
    });

    $(".boton_cerrar_modal_tarea_usu").on("click", function () {
        tareasModalUsuario.toggle();
    });

    //===================================================================================================
    $('.fc-toolbar-title').addClass('text-capitalize');
    $('.fc-col-header-cell-cushion').addClass('text-capitalize');

});

