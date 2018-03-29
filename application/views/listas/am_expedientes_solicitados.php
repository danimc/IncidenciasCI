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
        <h3 class="box-title">Histórico de Solicitudes</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive col-md-12">
         <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th># Caja</th>
              <th>Etiqueta</th>
              <th>Expediente</th>
              <th>Ubicación</th>
              <th>Solicitó</th>
              <th>Fecha Solicitud</th>
              <th>Estatus</th></tr>
          </thead>
          <tbody>
           <? foreach ($expedientes as $exp) 
           {
            
            ?>
            <tr class="">
              <td ><?=$exp->caja?></td>
              <td ><?=$exp->etiqueta?></td>
              <td ><?=$exp->expediente?></td>
              <td ><?=$exp->ubicacion?></td>
              <td ><?=$exp->usuario?></td>
              <td ><?=$exp->fecha_solicitud?>
              <td ><?=$exp->estatus?></td>              
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


<!-------MODAL PARA CAMBIAR EL ESTATUS---->
<!--
<form id="frmStatus">
     <div class="modal fade" id="modalStatus" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-maroon">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cambiar Status </h4>
            </div>
            <div class="modal-body">
              <p>Cambie el estatus actual del ticket de servicio.</p>
                <select name="estado" class="form-control">
                  <option disabled>Seleccione el estatus del ticket</option>
                  <?
                  foreach ($estados as $estado) {?>
                    <option value="<?=$estado->id?>"><?=$estado->situacion?></option>
                           <?}?>         
                </select>
                <input type="hidden" name="folio" value="<?=$ticket->folio?>">
                <input type="hidden" name="antStatus" value="<?=$ticket->situacion?>">
                </div>
              <div class="modal-footer">
                <button type="button" id="cambiarStatus"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
          </div>
        </div>
      </div>
</form>


 BLOQUEADO HASTA REPARAR ERROR EN EL FORMULARIO
<script type="text/javascript">
  $("#cambiarStatus").click(function(){
    var formulario = $("#frmStatus").serializeArray();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: "<?=base_url()?>index.php?/ticket/cambiar_estatus",
      data: formulario,
    }).done(function(respuesta){
       $("#mensaje").html(respuesta.mensaje);
       if (respuesta.id == 1) {

       // setTimeout('document.location.reload()',1000);
       }     
    });
   });
  </script> -->

        <!-- /.