
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Panel de control
      <small>Administración de Usuarios</small>
    </h1><br>
    <ol class="breadcrumb">
      <li><a href="/oag"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-users"></i> Usuarios</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a href="/oagmvc" class="btn btn-app bg-blue"><i class="fa fa-arrow-left"></i>Regresar</a>
    <a href="<?=base_url()?>index.php?/ticket/nuevo_ticket" class="btn btn-app bg-green"><span class="fa fa-user-plus"></span>Nuevo Usuario</a>
   <div id="form_newsletter_result"></div>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lista de Usuarios</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive col-md-12">
         <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>username</th>
              <th>Nombre</th>
              <th>Unidad</th>
              <th>puesto</th>
              <th>contacto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
           <? foreach ($usuario as $user) 
           {
             //$estatus = $this->m_ticket->etiqueta($user->id_situacion);
            ?>
            <tr class="">
              <td ><?=$user->codigo?></td>
              <td ><?=$user->usuario?></td>
              <td ><?=$user->nombre . ' ' . $user->apellido?></td>
              <td ><?=$user->nombre_dependencia?></td>
              <td ><?=$user->puesto?></td>
              <td align="center" ><?=$user->extension?></td>


              <td align="center">
                <a class="btn btn-xs btn-warning" href="<?=base_url()?>index.php?/usuario/perfil/<?=$user->codigo?>" title="Revisa y edita la Información del Usuario"><i class="fa fa-pencil"></i> Editar</a>
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