<hr />
<div class="row">
  <div id="dv_flot_est" class="col-12">
    <div id="filtros_est_gen">
      <div class="alert alert-success text-center" role="alert">
        Municipio: <span class="font-weight-bold"><?= $municipio ?></span>, Nivel: <span class="font-weight-bold"><?= $nivel ?></span>, Sostenimiento: <span class="font-weight-bold"><?= $sostenimiento ?></span>, Modalidad: <span class="font-weight-bold"><?= $modalidad ?></span>, Ciclo escolar: <span class="font-weight-bold"><?= $ciclo ?></span>.
      </div>
      <div class="col-12 mt-2 mb-3 text-center">
        <?= form_open('Reportes/est_generales_xmuni') ?>
        <?= form_hidden('idmunicipio', $idmunicipio) ?>
        <?= form_hidden('idnivel', $idnivel) ?>
        <?= form_hidden('idsostenimiento', $idsostenimiento) ?>
        <?= form_hidden('idmodalidad', $idmodalidad) ?>
        <?= form_hidden('idciclo', $idciclo) ?>
        <?php
        $data = array(
          'id' => 'btn_genera_excel_est_g_xmuni',
          'value' => 'true',
          'type' => 'submit',
          'class' => 'btn btn-primary',
          'content' => '<i class="fas fa-file-excel"></i> Exportar los resultados',
          'data-toggle' => "tooltip",
          'data-placement' => "top",
          'title' => 'Exportar los resultados'
        );
        echo form_button($data);
        ?>
        <?= form_close() ?>

        <button class="btn btn-success btn-block" type="button" id="btn_prueba">xxxxxxxx</button>
      </div><!-- col-md-1 -->
    </div>
  </div>
