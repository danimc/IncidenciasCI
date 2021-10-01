<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="page-content fade-in-up">

        <!-- BOTONES DE ACCION -->
        <div class="row">

            <div class="col mb-4">
                
                    <a href="">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <h2 class="text-white">Pedidos <i class="ti-file float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small>asignar documentos</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:100%; height:5px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                
            </div>

            <div class="col mb-4">
                <a href="<?= base_url() ?>ticket/lista_tickets">
                    <div class="card bg-info">
                        <div class="card-body">
                            <h2 class="text-white">Agregar <i class="ti-plus float-right"></i></h2>
                            <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Agregar documentos
                                </small></div>
                        </div>
                        <div class="progress mb-2 widget-dark-progress">
                            <div class="progress-bar" role="progressbar" style="width:100%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
            </div>

            <? $accesoUsr = $this->m_seguridad->acceso_modulo(1);
            if ($accesoUsr != 0) {
            ?>
                <div class="col mb-4">
                    <a href="<?= base_url() ?>usuario/lista_usuarios">
                        <div class="card bg-success">
                            <div class="card-body">
                                <h2 class="text-white">Historial <i class="ti-bar-chart float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> ----
                                    </small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col mb-4">
                    <a href="<?= base_url() ?>reportes">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <h2 class="text-white">Catalogos <i class="ti-book  float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small>
                                    </small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:100%; height:5px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>


            <?
            }

            $accesoActivos = $this->m_seguridad->acceso_modulo(2);
            if ($accesoActivos != 0) {
            ?>
                <!-- <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?= base_url() ?>activos/lista_activos">
                        <div class="card bg-pink">
                            <div class="card-body">
                                <h2 class="text-white">Ctrl Activos <i class="ti-desktop float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Altas y Bajas de Activos</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>-->
            <?
            }
            ?>



        </div>
        <!-- TABLAS --->
        <div class="row">
            <div class="col-xl-7">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-head">
                        <div class="ibox-title">LISTA DE PEDIDOS </div>

                    </div>
                    <div class="ibox-body">
                        <ul class="media-list media-list-divider scroller mr-2" data-height="470px">
                            <?
                            foreach ($tPendientes as $pendiente) {
                                $estatus = $this->m_inicio->etiqueta($pendiente->estatus);
                                $datetime = $pendiente->fecha_inicio . ' ' . $pendiente->hora_inicio;
                                $hora = $this->m_ticket->fecha_text($datetime);
                                $badge = '';
                                if ($pendiente->prioridad == 4) {
                                    $badge = '<small><span style="color: red"><i class="fa fa-exclamation-circle" ></i> Urgente!</span></small>';
                                }
                                if ($pendiente->prioridad == 3) {
                                    $badge = '<small><span style="color:orange"><i class="fa fa-warning" ></i> Alta!</span></small>';
                                }
                            ?>
                                <li class="media">
                                    <div class="media-body d-flex">
                                        <div class="flex-1">
                                            <h5 class="media-heading">
                                                <a href="<?= base_url() ?>ticket/seguimiento/<?= $pendiente->folio ?>">#<?= $pendiente->folio ?>:
                                                    <?= $pendiente->titulo ?> <?= $badge ?></a>
                                            </h5>
                                            <p class="font-13 text-light mb-1"><?= $pendiente->descripcion ?></p>
                                            <div class="d-flex align-items-center font-13">
                                                <img class="img-circle mr-2" src="<?= base_url() ?>src/img/usr/team.png" alt="image" width="22" />
                                                <a class="mr-2 text-success" href="javascript:;"><?= $pendiente->usuario ?></a>
                                                <span class="text-muted"><?= $hora ?></span>
                                            </div>
                                        </div>
                                        <div class="text-right" style="width:100px;">
                                            <a href="<?= base_url() ?>ticket/seguimiento/<?= $pendiente->folio ?>"><?= $estatus ?>
                                            </a>

                                        </div>
                                    </div>
                                </li>
                            <?
                            }
                            ?>


                        </ul>
                    </div>
                </div>
            </div>

            <?
            if ($usuario->id_rol == 1) {
            ?>
                <div class="col-lg-5">
                    <div class="ibox ibox-fullheight">
                        <div class="ibox-head">
                            <div class="ibox-title">DOCUMENTOS DISPONIBLES </div>
                        </div>
                        <div class="ibox-body">
                            <ul class="timeline scroller" data-height="470px">
                                <?
                                foreach ($tGeneral as $pendiente) {
                                    $estatus = $this->m_inicio->etiqueta($pendiente->estatus);
                                    $badge1 = "";
                                    if ($pendiente->prioridad == 4) {
                                        $badge1 = '<small><span style="color: red"><i class="fa fa-exclamation-circle" ></i> Urgente!</span></small>';
                                    }
                                    if ($pendiente->prioridad == 3) {
                                        $badge1 = '<small><span style="color:orange"><i class="fa fa-warning" ></i> Alta!</span></small>';
                                    }
                                ?>
                                    <li class="timeline-item">
                                        <span class="timeline-point"></span>
                                        <a href="<?= base_url() ?>ticket/seguimiento/<?= $pendiente->folio ?>">
                                            #<?= $pendiente->folio ?>: <?= $pendiente->titulo ?> <?= $badge1 ?> </a>
                                        <a><small class="float-right text-muted ml-2 nowrap">
                                                <a href="<?= base_url() ?>ticket/seguimiento/<?= $pendiente->folio ?>">
                                                    <?= $estatus ?>
                                                </a>
                                            </small>

                                    </li>
                                <?
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    <?
            } else {
    ?>

    <? } ?>
    </section>

    <script>
        function abrirNoticia() {
            $("#myModal").modal("toggle");
        }
    </script>