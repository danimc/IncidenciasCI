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
                    </div>
                </div>
                <div class="ibox-body"></div>
                <canvas id="myCanvas" width="600px" height="250px" style=" background-color: #fff;">
                </canvas>
            </div>
        </div>



</div>
</section>




<script>
(() => {
    // variables de BD
    const nombre = "<?= $usr->nombres?> <?=$usr->apellido?>";
    const area = "<?= $usr->nom_dependencia?>";
    const ext = "<?= $usr->extension?>";
    const correo = "<?= $usr->correo?>";


    var c = document.getElementById("myCanvas");
    var img = new Image();
    var ctx = c.getContext("2d");
    img.src = "https://fototeca.comsoc.udg.mx/theme_static/images/logo-udg-gris-mediagoblin.png";
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
    ctx.fillText(`${nombre}`, 130, 130);

    ctx.font = "15px Trajan pro";
    ctx.fillStyle = "#0e2d43";
    //ctx.fillText("Jefe de Área", 130, 150);

    ctx.font = "14px Times New Roman";
    ctx.fillStyle = "#304357";
    ctx.fillText("Av. Juárez 976, Edificio de la Rectoría General, Piso 3,", 130, 180);
    ctx.fillText("Col. Centro C.P. 44170, Guadalajara, Jalisco, México.", 130, 195);
    ctx.fillText(`Tel: [52] 33 3134 4661, 33 3134 2222 Ext. ${ext}`, 130, 210);

    ctx.font = "bold 15px Times";
    ctx.fillStyle = "#0e2d43";
    ctx.fillText(`${correo}`, 130, 235);

})();


const firma = () => {

}
</script>