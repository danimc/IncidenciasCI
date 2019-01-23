
<div class="content-wrapper">
    <div id="mensaje"></div>
<section class="content-header">
        <h1>Busquedas
            <small>para Marcos Juridicos</small>
          </h1><br>
          <ol class="breadcrumb">
            <li><a href="/index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Marcos Juridicos</li><li>Busqueda</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">     
          
              <div class="box-body">
                <div class="form-group">
                  <label for="busqueda" class="col-sm-2 control-label">Busqueda</label>
                  <div class="col-sm-8">
                    <form class="form-horizontal" id="frmBuscar" >
                      <input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="busqueda por palabras clave">
                    </form>
                  </div> 
                  <button id="btnBuscar" type="submit" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>                 
                </div>               
              </div>       
          <div class="col-sm-10">
            <div class="box">
              <div class="box-header">
                <label>Resultados:</label>
              </div>
              <div class="box-body">
                <div id="resultados"></div>
              </div>
              
            </div>
          </div>    
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <script>
    $("#btnBuscar").click(function()
    {
      console.log("entrando en la funcion");
       var formulario = $("#frmBuscar").serializeArray();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: "<?=base_url()?>index.php?/mj/buscar",
      data: formulario,
        }).done(function(respuesta){
         
            $('#resultados').html(respuesta.mensaje);
                 $("#example1").DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
            });
          });
      });

      </script>

       <script src="<?=base_url()?>src/js/wys.js"></script>
       <script type="text/javascript">
         $('#chat').wysihtml5();
       </script>