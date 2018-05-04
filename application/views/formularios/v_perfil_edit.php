
<script>
     function desactiva_enlace(input)
  {
      var contraEscrita = input.value;
      var contraMd5 = md5(contraEscrita);
      var contraActual = document.getElementById('contra').value;
       if (contraMd5 == contraActual) {
            document.getElementById('nueva').disabled=false;
            document.getElementById('verifica').disabled=false;
            document.getElementById('mensaje').innerHTML = null;

       }
       else{
            var mensaje = '<div class="alert alert-warning"><p><i class="fa fa-warning"></i> Su contraseña no es la correcta</p></div>';

            document.getElementById('nueva').disabled=true;
            document.getElementById('verifica').disabled=true;
            document.getElementById('mensaje').innerHTML = mensaje;
       } 
    
  }

  function verifica_contra()
  {
    var contraNueva = document.getElementById('nueva').value;
    var verifica    = document.getElementById('verifica').value;
    if (verifica != '') {
        if (contraNueva == verifica) {
            var mensaje = '<div class="alert alert-success"><p><i class="fa fa-success"></i> Correcto</p></div>';
            document.getElementById('mensaje').innerHTML = mensaje;
            document.getElementById('cambiarPass').disabled = false;
        }
        else{
            var mensaje = '<div align="center" class="alert alert-danger"><p><i class="fa fa-error"></i> Las contraseñas no coinciden</p></div>';
            document.getElementById('mensaje').innerHTML = mensaje;
            document.getElementById('cambiarPass').disabled = true;
        }
    }
  }
</script>

 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Editar
                        <small>Perfil de usuario</small>
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
                            <?
                                if ($this->uri->segment(3) == 'e') {?>
                                    <div align="center" class="alert alert-success"><p><i class="fa fa-check"></i> La contraseña se cambio Satisfactoriamente</p></div>
                                <?}
                            ?>
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
                        <form method="POST" action="<?=base_url()?>index.php?/usuario/editar_usuario" >
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    
                                    <h3 class="box-tittle"> Editar Información de Usuario</h3>

                                </div>

                                <div class="box-body">
                                    <input type="hidden" name="codigo" value="<?=$usuario->codigo?>">
                                    <h4><strong><i class="fa fa-vcard margin-r-5"></i> Nombre: </strong> </h4>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombre" value="<?=$usuario->nombres?>">
                                    </div>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="apellido" value="<?=$usuario->apellido?>">
                                    </div>
                                    <br><br>
                                    <hr>
                                    <h4><strong><i class="fa fa-user margin-r-5"></i> Username: </strong></h4>
                                    <input type="text" class="form-control" name="username" value="<?=$usuario->usuario?>" disabled><hr>
                                    <h4><strong><i class="fa fa-legal margin-r-5"></i> Dependencia: </strong></h4> 
                                        <select name="dependencia" class="form-control">
                                            <option value="<?=$usuario->depId?>"><?=$usuario->nom_dependencia?></option>
                                            <?foreach ($dependencias as $dependencia) {?>
                                                <option value="<?=$dependencia->id_dependencia?>">
                                                    <?=$dependencia->nombre_dependencia?>
                                                </option>                                                
                                           <? }?>    
                                        </select> 
                                    <hr>
                                    <h4><strong><i class="fa fa-phone margin-r-5"></i>Extension: </strong></h4>
                                    <input maxlength="5" type="text" class="form-control" name="extension" value="<?=$usuario->extension?>"> 
                                    <hr>
                                    <h4><strong><i class="fa fa-envelope margin-r-5"></i> Correo:</strong></h4>
                                    <input class="form-control" type="email" name="correo" value="<?=$usuario->correo?>">
                                    <hr>
                                    <a href="#" data-toggle="modal" data-target="#myModal""><span class="pull-right badge bg-blue"><i class="fa fa-pencil"></i> Modificar</span></a>
                                    <h4><strong><i class="fa fa-lock margin-r-5"></i> Contraseña: </strong>*******</h4>
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
