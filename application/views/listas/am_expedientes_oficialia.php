<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Archivo Muerto
      <small>Lista de Solicitudes </small>
    </h1><br>
    <ol class="breadcrumb">
      <li><a href="/oag"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-folder"></i> Lista expedientes</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a href="/oagmvc" class="btn btn-app bg-blue"><i class="fa fa-arrow-left"></i>Regresar</a>
    <a href="<?=base_url()?>index.php?/expedientes/solicitar_expediente" class="btn btn-app bg-green"><span class="fa fa-plus"></span>Solicitar Expediente</a>
    		   
    <div id="form_newsletter_result"></div>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Solicitudes Levantadas</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive col-md-12">
         <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Dependencia</th>
              <th>Solicitó</th>
              <th># Caja</th>
              <th>Etiqueta</th>
              <th>Expediente</th>
              <th>Ubicación</th>              
              <th>Fecha Solicitud</th>
              <th>Estatus</th>
            </tr>
          </thead>
          <tbody>
           <? foreach ($expedientes as $exp) 
           {

              $dependencia = $this->m_expedientes->etiqueta_dependencia($exp->id_dependencia);           
            ?>         
            <tr onclick="location='<?=base_url()?>index.php?/expedientes/seguimiento_expediente/<?=$exp->id?>'">
              <td class="<?=$dependencia?>"><?=$exp->abreviatura?></td>
              <td ><?=$exp->usuario?></td>
              <td ><?=$exp->caja?></td>
              <td ><?=$exp->etiqueta?></td>
              <td ><?=$exp->expediente?></td>
              <td ><?=$exp->ubicacion?></td>
              <td ><?=$exp->fecha_solicitud?></td>
              <td ><?=$exp->estatus?></td> 
            </tr>
       
            <?
          }
          ?>

        </tbody>            
      </table> 
    </div>
  </div>

  </section>
</div>