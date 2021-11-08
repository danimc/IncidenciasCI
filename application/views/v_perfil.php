<script>
function desactiva_enlace(input) {
    var contraEscrita = input.value;
    var contraMd5 = md5(contraEscrita);
    var contraActual = document.getElementById('contra').value;
    if (contraMd5 == contraActual) {
        document.getElementById('nueva').disabled = false;
        document.getElementById('verifica').disabled = false;
        document.getElementById('mensaje').innerHTML = null;

    } else {
        var mensaje =
            '<div class="alert alert-warning"><p><i class="fa fa-warning"></i> Su contraseña no es la correcta</p></div>';

        document.getElementById('nueva').disabled = true;
        document.getElementById('verifica').disabled = true;
        document.getElementById('mensaje').innerHTML = mensaje;
    }

}

function verifica_contra() {
    var contraNueva = document.getElementById('nueva').value;
    var verifica = document.getElementById('verifica').value;
    if (verifica != '') {
        if (contraNueva == verifica) {
            var mensaje = '<div class="alert alert-success"><p><i class="fa fa-success"></i> Correcto</p></div>';
            document.getElementById('mensaje').innerHTML = mensaje;
            document.getElementById('cambiarPass').disabled = false;
        } else {
            var mensaje =
                '<div align="center" class="alert alert-danger"><p><i class="fa fa-error"></i> Las contraseñas no coinciden</p></div>';
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
            if ($this->uri->segment(3) == 'e') { ?>
            <div id="alerta" class="alert alert-success col-md-4 pull-right">
                <p><i class="fa fa-check"></i> La contraseña se cambio Satisfactoriamente</p>
            </div>
            <? }
            if ($this->uri->segment(3) == 'i1') { ?>
            <div div="alerta" class="alert alert-danger col-md-4 pull-right">
                <p><i class="fa fa-close"></i> Error: solo puede subir imagenes</p>
            </div>
            <? }
            if ($this->uri->segment(3) == 'i2') { ?>
            <div div="alerta" class="alert alert-warning col-md-4 pull-right">
                <p><i class="fa fa-warning"></i> Atención: Debe seleccionar una imagen</p>
            </div>
            <? } ?>
        </div>
        <h1 class="page-title">Perfil de usuario</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Usuario</li>
            <li class="breadcrumb-item">Perfil</li>
        </ol>
        <br>
    </div>
    <a href="<?= base_url() ?>Inicio/" class="btn btn-app btn-blue"><i class="fa fa-arrow-left"></i>
        Regresar</a>


    <!-- Main content -->
    <section class="page-content fade-in-up">
        <div class="card card-air text-center centered mb-4 col-md-10">
            <a href="#" data-toggle="modal" data-target="#cambiarFoto"><span
                    class="pull-right badge badge-pill bg-blue"><i class="fa fa-image"></i> Cambiar Imagen</span></a>
            <div class="card-body">
                <div class="card-avatar mt-1 mb-4">
                    <img class="img-circle" src="<?= base_url() ?>src/img/usr/<?= $usuario->img ?>" alt="fPerfil">
                </div>
                <h4 class="card-title mb-1"><?= $usuario->nombre_completo ?></h4>
                <div class="text-info"><i class="ti-location-pin mr-2"></i><?= $usuario->nom_dependencia ?></div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-head">
                        <div class="ibox-title">Información de Usuario</div>

                        <a href="<?= base_url() ?>usuario/editar_perfil/<?= $usuario->codigo ?>" class="btn btn-info">
                            <i class="fa fa-pencil"> Editar Informacion</i>
                        </a>

                    </div>
                    <div class="ibox-body">
                        <div class="row">
                            <table class="table table-condensed">
                                <tr>
                                    <td><strong><i class="fa fa-user margin-r-5"></i> Prefijo: </strong></td>
                                    <td><?= $usuario->prefijo ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-user margin-r-5"></i> Nombre: </strong></td>
                                    <td><?= $usuario->nombre_completo ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa  fa-at margin-r-5"></i> Username:</strong></td>
                                    <td> <?= $usuario->usuario ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-building margin-r-5"></i> Adscripción:</strong></td>
                                    <td><?= $usuario->nom_dependencia ?> (<?= $usuario->dependencia ?>) </td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-phone margin-r-5"></i> Extension: </strong></td>
                                    <td><?= $usuario->extension ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-envelope margin-r-5"></i> Correo:</strong></td>
                                    <td><a href='mailto:<?= $usuario->correo ?>'> <?= $usuario->correo ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-asterisk margin-r-5"></i> Contraseña:</strong></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#myModal">
                                            <? if ($rol == 1 or $this->session->userdata('codigo') == $usuario->codigo) { ?>
                                            <span class="pull-right badge bg-blue"><i class="fa fa-pencil"></i>
                                                Modificar</span>
                                        </a>
                                        <? } ?>
                                        *******
                                    </td>

                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-head">
                        <div class="ibox-title">Datos de Personal:</div>



                    </div>
                    <div class="ibox-body">
                        <div class="row">
                            <table class="table table-condensed">
                                <tr>
                                    <td><strong><i class="fa fa-eye margin-r-5"></i> Estatus: </strong></td>
                                    <td><?= $usuario->situacion ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-black-tie margin-r-5"></i> Plaza: </strong></td>
                                    <td>
                                        <? if (isset($usuario->puesto)) { ?>
                                        <?= $usuario->puesto;
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-hand-o-right  margin-r-5"></i> Rol de Usuario: </strong>
                                    </td>
                                    <td> <?= $usuario->rol ?></td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <!-------Firma Institucional ------>

            <div class="col-md-6">
                <div class="ibox ibox-fullheight">
                    <section class="page-content fade-in-up">
                        <div class="row">
                            <div class="ibox">
                                <div class="ibox-head">
                                    <div class="ibox-title">
                                        Descarga tu firma Institucional

                                        <a id="download">
                                            <input type="button" value="Descargar" onClick="descargarFirma()">
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-body"></div>
                                <canvas id="myCanvas" width="900px" height="250px" style=" background-color: #fff;">
                                </canvas>
                            </div>

                            <div class="ibox">
                                <div class="ibox-head">
                                    <div class="ibox-title">
                                        Descargar Tipografía
                                    </div>

                                </div>
                                <div class="ibox-body">
                                    <a href="<?= base_url() ?>src/fonts/Trajan.ttf"> <i
                                            class="fa fa-download fa-5x txt-center"></i></a>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>



    <!-- /.content -->



    <!-------MODAL PARA CAMBIAR LA CONTRASEÑA ------>
    <form id="frmcambiarContra" method="POST" action="<?= base_url() ?>usuario/cambiar_contra">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cambiar Contraseña</h4>
                    </div>
                    <div class="modal-body">
                        <h3 align="center" class="title">Cambiar Contraseña</h3>

                        <p align="center">Esta a punto de cambiar su contraseña de usuario. Por favor
                            ingrese los datos necesarios en el siguiente formulario </p>

                        <div id="mensaje"></div>
                        <br>
                        <label for="contraAnterior">Su contraseña Actual:</label>
                        <input required id="encripta" onchange="desactiva_enlace(this)" class="form-control"
                            type="password" name="contraAnterior">
                        <br>
                        <label for="contraAnterior">Contraseña Nueva:</label>
                        <input onchange="verifica_contra()" class="form-control" disabled id="nueva" type="password"
                            name="contraNueva">
                        <br>
                        <label for="contraAnterior">Repetir nueva contraseña</label>
                        <input onchange="verifica_contra()" id="verifica" disabled class="form-control" type="password"
                            name="contraVerifica">

                        <input type="hidden" name="usuario" value="<?= $usuario->codigo ?>">
                        <input type="hidden" id="contra" name="contra" value="<?= $usuario->password ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="cambiarPass" class="btn btn-success" disabled><i
                                class="fa fa-check"></i> Cambiar Contraseña</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close">
                                Cancelar</i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="frmCambiarImg" enctype="multipart/form-data" method="POST" action="<?= base_url() ?>usuario/cambiar_img">
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
                        <input type="hidden" name="usuario" value="<?= $usuario->codigo ?>">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="cambiarFoto" class="btn btn-success"><i class="fa fa-check"></i>
                            Cambiar Foto</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close">
                                Cancelar</i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="<?= base_url() ?>src/js/md5.js"></script>

    <script>
    (() => {
        // variables de BD
        const nombre = "<?= $usuario->nombres ?> <?= $usuario->apellido ?>";
        const area = "<?= $usuario->nom_dependencia ?>";
        const ext = "<?= $usuario->extension ?>";
        const correo = "<?= $usuario->correo ?>";
        const prefijo = "<?= $usuario->prefijo ?>";
        const idPuesto = "<?=$usuario->idPuesto?>";
        const logo = "<?=base_url()?>src/img/logo-udg-gris.png";

        let puesto = "";

        if (idPuesto != 1) {
            if (idPuesto <= 5 || idPuesto >= 7) {
                puesto = "<?=$usuario->puesto?>";
            }
        }




        var c = document.getElementById("myCanvas");
        var img = new Image();
        var ctx = c.getContext("2d");
        img.src = logo;

        img.onload = function() {
            ctx.drawImage(img, 20, 20, 100, 120);
        }

        ctx.font = "24px Trajan pro";
        ctx.fillStyle = "#0e2d43";
        ctx.fillText("Universidad de Guadalajara", 130, 50);

        ctx.font = "14px Trajan pro";
        ctx.fillStyle = "#304357";
        ctx.fillText("Secretaría General", 130, 70);
        ctx.fillText("Oficina de la Abogacía General", 130, 85);
        ctx.fillText(`${area}`, 130, 100);

        ctx.font = "18px Trajan pro";
        ctx.fillStyle = "#0e2d43";
        ctx.fillText(`${prefijo} ${nombre}`, 130, 130);

        ctx.font = "15px Trajan pro";
        ctx.fillStyle = "#0e2d43";
        ctx.fillText(`${puesto}`, 130, 150);

        ctx.font = " 14px Times New Roman";
        ctx.fillStyle = "#304357";
        ctx.fillText("Av. Juárez 976, Edificio de la Rectoría General, Piso 3,", 130, 180);
        ctx.fillText("Col. Centro C.P. 44170, Guadalajara, Jalisco, México.", 130, 195);
        ctx.fillText(`Tel: [52] 33 3134 4661, 33 3134 2222 Ext. ${ext}`, 130, 210);

        ctx.font = "15px Times";
        ctx.fillStyle = "#0e2d43";

        ctx.fillText(`${correo}`, 130, 235);

    })();



    const descargarFirma = () => {
        var canvas = document.getElementById("myCanvas");


        //  var filename = prompt("Guardar como...", "Nombre del archivo");
        const filename = "firma"
        if (canvas.msToBlob) { //para internet explorer
            var blob = canvas.msToBlob();
            window.navigator.msSaveBlob(blob, filename + ".png"); // la extensión de preferencia pon jpg o png
        } else {
            link = document.getElementById("download");
            //Otros navegadores: Google chrome, Firefox etc...
            link.href = canvas.toDataURL(
                "image/png"); // Extensión .png ("image/png") --- Extension .jpg ("image/jpeg")
            link.download = filename;
        }

    }


    const firma = () => {

    }
    </script>