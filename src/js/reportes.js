$(function() {
    // Line Chart example
        $.ajax({
        type: "GET",
        dataType: 'json',
        url: 'http://148.202.169.71/incidencias/index.php/reportes/reporte_years',
          }).done(function(respuesta){

            arrays = respuesta.length
            dataset = [];
            colorFondo = [];
            colorBorde = [];
            colorPunto = [];

            colorFondo[0] = 'rgba(7,174,18,0.5)';
            colorBorde[0] = 'rgba(7,174,18,0.7)';
            colorPunto[0] = 'rgba(7,174,18,1)';

            c = 0;
            
            while(c < arrays)
            {
                meses = respuesta[c];
                year = meses.year;
                i = 1;
                valores = [];
                while(i < 13){
                    valores[i] = meses[i];
                    i++;
                }
                if (c > 0) {
                    color = getRandomRgb();
                    colorFondo[c] = color + ',0.5)';
                    colorBorde[c] = color + ',0.7)';
                    colorPunto[c] = color + ',1)';
                }
                dataset[c] = {
                        label: year,
                        backgroundColor: colorFondo[c],
                        borderColor: colorBorde[c] ,
                        pointBackgroundColor: colorPunto[c],
                        pointBorderColor: "#fff",
                        data: valores.filter(Boolean)
                };
                c++;
                    }
            var lineData = {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                datasets: dataset
            };
            var lineOptions = {
                responsive: true,
                maintainAspectRatio: false

            };
            var ctx = document.getElementById("line_chart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});                 
        })

     $.ajax({
        type: "GET",
        dataType: 'json',
        url: 'http://148.202.169.71/incidencias/index.php/reportes/reporte_asignados_areas',
          }).done(function(respuesta){

        var doughnutData = {
            labels: ["Impresoras","Bases de Datos","Correo Electronico", 'Software' ],
            datasets: [{
                data: respuesta,
                backgroundColor: ["#3bceb6","#ff123f","#8995c7","#dfc345"]
            }]
        } ;


        var doughnutOptions = {
            responsive: true
        };


        var ctx4 = document.getElementById("doughnut_chart").getContext("2d");

        window.pie = new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
        })
      

          //   GRAFICA POR DIA DE LA SEMANA EN LA QUE SE ABREN LOS TICKETS DE SERVICIO
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: 'http://148.202.169.71/incidencias/index.php/reportes/reporte_dias_semanas',
          }).done(function(respuesta){

            etiquetasCaptura(respuesta);
        
            var barChartData = {
            labels:  respuesta.etiquetas,
            datasets: [{
                label: 'Servicios Abiertos',
                backgroundColor: "#3bceb6",
                data: respuesta.direccion
            }]

        };
   
            var ctx = document.getElementById('dias').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Grafica de captura de servicios por dia de la semana'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });   
    })
    /* FINAL DE GRAFICA
    INICIO DE GRAFICA DE TICKETS CERRADOS POR DIA
    */

        $.ajax({
        type: "GET",
        dataType: 'json',
        url: 'http://148.202.169.71/incidencias/index.php/reportes/reporte_cierre_por_dia',
          }).done(function(respuesta){
             etiquetasCerrados(respuesta);
             var barChartData = {
            labels: respuesta.etiquetas,
            datasets: [{
                label: 'Servicios Cerrados',
                backgroundColor: "#3bceb6",
                data: respuesta.direccion
            }]

        };
   
            var ctx = document.getElementById('cerrados_dia').getContext('2d');
            window.cerrados = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Grafica de cierre de servicios por dia de la semana '
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });   
    })



   

    /* Polar area example

    var polarData = {
        datasets: [{
            data: [
                300,130,180
            ],
            backgroundColor: [
                "#3bceb6", "#bdc3c7", "#8995c7"
            ],
            label: [
                "My Radar chart"
            ]
        }],
        labels: [
            "App","Software","Laptop"
        ]
    };

    var polarOptions = {
        segmentStrokeWidth: 2,
        responsive: true

    };

    var ctx3 = document.getElementById("polar_chart").getContext("2d");
    new Chart(ctx3, {type: 'polarArea', data: polarData, options:polarOptions});



    // Radar chart example

    var radarData = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: "rgba(189,195,199,0.2)",
                borderColor: "rgba(189,195,199,1)",
                data: [60, 75, 80, 81, 40, 65, 45]
            },
            {
                label: "My Second dataset",
                backgroundColor: "rgba(24,197,169,0.2)",
                borderColor: "rgba(24,197,169,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    var radarOptions = {
        responsive: true
    };

    var ctx5 = document.getElementById("radar_chart").getContext("2d");
    new Chart(ctx5, {type: 'radar', data: radarData, options:radarOptions});
    */

});

function getRandomRgb() {
  var num = Math.round(0xffffff * Math.random());
  var r = num >> 16;
  var g = num >> 8 & 255;
  var b = num & 255;
  return 'rgba(' + r + ', ' + g + ', ' + b;
}

function etiquetasCaptura(respuesta)
{

    i=0;
    totalDias=[];
    dias = respuesta.etiquetas;
    direccion = respuesta.direccion;
   // sistemas = respuesta.desarrollo;
   // cot = respuesta.cot;
   // soporte = respuesta.soporte;
    cdias = dias.length;
    while(i < cdias)
    {
        totalDias[i] = parseInt(direccion[i]);
        etiquetas ='<tr><td>'+dias[i]+'</td><td>'+direccion[i]+'</td><td class="btn-secondary"><b>'+totalDias[i]+'</b></td></tr>';
        $("#etiquetasCaptura").append(etiquetas);

        i++;
    }
    
}

function etiquetasCerrados(respuesta)
{
    i=0;
    totalDias=[];
    dias = respuesta.etiquetas;
    direccion = respuesta.direccion;
    
    cdias = dias.length;
    while(i < cdias)
    {
        totalDias[i] = parseInt(direccion[i]) ;
        etiquetas ='<tr><td>'+dias[i]+'</td><td>'+direccion[i]+'</td><td class="btn-secondary"><b>'+totalDias[i]+'</b></td></tr>';
        $("#etiquetasCerrados").append(etiquetas);

        i++;
    }
    
}
