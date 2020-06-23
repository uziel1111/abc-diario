  <section class="main-area">
  <div class="container">
  <div class="card mb-3 card-style-1">
  <div class="card-header card-1-header bg-light">Lista de Escuelas</div>
  <div class="card-body">
  <?php if($cct=="") { ?>
    <div class="row">
      <div class="col-12 col-sm-12">
        <center><?= $total_escuelas ?> escuelas encontradas del municipio: <?= $municipio ?>, nivel: <?= $nivel ?> y sotenimiento: <?= $sostenimiento ?></center>
      </div>
    </div>
  <br>
  <div class="row">
    <div class="col-md-9">
      <label>Conozca los datos de matricula maestros y desempeño de cada escuela haciendo clic en su CCT.</label>
    </div>
    <div class="col-md-3">
      <?= form_open('Reportes/escuelas') ?>
      <?= form_hidden('busquedalista_municipio_reporte', $idmunicipio) ?>
      <?= form_hidden('busquedalista_nivel_reporte', $idnivel) ?>
      <?= form_hidden('busquedalista_sostenimiento_reporte', $idsostenimiento) ?>
      <?= form_hidden('busquedalista_nombreescuela_reporte', $nombre_escuela, array('id' => 'busquedalista_nombreescuela_reporte')) ?>
      <?php
        $data = array(
                'name' => 'btn_busquedaxlista_xlsx',
                'id' => 'btn_busquedaxlista_xlsx',
                'value' => 'true',
                'type' => 'submit',
                'class'=>'btn btn-primary',
                'content' => 'Generar Excel',
                'data-toggle' => "tooltip",
                'data-placement' => "top",
                'title' => 'Exportar los resultados'
              );
        echo form_button($data);
      ?>
      <?= form_close() ?>
  </div><!-- col-md-1 -->
</div><!-- row -->
<?php } ?>

<div class="row mt-3">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
      <div id="table_escuelas">
      <div class="table-responsive">
      <table class="table table-style-1 table-striped table-hover">
        <thead class="bg-info">
          <tr>
            <th scope="col">CCT</th>
            <th scope="col">Turno</th>
            <th scope="col">Nombre</th>
            <th scope="col">Nivel</th>
            <th scope="col">Municipio</th>
            <th scope="col">Domicilio</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($escuelas as $escuela) { ?>
            <tr data-idcentrocfg="<?= $escuela['idcentrocfg'] ?>">
              <td>
                <?= $escuela['cct'] ?>
              </td>
              <td ><?=$escuela['turno']?></td>
              <td><?=$escuela['nombre']?></td>
              <td><?=$escuela['nivel']?></td>
              <td><?=$escuela['municipio']?></td>
              <td><?=$escuela['domicilio']?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div><!-- table-responsive -->
    </div>
  </div><!-- col-12 -->
  </div><!-- row -->
</div>
</div>
</div><!-- container-fluid -->
</section>

<script src="<?= base_url('assets/js/escuela/lista_escuelas.js') ?>"></script> 

