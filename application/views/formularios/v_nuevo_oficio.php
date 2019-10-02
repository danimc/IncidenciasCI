 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <div class="page-heading">
    <h1 class="page-title">Capturar Nuevo Oficio:</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index-2.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Ctrl Oficios</li>
        <li class="breadcrumb-item">Capturar Oficio</li>
    </ol>
    <div id="alerta1" class="alert alert-warning col-md-4 pull-right" style="position: fixed; top: 80px; right: 0px; z-index: 3;"><p><i class="fa fa-warning"></i> Atención: El numero de oficio ya fue utilizado.</p></div>
    <br>
 </div>

    <!-- Main content -->
 <section class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Datos del Oficio</div>
                </div> 
                <div class="ibox-body">
                    <div class="form-group mb-4 col-md-12">
                        <label class="col-sm-4 col-form-label">Oficio: </label>                
                        <span><b>DTI/</b></span>
                        <input type="number" min="<?=$consecutivo?>" max="9999" name="oficio"  id="oficio" value="<?=$consecutivo?>" class="form-control-sm col-sm-4">
                        <span><b>/2019</b></span>
                    </div>
                    <div class="form-group mb-4 col-md-12">
                        <label class="col-sm-12 col-form-label">Tipo Oficio: </label>                
                        <select class="form-control-sm col-md-12" name="tipoOficio" id="tipoOficio">
                        <option value="0">Seleccione un Tipo de Oficio</option>
                            <? foreach ($tipos as $tipo ) {?>
                            <option value="<?=$tipo->id?>"><?=$tipo->tipoOficio?></option>
                            <?}?>                 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="dvRespuesta1">
            <div class="ibox ibox-fullheight">
                <div class="ibox-head">
                    <div class="ibox-title">Capturar Oficio | Respuesta Oficio </div>
                </div> 
                <div class="ibox-body">                        
                    <form enctype="multipart/form-data" role="form"  id="frmRespuesta">
                    <div class="row">
                        <div class="form-group mb-4 col-md-12">
                            <label class="col-sm-2 col-form-label">Folio: </label> 
                            <input type="hidden" name="consecutivo" id="consecutivo" value="<?=$consecutivo?>">               
                            <input type="number" min="0" max="9999" name="folio"  id="folio" class="form-control-sm col-sm-1">
                            <label class="col-sm-1 col-form-label">Oficio Recibido: </label>               
                            <input type="text" min="0" max="9999" name="oficioRecibido"  id="oficioRecibido" class="form-control-sm col-sm-3">
                        </div>
                        <div class="form-group mb-4 col-md-12 ">
                            <label class="col-sm-2 col-form-label">Destinatario: </label>
                            <input type="text" required="true" name="destinatario" id="destinatario" placeholder="" class="form-control-sm col-md-6">
                        </div>
                        <div class="form-group mb-4 col-md-12 ">
                            <label class="col-sm-2 col-form-label">Cargo: </label>
                            <input type="text" required="true" name="cargo" id="cargo" placeholder="" class="form-control-sm col-md-6">
                        </div>
                        <div class="form-group mb-4 col-md-12 ">
                            <label class="col-sm-2 col-form-label">CCP: </label>
                            <input type="text" name="ccp" id="ccp" placeholder="" class="form-control-sm col-md-6">
                        </div>                                                   
                        <div class="form-group mb-4 col-sm-12 ">
                            <label class="col-sm-3 col-form-label">Redacción: </label>
                            <div class="col-sm-9">
                                <textarea required="true" id="summernote" placeholder="Redacción del Oficio" name="redaccion" data-plugin="summernote" data-air-mode="true">
                                </textarea>
                            </div>
                        </div>                         
                    </div>
                    </form>
                </div>           
                <div class="ibox-footer">
                    <button  id="btnCapturarRespuesta" type="btn" class="btn btn-success">
                        <i class="fa fa-save"></i> Capturar Oficio:
                    </button>
                   
                    <a class="btn btn-danger" href="<?=base_url()?>">Cancelar</a>
                </div>
            </div>
        </div>
        <!-- SEGUNDO FORMULARIO     -->
            <div class="col-md-9" id="dvRespuesta2">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-head">
                        <div class="ibox-title">Capturar Oficio | Cambio Resguardo </div>
                    </div> 
                    <div class="ibox-body">                        
                    <form enctype="multipart/form-data" role="form" id="form_newsletter">
                        <div class="row">
                            <div class="form-group mb-4 col-md-12 ">
                                <label class="col-sm-2 col-form-label">Resguardante: </label>
                                <input type="hidden" name="consecutivo" id="consecutivo1" value="">
                                <input type="hidden" name="tipo" id="tipo"> 
                                <input type="text" required="true" name="resguardante" id="resguardante" placeholder="" class="form-control-sm col-md-6">
                            </div>
                            <div class="form-group mb-4 col-md-12 ">
                                <label class="col-sm-2 col-form-label">Cargo: </label>
                                 <input type="text" name="cargo" id="cargo1" placeholder="" class="form-control-sm col-md-4">
                                
                            </div>
                            <div class="form-group mb-4 col-md-12 ">
                                <label class="col-sm-2 col-form-label">Adscripción: </label>
                                <input type="text" name="adscripcion" id="adscripcion" placeholder="" class="form-control-sm col-md-4">
                                <label class="col-sm-2 col-form-label">Extension: </label>
                                <input type="number" name="ext" id="ext1" placeholder="" class="form-control-sm col-md-1">
                            </div>                                                 
                            <div class="form-group mb-4 col-sm-12 ">
                                <label class="col-sm-3 col-form-label">Resguardo : </label>
                                <div  class="col-sm-12">
                                    <input type="text" name="equipo[]" id="equipo" placeholder="EQUIPO" class=" col-md-2">
                                    <input type="text" name="marca[]" id="marca" placeholder="MARCA" class="col-md-2">
                                    <input type="text" name="modelo[]" id="modelo" placeholder="MODELO" class="col-md-2">
                                    <input type="text" name="serie[]" id="serie" placeholder="SERIE" class="col-md-2">
                                    <input type="text" name="pesa[]" id="pesa" placeholder="PESA" class="col-md-2">
                                    <a id="nuevoResguardo" class="btn btn-sm btn-secondary">Agregar Equipo</a>
                                </div>                                                             
                            </div>
                            <div class="form-group mb-4 col-sm-12 "> 
                                
                                <table class="table table-bordered">
                                    <th>EQUIPO</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>SERIE</th>
                                    <th>PESA</th>
                                    <tbody id="resguardoNuevo"> 
                                    
                                    </tbody>  
                                </table>
                            </div>
                        </div>
                        <a class="btn btn-sm btn-warning" id="nuevoRegistro">Agregar Resguardante</a>
                        <div id="recipiente"></div>
                    </div>           
                    <div class="ibox-footer">
                    </form>
                         <button type="btn" id="btnCapturarResguardo" class="btn btn-success">
                            <i class="fa fa-save"></i> Capturar Oficio:
                        </button>
                        <a class="btn btn-danger" href="<?=base_url()?>">Cancelar</a>
                    </div>
                </div>
            </div>

            <!-- tercero -->

        <div class="col-md-9" id="dvRespuesta3">
            <div class="ibox ibox-fullheight">
                <div class="ibox-head">
                    <div class="ibox-title">Capturar Oficio | Compras </div>
                </div> 
                <div class="ibox-body">                        
                    <form enctype="multipart/form-data" role="form"  id="frmCompras">
                    <div class="row">
                        <div class="form-group mb-6 col-md-12">
                            <label class="col-sm-12 col-form-label">Atención a Oficio: </label>
                            <div class="mb-6 col-md-12">
                                <label class="radio radio-inline">
                                <input type="radio" id="e" name="solicitud" value="1" checked="">
                                <span class="input-span"></span>No</label>
                                <label class="radio radio-inline">
                                <input type="radio" id="e1" name="solicitud" value="2">
                                <span class="input-span"></span>Si</label>
                            </div>
                        </div>
                    <div id="atencion">
                        <div class="form-group mb-4 col-md-12">
                            <label class="col-sm-2 col-form-label">Folio: </label> 
                            <input type="hidden" name="consecutivo" id="consecutivo" value="<?=$consecutivo?>">               
                            <input type="number" min="0" max="9999" name="folio"  id="folio" class="form-control-sm col-sm-1">
                            <label class="col-sm-2 col-form-label">Oficio Recibido: </label>               
                            <input type="text" min="0" max="9999" name="oficioRecibido"  id="oficioRecibido" class="form-control-sm col-sm-3">
                        </div>
                        <div class="form-group mb-4 col-md-12 ">
                            <label class="col-sm-2 col-form-label">remitente: </label>
                            <input type="text" required="true" name="destinatario" id="destinatario" placeholder="" class="form-control-sm col-md-6">
                        </div>
                        <div class="form-group mb-4 col-md-12 ">
                            <label class="col-sm-2 col-form-label">Cargo: </label>
                            <input type="text" required="true" name="cargo" id="cargo" placeholder="" class="form-control-sm col-md-6">
                        </div>
                    </div>                                                   
                        <div class="form-group col-sm-12 ">
                            <label class="col-sm-12 col-form-label">Redacción: </label>
                            <textarea required="true" id="summernote1" class="form-control" placeholder="Redacción del Oficio" name="redaccion" ></textarea>
                        </div>                         
                    </div>
                    </form>
                </div>           
                <div class="ibox-footer">
                    <button  id="btnCapturarRespuesta" type="btn" class="btn btn-success">
                        <i class="fa fa-save"></i> Capturar Oficio:
                    </button>
                   
                    <a class="btn btn-danger" href="<?=base_url()?>">Cancelar</a>
                </div>
            </div>
        </div>


        </div> 
