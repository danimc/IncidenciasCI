
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


 <div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="page-heading">
        <div class="col-md-12">
  
 <?
    if ($this->uri->segment(3) == 'e') {?>
        <div id="alerta" class="alert alert-success col-md-4 pull-right"><p><i class="fa fa-check"></i> La contraseña se cambio Satisfactoriamente</p></div>
    <?}
    if ($this->uri->segment(3) == 'i1') {?>
        <div div="alerta" class="alert alert-danger col-md-4 pull-right"><p><i class="fa fa-close"></i> Error: solo puede subir imagenes</p></div>
    <?}
    if ($this->uri->segment(3) == 'i2') {?>
        <div div="alerta" class="alert alert-warning col-md-4 pull-right"><p><i class="fa fa-warning"></i> Atención: Debe seleccionar una imagen</p></div>
    <?} ?>
      </div>
    <h1 class="page-title">Editar Perfil de Usuario</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/incidencias"><i class="la la-home font-20"></i></a>
      </li>
      <li class="breadcrumb-item">Usuario</li>
      <li class="breadcrumb-item">Perfil</li>
      <li class="breadcrumb-item">Editar</li>
    </ol>
    <br>
  </div>
          <a href="<?=base_url()?>index.php?/usuario/perfil/<?=$usuario->codigo?>" class="btn btn-app btn-blue"><i class="fa fa-arrow-left"></i> Regresar</a>
         
         
    <!-- Main content -->
  <section class="page-content fade-in-up">
    <div class="card card-air text-center centered mb-4 col-md-10" >
          <a href="#" data-toggle="modal" data-target="#cambiarFoto"><span class="pull-right badge badge-pill bg-blue"><i class="fa fa-image"></i> Cambiar Imagen</span></a>
                        <div class="card-body">
                            <div class="card-avatar mt-1 mb-4">
                              <img class="img-circle" src="<?=base_url()?>src/img/usr/<?=$usuario->img?>" alt="fPerfil">                             
                            </div>
                            <h4 class="card-title mb-1"><?=$usuario->nombre_completo?></h4>
                            <div class="text-info"><i class="ti-location-pin mr-2"></i><?=$usuario->nom_dependencia?></div>
                        </div>
                    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="ibox ">
          <div class="ibox-head">
            <div class="ibox-title">Información de Usuario</div>
          </div> 
          <div class="ibox-body">
            <div class="row">
            <form method="POST" action="<?=base_url()?>index.php?/usuario/modificar_perfil">
              <table class="table table-condensed">
                <tr>
                  <td><strong><i class="fa fa-user margin-r-5"></i> Nombre: </strong></td>
                  <td>
                    <input type="hidden" name="codigo" id="codigo" value="<?=$usuario->codigo?>">
                    <input type="text" id="nombres" name="nombres" value="<?=$usuario->nombres?>" class="form-control-sm col-md-6">
                    <input type="text" id="apellido" name="apellido" value="<?=$usuario->apellido?>" class="form-control-sm col-md-5">
                  </td>
                </tr>
                <tr>
                  <td><strong><i class="fa  fa-at margin-r-5"></i> Username:</strong></td>
                  <td> <input type="text" disabled="" name="userid" value="<?=$usuario->usuario?>" class="form-control"></td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-building margin-r-5"> </i> Unidad:</strong></td>
                  <td>
                    <select name="dependencia" id="dependencia" class="form-control ">
                        <option value="<?=$usuario->depId?>"><?=$usuario->nom_dependencia?> (<?=$usuario->dependencia?>) </option>
                        <? foreach ($dependencias as $unidad ) {?>
                           <option value="<?=$unidad->id_dependencia?>"><?=$unidad->nombre_dependencia?> (<?=$unidad->abreviatura?>) </option>
                        <?}?>
                    </select> </td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-phone margin-r-5"></i> Extension: </strong></td>
                  <td><input type="number" name="extension" id="extension" value="<?=$usuario->extension?>" class="form-control" ></td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-envelope margin-r-5"></i> Correo:</strong></td>
                  <td><input type="email" name="email" id="email" value="<?=$usuario->correo?>" class="form-control"> </td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-asterisk margin-r-5"></i> Contraseña:</strong></td>
                  <td>
                      <a href="#" data-toggle="modal" data-target="#myModal">
                         <? if($rol == 1 OR $this->session->userdata('codigo') == $usuario->codigo) {?>
                          <span class="pull-right badge bg-blue"><i class="fa fa-pencil"></i> Modificar</span></a>
                          <?}?>
                      *******
                  </td>
                                      
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <? if($rol == 1 ) {?>
        <div class="col-md-6">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Datos de Personal:</div>
                </div>
                <div class="ibox-body">
                    <div class="row">
                        <table class="table table-condensed">
                            <tr>
                                <td><strong><i class="fa fa-eye margin-r-5"></i> Estatus: </strong></td>
                                <td>
                                    <select name="estatus" id="estatus" class="form-control">
                                        <option value="<?=$usuario->estatus?>"><?=$usuario->situacion?></option>
                                        <? foreach ($estatus as $situacion) {?>
                                            <option value="<?=$situacion->id?>"><?=$situacion->situacion?></option>
                                        <?}?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><i class="fa fa-black-tie margin-r-5"></i> Plaza: </strong></td>
                                <td>
                                    <select name="plaza" id="plaza" class="form-control">
                                        <option value="<?=$usuario->id_rol?>"><?=$usuario->puesto?></option>
                                        <? foreach ($plazas as $plaza) {?>
                                            <option value="<?=$plaza->id?>"><?=$plaza->puesto?></option>
                                        <?}?>
                                    </select>
                                    <!--
                                    <? if (isset($usuario->puesto)) {?>
                                    <?=$usuario->puesto;
                                     }?> -->
                                </td>
                            </tr>
                            <tr>
                                <td><strong><i class="fa fa-hand-o-right  margin-r-5"></i> Rol de Usuario: </strong></td>
                                <td>
                                     <select name="rol" id="rol" class="form-control">
                                        <option value="<?=$usuario->estatus?>"><?=$usuario->rol?></option>
                                        <? foreach ($roles as $rol) {?>
                                            <option value="<?=$rol->id_rol?>"><?=$rol->rol?></option>
                                        <?}?>
                                    </select> 
                                </td>
                            </tr>        
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
        <?}?>
    </div>

    <div class="ibox">
        <div class="ibox-head">
            <button class="btn btn-success" id="btnGuardarPerfil"><i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
</form>
  </section>

             <!-- /.content -->
     


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

<form id="frmCambiarImg" enctype="multipart/form-data" method="POST" action="<?=base_url()?>index.php?/usuario/cambiar_img">
     <div class="modal fade" id="cambiarFoto" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-blue">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cambiar Imagen de Perfil</h4>
            </div>
            <div class="modal-body">
                <h3 align="center" class="title">Cambiar imagen de Perfil</h3>                  
              <p align="center">Suba una nueva foto de perfil </p>
                <div id="mensaje"></div>
              <br>
              <input type="file" name="img">
              <input type="hidden" name="usuario" value="<?=$usuario->codigo?>">
                
                </div>
              <div class="modal-footer">
                <button type="submit" id="cambiarFoto"   class="btn btn-success"  ><i class="fa fa-check"></i> Cambiar Foto</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> Cancelar</i></button>
            </div>
          </div>
        </div>
      </div>
</form>
<script src="<?=base_url()?>src/js/md5.js"></script>
