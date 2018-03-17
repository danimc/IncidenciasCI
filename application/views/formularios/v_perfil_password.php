


 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Perfil
                        <small>De usuario</small>
                    </h1><br>
                    <ol class="breadcrumb">
                        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li>Perfil</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header bg-aqua-active">
                                    <h3 class="widget-user-username"></h3>
                                    <h5 class="widget-user-desc"></h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" src="<?=base_url()?>src/img/usr/team.png" alt="imagen de perfil">
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"> 1</h5>
                                                <span class="description-text"> Tickets Reportados</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">0</h5>
                                                <span class="description-text">Tickets abiertos</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header"> <?=$usuario->extension?> </h5>
                                                <span class="description-text">Contacto</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <a href="" class="btn btn-default pull-right"><i class="fa fa-pencil"></i></a>
                                    <h3 class="box-tittle"> Información de Usuario</h3>

                                </div>             
                            </div>
                        </div>
                    </div>

                </section>
                
                <!-- /.content -->
            </div>