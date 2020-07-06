  <section class="main-area">
    <div class="container">
      <hr>
      <div class="card mb-3 card-style-1">
        <div class="card-header card-1-header bg-light">Lista de Escuelas</div>
        <div class="card-body">
          <?php if ($cct == "") { ?>
            <div class="alert alert-success text-center" role="alert">
              <div class="row">
                <div class="col-12 col-sm-12 text-center">
                  <span class="font-weight-bold"><?= $total_escuelas ?></span> escuelas encontradas del municipio: <span class="font-weight-bold"><?= $municipio ?></span>, nivel: <span class="font-weight-bold"><?= $nivel ?></span> y sotenimiento: <span class="font-weight-bold"><?= $sostenimiento ?></span>
                  <br>
                  <span class="font-weight-bold">Conozca los datos de matricula maestros y desempeño de cada escuela haciendo clic en su CCT.</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col text-center">
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
                  'class' => 'btn btn-primary',
                  'content' => '<i class="fas fa-file-excel"></i> General Excel',
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
                      <?php foreach ($escuelas as $escuela) { ?>
                        <tr data-idcentrocfg="<?= $escuela['idcentrocfg'] ?>">
                          <td class="font-weight-bold text-center">
                            <?= $escuela['cct'] ?>
                          </td>
                          <td><?= $escuela['turno'] ?></td>
                          <td><?= $escuela['nombre'] ?></td>
                          <td><?= $escuela['nivel'] ?></td>
                          <td><?= $escuela['municipio'] ?></td>
                          <td><?= $escuela['domicilio'] ?></td>
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