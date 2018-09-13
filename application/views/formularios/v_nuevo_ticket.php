


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Nuevo
            <small>Ticket de Servicio</small>
        </h1><br>
        <ol class="breadcrumb">
            <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Nuevo Ticket</li>
        </ol>
    </section>

        <form enctype="multipart/form-data" role="form" action="<?base_url()?>index.php?/ticket/levantar_incidente" method="post" id="form_newsletter">
    <!-- Main content -->
    <section class="content">
        
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-tittle"> Detalles del Reportante </h3>
                    </div>
                    <div class="box-body">    
                        <input type="hidden" id="codigo" name="codigo" value="<?=$usuario->usuario ?>">
                            <div class="form-group ">
                                <h4><strong><i class="fa fa-vcard margin-r-5"></i>¿Que usuario presenta el incidente?: </strong></h4>
                            </div>

                            <div class="form-group col-md-12">
                                <select class="form-control selectpicker" id="usrIncidente" data-live-search="true" name="usrIncidente">
                                    <option value="<?=$usuario->codigo?>" >
                                        <?=$usuario->usuario?>
                                    </option>
                                <? foreach ($reportante as $repo) {?>
                                    <option value="<?=$repo->codigo?>">
                                        <?=$repo->usuario?>
                                    </option>
                                              <?  }?>
                                 </select>
                            </div>
                        </div>
                    </div>
                </div>
         

            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-tittle"> </h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <h4><i class="fa fa-box"></i>Descripcion corta del Incidente</h4>
                            <input required="" class="form-control" type="text" name="incidente" id="incidente" onchange="activar_envio()" placeholder="Ejemplo: mi pc no enciende">
                        </div>
                        <div class="form-group col-md-4">
                            <h4><i class="fa fa-box"></i>Categoria: </h4>
                            <select name="categoria" id="categoria" class="form-control selectpicker" data-live-search="true">
                        <option >Seleccione una categoria</option>
                        <? foreach ($categorias as $cat) {?>
                                                    <option value="<?=$cat->id_cat?>"><?=$cat->categoria?></option>
                                              <?  }?>
                                        </select>
                            <help>Si no esta seguro de a que categoria pertenece su incidente, seleccione <b> "Otro..."</b></help>
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="box-header">
                        <h3 class="box-title">Detalles del Incidente</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <textarea onchange="activar_envio()" required="true" class="textarea" id="chat" name="descripcion" placeholder="Escriba aquí todos los detalles del incidente" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        <div class="form-group">
                            <button  id="btn" data-toggle="modal" data-target="#cerrar"  type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    Generar Ticket de Servicio</button>
                            </form>
                            <a class="btn btn-danger" href="/oagmvc">Cancelar</a>
                            
                        </div>

</section>


 <div class="modal fade" id="cerrar" role="dialog">
        <div class="modal-dialog col-md">
          <div class="modal-content">
            <div class="modal-body">
              <div class="icon" align="center">
                <i class="fa fa-spinner fa-spin" style="font-size:80px;"></i>
              </div>  

              <h4 align="center">Generando Ticket de Servicio...</h4>
              </div>
            
          </div>
        </div>
      </div>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
 

