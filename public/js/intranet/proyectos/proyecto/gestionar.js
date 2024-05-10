$(document).ready(function () {
    renderizar_ponnderacion_componentes();
    renderizar_proyecto_avance_comp();

});

function renderizar_proyecto_avance_comp(){
    const pieChartCanvas = $('#avanceComponentesChart').get(0).getContext('2d');
    const pieOptions     = {
        maintainAspectRatio : true,
        responsive : true,
        plugins: {
          legend: {
            position: 'top',
            usePointStyle: true,
          },
          subtitle: {
            display: true,
            align : 'start',
            text: 'Valores en %',
            color: 'black',
            font: {
              size: 12,
              family: 'tahoma',
              weight: 'normal',
              style: 'italic'
            },
            padding: {
              bottom: 10
            }
          }
        }
      };
    const data_url = $('#proyecto_avance_comp').attr("data_url");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            var locations2 = [];
            var location = respuesta.data_ponderacion_comp.datasets.data;
            for (var i = 0; i < respuesta.data_ponderacion_comp.datasets.data.length; i++) {
                locations2.push(parseFloat(respuesta.data_ponderacion_comp.datasets.data[i]));

            }

            var datapondComp        = {
                labels: respuesta.data_ponderacion_comp.labels,
                datasets: [
                  {
                    label: 'Valores en porcentaje de avance',
                    data: locations2,
                    backgroundColor: respuesta.data_ponderacion_comp.datasets.backgroundColor,
                    borderColor: respuesta.data_ponderacion_comp.datasets.backgroundColor,
                    borderWidth: 1
                  }
                ]
              }
            new Chart(pieChartCanvas, {
                type: 'bar',
                data: datapondComp,
                options: pieOptions
              })
        },
        error: function () {},
    });

}

function renderizar_ponnderacion_componentes(){
    const pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    const pieOptions     = {
        maintainAspectRatio : true,
        responsive : true,
        plugins: {
          legend: {
            position: 'top',
            usePointStyle: true,
            onHover: handleHover,
            onLeave: handleLeave
          },
          subtitle: {
            display: true,
            align : 'start',
            text: 'Valores en %',
            color: 'black',
            font: {
              size: 12,
              family: 'tahoma',
              weight: 'normal',
              style: 'italic'
            },
            padding: {
              bottom: 10
            }
          }
        }
      };
    const data_url = $('#proyecto_mostrar_proyecto').attr("data_url");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (respuesta) {
            var datapondComp        = {
                labels: respuesta.data_ponderacion_comp.labels,
                datasets: [
                  {
                    data: respuesta.data_ponderacion_comp.datasets.data,
                    backgroundColor : respuesta.data_ponderacion_comp.datasets.backgroundColor,
                  }
                ]
              }
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: datapondComp,
                options: pieOptions
              })
        },
        error: function () {},
    });
}

function handleHover(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
      colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
    });
    legend.chart.update();
  }

  // Removes the alpha channel from background colors
function handleLeave(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
      colors[index] = color.length === 9 ? color.slice(0, -2) : color;
    });
    legend.chart.update();
  }
