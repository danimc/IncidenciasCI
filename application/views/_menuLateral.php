<?
$codigo = $this->session->userdata("codigo");	
$usuario = $this->m_usuario->obt_usuario($codigo);
?>
<aside class="main-sidebar">


				
				<section class="sidebar">

					
					<div class="user-panel">
						
						<div class="pull-left image">
							<img src="<?=base_url()?>src/img/usr/team.png" class="img-circle" alt="Imagen de Usuario">
						</div>
						
						<div class="pull-left info">
							<p><?=$usuario->nombre?></p>
							<p><?=$usuario->dependencia?></p> 
						</div>
					</div>
			



					<!-- Sidebar Menu -->
					<ul class="sidebar-menu">
						<li class="header">
							MENU LATERAL
						</li>
						<!-- Optionally, you can add icons to the links -->
						<li class="active">
							<a href="<?php echo base_url();?>index.php?/Inicio"><i class="fa fa-home"></i> <span>Inicio</span></a>
						</li>
						<!--<li ><a href="menuUsuarios"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>-->
						 <li class="treeview">
					        <a href="#">
					        	<i class="fa fa-ticket"></i>
					            <span>Tickets</span>
					            <span class="pull-right-container">
					              <i class="fa fa-angle-left pull-right"></i>
					            </span>
					          </a>
					          <ul class="treeview-menu">
					          	<li>
					          		<a href="<?=base_url()?>index.php?/ticket/nuevo_ticket"><i class="fa fa-plus"></i> Nuevo Ticket</a>
					          	</li>

					          	<?
					          		if( $usuario->id_rol == 1 )
					          		{
					          	 ?>

					            <li>
									<a href="<?php echo base_url();?>index.php?/ticket/lista_tickets_abiertos"><i class="fa fa-ticket"></i> <span>Tickets Abiertos</span></a>
								</li>
								<li>
									<a href="<?php echo base_url();?>index.php?/ticket/lista_tickets_cerrados"><i class="fa fa-lock"></i> <span>Tickets Cerrados</span></a>
								</li>

								<?
									}
								?>
								<li>
									<a href="<?php echo base_url();?>index.php?/ticket/lista_tickets"><i class="fa fa-barcode"></i> <span>Lista de Tickets</span></a>
								</li>
					          </ul>
					        </li>
					   			  <? $accesoUsr = $this->m_seguridad->acceso_modulo(1);

				              	  if($accesoUsr != 0){ ?>
							    <li class=>
									<a href="<?=base_url()?>index.php?/usuario/lista_usuarios"><i class="fa fa-user"></i> <span>Ctrl de Usuarios</span></a>
								</li>
								<?}?>

					        <? 
					        $accesoArchMuerto = $this->m_seguridad->acceso_modulo(10);
					        if($accesoArchMuerto != 0){
					        	?>
					        
					        <li class="treeview">
					        <a href="#">
					        	<i class="fa  fa-folder"></i>
					            <span>Archivo Muerto</span>
					            <span class="pull-right-container">
             						 <small class="label pull-right bg-red">Nuevo</small>
           						 </span>
					           
					          </a>
					          <ul class="treeview-menu">
					          	<li>
					          		<a href="<?=base_url()?>index.php?/expedientes/solicitar_expediente"><i class="fa fa-plus"></i> Solicitar Expediente</a>
					          	</li>
					          	<?
					          		if($this->m_seguridad->acceso_modulo(3) != 0)
					          			{?>
					          	  <li>
									<a href="<?php echo base_url();?>index.php?/expedientes/archivo_muerto_oficialia"><i class="fa fa-toggle-right"></i> <span>Atender Solicitudes</span></a>
								</li>
									<?
										}
									?>
					            <li>
									<a href="<?php echo base_url();?>index.php?/expedientes/archivo_muerto_usr"><i class="fa fa-barcode"></i> <span>Exp. Pedidos</span></a>
								</li>

					          </ul>
					        </li>
					        <?
					    }?>


					</ul>
					<!-- /.sidebar-menu -->
				</section>
				<!-- /.sidebar -->
			</aside>