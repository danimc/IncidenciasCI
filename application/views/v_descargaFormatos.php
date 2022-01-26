<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="content-wrapper">
    <? if ($this->uri->segment(3) == 'e') { ?>
    <div class="col-md-4 alert alert-warning pull-right">
        <p><i class="fa fa-warning"></i> Atención! debe Capturar un usuario valido.</p>
    </div>
    <? } ?>
    <!-- Content Header (Page header) -->
    <div class="page-heading">
        <h1 class="page-title">Documentos y formatos :</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">HelpDesk</li>
            <li class="breadcrumb-item">Documentos y Formatos</li>
        </ol>
        <br>
    </div>

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
                <canvas id="myCanvas" width="600px" height="250px" style=" background-color: #fff;">
                </canvas>
            </div>

            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Descargar Tipografia
                    </div>

                </div>
                <div class="ibox-body">
                    <a href="<?= base_url() ?>src/fonts/Trajan.ttf"> <i class="fa fa-download fa-5x txt-center"></i></a>
                </div>
            </div>

        </div>






</div>
</section>







<script>
(() => {
    // variables de BD
    const nombre = "<?= $usr->nombres ?> <?= $usr->apellido ?>";
    const area = "<?= $usr->nom_dependencia ?>";
    const ext = "<?= $usr->extension ?>";
    const correo = "<?= $usr->correo ?>";
    const prefijo = "<?= $usr->prefijo ?>";
    const idPuesto = "<?= $usr->idPuesto ?>";
    const logo = "<?= base_url() ?>src/img/logo-udg-gris.png";

    let puesto = "";

    if (idPuesto != 1) {
        if (idPuesto <= 5 || idPuesto >= 7) {
            puesto = "<?= $usr->puesto ?>";
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