</section>

 <div class="modal fade" id="cerrar" role="dialog">
        <div class="modal-dialog col-md">
          <div class="modal-content">
            <div class="modal-body">
              <div class="icon" align="center">
                <i class="fa fa-spinner fa-spin" style="font-size:80px;"></i>
              </div>  

              <h4 align="center">Generando Oficio</h4>
              </div>
            
          </div>
        </div>
      </div>

<!-- /.content -->

<!-- /.content-wrapper -->


    <script>
        $(function() {
 $('#summernote, #summernote1').summernote({
                  toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view',['fullscreen','codeview']],
                ['table', ['table']],
                ['height', ['height']]
              ],
           
            height: 300
            });
        })
            
    </script>


<script>
    $("#tipoOficio").change(function () {
        tipo = $("#tipoOficio").val();
        console.log(tipo);

        $("#tipo").val(tipo);
        if (tipo == 0) {
            $('#dvRespuesta1, #dvRespuesta2, #dvRespuesta3, #atencion').hide('fast');
         
        }
        if (tipo == 1) {
            $('#dvRespuesta2, #dvRespuesta3').hide('fast');
            $("#dvRespuesta1").show('fast');
                
        }
        if (tipo == 2) {           
            $("#dvRespuesta1, #dvRespuesta3").hide('fast');
            $("#dvRespuesta2").show('fast');
        }
        if (tipo == 3) {           
            $("#dvRespuesta1, #dvRespuesta2").hide('fast');
            $("#dvRespuesta3").show('fast');
        }    

     })
    $('#oficio').change( function() {
        valor = $("#oficio").val();
        console.log('oficio numero: ' + valor);
        $("#consecutivo, #consecutivo1").val(valor);
        
    })
