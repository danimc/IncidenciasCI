<?
    $tickets = $this->m_ticket->tabla_admon();
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
       <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Panel de control
                    <small>Listado de Tickets</small>
                </h1><br>
                <ol class="breadcrumb">
                    <li><a href="/oag"><i class="fa fa-dashboard"></i> Home</a></li>
                     <li><a href="#"><i class="fa fa-ticket"></i> Tickets</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <a href="/oag" class="btn btn-app bg-blue"><i class="fa fa-arrow-left"></i>Regresar</a>
				<a href="formNuevoticket" class="btn btn-app bg-green"><span class="fa fa-plus"></span>Nuevo Ticket</a>
        <a href="menuTickets?asignado=true" class="btn btn-app bg-orange"><span class="fa fa-search"></span>Mis Asignados</a>			   
        <div id="form_newsletter_result"></div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de Tickets</h3>
            </div>
            <!-- /.box-header -->

    <div class="table-responsive col-md-12">
   <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha de Reporte</th>
                  <th>Estatus</th>
                  <th>Usuario</th>
                  <th>Incidente</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
        
                </tr>
                </thead>
                <tbody>
             <? foreach ($tickets as $ticket) 
             {
                $fecha = $this->m_ticket->fecha_text_f($ticket->fecha_inicio);
              ?>
                <tr class="">
                  <td ><?=$ticket->folio?></td>
                  <td  data-toggle = "tooltip" title="Hora de reporte: <?=$ticket->hora_inicio?>"><?=$fecha?></td>
                  <td data-toggle="tooltip">
                  <?=$ticket->situacion?>
                  </td>
                  <td ><?=$ticket->usuario?></td>
                  <td ><?=$ticket->titulo?></td>
                  <td ><?=$ticket->categoria?></td>
        
          
                  <td width="10" align="center"><a class="btn btn-info" href="seguimiento?folio=" title="Información y seguimiento del Ticket de servicio"><i class="fa fa-info-circle"></i> info</a>
          </td>


            
 
                </tr>
                  <?
                }
                ?>
           
               </tbody>            
              </table>

 
  </div>

            <div class="box-body ">
          
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        
			</section>
			
			
         
        </div>
        <!-- /.