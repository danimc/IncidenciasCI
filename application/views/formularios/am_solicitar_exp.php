
<script>
     function desactiva_enlace(enlace)
  {
      var button = "<i class='fa fa-spinner fa-pulse fa-fw'></i> Generando Ticket de Servicio...";
      enlace.disabled='disabled';
      enlace.innerHTML = button;
  }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Solicitar Expediente
            <small>Archivo Muerto</small>
        </h1><br>
        <ol class="breadcrumb">
            <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Solicitar Expediente</li>
        </ol>
    </section>

        <form enctype="multipart/form-data" role="form" action="<?base_url()?>index.php?/expedientes/realizar_solicitud" method="post" id="form_newsletter">
    <!-- Main content -->
    <section class="content">
        
            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-tittle"> Detalles del Expediente </h3>
                    </div>
                    
                    <div class="box-body"> 
                       <input type="hidden" id="codigo" name="codigo" value="<?=$solicitante?>">
                       <input type="hidden"  name="dependencia" value="<?=$dependencia?>">
                        <div class="form-group col-md-3 ">
                            <h4><strong><i class="fa fa-vcard margin-r-5"></i># de Caja: </strong></h4>
                             <input type="text" class="form-control" name="caja">
                        </div>
                        <div class="form-group col-md-3 ">
                             <h4><strong><i class="fa fa-vcard margin-r-5"></i>Etiqueta: </strong></h4>
                             <input type="text" class="form-control" name="etiqueta">
                        </div>
                         <div class="form-group col-md-6 ">
                             <h4><strong><i class="fa fa-vcard margin-r-5"></i>Ubicación: </strong></h4>
                             <select class="form-control" name="ubicacion">
                                 <option disabled value="0">Seleccione la ubicacion del Exp.</option>
                                 <? 
                                 foreach ($ubicaciones as $ubicacion) {?>
                                     <option value="<?=$ubicacion->id?>"><?=$ubicacion->nombre?></option>
                                <? }?>
                             </select>
                             
                        </div>
                          <div class="form-group col-md-12 ">
                             <h4><strong><i class="fa fa-vcard margin-r-5"></i>Expediente: </strong></h4>
                             <input type="text" class="form-control" size="3" name="expediente">
                        </div>
                          <div class="form-group col-md-12 ">
                             <h4><strong><i class="fa fa-vcard margin-r-5"></i>Observaciones: </strong></h4>
                             <textarea class="form-control" size="2" name="notas" placeholder="Ingrese las observaciones correspondientes">                                 
                             </textarea>
                        </div>
                        <button class="btn btn-info" type="submit" onclick="desactiva_enlace(this)">
                            <i class="fa fa-check"></i> Solicitar Expediente
                        </button>
                        <a class="btn btn-danger" href="<?=base_url()?>index.php?/expedientes/archivo_muerto_usr">
                            <i class="fa"></i> Cancelar
                        </a>
                    </div>
                </div>
            </div>
         

                    
                    </section>
                </form>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
 