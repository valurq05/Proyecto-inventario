
function inicializarGraficoBarras(TiendasCantidadProChart, datos){

    console.log(datos);

    var ctx = document.getElementById(TiendasCantidadProChart).getContext('2d');

    var myChart = new Chart(ctx,{
        type: 'bar',
        data: {
            labels: datos.map(entry => entry.pro_nombre),
            datasets: [{
                label: "Cantidad producto en tienda",
                data: datos.map(entry => entry.total_cantidad),
                backgroundColor: ["rgba(113, 8, 40, 0.55)", "rgba(127, 17, 224, 1)", "rgba(67, 220, 100, 1)", "rgba(50, 130, 240, 1)", "rgba(240, 180, 10, 1)", "rgba(10, 125, 10, 1)"],
                borderColor: 'rgba(75,192,192,1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }

    });
}


function inicializarGraficoTorta(productoVentasChart, datos){

    console.log(datos);

    var ctx = document.getElementById(productoVentasChart).getContext('2d');

    var myChart = new Chart(ctx,{
        type: 'bar',
        data: {
            labels: datos.map(entry => entry.ven_fecha),
            datasets: [{
                label: "Ventas últimos 5 dias",
                data: datos.map(entry => entry.totalDiario),
                backgroundColor: ["rgba(113, 8, 40, 0.55)", "rgba(127, 17, 224, 1)", "rgba(67, 220, 100, 1)", "rgba(50, 130, 240, 1)", "rgba(240, 180, 10, 1)", "rgba(10, 125, 10, 1)"],
                borderColor: 'rgba(75,192,192,1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }

    });
}

function inicializarGraficoBarraCompras(productoComprasChart, datos){

    console.log(datos);

    var ctx = document.getElementById(productoComprasChart).getContext('2d');

    var myChart = new Chart(ctx,{
        type: 'pie',
        data: {
            labels: datos.map(entry => entry.pro_nombre),
            datasets: [{
                label: "Cantidad Comprada por producto",
                data: datos.map(entry => entry.total_cantidad),
                backgroundColor: ["rgba(113, 8, 40, 0.55)", "rgba(127, 17, 224, 1)", "rgba(67, 220, 100, 1)", "rgba(50, 130, 240, 1)", "rgba(240, 180, 10, 1)", "rgba(10, 125, 10, 1)"],
                borderColor: 'rgba(75,192,192,1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }

    });
}
