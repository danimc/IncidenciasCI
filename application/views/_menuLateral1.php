<?
$codigo = $this->session->userdata("codigo");	
$usuario = $this->m_usuario->obt_usuario($codigo);
?>

        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">

                <ul class="side-menu metismenu">
                	<li class="heading">MENÚ LATERAL</li>
                    <li class="active">
                        <a href="<?php echo base_url();?>index.php?/Inicio"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Inicio</span></a>
                    </li>                    
                    <li>
                        <a href="<?=base_url()?>index.php?/ticket/nuevo_ticket"><i class="sidebar-item-icon ti-ticket"></i>
                            <span class="nav-label">Nuevo Ticket</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php?/ticket/lista_tickets"><i class="sidebar-item-icon fa fa-barcode"></i> <span>Lista de Tickets</span></a>
                    </li>
                            <?
			if( $usuario->id_rol == 1 )
			{
		?>

                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-package"></i>
                            <span class="nav-label">Menú Tickets</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
									<a href="<?php echo base_url();?>index.php?/ticket/lista_tickets_abiertos"><i class="sidebar-item-icon fa fa-ticket"></i> <span>Tickets Abiertos</span></a>
								</li>
								<li>
									<a href="<?php echo base_url();?>index.php?/ticket/lista_tickets_cerrados"><i class="sidebar-item-icon fa fa-lock"></i> <span>Tickets Cerrados</span></a>
								</li>								
                        </ul>
                    </li>
                    <?
				}
                
				$accesoUsr = $this->m_seguridad->acceso_modulo(1);
				if($accesoUsr != 0)
					{
		?>
							                      <li>
                        <a href="<?=base_url()?>index.php?/usuario/lista_usuarios"><i class="sidebar-item-icon ti-user"></i>
                            <span class="nav-label">Ctrl Usuarios</span></a>
                    </li>
		<?
					}
		?>
                </ul>
                <div class="sidebar-footer">
<!--                     <a href="javascript:;"><i class="ti-announcement"></i></a>
                    <a href="calendar.html"><i class="ti-calendar"></i></a>
                    <a href="javascript:;"><i class="ti-comments"></i></a> -->
                    <a href="<?=base_url()?>index.php?/acceso/logout" title="Cerrar Sesion"><i class="ti-power-off"></i></a>
                </div>
            </div>
        </nav>