


 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <div class="page-heading">
                <h1 class="page-title">Registrar Nuevo Ticket de Servicio:</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index-2.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Tickets</li>
                    <li class="breadcrumb-item">Nuevo Ticket</li>
                </ol>
                <br>
    </div>

        <form enctype="multipart/form-data" role="form" action="<?base_url()?>index.php?/ticket/levantar_incidente" method="post" id="form_newsletter">
    <!-- Main content -->
 <section class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-head">
                        <div class="ibox-title">Datos del Reportante</div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">
                            <div class="form-group mb-4 ">
                                <label class="col-sm-12 col-form-label">Usuario: </label>
                                <div class="col-sm-12">
                                    <input type="hidden" name="codigo" value="<?=$usuario->codigo?>">
                                    <select class="form-control selectpicker col-sm-12" id="usrIncidente" data-live-search="true" name="usrIncidente">
                                        <option value="<?=$usuario->codigo?>" >
                                            <?=$usuario->usuario?>
                                        </option>
                                    <? foreach ($reportante as $repo) {?>
                                        <option value="<?=$repo->codigo?>">
                                            <?=$repo->usuario?>
                                        </option>
                                    <?  } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-body">
                        <div class="row">
                            <div class="form-group mb-4 col-sm-5">
                                <label class="col-sm-12 col-form-label">Descripcion del Incidente: </label>
                                <div class="col-sm-12">
                                    <input class="form-control" name="incidente" type="text" placeholder="Ej. Problema con Word ">
                                </div>
                            </div>
                            <div class="form-group mb-4 col-sm-4 ">
                                <label class="col-sm-12 col-form-label">Categoria: </label>
                                <div class="col-sm-12">
                                    <select name="categoria" id="categoria" class="form-control selectpicker" data-live-search="true">
                        <option >Seleccione una categoria</option>
                        <? foreach ($categorias as $cat) {?>
                                                    <option value="<?=$cat->id_cat?>"><?=$cat->categoria?></option>
                                              <?  }?>
                                        </select>
                            
                                </div>
                            </div>
                            <div class="form-group mb-4 col-sm-2 ">
                                <label class="col-sm-12 col-form-label">Prioridad: </label>
                                <div class="col-sm-12">
                                    <label class="radio radio-success">
                                        <input type="radio" value="1" name="prioridad">
                                        <span class="input-span"></span>Baja
                                    </label>
                                </div>
                                <div class="col-sm-12">
                                    <label class="radio radio-info">
                                        <input type="radio" value="2" name="prioridad" checked>
                                        <span class="input-span"></span>Normal
                                    </label>
                                </div>
                                <div class="col-sm-12">
                                    <label class="radio radio-warning">
                                        <input type="radio" value="3" name="prioridad">
                                        <span class="input-span"></span>Alta
                                    </label>
                                </div>
                                <div class="col-sm-12">
                                    <label class="radio radio-danger">
                                        <input type="radio" value="4" name="prioridad">
                                        <span class="input-span"></span>Urgente!
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-4 col-sm-12 ">
                                <label class="col-sm-12 col-form-label">Detalles del Incidente: </label>
                                <div class="col-sm-12">
                                    <textarea id="summernote" placeholder="Escriba aquí todos los detalles del incidente" name="descripcion" data-plugin="summernote" data-air-mode="true">
                        </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <button  id="btn" data-toggle="modal" data-target="#cerrar"  type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Generar Ticket de Servicio
                        </button>
                        </form>
                        <a class="btn btn-danger" href="/oagmvc">Cancelar</a>
                    </div>
                </div>
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

<!-- /.content-wrapper -->
    <script>
        $(function() {
            $('#summernote').summernote({
                 height: 100
            });
        });
    </script>
 

