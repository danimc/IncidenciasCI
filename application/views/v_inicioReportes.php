<?
if ($total != 0) {
$pieResuletos   = $cerrados/$total * 100;
$pieAbiertos    = $abiertos/$total * 100;
$pieNoasig      = $noasig/$total   * 100;   
}else {
$pieResuletos   = 0;
$pieAbiertos    = 0;
$pieNoasig      = 0; 
}
       
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->

          <!-- Main content -->
    <section class="page-content fade-in-up">
      <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="100" data-bar-color="#a4daff" data-size="80" data-line-width="8">
                                <span class="easypie-data text-blue" style="font-size:32px;"><i class="la la-ticket"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-blue"><?=$total?></h3>
                                <div class="text-muted">INCIDENTES REPORTADOS</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="<?=$pieResuletos?>" data-bar-color="#006815" data-size="80" data-line-width="8">
                                <span class="easypie-data text-success" style="font-size:32px;"><i class="la la-check"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-success"><?=$cerrados?></h3>
                                <div class="text-muted">INCIDENTES RESUELTOS</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="<?=$pieAbiertos?>" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-tags"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-pink"><?=$abiertos?></h3>
                                <div class="text-muted">INCIDENTES PENDIENTES</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="<?=$pieNoasig?>" data-bar-color="#f39c12" data-size="80" data-line-width="8">
                                <span class="easypie-data text-warning" style="font-size:32px;"><i class="la la-info"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-warning"><?=$noasig?></h3>
                                <div class="text-muted">INCIDENTES SIN ASIGNAR</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

            <!-- BOTONES DE ACCION GENERAL -->
    <div class="row">
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Servicios Capturados</div>
                   <!-- <button onclick="filtrarTodo(this.value);" type="button" id="mesAnt" value="<?=date('m', strtotime('now - 1 month'))?>" class="btn btn-sm btn-rounded btn-primary"><i class="fa fa-arrow-left"></i> Filtrar Mes Anterior</button> -->
                   <!--
                   <button onclick="filtrarTodo(this.value);" type="button" id="mes" value="<?=date('m')?>" class="btn btn-sm btn-rounded btn-success"><i class="fa fa-calendar"></i> Filtrar mes actual </button>-->
                   <!--<a href="<?base_url()?>index.php/reportes/exp_tickets_excel"> <span class="badge bg-success"><i class="fa fa-file-excel-o"></i>  Descargar Reporte en Excel</span></a>-->
                </div>
                <div class="ibox-body">
                    <div>
                        <canvas id="line_chart" style="height:300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">TOP categorias Reportadas: <span id="nombre_mes">Anual</span></div>
                </div>
                <div class="ibox-body">
                    <div>
                        <canvas id="doughnut_chart" style="height:300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Servicios Capturados por dia de la semana</div>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-3-1" data-toggle="tab">Grafica</a>
                             </li>
                            <!--<li class="nav-item">
                                 <a class="nav-link" href="#tab-3-2" data-toggle="tab">Datos</a>
                             </li>-->
                            <!--<li class="nav-item">
                                <a class="nav-link" href="#tab-3-3" data-toggle="tab">Uso</a>
                            </li>-->
                         </ul>
                </div>
                <div class="ibox-body">
                     <div class="tab-content">
                         <div class="tab-pane fade show active text-center" id="tab-3-1">
                            <div>
                                <canvas id="dias" style="height:200px;">
                                </canvas>
                            </div>
                         </div>
                        <div class="tab-pane fade text-center" id="tab-3-2">
                             <table class="table table-bordered table-hover">
                                <th>DIA/ÁREA</th>
                                <th>DIRECCIÓN</th>
                                <th>SISTEMAS</th>
                                <th>COT</th>
                                <th>SOPORTE</th>
                                <th>TOTAL</th>
                                <tbody id="etiquetasCaptura"> 
                                </tbody>  
                            </table>
                        </div>
                        <div class="tab-pane fade text-center" id="tab-3-3">
                            <div class="h1 mt-5 mb-3">LECTURA</div>
                            <p class="mb-5">Dada la siguiente grafica de datos, podemos observar que el dia Lunes es cuando mas 
                            se lecantan tickets de servicio, siendo la mayor parte de estos para el area de Sistemas</p>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Servicios Resueltos por dia de la semana</div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-2-1" data-toggle="tab">Grafica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-2-2" data-toggle="tab">Datos</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#tab-2-3" data-toggle="tab">Uso</a>
                        </li>-->
                    </ul>
                </div>
                <div class="ibox-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active text-center" id="tab-2-1">
                            <div>
                                <canvas id="cerrados_dia" style="height:200px;">
                                </canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade text-center" id="tab-2-2">
                             <table class="table table-bordered table-hover">
                                <th>DIA/ÁREA</th>
                                <th>DIRECCIÓN</th>
                                <th>SISTEMAS</th>
                                <th>COT</th>
                                <th>SOPORTE</th>
                                <th>TOTAL</th>
                                <tbody id="etiquetasCerrados"> 
                                </tbody>  
                            </table>
                        </div>
                        <div class="tab-pane fade text-center" id="tab-2-3">
                            <div class="h1 mt-5 mb-3"></div>
                                <p class="mb-5"></p>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>        

