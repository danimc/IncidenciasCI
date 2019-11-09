
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="page-heading">
    <h1 class="page-title">Lista de Usuarios</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index-2.html"><i class="la la-home font-20"></i></a>
      </li>
      <li class="breadcrumb-item">Usuarios</li>
      <li class="breadcrumb-item">Lista de usuarios</li>
    </ol>
    <br>
    
    <a href="<?=base_url()?>" class="btn btn-blue btn-icon-only btn-lg"><i class="fa fa-arrow-left"></i></a>
    <a href="<?=base_url()?>index.php?/usuario/nuevo_usuario" class="btn btn-warning btn-icon-only btn-lg "><span class="fa fa-plus"></span></a>
    
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
                  <th>Codigo</th>
                  <th>username</th>
                  <th>Nombre</th>
                  <th>Unidad</th>
                  <th>puesto</th>
                  <th>contacto</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <? foreach ($usuario as $user)
                {
               ?>
                <tr class="">
                  <td ><?=$user->codigo?></td>
                  <td ><?=$user->usuario?></td>
                  <td ><?=$user->nombre . ' ' . $user->apellido?></td>
                  <td ><?=$user->nombre_dependencia?></td>
                  <td ><?=$user->puesto?></td>
                  <td align="center" ><?=$user->extension?></td>
                  <td align="center">
                    <a class="btn btn-xs btn-warning" href="<?=base_url()?>index.php?/usuario/perfil/<?=$user->codigo?>" title="Revisa y edita la Información del Usuario"><i class="fa fa-pencil"></i> Editar</a>
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

