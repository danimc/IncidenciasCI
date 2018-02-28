<?

?>

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
    <a href="/oagmvc" class="btn btn-app bg-blue"><i class="fa fa-arrow-left"></i>Regresar</a>
    <a href="<?=base_url()?>index.php?/ticket/nuevo_ticket" class="btn btn-app bg-green"><span class="fa fa-plus"></span>Nuevo Ticket</a>
    <a href="menuTickets?asignado=true" class="btn btn-app bg-orange"><span class="fa fa-search"></span>Mis Asignados</a>			   
    <div id="form_newsletter_result"></div>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lista de Tickets</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive col-md-12">
         <table id="example1" class="table table-bordered table-hover">
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
            $estatus = $this->m_ticket->etiqueta($ticket->id_situacion);
            ?>
            <tr class="">
              <td ><?=$ticket->folio?></td>
              <td  data-toggle = "tooltip" title="Hora de reporte: <?=$ticket->hora_inicio?>"><?=$fecha?></td>
              <td data-toggle="tooltip"><?=$estatus?></td>
              <td ><?=$ticket->usuario?></td>
              <td ><?=$ticket->titulo?></td>
              <td ><?=$ticket->categoria?></td>


              <td width="10" align="center"><a class="btn btn-info" href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$ticket->folio?>" title="Información y seguimiento del Ticket de servicio"><i class="fa fa-info-circle"></i> información</a>
              </td>
            </tr>
            <?
          }
          ?>

        </tbody>            
      </table> 
    </div>
  </div>
</div>
  </section>





        <!-- /.