<!-- TABLAS ---
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Servicios Resueltos por usuario: <span id="nombre_mes1">Anual</span></div>
                    <div>                        
                        
                    </div>
                </div>
                <div class="ibox-body">
                    <div class="flexbox mb-4">
                        <div class="flexbox"></div>
                        <div class="input-group-icon input-group-icon-left mr-3">
                            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                            <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Buscar ...">
                        </div>
                    </div>
                    <div class="table-responsive row">
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                                <div id="ingenieros"></div>
                         <!--   <?      foreach ($Sresueltos as $r) 
                                    { ?>
                                        <tr class="">
                                            <td ><img width="30px" class="user-image img-circle" src="<?=base_url()?>src/img/usr/<?=$r->img?>"></td>
                                            <td><?=$r->nombre_completo?></td>
                                            <td><?=$r->canal?></td>
                                            <td><?=$r->cuenta?></td>          
                                        </tr>
                             <?     } ?>--
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
</section>

            

 <script src="<?=base_url()?>src/js/reportes.js"></script>
  <script>
        $(function() {
            filtrar_x_mes(valor=0);
        });

    function filtrarTodo(mes)
    {
       filtro_resueltos_usuario(mes);
       pie_filtro(mes);
       filtro_abiertos_x_dia(mes);

    }

    function filtrar_x_mes(mes)
    {
        console.log(mes)
        $.ajax({
        type: "GET",
        dataType: 'json',
        url: 'index.php?/reportes/reporte_servicios_resueltos_usuarios',
          }).done(function(respuesta){
            $("#ingenieros").html(respuesta);
            $('#datatable').DataTable({
                pageLength: 10,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });
            var table = $('#datatable').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(2).search($(this).val()).draw();
            });
          })
    }

    function filtro_resueltos_usuario(mes)
    {
        dato = {mes: mes};

     console.log(mes);
     $.ajax({
        type: "POST",
        dataType: 'json',
        url: 'index.php?/reportes/reporte_servicios_resueltos_usuarios',
        data: dato,
          }).done(function(respuesta){
            $("#ingenieros").html(respuesta.div);
             $('#datatable').DataTable({
                pageLength: 10,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });
            var table = $('#datatable').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(2).search($(this).val()).draw();
            });

            $("#nombre_mes1").html(respuesta.mes);
        })
    }

    function pie_filtro(mes)
    {
        dato = {mes: mes};
        $.ajax({
        type: "POST",
        dataType: 'json',
        url: 'index.php?/reportes/reporte_asignados_areas',
        data: dato,
          }).done(function(respuesta){

        var doughnutData = {
            labels: ["Dirección","Sistemas","COT", 'Soporte Técnico' ],
            datasets: [{
                data: respuesta,
                backgroundColor: ["#3bceb6","#ff123f","#8995c7","#dfc345"]
            }]
        } ;


        var doughnutOptions = {
           // responsive: true
        };


        var ctx4 = document.getElementById("doughnut_chart").getContext("2d");
        console.log(window.pie);
            if (window.pie) {
                window.pie.clear();
                window.pie.destroy();
            }
        window.pie = new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
        })

       // $("#nombre_mes").html(respuesta.mes);
      }

    function filtro_abiertos_x_dia(mes)
    {
        dato = {mes: mes};
        $.ajax({
        type: "POST",
        dataType: 'json',
        url: 'index.php?/reportes/reporte_dias_semanas',
        data: dato,
          }).done(function(respuesta){

            etiquetasCaptura(respuesta);
        
            var barChartData = {
            labels:  respuesta.etiquetas,
            datasets: [{
                label: 'Direccion',
                backgroundColor: "#3bceb6",
                data: respuesta.direccion
            }]

        };
   
            var ctx = document.getElementById('dias').getContext('2d');
            console.log(window.myBar);
            if (window.myBar) {
                window.myBar.clear();
                window.myBar.destroy();
            }
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Grafica de captura de servicios por dia de la semana y área a la que corresponde'
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
        type: "POST",
        dataType: 'json',
        url: 'index.php?/reportes/reporte_cierre_por_dia',
        data: dato,
          }).done(function(respuesta){
             etiquetasCerrados(respuesta);
             var barChartData = {
            labels: respuesta.etiquetas,
            datasets: [{
                label: 'Direccion',
                backgroundColor: "#3bceb6",
                data: respuesta.direccion
            }, {
                label: 'Sistemas',
                backgroundColor: '#ff123f' ,
                data: respuesta.desarrollo
            }, {
                label: 'COT',
                backgroundColor:"#8995c7",
                data: respuesta.cot
            },
                {
                label: 'Soporte Técnico',
                backgroundColor:"#dfc345",
                data: respuesta.soporte
            }]

        };
   
            var ctx = document.getElementById('cerrados_dia').getContext('2d');
            window.cerrados = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Grafica de cierre de servicios por dia de la semana y área a la que corresponde'
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
    }

    </script>

    <script>
    function etiquetasCaptura(respuesta)
    {
    $("#etiquetasCaptura").val();
    i=0;
    totalDias=[];
    dias = respuesta.etiquetas;
    direccion = respuesta.direccion;
    //sistemas = respuesta.desarrollo;
    //cot = respuesta.cot;
    //soporte = respuesta.soporte;
    cdias = dias.length;
    while(i < cdias)
    {
        totalDias[i] = parseInt(direccion[i]) ;
        etiquetas ='<tr><td>'+dias[i]+'</td><td>'+direccion[i]+'</td><td class="btn-secondary"><b>'+totalDias[i]+'</b></td></tr>';
        $("#etiquetasCaptura").append(etiquetas);

        i++;
    }
    
}
    </script>

