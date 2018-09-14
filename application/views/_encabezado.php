<?php
header("Content-Type: text/html;charset=utf-8");
$codigo = $this->session->userdata("codigo");  
$usuario = $this->m_usuario->obt_usuario($codigo);

?>
    <!--
    ###########################################
    #                                         #
    #  CARGANDO TODAS LAS LIBRERIAS CSS Y JS  #
    #       NECESARIAS PARA EL PROYECTO       #
    #                                         #
    ###########################################
-->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Incidencias OAG</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=base_url()?>src/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- tema -->
        <link rel="stylesheet" href="<?=base_url()?>src/css/AdminLTE.min.css">
        <!-- Tema -->
        <link rel="stylesheet" href="<?=base_url()?>src/css/skins/skin-blue.min.css">
        <!-- plugins -->
        <link rel="stylesheet" href="<?=base_url()?>src/css/icheck/blue.css">
        <!-- Tablas -->
        <link rel="stylesheet" href="<?=base_url()?>src/css/dataTables.bootstrap.css">

        <link rel="stylesheet" type="text/css" href="<?=base_url()?>src/css/bootstrap3-wysihtml5.css">

        <link rel="stylesheet" href="<?=base_url()?>src/css/bootstrap-select.min.css">

        <script src="<?=base_url()?>src/js/jquery-2.2.3.min.js"></script>
    </head>    

    <?php
    $controlador = $this->uri->segment(1);
    $funcion = $this->uri->segment(2);
    $objeto  = $this->uri->segment(3);

    $this->m_seguridad->log_general($controlador, $funcion, $objeto);
    
    if($this->session->userdata("codigo") == null){
        redirect('/acceso/logout');
    }
    if($this->m_seguridad->acceso_sistema() == 0)
    {

        redirect('/Inicio/noaccess');
    }
    ?>

<body class="hold-transition skin-blue sidebar-mini">
         <div class="wrapper">
    <header class="main-header">
        <!--logo-->
        <a href="<?php echo base_url();?>index.php?/Inicio" class="logo">
            <span class="logo-mini"><b>OAG</b></span>
            <span class="logo-lg">Incidencias <b>OAG</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">                  
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-bell-o"></i>
                          <span class="label label-warning">0</span>
                      </a>
                      <ul class="dropdown-menu">
                          <li class="header"></li>
                          <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                              <li>
                                <a href="#">
                                  <i class="fa fa-users text-aqua"></i> 
                              </a>
                          </li>                  
                      </ul>
                  </li>
                  <li class="footer"><a href="#">Notificaciones</a></li>
              </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?=base_url()?>src/img/usr/team.png" class="user-image" alt="foto Perfil">
                <span class="hidden-xs">
                    <?=$usuario->usuario?>
                </span>
            </a>
            <ul class="dropdown-menu">
                <li class="user-header">
                    <img src="<?=base_url()?>src/img/usr/team.png" class="img-circle" alt="imagen de usuario">

                    <p>
                     <?=$usuario->nombre?>
                     <small><?=$usuario->dependencia?></small>
                 </p>
             </li>
             <li class="user-body">
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <a href="#">Seguidores</a>
                    </div>
                    <div class="col-xs-4 text-center">
                        <a href="#">Tickets sin atender</a>
                    </div>
                </div>
            </li>
            <li class="user-footer">
                <div class="pull-left">
                    <a href="<?=base_url()?>index.php?/usuario/perfil" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                    <a href="<?=base_url()?>index.php?/acceso/logout" class="btn btn-default btn-flat"> Cerrar Sesion</a>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" title="Configuraciones del sistema" ><i class="fa fa-gears"></i></a>
    </li>
    </ul>
</div>
</nav>
</header>
