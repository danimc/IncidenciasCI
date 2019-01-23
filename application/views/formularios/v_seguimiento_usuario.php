<?
$estatus    = $this->m_ticket->etiqueta($ticket->situacion);
$asignado   = $this->m_ticket->asignados($ticket->asignado);
$estados = $this->m_ticket->estatus();
$mensaje = '';
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
            <small>De Incidente</small>
          </h1><br>
          <ol class="breadcrumb">
            <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Tickets</li><li>Seguimiento Incidentes</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <a href="<?=base_url()?>index.php?/ticket/lista_tickets" class="btn btn-app bg-blue"><i class="fa fa-arrow-left"></i>Regresar</a>
          <? if($ticket->situacion != 5){?>
          <a href="#" data-toggle="modal" data-target="#cerrar" class="btn btn-app bg-red"><span class="fa fa-lock"></span>Cerrar Ticket</a>
          <?}else{?>
             <a disabled="true" class="btn btn-app bg-red" ><i class="fa fa-lock"></i> Cerrar Ticket</a>
          <?}?>
          <div class="row">
            <div class="col-md-12">
              <div id="mensaje"></div>
              <div class="col-md-2"></div>
               <div class="col-md-8">
                <div class="box box-success">
                  <div class="box-header with-border">                    
                    <h4 class="box-tittle"> Información del Incidente</h4>
                  </div>
                  <div class="box-body">
                    <table class="table">
                      <tr>
                        <th>Num. de Folio:</th><td><?=$ticket->folio?></td><th class="">Asignado a:
                        </th><td class=""><b><?=$ticket->asignado?></b></td>
                        </tr><tr>
                        <th>Fecha de Reporte:</th><td><?=$ticket->fecha_inicio?> a las <?=$ticket->hora_inicio?> </td>
                        <th>Fecha de Finalización:</th><td>
                            <?if(isset($ticket->fecha_cierre)){ ?>                            
                                <?=$ticket->fecha_cierre?> a las <?=$ticket->hora_cierre?>
                            <? }else{
                              echo "----";
                            }?>
                          </td>
                        </tr><tr>
                        <th>Categoría de Incidencia:</th><td> <?=$ticket->categoria?>
                        </td><th>Estatus: </th><td><?=$estatus?></td>
                        </tr><tr>
                        <th>Incidente:</th><td colspan="3"> <?=$ticket->titulo?></td>
                        </tr><tr>
                        <th style="vertical-align: middle;">Descripción: </th><td class="bg-danger" colspan="3"><?=$ticket->descripcion?></td>
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
                  <h2>Seguimiento del Ticket</h2>
                </div>
                <div class=" box-body">
              <ul class="timeline"> 
              <?php 
                $contadorfecha = '';
              foreach ($seguimiento as $time){
                if ($time->fecha != $contadorfecha ) {
                  $contadorfecha = $time->fecha;
                  $fecha = $contadorfecha;
                }
                else{
                  $fecha = 1;
                }
                    $mensaje = $this->m_ticket->timeline($time, $fecha);               
                    } ?>

                    <?=$mensaje?>
              </ul>
                <form id="seguimiento" method="POST" action="<?=base_url()?>index.php?/ticket/mensaje">
                    <textarea id="chat" required name="chat" class="form-control" placeholder="Ingrese su Mensaje"></textarea>
                    <input type="hidden" name="folio" value="<?=$ticket->folio?>">
                    <br>
                    <button type="submit" class="btn btn-success"><i class="fa fa-comment"></i> Enviar Mensaje</button>
                  </form>
                 </div>
              </div>
            
            </div>
          </div>

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <!-- #############################MODALES################################-->

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
      url: "<?=base_url()?>index.php?/ticket/asignar_usuario",
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