<?
$pieResuletos = $cerrados/$total * 100;
$pieAbiertos = $abiertos/$total * 100;
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->

          <!-- Main content -->
    <section class="page-content fade-in-up">
    <? if( $usuario->id_rol == 1 )  {
    ?> 
    
      <div class="row mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="100" data-bar-color="#a4daff" data-size="80" data-line-width="8">
                                <span class="easypie-data text-blue" style="font-size:32px;"><i class="la la-ticket"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-blue"><?=$total?></h3>
                                <div class="text-muted">INCIDENTES REPORTADOS</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="<?=$pieResuletos?>" data-bar-color="#006815" data-size="80" data-line-width="8">
                                <span class="easypie-data text-success" style="font-size:32px;"><i class="la la-check"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-success"><?=$cerrados?></h3>
                                <div class="text-muted">INCIDENTES RESUELTOS</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="<?=$pieAbiertos?>" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-tags"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-pink"><?=$abiertos?></h3>
                                <div class="text-muted">TICKETS PENDIENTES</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
         <?
               }
         ?>
<!-- BOTONES DE ACCION -->
    <div class="row">
        
                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/ticket/nuevo_ticket">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <h2 class="text-white">Nuevo Ticket <i class="ti-ticket float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small>Reporte un nuevo incidente</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/ticket/lista_tickets">
                        <div class="card bg-info">
                            <div class="card-body">
                                <h2 class="text-white">Mis Tickets <i class="ti-list float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Revise todos los Tickets</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div> 

        <?  $accesoUsr = $this->m_seguridad->acceso_modulo(1);
            if($accesoUsr != 0){
        ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/usuario/lista_usuarios">
                        <div class="card bg-success">
                            <div class="card-body">
                                <h2 class="text-white">Ctrl Usuarios <i class="ti-user float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Gestion del personal</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>
        <?
            }

            $accesoActivos = $this->m_seguridad->acceso_modulo(2);
            if ($accesoActivos != 0) {
        ?>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/activos/lista_activos">
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
                    </div>
        <?
            }
        ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/inicio/descargar_formatos">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <h2 class="text-white">Formatos <i class="ti-cloud-down float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Descarga de Formatos Varios</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>

    </div> 
<!-- TABLAS --->
                   <div class="row">
                    <div class="col-xl-7">
                        <div class="ibox ibox-fullheight">
                            <div class="ibox-head">
                                <div class="ibox-title">TICKETS ASIGNADOS</div>
                                <div class="ibox-tools">
                                    <a class="dropdown-toggle font-18" data-toggle="dropdown"><i class="ti-ticket"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"><i class="ti-pencil mr-2"></i>Create</a>
                                        <a class="dropdown-item"><i class="ti-pencil-alt mr-2"></i>Edit</a>
                                        <a class="dropdown-item"><i class="ti-close mr-2"></i>Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-body">
                                <ul class="media-list media-list-divider scroller mr-2" data-height="470px">
 <?
        foreach ($tPendientes as $pendiente) {
            $estatus = $this->m_inicio->etiqueta($pendiente->estatus);
            $datetime = $pendiente->fecha_inicio . ' ' . $pendiente->hora_inicio;
            $hora = $this->m_ticket->fecha_text($datetime); 
            ?>
                            <li class="media">
                                <div class="media-body d-flex">
                                    <div class="flex-1">
                                        <h5 class="media-heading">
                                            <a href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$pendiente->folio?>">#<?=$pendiente->folio?>: <?=$pendiente->titulo?></a>
                                        </h5>
                                        <p class="font-13 text-light mb-1"><?=$pendiente->descripcion?></p>
                                        <div class="d-flex align-items-center font-13">
                                            <img class="img-circle mr-2" src="<?=base_url()?>src/img/usr/team.png" alt="image" width="22" />
                                            <a class="mr-2 text-success" href="javascript:;"><?=$pendiente->usuario?></a>
                                            <span class="text-muted"><?=$hora?></span>
                                        </div>
                                    </div>
                                    <div class="text-right" style="width:100px;">
                                         <a href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$pendiente->folio?>"><?=$estatus?>
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
            if ($usuario->id_rol == 1 ){
        ?>
                    <div class="col-lg-5">
                        <div class="ibox ibox-fullheight">
                            <div class="ibox-head">
                                <div class="ibox-title">TICKETS ABIERTOS </div>
                                <div class="ibox-tools">
                                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"><i class="ti-pencil"></i>Create</a>
                                        <a class="dropdown-item"><i class="ti-pencil-alt"></i>Edit</a>
                                        <a class="dropdown-item"><i class="ti-close"></i>Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 470px;">
                                  <ul class="timeline scroller" data-height="470px" style="overflow: hidden; width: auto; height: 470px;">
        <? 
                    foreach ($tGeneral as $pendiente) {
                      $estatus = $this->m_inicio->etiqueta($pendiente->estatus); ?>
                                    <li class="timeline-item">
                                        <span class="timeline-point"></span>
                                        <a href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$pendiente->folio?>">
                                        #<?=$pendiente->folio?>: <?=$pendiente->titulo?></a><a><small class="float-right text-muted ml-2 nowrap">
                                        <a href="<?=base_url()?>index.php?/ticket/seguimiento/<?=$pendiente->folio?>">
                                          <?=$estatus?>
                                          </a>
                                        </small>

                                      </li>
        <?
                                     }
        ?>
                                </ul>
                                <div class="slimScrollBar" style="background: rgb(113, 128, 143) none repeat scroll 0% 0%; width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 446.263px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.9; z-index: 90; right: 1px;"></div>
                              </div>
                            </div>
                        </div>
                    </div>
        <?
                 }
        ?>
                </div>




    <div class="row"> 
             
              </div>
  
              </section>
            