</div>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Alumnos</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="3" class="text-center align-middle">Nivel educativo</th>
                <th colspan="21" class="text-center">Alumnos</th>
              </tr>
              <tr>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
                <th>1°</th>
                <th>2°</th>
                <th>3°</th>
                <th>4°</th>
                <th>5°</th>
                <th>6°</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($alumnos as $row) {
                if ($row['sostenimiento'] == 'total' && $row['modalidad'] == 'total') {
                  if ($row['idnivel'] == $idnivel) { ?>
                    <tr class="parent bg-info text-light font-weight-bold" id="<?= str_replace(' ', '', $row['nivel']) ?>">
                    <?php  } else { ?>
                    <tr class="parent" id="<?= str_replace(' ', '', $row['nivel']) ?>">
                    <?php  } ?>

                    <td class="pl-1"><img style="width:12px;" class="mr-5" src="<?= base_url('assets/img/expand-button.svg') ?>"><?= $row['nivel'] ?></td>
                    <?php } else if ($row['sostenimiento'] != 'total' && $row['modalidad'] == 'total') {
                    if ($row['idnivel'] == $idnivel && $row['idsostenimiento'] == $idsostenimiento) { ?>
                    <tr class="child-<?= str_replace(' ', '', $row['nivel']) ?> child-parent bg-secondary text-light font-weight-bold" id="<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>">
                    <?php  } else { ?>
                    <tr class="child-<?= str_replace(' ', '', $row['nivel']) ?> child-parent hide-ini" id="<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>">
                    <?php  } ?>
                    <td class="pl-4"><img style="width:12px" class="mr-5" src="<?= base_url("assets/img/expand-button.svg") ?>"><?= $row['sostenimiento'] ?></td>
                    <?php } else if ($row['sostenimiento'] != 'total' && $row['modalidad'] != 'total') {
                    if ($row['idnivel'] == $idnivel && $row['idsostenimiento'] == $idsostenimiento && $row['idmodalidad'] == $idmodalidad) { ?>
                    <tr class="nieto-<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>  class-hide-<?= str_replace(' ', '', $row['nivel']) ?> bg-primary text-light font-weight-bold">
                    <?php  } else { ?>
                    <tr class="nieto-<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?> class-hide-<?= str_replace(' ', '', $row['nivel']) ?> hide-ini">
                    <?php  } ?>
                    <td class="pl-5"><?= $row['modalidad'] ?></td>
                <?php }
                  ($row['alumn_m_t'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumn_m_t']) . '</td>';
                  ($row['alumn_h_t'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumn_h_t']) . '</td>';
                  ($row['alumn_t_t'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumn_t_t']) . '</td>';
                  ($row['alumnos1'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumnos1']) . '</td>';
                  ($row['alumnos2'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumnos2']) . '</td>';
                  ($row['alumnos3'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumnos3']) . '</td>';
                  ($row['alumnos4'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumnos4']) . '</td>';
                  ($row['alumnos5'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumnos5']) . '</td>';
                  ($row['alumnos6'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['alumnos6']) . '</td>';
                  // echo "</tr>";
                } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
          </div>
        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>
</div>
<br>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Personal Docente</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="2" class="text-center align-middle">Nivel educativo</th>
                <th colspan="3" class="text-center align-middle">Docentes</th>
                <th colspan="3" class="text-center align-middle">Directivo con grupo</th>
                <th colspan="3" class="text-center align-middle">Directivo sin grupo</th>
              </tr>
              <tr>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($docentes as $row) {
                if ($row['sostenimiento'] == 'total' && $row['modalidad'] == 'total') {
                  if ($row['idnivel'] == $idnivel) { ?>
                    <tr class="parent bg-info text-light font-weight-bold" id="<?= str_replace(' ', '', $row['nivel']) ?>">
                    <?php } else { ?>
                    <tr class="parent" id="<?= str_replace(' ', '', $row['nivel']) ?>">
                    <?php } ?>
                    <td class="pl-1"><img style="width:12px" class="mr-5" src="<?= base_url('assets/img/expand-button.svg') ?>"><?= $row['nivel'] ?></td>
                    <?php } else if ($row['sostenimiento'] != 'total' && $row['modalidad'] == 'total') {
                    if ($row['idnivel'] == $idnivel && $row['idsostenimiento'] == $idsostenimiento) { ?>
                    <tr class="child-<?= str_replace(' ', '', $row['nivel']) ?> child-parent bg-secondary text-light font-weight-bold" id="<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>">
                    <?php  } else { ?>
                    <tr class="child-<?= str_replace(' ', '', $row['nivel']) ?> child-parent hide-ini" id="<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>">
                    <?php  } ?>
                    <td class="pl-4"><img style="width:12px" class="mr-5" src="<?= base_url('assets/img/expand-button.svg') ?>"><?= $row['sostenimiento'] ?></td>
                    <?php } elseif ($row['sostenimiento'] != 'total' && $row['modalidad'] != 'total') {
                    if ($row['idnivel'] == $idnivel && $row['idsostenimiento'] == $idsostenimiento && $row['idmodalidad'] == $idmodalidad) { ?>
                    <tr class="nieto-<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>  class-hide-<?= str_replace(' ', '', $row['nivel']) ?> bg-primary text-light font-weight-bold">
                    <?php  } else { ?>
                    <tr class="nieto-<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>  class-hide-<?= str_replace(' ', '', $row['nivel']) ?> hide-ini">
                    <?php  } ?>
                    <td class="pl-5"><?= $row['modalidad'] ?></td>
                <?php }
                  ($row['docentes_m'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['docentes_m']) . '</td>';
                  ($row['docentes_h'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['docentes_h']) . '</td>';
                  ($row['docentes_t_g'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['docentes_t_g']) . '</td>';
                  ($row['directivo_m_congrup'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['directivo_m_congrup']) . '</td>';
                  ($row['directivo_h_congrup'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['directivo_h_congrup']) . '</td>';
                  ($row['directivo_t_congrup'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['directivo_t_congrup']) . '</td>';
                  ($row['directivo_m_singrup'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['directivo_m_singrup']) . '</td>';
                  ($row['directivo_h_singrup'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['directivo_h_singrup']) . '</td>';
                  ($row['directivo_t_singrup'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['directivo_t_singrup']) . '</td>';
                } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
          </div>
        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>
</div>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Infraestructura</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="2" class="text-center align-middle">Nivel educativo</th>
                <th rowspan="2" class="text-center align-middle">Escuelas</th>
                <th colspan="8" class="text-center align-middle">Grupos</th>
              </tr>
              <tr>
                <th>1°</th>
                <th>2°</th>
                <th>3°</th>
                <th>4°</th>
                <th>5°</th>
                <th>6°</th>
                <th class="text-center align-middle">Multigrado</th>
                <th class="text-center">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($infraestructura as $row) {
                if ($row['sostenimiento'] == 'total' && $row['modalidad'] == 'total') {
                  if ($row['idnivel'] == $idnivel) { ?>
                    <tr class="parent bg-info text-light font-weight-bold" id="<?= str_replace(' ', '', $row['nivel']) ?>">
                    <?php  } else { ?>
                    <tr class="parent" id="<?= str_replace(' ', '', $row['nivel']) ?>">
                    <?php  } ?>
                    <td class="pl-1"><img style="width:12px" class="mr-5" src="<?= base_url('assets/img/expand-button.svg') ?>"><?= $row['nivel'] ?></td>
                    <?php } else if ($row['sostenimiento'] != 'total' && $row['modalidad'] == 'total') {
                    if ($row['idnivel'] == $idnivel && $row['idsostenimiento'] == $idsostenimiento) { ?>
                    <tr class="child-<?= str_replace(' ', '', $row['nivel']) ?> child-parent bg-secondary text-light font-weight-bold" id="<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>">
                    <?php  } else { ?>
                    <tr class="child-<?= str_replace(' ', '', $row['nivel']) ?> child-parent hide-ini" id="<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>">
                    <?php  } ?>
                    <td class="pl-4"><img style="width:12px" class="mr-5" src="<?= base_url("assets/img/expand-button.svg") ?>"><?= $row['sostenimiento'] ?></td>
                    <?php } else if ($row['sostenimiento'] != 'total' && $row['modalidad'] != 'total') {
                    if ($row['idnivel'] == $idnivel && $row['idsostenimiento'] == $idsostenimiento && $row['idmodalidad'] == $idmodalidad) { ?>
                    <tr class="nieto-<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>  class-hide-<?= str_replace(' ', '', $row['nivel']) ?> bg-primary text-light font-weight-bold">
                    <?php  } else {  ?>
                    <tr class="nieto-<?= str_replace(' ', '', $row['nivel']) . $row['sostenimiento'] ?>  class-hide-<?= str_replace(' ', '', $row['nivel']) ?> hide-ini">
                    <?php } ?>
                    <td class="pl-5"><?= $row['modalidad'] ?></td>
                <?php }

                  ($row['nescuelas'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['nescuelas']) . '</td>';
                  ($row['grupos_1'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_1']) . '</td>';
                  ($row['grupos_2'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_2']) . '</td>';
                  ($row['grupos_3'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_3']) . '</td>';
                  ($row['grupos_4'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_4']) . '</td>';
                  ($row['grupos_5'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_5']) . '</td>';
                  ($row['grupos_6'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_6']) . '</td>';
                  ($row['grupos_multi'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_multi']) . '</td>';
                  ($row['grupos_t'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_t']) . '</td>';
                } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911. </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="dv_tablas_estmuni">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Asistencia</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th class="text-center align-middle">Nivel</th>
                <th class="text-center align-middle">Cobertura</th>
                <th class="text-center align-middle">Absorción</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($asistencia as $row) { ?>
                <tr>
                  <td><?= $row['nivel'] ?></td>
                  <td style="text-align: center;"><?= $row['cobertura'] ?>%</td>
                  <td style="text-align: center;"><?= $row['absorcion'] ?>%</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
          </div>
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Permanencia</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th class="text-center align-middle">Nivel</th>
                <th class="text-center align-middle">Retención</th>
                <th class="text-center align-middle">Aprobación</th>
                <th class="text-center align-middle">Eficiencia Terminal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($permanencia as $row) { ?>
                <tr>
                  <td><?= $row['nivel'] ?></td>
                  <td style="text-align: center;"><?= $row['retencion'] ?>%</td>
                  <td style="text-align: center;"><?= $row['aprobacion'] ?>%</td>
                  <td style="text-align: center;"><?= ($row['et'] == '0.00') ? print 'N/D' : print $row['et'] . '%' ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
            <div id="">N/D : Dato no disponible</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Aprendizaje</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="2" class="text-center align-middle">Resultados de la prueba Planea</th>
                <th colspan="5" class="text-center align-middle">Lenguaje y Comunicación</th>
                <th colspan="5" class="text-center align-middle">Matemáticas</th>
              </tr>
              <tr>
                <th colspan="4" class="text-center align-middle">Nivel de dominio</th>
                <th rowspan="2" class="text-center align-middle">Alumnos que superaron el nivel I</th>
                <th colspan="4" class="text-center align-middle">Nivel de dominio</th>
                <th rowspan="2" class="text-center align-middle">Alumnos que superaron el nivel I</th>
              </tr>
              <tr>
                <th class="text-center align-middle">Nivel</th>
                <th class="text-center align-middle">I<br><sub>Insuficiente</sub></th>
                <th class="text-center align-middle">II<br><sub>Elemental</sub></th>
                <th class="text-center align-middle">III<br><sub>Bueno</sub></th>
                <th class="text-center align-middle">IV<br><sub>Excelente</sub></th>
                <th class="text-center align-middle">I<br><sub>Insuficiente</sub></th>
                <th class="text-center align-middle">II<br><sub>Elemental</sub></th>
                <th class="text-center align-middle">III<br><sub>Bueno</sub></th>
                <th class="text-center align-middle">IV<br><sub>Excelente</sub></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($aprendizaje as $row) { ?>
                <tr>
                  <td><?= $row['nivel'] ?></td>
                  <td style="text-align: center;"><?= ($row['ni_lyc']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['nii_lyc']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['niii_lyc']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['niv_lyc']) . '%' ?></td>
                  <td style="text-align: center;"><?= (intval($row['nii_lyc']) + intval($row['niii_lyc']) + intval($row['niv_lyc'])) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['ni_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['nii_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['niii_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['niv_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= (intval($row['nii_mat']) + intval($row['niii_mat']) + intval($row['niv_mat'])) . '%' ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: SEP Federal.</div>
          </div>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Rezago Educativo</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th>Inasistencia escolar</th>
                <th colspan="3">Población total</th>
                <th colspan="3">Población que no asiste a la escuela</th>
              </tr>
              <tr>
                <th id="rezago">Población por grupo de edad<br> que no asiste a la escuela</th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rezago as $row) { ?>
                <tr>
                  <td>3 a 14 años</td>
                  <td><?= number_format($row['p3A14_ptotal_h']) ?></td>
                  <td><?= number_format($row['p3A14_ptotal_m']) ?></td>
                  <td><?= number_format($row['p3A14_ptotal_h'] + $row['p3A14_ptotal_m']) ?></td>
                  <td><?= number_format($row['p3A14_noa_h']) ?></td>
                  <td><?= number_format($row['p3A14_noa_m']) ?></td>
                  <td><?= number_format($row['p3A14_noa_m'] + $row['p3A14_noa_h']) ?></td>
                </tr>
                <tr>
                  <td>12 a 14 años</td>
                  <td><?= number_format($row['p12A14ptotal_h']) ?></td>
                  <td><?= number_format($row['p12A14ptotal_m']) ?></td>
                  <td><?= number_format($row['p12A14ptotal_h'] + $row['p12A14ptotal_m']) ?></td>
                  <td><?= number_format($row['p12A14noa_h']) ?></td>
                  <td><?= number_format($row['p12A14noa_m']) ?></td>
                  <td><?= number_format($row['p12A14noa_h'] + $row['p12A14noa_m']) ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: INEGI</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded text-muted">Analfabetismo</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th>Población</th>
                <th><i class="fa fa-male"></i></th>
                <th><i class="fa fa-female"></i></th>
                <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($analfabetismo as $row) { ?>
                <tr>
                  <td>Mayor de 15 años que no saben leer y escribir</td>
                  <td><?= number_format($row['analfabetismo_mayor15_h']) ?></td>
                  <td><?= number_format($row['analfabetismo_mayor15_m']) ?></td>
                  <td><?= number_format($row['analfabetismo_mayor15_m'] + $row['analfabetismo_mayor15_h']) ?></td>
                </tr>
              <?php  } ?>
            </tbody>
          </table>
          <div class="pie_tabla">
            <div id="fuentes_pie">Fuente: INEGI</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
</div>

<script>
  $(function() {

    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      var position = 300;
      if (scroll > position) {
        $("#dv_flot_est").addClass("dv_flotante");
      } else {
        $("#dv_flot_est").removeClass("dv_flotante");
      }
    });

    $(".hide-ini").css("display", "none");

    $('tr.parent').css("cursor", "pointer").attr("title", "Click para expander/contraer").click(function() {
      if ($(this).siblings('.child-' + this.id).is(":visible")) {
        $(this).find('img').css("transform", "rotate(360deg)");
        $(this).siblings('.child-' + this.id).fadeOut('500');
        $(this).siblings('.child-' + this.id).siblings('.class-hide-' + this.id).fadeOut('500');
      } else {
        $(this).find('img').css("transform", "rotate(270deg)");
        $(this).siblings('.child-' + this.id).fadeIn('500');
      }
    });

    $('tr.child-parent').css("cursor", "pointer").attr("title", "Click para expander/contraer").click(function() {
      if ($(this).siblings('.nieto-' + this.id).is(":visible")) {
        $(this).find('img').css("transform", "rotate(360deg)");
        $(this).siblings('.nieto-' + this.id).fadeOut('500');
        $(this).siblings('.nieto-' + this.id).siblings('.class-hide-' + this.id).fadeOut('500');
      } else {
        $(this).find('img').css("transform", "rotate(270deg)");
        $(this).siblings('.nieto-' + this.id).fadeIn('500');
      }
    });

    $('tr.child-nieto').css("cursor", "pointer").attr("title", "Click para expander/contraer").click(function() {
      if ($(this).siblings('.bisnieto-' + this.id).is(":visible")) {
        $(this).find('img').css("transform", "rotate(360deg)");
        $(this).siblings('.bisnieto-' + this.id).fadeOut('500');
      } else {
        $(this).find('img').css("transform", "rotate(270deg)");
        $(this).siblings('.bisnieto-' + this.id).fadeIn('500');
      }
    });
  });
</script>
