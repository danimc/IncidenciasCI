
<body class="hold-transition loading-page">
        <div class="login-box">
            <div class="login-logo">
                sistema de incidencias<br> OAG
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Ingresa al Sistema</p>

                <!--INICIO DE SESION FALLIDO - ALERTA -->
                <? if($this->uri->segment(3) == "e")
                    {?>
                     <div class="alert alert-danger alert-dismissible">
                     <h4><i class="icon fa fa-remove"></i> ¡Atención!</h4>
                        ¡El Usuario o la contraseña son Incorrectos!
                     </div>
                     <?}?>

                <form action="<?php echo base_url();?>index.php?/acceso/login" method="post">
                    <div class="form-group has-feedback">
                        <input name="user" type="text" class="form-control" placeholder="Usuario" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
                    </div>
                </form>
                <a href="#"> Olvide mi contraseña</a><br>
                <a href="#"> No tengo cuenta</a>
            </div>
        </div>
    </body>


</html>