<?
$usuario = $this->m_usuario->obt_usuario()
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
					            <li>
									<a href="<?php echo base_url();?>index.php?/ticket/lista_tickets"><i class="fa fa-barcode"></i> <span>Mis Tickets</span></a>
								</li>
					          </ul>
					        </li>

					</ul>
					<!-- /.sidebar-menu -->
				</section>
				<!-- /.sidebar -->
			</aside>