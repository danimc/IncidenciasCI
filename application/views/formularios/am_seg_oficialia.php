<?
$fecha_solicitud = $this->m_ticket->fecha_text($exp->fecha_solicitud);
$mensaje = '';
$asignado   = $this->m_ticket->asignados($exp->asignado);
?>

<script>
     function desactiva_enlace(enlace)
  {
      var button = "<i class='fa fa-spinner fa-pulse fa-fw'></i> Cerrando...";
      enlace.disabled='disabled';
      document.getElementById('btn2').disabled=true;
      enlace.innerHTML = button;
  }
</script>
<div class="content-wrapper">
    <div id="mensaje"></div>
<section class="content-header">
        <h1>Seguimiento
            <small>De Expediente</small>
          </h1><br>
          <ol class="breadcrumb">
            <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Archivo Muerto</li><li>Seguimiento Expedientes</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <a href="<?=base_url()?>index.php?/expedientes/archivo_muerto_oficialia" class="btn btn-app bg-blue"><i class="fa fa-arrow-left"></i>Regresar</a>
          <div class="row">
            <div class="col-md-12">
              <div id="mensaje"></div>
              <div class="col-md-4">
                <div class="box box-primary">
                  <div class="box-header with-border">                    
                    <h4 class="box-tittle"> Datos del solicitante</h4>
                  </div>
                  <div class="box-body">
                    <strong><i class="fa fa-user margin-r-5"></i> Usuario: </strong> <?=$exp->usuario ?>
                    <hr>
                    <!--  <h4><strong><i class="fa fa-user margin-r-5"></i> Username:</strong> <?=$username?></h4>
<hr> -->
                    <strong><i class="fa fa-legal margin-r-5"></i> Dependencia:</strong> <?=$exp->nombre_dependencia?>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i>Extension:</strong> <?=$exp->extension?>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Correo: </strong><a href='mailto:<?=$exp->correo?>'><?=$exp->correo?>
                    </a>
                  </div>
                </div>  
              </div>
             <!--Fin de la carta de datos del solicitante-->

              <div class="col-md-8 ">
                <div class="box box-success">
                  <div class="box-header with-border">                    
                    <h4 class="box-tittle"> Información de la Solicitud</h4>
                  </div>
                  <div class="box-body">
                    <table class="table">
                      <tr>
                        <th>Num. de Solicitud:</th><td><?=$exp->id?></td><th class="">Asignado a:
                        </th><td class=""><b><?=$exp->asignado?> <?=$asignado?></b></td>
                        </tr><tr>
                        <th>Fecha de solicitud:</th><td><?=$fecha_solicitud?> </td>
                        <th>Fecha de Finalización:</th><td>
                            <?if(isset($exp->fecha_cierre)){ ?>                            
                                <?=$exp->fecha_cierre?> a las <?=$exp->hora_cierre?>
                            <? }else{
                              echo "----";
                            }?>
                          </td>
                        </tr><tr>
                        </td><th>Estatus: </th><td><?=$estatus?></td>
                        <th>Ubicación de Exp.:</th><td> <?=$exp->ubicacion?>
                        
                        </tr><tr>
                        <th># de Caja:</th><td> <?=$exp->caja?></td>
                        <th>Etiqueta:</th><td> <?=$exp->etiqueta?></td>
                        </tr><tr>
                        <th style="vertical-align: middle;">Expediente: </th><td class="bg-danger" colspan="3"><?=$exp->expediente?></td>
                        </tr><tr>
                        <th style="vertical-align: middle;">Notas: </th><td class="" colspan="3"><b><?=$exp->notas?></b></td>
                        </tr>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="row">

            </div>
            <div class="col-md-1"></div>
            <div class="col-md-10" >
              <div class="box box-danger">
                <div class="box-tittle" align="center">
                  <h2>Seguimiento de la Solicitud</h2>
                </div>
                <div class=" box-body">
              <ul class="timeline"> <?php 

              foreach ($historial as $time){
                    $mensaje = $this->m_expedientes->timeline($time);               
                    } ?>

                    <?=$mensaje?>
              </ul>
              </div>
          </div>

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <!-- #############################MODALES################################-->

