 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header">
            <h1>
              Panel de control
              <small>Pagina principal</small>
            </h1><br>
              <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              </ol>
    </section>

          <!-- Main content -->
    <section class="content">
            <a href="<?=base_url()?>index.php?/ticket/nuevo_ticket">
              <div class="col-md-3 col-sm-6 col-xs-12">           
                <div class="info-box bg-orange-active">
                  <span class="info-box-icon"><i class="fa fa-ticket"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">Nuevo Ticket</span>
                    <!-- The progress section is optional -->
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      Reporte un nuevo Incidente
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
            </a>

            <a href="<?=base_url()?>index.php?/ticket/lista_tickets">
              <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box bg-yellow">
                  <span class="info-box-icon"><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">
                      Mis Tickets                       
                    </span>
                    <!-- The progress section is optional -->
                    <div title="porcentaje de tickets cerrados" class="progress">
                      <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                      Revise todos los Tickets
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
            </a>
            <? $accesoUsr = $this->m_seguridad->acceso_modulo(1);
                if($accesoUsr != 0){
                  ?>
                
              <a href="<?=base_url()?>index.php?/usuario/lista_usuarios">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Control de Usuarios</span>
                        <!-- The progress section is optional -->
                        <div title="porcentaje de tickets cerrados" class="progress">
                          <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                          Altas y bajas de Usuarios
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                 </div>
                 </a>
                  <?}

                  $accesoActivos = $this->m_seguridad->acceso_modulo(2);
                  if ($accesoActivos != 0) {
                    ?>
                  
                 <a href="menuActivos">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      
                    <div class="info-box bg-red">
                      <span class="info-box-icon"><i class="fa fa-barcode"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Activos</span>
                        <!-- The progress section is optional -->
                        <div title="porcentaje de tickets cerrados" class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                          Gestion de activos 
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                 </div>
                 </a>
                 <?
               }?>

<a href="<?=base_url()?>src/formatos/formato56.xls">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      
                    <div class="info-box bg-red">
                      <span class="info-box-icon"><i class="fa fa-file-excel-o"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Descargar Formato</span>
                        <!-- The progress section is optional -->
                        <div title="porcentaje de tickets cerrados" class="progress">
                          <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                          Descarga el formato 5.6
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                 </div>
                 </a>


        <div class="col-md-6 col-sm-6 col-xs-12 ">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Mis Tickets Pendientes</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
               <div class="table-responsive col-md-12">
              <table class="table table-bordered responsive">
                <tbody><tr>
                  <th ># Folio</th>
                  <th>Incidencia</th>
                  <th>Solicitante</th>
                  <th >Estado</th>
                </tr>   

                <? foreach ($tPendientes as $pendiente) {
                   $estatus = $this->m_inicio->etiqueta($pendiente->estatus); ?>
           
              <tr  data-toggle="tooltip" data-placement="right"  title= "Solicitado desde:  ">

                  <td width="70px"><?=$pendiente->folio?></td>
                  <td><?=$pendiente->titulo?></td>
                  <td align="center"><?=$pendiente->usuario?></td>                
                  <td width="150px" align="center"><a href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$pendiente->folio?>"><span class="badge bg-red"><?=$pendiente->situacion?></span></a></td> 
                </tr>  
                <?}?>
              </tbody></table>
            </div>
            </div>

            <!-- /.box-body -->
         
          </div>
        </div>

                <div class="col-md-6 col-sm-6 col-xs-12 ">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tickes Abiertos</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
               <div class="table-responsive col-md-12">
              <table class="table table-bordered responsive">
                <tbody><tr>
                  <th ># Folio</th>
                  <th>Incidencia</th>
                  <th >Estado</th>
                </tr>   

                <? foreach ($tGeneral as $pendiente) {
                   $estatus = $this->m_inicio->etiqueta($pendiente->estatus); ?>
           
              <tr  data-toggle="tooltip" data-placement="right"  title= "Solicitado desde:  ">

                  <td width="70px"><?=$pendiente->folio?></td>
                  <td><?=$pendiente->titulo?></td>          
                  <td width="150px" align="center"><a href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$pendiente->folio?>"><span class="badge bg-red"><?=$pendiente->situacion?></span></a></td> 
                </tr>  
                <?}?>
              </tbody></table>
            </div>
            </div>

            <!-- /.box-body -->
         
          </div>
        </div>
          

          </section>
        </div>


