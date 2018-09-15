
 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Editar
                        <small>Perfil de usuario | Datos de Personal</small>
                    </h1><br>
                    <ol class="breadcrumb">
                        <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li>Perfil</li>
                        <li>editar</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                           <div class="box box-widget widget-user">
                                <div class="widget-user-header bg-aqua-active">
                                    <h3 class="widget-user-username"><?=$usuario->nombre?></h3>
                                    <h5 class="widget-user-desc"><?=$usuario->nom_dependencia?></h5>
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
                        <form method="POST" action="<?=base_url()?>index.php?/usuario/editar_datos_personal" >
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    
                                    <h3 class="box-tittle"> Editar Información de Personal</h3>

                                </div>

                                <div class="box-body">
                                    <h4><strong><i class="fa fa-eye margin-r-5"></i> Estatus: </strong></h4> 
                                        <select name="situacion" class="form-control selectpicker">
                                            <option value="<?=$usuario->estatus?>"><?=$usuario->situacion?></option>
                                            <?foreach ($situaciones as $situacion) {?>
                                                <option value="<?=$situacion->id?>">
                                                    <?=$situacion->situacion?>
                                                </option>                                                
                                           <? }?>    
                                        </select> 
                           
                                     <h4><strong><i class="fa fa-black-tie margin-r-5"></i> Plaza: </strong></h4> 
                                        <select name="plaza" class="form-control selectpicker">
                                            <option value="<?=$usuario->estatus?>"><?=$usuario->puesto?></option>
                                            <?foreach ($plazas as $plaza) {?>
                                                <option value="<?=$plaza->id?>">
                                                    <?=$plaza->puesto?>
                                                </option>                                                
                                           <? }?>    
                                        </select> 
                                         <h4><strong><i class="fa fa-black-tie margin-r-5"></i> Rol de Usuario: </strong></h4> 
                                        <select name="rol" class="form-control selectpicker">
                                            <option value="<?=$usuario->estatus?>"><?=$usuario->rol?></option>
                                            <?foreach ($roles as $rol) {?>
                                                <option value="<?=$rol->id_rol?>">
                                                    <?=$rol->rol?>
                                                </option>                                                
                                           <? }?>    
                                        </select> 
                                        <input type="hidden" name="codigo" value="<?=$usuario->codigo?>">
                                    <hr>
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </div>                               
                        </div>
                        </form>
                    </div>

                </section>
                
                <!-- /.content -->
            </div>


<!-------MODAL PARA CAMBIAR LA CONTRASEÑA ------>
 <form id="frmcambiarContra" method="POST" action="<?=base_url()?>index.php?/usuario/cambiar_contra">
     <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cambiar Contraseña</h4>
            </div>
            <div class="modal-body">
                <h3 align="center" class="title">Cambiar Contraseña</h3>
                  
              <p align="center">Esta a punto de cambiar su contraseña de usuario. Por favor ingrese los datos necesarios en el siguiente formulario  </p>

                <div id="mensaje"></div>
                <br>
              <label for="contraAnterior">Su contraseña Actual:</label>
              <input required id="encripta" onchange="desactiva_enlace(this)" class="form-control" type="password" name="contraAnterior">
              <br>
              <label for="contraAnterior">Contraseña Nueva:</label>
              <input onchange="verifica_contra()" class="form-control" disabled id="nueva" type="password" name="contraNueva">
              <br>
              <label for="contraAnterior">Repetir nueva contraseña</label>
              <input onchange="verifica_contra()" id="verifica" disabled class="form-control" type="password" name="contraVerifica">
                
                <input type="hidden" name="usuario" value="<?=$usuario->codigo?>">
                <input type="hidden" id="contra" name="contra" value="<?=$usuario->password?>">
                </div>
              <div class="modal-footer">
                <button type="submit" id="cambiarPass"   class="btn btn-success" disabled ><i class="fa fa-check"></i> Cambiar Contraseña</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> Cancelar</i></button>
            </div>
          </div>
        </div>
      </div>
</form>
