
<div class="row">
  <div id="dv_flot_est" class="col-12">
    <div id="filtros_est_gen">
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
      </div><!-- col-md-1 -->
    </div>
  </div>
</div>
<div class="row" id="dv_alumnos_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="bg-success text-light card-header rounded">Alumnos</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="3" class="align-middle">Nivel educativo</th>
                <th colspan="19" class="text-center">Alumnos</th>
              </tr>
              <tr>
                <th><center><i class="fa fa-female text-secondary"></i><i class="fa fa-male text-primary"></i></center></th>
                <th><center>1°</center></th>
                <th><center>2°</center></th>
                <th><center>3°</center></th>
                <th><center>4°</center></th>
                <th><center>5°</center></th>
                <th><center>6°</center></th>
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
                  ($row['alumn_t_t'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumn_t_t']) . '</center></td>';
                  ($row['alumnos1'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumnos1']) . '</center></td>';
                  ($row['alumnos2'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumnos2']) . '</center></td>';
                  ($row['alumnos3'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumnos3']) . '</center></td>';
                  ($row['alumnos4'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumnos4']) . '</center></td>';
                  ($row['alumnos5'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumnos5']) . '</center></td>';
                  ($row['alumnos6'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['alumnos6']) . '</center></td>';
                  // echo "</tr>";
                } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
          </div>
        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>
</div>
<br>
<div class="row" id="dv_personal_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Personal Docente</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="2" class="align-middle">Nivel educativo</th>
                <th colspan="1" class="text-center align-middle">Docentes</th>
              </tr>
              <tr>
                <th><center><i class="fa fa-female text-secondary"></i><i class="fa fa-male text-primary"></i></center></th>
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
                  ($row['docentes_t_g'] == 0) ? print '<td><center>-</center></td>' : print '<td><center>' . number_format($row['docentes_t_g']) . '</center></td>';
                } ?>
            </tbody>
          </table>

          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
          </div>
        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>
</div>
<div class="row" id="dv_infraestructura_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Infraestructura</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th rowspan="2" class=" align-middle">Nivel educativo</th>
                <th rowspan="2" class="text-center align-middle">Escuelas</th>
                <th colspan="6" class="text-center align-middle">Grupos</th>
                <th colspan="2" class="text-center align-middle"></th>
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

                  ($row['nescuelas'] == 0) ? print '<td>-</td>' : print '<td class="text-center align-middle">' . number_format($row['nescuelas']) . '</td>';
                  ($row['grupos_1'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_1']) . '</td>';
                  ($row['grupos_2'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_2']) . '</td>';
                  ($row['grupos_3'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_3']) . '</td>';
                  ($row['grupos_4'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_4']) . '</td>';
                  ($row['grupos_5'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_5']) . '</td>';
                  ($row['grupos_6'] == 0) ? print '<td>-</td>' : print '<td>' . number_format($row['grupos_6']) . '</td>';
                  ($row['grupos_multi'] == 0) ? print '<td>-</td>' : print '<td class="text-center align-middle">' . number_format($row['grupos_multi']) . '</td>';
                  ($row['grupos_t'] == 0) ? print '<td>-</td>' : print '<td class="text-center align-middle">' . number_format($row['grupos_t']) . '</td>';
                } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911. </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="dv_asistencia_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Asistencia</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th class="text-left align-middle">Nivel</th>
                <th class="text-center align-middle">Cobertura</th>
                <th class="text-center align-middle">Absorción</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($asistencia as $row) { ?>
                <tr>
                  <td><?= $row['nivel'] ?></td>
                  <td style="text-align: center;"><?= (($row['cobertura']=='')?'-':$row['cobertura'].'%') ?></td>
                  <td style="text-align: center;"><?= (($row['absorcion']=='')?'-':$row['absorcion'].'%') ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
          </div>
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="dv_permanencia_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Permanencia</div>
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
                  <td style="text-align: center;"><?= (($row['retencion']=='')?'-':$row['retencion'].'%') ?></td>
                  <td style="text-align: center;"><?= (($row['aprobacion']=='')?'-':$row['aprobacion'].'%') ?></td>
                  <td style="text-align: center;"><?= (($row['et']=='')?'-':$row['et'].'%') ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: SEPyC Sinaloa con base en el Formato 911.</div>
            <div id="">- : Dato no disponible</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="dv_aprendizaje_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Aprendizaje</div>
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
                  <td style="text-align: center;"><?= (($row['nii_lyc']) + ($row['niii_lyc']) + ($row['niv_lyc'])) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['ni_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['nii_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['niii_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= ($row['niv_mat']) . '%' ?></td>
                  <td style="text-align: center;"><?= (($row['nii_mat']) + ($row['niii_mat']) + ($row['niv_mat'])) . '%' ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: SEP Federal.</div>
          </div>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="dv_rezagoeducativo_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Rezago Educativo</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th>Inasistencia escolar</th>
                <th colspan="3" class="text-center align-middle">Población total</th>
                <th colspan="3" class="text-center align-middle">Población que no asiste a la escuela</th>
              </tr>
              <tr>
                <th id="rezago">Población por grupo de edad<br> que no asiste a la escuela</th>
                <th><center><i class="fa fa-male text-primary"></i></center></th>
                <th><center><i class="fa fa-female text-secondary text-center"></i></center></th>
                <th><center><i class="fa fa-female text-secondary text-center"></i><i class="fa fa-male text-primary"></i></center></th>
                <th><center><i class="fa fa-male text-primary"></i></center></th>
                <th><center><i class="fa fa-female text-secondary"></i></center></th>
                <th><center><i class="fa fa-female text-secondary"></i><i class="fa fa-male text-primary"></i></center></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rezago as $row) { ?>
                <tr>
                  <td>3 a 14 años</td>
                  <td><center><?= number_format($row['p3A14_ptotal_h']) ?></center></td>
                  <td><center><?= number_format($row['p3A14_ptotal_m']) ?></center></td>
                  <td><center><?= number_format($row['p3A14_ptotal_h'] + $row['p3A14_ptotal_m']) ?></center></td>
                  <td><center><?= number_format($row['p3A14_noa_h']) ?></center></td>
                  <td><center><?= number_format($row['p3A14_noa_m']) ?></center></td>
                  <td><center><?= number_format($row['p3A14_noa_m'] + $row['p3A14_noa_h']) ?></center></td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: INEGI 2015</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="dv_analfabetismo_emunicipio">
  <div class="dv_tablas_estmuni col-md-12">
    <div class="card mb-3">
      <div class="card-header rounded bg-success text-light ">Analfabetismo</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover">
            <thead class="bg-light">
              <tr>
                <th>Población</th>
                <th class="text-center"><i class="fa fa-male text-primary"></i></th>
                <th class="text-center"><i class="fa fa-female text-secondary"></i></th>
                <th class="text-center"><i class="fa fa-female text-secondary"></i><i class="fa fa-male text-primary"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($analfabetismo as $row) { ?>
                <tr>
                  <td>Mayor de 15 años que no saben leer y escribir</td>
                  <td class="text-center"><?= number_format($row['analfabetismo_mayor15_h']) ?></td>
                  <td class="text-center"><?= number_format($row['analfabetismo_mayor15_m']) ?></td>
                  <td class="text-center"><?= number_format($row['analfabetismo_mayor15_m'] + $row['analfabetismo_mayor15_h']) ?></td>
                </tr>
              <?php  } ?>
            </tbody>
          </table>
          <div class="pie_tabla bg-info text-light font-weight-bold">
            <div id="fuentes_pie">Fuente: INEGI 2015</div>
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
