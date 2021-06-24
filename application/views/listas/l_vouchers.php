
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="page-heading">
    <h1 class="page-title">Unidad de Protección a la Propiedad Intelectual</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/incidencias"><i class="la la-home font-20"></i></a>
      </li>
      <li class="breadcrumb-item">UPPI</li>
    </ol>
    <br>
    
    <a href="<?=base_url()?>" class="btn btn-blue btn-icon-only btn-lg"><i class="fa fa-arrow-left"></i></a>

    <?                
        $accesoUsr = $this->m_seguridad->acceso_modulo(3);
        if($accesoUsr != 0)
          {
    ?>
    <a href="<?=base_url()?>index.php?/uppi/nuevo_registro" class="btn btn-warning btn-icon-only btn-lg "><span class="fa fa-plus"></span></a>
    <?}?>
  </div>
  
  <section class="page-content fade-in-up">
    <div class="ibox">
      <div class="ibox-body">
        <div class="flexbox mb-4">
          <div class="flexbox">
            <div class="btn-group bootstrap-select show-tick form-control" style="width: 150px;"></div>
          </div>
          <div class="input-group-icon input-group-icon-left mr-3">
            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
            <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Buscar ...">
          </div>
        </div>
        <div class="table-responsive row">
          <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <table class="table table-bordered table-hover dataTable no-footer dtr-inline" id="datatable" role="grid" aria-describedby="datatable_info" >
              <thead class="thead-default thead-lg">
                <tr>
                  <th>N°</th>
                  <th>ISBN ASIGNADO</th>
                  <th>DEPENDENCIA SOLICITANTE</th>
                  <th>EXPEDIENTE INTERNO</th>
                  <th>FECHA</th>
                  <th>ADJUNTO</th>
             
                </tr>
              </thead>
              <tbody>
              <? foreach ($bouchers as $data)
                {
               ?>
                <tr class="">
                  <td ><?=$data->consecutivo?></td>
                  <td ><?=$data->isbn?></td>
                  <td ><?=$data->dependencia?></td>
                  <td ><?=$data->expediente?></td>
                  <td ><?=$data->fecha?></td>
                  <td align="center">
                    <a class="btn btn-xs btn-warning" href="<?=base_url()?>src/uppi/boucher/<?=$data->comprobante?>" target="_blank" title="VER COMPROBANTE"><i class="fa fa-eye"></i> COMPROBANTE</a>
                  </td>
                </tr>
              <?}?>
              </tbody>
            </table>
            
            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"></div>
          </div>
        </div>
      </div>
    </div>
  </section>





 <script>
        $(function() {
            $('#datatable').DataTable({
                pageLength: 10,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });
            var table = $('#datatable').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(2).search($(this).val()).draw();
            });
        });
    </script>

