<?
$estatus    = $this->m_ticket->etiqueta($ticket->situacion);
$asignado   = $this->m_ticket->asignados($ticket->asignado);
$estados = $this->m_ticket->estatus();
?>
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
          <div class="row">
            <div class="col-md-12">
              <div id="mensaje"></div>
              <div class="col-md-4">
                <div class="box box-primary">
                  <div class="box-header with-border">                    
                    <h4 class="box-tittle"> Datos del solicitante</h4>
                  </div>
                  <div class="box-body">
                    <strong><i class="fa fa-user margin-r-5"></i> Usuario: </strong> <?=$ticket->usuario ?>
                    <hr>
                    <!--  <h4><strong><i class="fa fa-user margin-r-5"></i> Username:</strong> <?=$username?></h4>
<hr> -->
                    <strong><i class="fa fa-legal margin-r-5"></i> Dependencia:</strong> <?=$ticket->nombre_dependencia?>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i>Extension:</strong> <?=$ticket->extension?>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Correo: </strong><a href='mailto:<?=$ticket->correo?>'><?=$ticket->correo?>
                    </a>
                  </div>
                </div>  
              </div>
             <!--Fin de la carta de datos del solicitante-->

              <div class="col-md-8 ">
                <div class="box box-success">
                  <div class="box-header with-border">                    
                    <h4 class="box-tittle"> Información del Incidente</h4>
                  </div>
                  <div class="box-body table-responsive">
                    <table class="table">
                      <tr>
                        <th>Num. de Folio:</th><td><?=$ticket->folio?></td><th class="">Asignado a:
                        </th><td class=""><b><?=$ticket->asignado?> <?=$asignado?></b></td>
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
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modalCategoria" title="Cambiar Categoría"><i class="fa fa-get-pocket "></i> </button> 
                          
               

                        </td><th>Estatus: </th><td><?=$estatus?></td>
                        </tr><tr>
                        <th>Incidente:</th><td colspan="3"> <?=$ticket->titulo?></td>
                        </tr><tr>
                        <th style="vertical-align: middle;">Descripción: </th><td class="bg-red" colspan="3"><?=$ticket->descripcion?></td>
                        </tr>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="col-md-12">
                <ul class="timeline">

                </ul>
                <div class="box box-body">
                  <form id="seguimiento" method="POST" action="acciones/funcionesTickets">
                    <textarea id="chat" name="chat" class="form-control" placeholder="Ingrese su Mensaje"></textarea>
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

<!-------MODAL PARA CAMBIAR AL USUARIO ASIGNADO---->
<form id="frmAsignarUsr">
     <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asignar a un Ingeniero</h4>
            </div>
            <div class="modal-body">
              <p>Asigne a un ingeniero que se hará cargo de este incidente y llevara el seguimiento del mismo.</p>
                <select name="ingeniero" class="form-control">
                  <option>Elegir a un Ingeniero de la lista</option>
                  <?
                  foreach ($asignados as $usuario) {?>
                    <option value="<?=$usuario->codigo?>"><?=$usuario->usuario?></option>
                           <?}?>         
                </select>
                <input type="hidden" name="folio" value="<?=$ticket->folio?>">
                <input type="hidden" name="antAsignado" value="<?=$ticket->asignado?>">
                </div>
              <div class="modal-footer">
                <button type="button" id="asignarUsr"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
          </div>
        </div>
      </div>
</form>

<!-------MODAL PARA CAMBIAR LA CATEGORIA---->
<form id="frmCategoria">
     <div class="modal fade" id="modalCategoria" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-blue">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cambiar Categoria </h4>
            </div>
            <div class="modal-body">
              <p>Cambie la categoría del Incidente si no corresponde al reporte registrado de este Ticket de servicio.</p>
                <select name="categoria" class="form-control">
                  <option>Selecciones una Categoría Valida</option>
                  <?
                  foreach ($categorias as $categoria) {?>
                    <option value="<?=$categoria->id_cat?>"><?=$categoria->categoria?></option>
                           <?}?>         
                </select>
                <input type="hidden" name="folio" value="<?=$ticket->folio?>">
                <input type="hidden" name="antCategoria" value="<?=$ticket->id_categoria?>">
                </div>
              <div class="modal-footer">
                <button type="button" id="cambiarCat"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
          </div>
        </div>
      </div>
</form>
 
 <!-------MODAL PARA CAMBIAR EL ESTATUS---->
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
                <select name="categoria" class="form-control">
                  <option>Seleccione el estatus del ticket</option>
                  <?
                  foreach ($estados as $estado) {?>
                    <option value="<?=$estado->id?>"><?=$estado->situacion?></option>
                           <?}?>         
                </select>
                <input type="hidden" name="folio" value="<?=$ticket->folio?>">
                <input type="hidden" name="antStatus" value="<?=$ticket->situacion?>">
                </div>
              <div class="modal-footer">
                <button type="button" id="cambiarCat"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
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

  });
</script>