</script> 
 
<script>

    $( function (){
        $("#atencion").hide('fast');
    })
    $("#e1").change(function () {   
        $('#atencion').show('fast');
    });
    $("#e").change(function () {   
        $("#atencion").hide('fast');
    });
</script>
   
<script>
    $( function (){
        i=0;
        c=0;
        valorLocal = 0;
        var datos = [];
        var resguardos = [];

        $("#dvRespuesta1 , #dvRespuesta2, #alerta1, #dvRespuesta3").hide('fast');
        $("#nuevoRegistro").click( function () {
            console.log(i);
            cargo = $("#cargo1").val();
            console.log(cargo);
            datos[i] = {
              resguardante: $("#resguardante").val(),
              cargo: $("#cargo1").val(),
              adscripcion: $("#adscripcion").val(),
              ext: $("#ext1").val(),
              resguardo: resguardos
            }

            $("#resguardante").val("");
            $("#cargo1").val("");
            $("#adscripcion").val("");
            $("#ext1").val(""); 
            console.log(datos);
            //reinicio de las variables de los resguardos
            resguardos = [];
            c=0;
            // aumento en el contador de los resguardantes
            i++;            

       }) 

        $("#nuevoResguardo").click( function () {

            resguardos[c] = {
                equipo: $("#equipo").val(),
                marca: $("#marca").val(),
                modelo: $("#modelo").val(),
                serie: $("#serie").val(),
                pesa: $("#pesa").val()
            };

             input = '<tr><td>'+ $("#equipo").val()+'</td><td>'+ $("#marca").val()+'</td><td>'+ $("#modelo").val()+'</td><td>'+ $("#serie").val()+'</td><td>'+ $("#pesa").val()+'</td> </tr>';

            $("#equipo").val("");
            $("#marca").val("");
            $("#modelo").val("");
            $("#serie").val("");
            $("#pesa").val("");

            console.log(resguardos);
            c++;
            console.log(c);
           
            $("#resguardoNuevo").append(input);
         
        })

        $("#btnCapturarResguardo").click( function() {            
            console.log("entre" + valorLocal);
            console.log(datos);
            if (valorLocal == 0) {
                datos.push($("#oficio").val());
            }            
            valorLocal= 1;
            console.log(datos);
            $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?=base_url()?>index.php/oficios/vista_previa_resguardo',
            data: {'datos' : JSON.stringify(datos)},
              }).done(function(respuesta){
               if (respuesta > 0) {
                window.location.href = "<?=base_url()?>index.php/oficios/genera_PDF/"+respuesta;
               }
              })
        })
    })
</script>
<script>
    $("#btnCapturarRespuesta").click( function() {  
        datos = $("#frmRespuesta").serializeArray();
        console.log(datos);          
        $.ajax({       
        type: "POST",
        dataType: 'json',
        url: '<?base_url()?>index.php?/oficios/capturar_oficio',
        data: datos,
        }).done(function(respuesta){
            if (respuesta > 0) {
            window.location.href = "<?=base_url()?>index.php/oficios/genera_PDF/"+respuesta;
            }
            if (respuesta == 0) {
                $("#alerta1").show('fast');
            }
        })
    })
</script> 


