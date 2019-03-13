<div class="content-wrapper">
   <!-- Content Header (Page header) -->

          <!-- Main content -->
 <div class="page-content fade-in-up">
                <div class="flexbox-b mb-5">
                    <span class="mr-4 static-badge badge-pink"><i class="ti-search"></i></span>
                    <div>
                        <h5 class="font-strong">Consulta de Marcos</h5>
                        <div class="text-light"></div>
                    </div>
                </div>
                <div class="input-group-icon input-group-icon-left input-group-lg mb-4 col-sm-6">
                    <span class="input-icon input-icon-right"><i class="ti-search"></i></span>
                    <input class="form-control form-control-air font-light font-poppins border-0" id="busqueda" name="busqueda" type="text" placeholder="BUSCAR..." style="box-shadow:0 3px 6px rgba(10,16,20,.15);">
                </div>

                <div class="ibox col-sm-12">
                <div class="ibox-body">
                    <h5 class="font-strong mb-4">Articulos encontrados:</h5>
                    <div id="tablaServicios"></div>
                               
                </div>
                </div>


    </section>
           

<script>
    $("#busqueda").change(function () {
        busqueda = $("#busqueda").val();
        datos = { busqueda : busqueda };

        $.ajax({
        type: "POST",
        dataType: 'json',
        url: '<?=base_url()?>index.php/mj/buscar',
        data: datos,
          }).done(function(respuesta){
            $('#tablaServicios').html(respuesta);
          })
     })
</script> 


