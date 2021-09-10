

<body class="hold-transition loading-page">

<div class="cover"></div>
    <div class="ibox login-content">
        <div class="text-center">
            <span class="auth-head-icon"><img class="img-circle" src="<?=base_url()?>src/img/escudoazul.jpg"></span>
        </div>
        <form class="ibox-body"  action="<?php echo base_url();?>acceso/login" method="post">
            <h4 class="font-strong text-center mb-5">INICIAR SESION<br><br>HelpDesk</h4>
            <? if($this->uri->segment(3) == "e")
                    {?>
                     <div class="alert alert-danger alert-dismissible">
                     <h4><i class="icon fa fa-remove"></i> ¡Atención!</h4>
                        ¡El Usuario o la contraseña son Incorrectos!
                     </div>
                     <?}?>
            <div class="form-group mb-4">
                <input class="form-control form-control-line" type="text" name="user" placeholder="Usuario" required>
            </div>
            <div class="form-group mb-4">
                <input class="form-control form-control-line" type="password" name="password" placeholder="Contraseña">
            </div>
  <!--           <div class="flexbox mb-5">
                <span>
                    <label class="ui-switch switch-icon mr-2 mb-0">
                        <input type="checkbox" checked="">
                        <span></span>
                    </label>Remember</span>
                <a class="text-primary" href="forgot_password.html">Forgot password?</a>
            </div> -->
            <div class="text-center mb-4">
                <button class="btn btn-primary btn-rounded btn-block">ACCEDER</button>
            </div>
        </form>
    </div>
    </body>


</html>

<!--

<body class="hold-transition loading-page">
        <div class="login-box">
            <div class="login-logo">
                sistema de incidencias<br> OAG
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Ingresa al Sistema</p>

                <!--INICIO DE SESION FALLIDO - ALERTA 
                <? if($this->uri->segment(3) == "e")
                    {?>
                     <div class="alert alert-danger alert-dismissible">
                     <h4><i class="icon fa fa-remove"></i> ¡Atención!</h4>
                        ¡El Usuario o la contraseña son Incorrectos!
                     </div>
                     <?}?>

                <form action="<?php echo base_url();?>acceso/login" method="post">
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

-->