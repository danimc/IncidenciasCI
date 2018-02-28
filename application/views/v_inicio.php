 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header">
            <h1>
              Panel de control
              <small>Pagina principal</small>
            </h1><br>
              <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              </ol>
    </section>

          <!-- Main content -->
    <section class="content">
            <a href="<?=base_url()?>index.php?/ticket/nuevo_ticket">
              <div class="col-md-3 col-sm-6 col-xs-12">           
                <div class="info-box bg-orange-active">
                  <span class="info-box-icon"><i class="fa fa-ticket"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">Nuevo Ticket</span>
                    <!-- The progress section is optional -->
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      Reporte un nuevo Incidente
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
            </a>

            <a href="<?=base_url()?>index.php?/ticket/lista_tickets">
              <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box bg-yellow">
                  <span class="info-box-icon"><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">
                      Mis Tickets                       
                    </span>
                    <!-- The progress section is optional -->
                    <div title="porcentaje de tickets cerrados" class="progress">
                      <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                      Revise todos los Tickets
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
            </a>
          </section>
        </div>

