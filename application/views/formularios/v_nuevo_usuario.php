
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
    <h1 class="page-title">Nuevo Usuario</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/incidencias"><i class="la la-home font-20"></i></a>
      </li>
      <li class="breadcrumb-item">Usuario</li>
      <li class="breadcrumb-item">Nuevo Usuario</li>
    </ol>
    <br>
  </div>
          <a href="<?=base_url()?>index.php?/usuario/lista_usuarios" class="btn btn-app btn-blue"><i class="fa fa-arrow-left"></i> Regresar</a>
         
         
    <!-- Main content -->
  <section class="page-content fade-in-up">

    <div class="row">
      <div class="col-md-6">
        <div class="ibox ">
          <div class="ibox-head">
            <div class="ibox-title">Información de Usuario</div>
          </div> 
          <div class="ibox-body">
            <div class="row">
            <form method="POST" action="<?=base_url()?>index.php?/usuario/alta_usuario">
              <table class="table table-condensed">
                 <tr>
                  <td><strong><i class="fa fa-code margin-r-5"></i> Codigo: </strong></td>
                  <td>
                    <input type="number" id="codigo" name="codigo" class="form-control-sm col-md-6">
                  </td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-user margin-r-5"></i> Nombre: </strong></td>
                  <td>
                    <input type="text" id="nombre" name="nombre" class="form-control-sm col-md-6">
                    <input type="text" id="apellido" name="apellido" class="form-control-sm col-md-5">
                  </td>
                </tr>
                <tr>
                  <td><strong><i class="fa  fa-at margin-r-5"></i> Username:</strong></td>
                  <td> <input type="text"  name="userid" class="form-control"></td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-building margin-r-5"> </i> Unidad:</strong></td>
                  <td>
                    <select name="dependencia" id="dependencia" class="form-control ">
                        
                        <? foreach ($dependencias as $unidad ) {?>
                           <option value="<?=$unidad->id_dependencia?>"><?=$unidad->nombre_dependencia?> (<?=$unidad->abreviatura?>) </option>
                        <?}?>
                    </select> </td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-phone margin-r-5"></i> Extension: </strong></td>
                  <td><input type="number" name="extension" id="extension" class="form-control" ></td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-envelope margin-r-5"></i> Correo:</strong></td>
                  <td><input type="email" name="email" id="email"  class="form-control"> </td>
                </tr>
                <tr>
                  <td><strong><i class="fa fa-asterisk margin-r-5"></i> Contraseña:</strong></td>
                  <td>
                    <input type="password" name="password" id="password"  class="form-control">
                  </td>                                      
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>     
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
                                       
                                        <? foreach ($plazas as $plaza) {?>
                                            <option value="<?=$plaza->id?>"><?=$plaza->puesto?></option>
                                        <?}?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><i class="fa fa-hand-o-right  margin-r-5"></i> Rol de Usuario: </strong></td>
                                <td>
                                     <select name="rol" id="rol" class="form-control">
                                        
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


    <div class="ibox">
        <div class="ibox-head">
            <button class="btn btn-success" id="btnGuardarPerfil"><i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
</form></div>
  </section>

             <!-- /.content -->
     



<script src="<?=base_url()?>src/js/md5.js"></script>