<!-------MODAL PARA CAMBIAR AL USUARIO ASIGNADO---->
<form id="frmAsignarUsr">
     <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asignar a un Responsable</h4>
            </div>
            <div class="modal-body">
              <p>Asigne a un responsable que se hará cargo de resolver esta solicitud.</p>
                <select name="responsable" class="form-control">
                  <option disabled>Elegir a un Responsable de la lista</option>
                  <?
                  foreach ($asignados as $usuario) {?>
                    <option value="<?=$usuario->codigo?>"><?=$usuario->usuario?></option>
                           <?}?>         
                </select>
                <input type="hidden" name="folio" value="<?=$exp->id?>">
                <input type="hidden" name="antAsignado" value="<?=$exp->asignado?>">
                </div>
              <div class="modal-footer">
                <button type="button" id="asignarUsr"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
          </div>
        </div>
      </div>
</form>

 <!-------MODAL PARA CAMBIAR EL ESTATUS A RECIBIDO---->
<form id="frmStatus">
     <div class="modal fade" id="modalRecibido" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-maroon">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Marcar como Entregado </h4>
            </div>
            <div class="modal-body">
              <p>Marque como entregado el expediente.</p>

                <input type="checkbox" name="solicitante">
                <label>El expediente fue Entregado al Solicitante</label>
                <select disabled  name="estado" class="form-control">
                  <option >Seleccione quien recibió el Expediente</option>
                  <?
                  foreach ($usuarios as $usr) {?>
                    <option value="<?=$usr->codigo?>"><?=$usr->usuario?></option>
                           <?}?>         
                </select>
                <input type="hidden" name="folio" value="<?=$exp->id?>">            
                </div>
              <div class="modal-footer">
                <button type="button" id="recibido"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
          </div>
        </div>
      </div>
</form>

<!-------MODAL PARA CAMBIAR CERRAR EL TICKET---->
<form id="frmCerrar" action="<?=base_url()?>index.php?/ticket/cerrar_ticket" method="POST">
      <div class="modal fade" id="cerrar" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title " align="center">Cerrar Ticket de Servicio</h4>
            </div>
            <div class="modal-body">
              <div class="icon" align="center">
                <img src="<?=base_url()?>src/img/advertencia.png">
              </div>
              <h3 align="center">ATENCION!</h3>
              <h4 align="center">Esta a punto de cerrar un ticket de servicio.</h4>
                <br> <small>Al cerrar un ticket de servicio se da por terminado el incidente y termina la atencion al mismo. ¿Esta seguro de 
                querer continuar?  </small>
        
                <input type="hidden" name="folio" value="<?=$ticket->folio?>">
                </div>
              <div class="modal-footer">
                <button type="submit" onclick="desactiva_enlace(this)" class="btn btn-success pull-left" data-dismiss="modal">Cerrar Ticket <i class="fa fa-check"></i></button>
                <button type="button" id="btn2" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-close"></i></button>
                  </div>
          </div>
        </div>
      </div>
</form>




<script type="text/javascript">
  $(document).ready(function(){
  $("#asignarUsr").click(function(){
    var formulario = $("#frmAsignarUsr").serializeArray();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: "<?=base_url()?>index.php?/expedientes/asignar_usuario",
      data: formulario,
    }).done(function(respuesta){
       $("#mensaje").html(respuesta);
        setTimeout('document.location.reload()',1000);
     
    });
   }); 

     $("#cambiarCat").click(function(){
    var formulario = $("#frmCategoria").serializeArray();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: "<?=base_url()?>index.php?/ticket/cambiar_categoria",
      data: formulario,
    }).done(function(respuesta){
       $("#mensaje").html(respuesta.mensaje);
       if (respuesta.id == 1) {

        setTimeout('document.location.reload()',1000);
       }     
    });
   });

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

        setTimeout('document.location.reload()',1000);
       }     
    });
   });
  });

 

</script>
    <script src="<?=base_url()?>src/js/wys.js"></script>

  <script type="text/javascript">
    $('#chat').wysihtml5();
  </script>