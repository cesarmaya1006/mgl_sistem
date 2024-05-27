$(document).ready(function () {
    renderizar_ponnderacion_componentes();
    renderizar_proyecto_avance_comp();
    proyecto_presupuesto_comp();
    //------------------------------------------------------------------------------------------------------------------------
    $('.tablaTarea_selector').on("click", function () {
        const data_url = $(this).attr("data_url");
        const tabla_id = $(this).attr("data_id");
        $('#'+tabla_id).DataTable().ajax.url(data_url).load();

        $.ajax({
            url: data_url,
            type: "GET",
            success: function (respuesta) {
                console.log(respuesta);
            },
            error: function () {},
        });
    });
    //------------------------------------------------------------------------------------------------------------------------
});

function proyecto_presupuesto_comp() {
    const chart_proyecto_presupuesto_comp = $(
        "#chart_proyecto_presupuesto_comp"
    )
        .get(0)
        .getContext("2d");
    const barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };
    const data_url = $("#proyecto_presupuesto_comp").attr("data_url");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            //----------------------------------------------------------------------
            //console.log(respuesta);
            var labels = [];
            var presupuesto = [];
            var ejecucion = [];
            var i = 0;
            $.each(respuesta.datos.labels, function (index, item) {
                labels.push(item);
                presupuesto.push(respuesta.datos.data_presupuesto[i]);
                ejecucion.push(respuesta.datos.data_ejecutado[i]);
                i++;
            });
            var areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: "Presupuesto",
                        backgroundColor: "rgba(0,164,247,0.9)",
                        borderColor: "rgba(0,164,247,0.8)",
                        pointRadius: false,
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(0,164,247,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(0,164,247,1)",
                        data: presupuesto,
                    },
                    {
                        label: "Ejecutado",
                        backgroundColor: "rgba(0, 247, 247, 1)",
                        borderColor: "rgba(0, 247, 247, 1)",
                        pointRadius: false,
                        pointColor: "rgba(0, 247, 247, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(0,247,247,1)",
                        data: ejecucion,
                    },
                ],
            };
            var barChartData = $.extend(true, {}, areaChartData);
            var temp0 = areaChartData.datasets[0];
            var temp1 = areaChartData.datasets[1];
            barChartData.datasets[0] = temp1;
            barChartData.datasets[1] = temp0;

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }
            //---------------------------------------------------------------------------

            new Chart(chart_proyecto_presupuesto_comp, {
                type: "bar",
                data: barChartData,
                options: barChartOptions,
            });
        },
        error: function () {},
    });
}

function renderizar_proyecto_avance_comp() {
    const pieChartCanvas = $("#avanceComponentesChart").get(0).getContext("2d");
    const pieOptions = {
        maintainAspectRatio: true,
        responsive: true,
        plugins: {
            legend: {
                position: "top",
                usePointStyle: true,
            },
            subtitle: {
                display: true,
                align: "start",
                text: "Valores en %",
                color: "black",
                font: {
                    size: 12,
                    family: "tahoma",
                    weight: "normal",
                    style: "italic",
                },
                padding: {
                    bottom: 10,
                },
            },
        },
    };
    const data_url = $("#proyecto_avance_comp").attr("data_url");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            var locations2 = [];
            var location = respuesta.data_ponderacion_comp.datasets.data;
            for (
                var i = 0;
                i < respuesta.data_ponderacion_comp.datasets.data.length;
                i++
            ) {
                locations2.push(
                    parseFloat(respuesta.data_ponderacion_comp.datasets.data[i])
                );
            }

            var datapondComp = {
                labels: respuesta.data_ponderacion_comp.labels,
                datasets: [
                    {
                        label: "Valores en porcentaje de avance",
                        data: locations2,
                        backgroundColor:
                            respuesta.data_ponderacion_comp.datasets
                                .backgroundColor,
                        borderColor:
                            respuesta.data_ponderacion_comp.datasets
                                .backgroundColor,
                        borderWidth: 1,
                    },
                ],
            };
            new Chart(pieChartCanvas, {
                type: "bar",
                data: datapondComp,
                options: pieOptions,
            });
        },
        error: function () {},
    });
}

function renderizar_ponnderacion_componentes() {
    const pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    const pieOptions = {
        maintainAspectRatio: true,
        responsive: true,
        plugins: {
            legend: {
                position: "top",
                usePointStyle: true,
                onHover: handleHover,
                onLeave: handleLeave,
            },
            subtitle: {
                display: true,
                align: "start",
                text: "Valores en %",
                color: "black",
                font: {
                    size: 12,
                    family: "tahoma",
                    weight: "normal",
                    style: "italic",
                },
                padding: {
                    bottom: 10,
                },
            },
        },
    };
    const data_url = $("#proyecto_mostrar_proyecto").attr("data_url");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            var datapondComp = {
                labels: respuesta.data_ponderacion_comp.labels,
                datasets: [
                    {
                        data: respuesta.data_ponderacion_comp.datasets.data,
                        backgroundColor:
                            respuesta.data_ponderacion_comp.datasets
                                .backgroundColor,
                    },
                ],
            };
            new Chart(pieChartCanvas, {
                type: "pie",
                data: datapondComp,
                options: pieOptions,
            });
        },
        error: function () {},
    });
}

function handleHover(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach(
        (color, index, colors) => {
            colors[index] =
                index === item.index || color.length === 9
                    ? color
                    : color + "4D";
        }
    );
    legend.chart.update();
}

// Removes the alpha channel from background colors
function handleLeave(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach(
        (color, index, colors) => {
            colors[index] = color.length === 9 ? color.slice(0, -2) : color;
        }
    );
    legend.chart.update();
}
