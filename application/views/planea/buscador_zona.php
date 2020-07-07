<div class="row">
  <div class="col-12 col-sm-12 col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <label>Nivel:</label>
			<select name="slt_nivel_planeazn" id="slt_nivel_planeazn" class="form-control">
				<option value="0" disabled="true" selected='true'>SELECCIONE UN NIVEL EDUCATIVO</option>
				<?php foreach ($niveles as $key => $value) { ?>
					<option value="<?= $value['idnivel'] ?>"> <?= $value['nombre'] ?></option>
				<?php } ?>
			</select>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 mt-2">
    <div class="form-group form-group-style-1">
      <label>Sostenimiento:</label>
			<select name="slt_sostenimiento_planeazn" id="slt_sostenimiento_planeazn" class="form-control">
				<option value="-1" disabled="true" selected="true">SELECCIONE UN SOSTENIMIENTO</option>
				<?php foreach ($sostenimiento as $key => $value) { ?>
					<option value="<?= $value['idsostenimiento'] ?>"> <?= $value['nombre'] ?></option>
				<?php } ?>
			</select>
    </div>
  </div><!-- col-md-4 -->
   <div class="col-12 col-sm-12 col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <label>Zona escolar:</label>
			<select name="slt_zona_planeazn" id="slt_zona_planeazn" class="form-control">
				<option value="0" disabled="true" selected='true'>SELECCIONE UNA ZONA ESCOLAR</option>
				<?php foreach ($zona as $key => $value) { ?>
					<option value="<?= $value['cct_supervisor'] ?>"> <?= $value['zona_escolar'] ?></option>
				<?php } ?>
			</select>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <label>Periodo:</label>
			<select name="slt_periodo_planeazn" id="slt_periodo_planeazn" class="form-control">
				<option value="0" disabled='true' selected='true'>SELECCIONE UN PERIODO</option>
				<?php foreach ($periodos as $key => $value) { ?>
					<option value="<?= $value['id_periodo'] ?>"> <?= $value['periodo'] ?></option>
				<?php } ?>
			</select>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 mt-2">
    <div class="form-group form-group-style-1">
      <label>Campo disciplinario:</label>
			<select name="slt_campod_planeazn" id="slt_campod_planeazn" class="form-control">
				<option value="0" disabled="true" selected='true'>SELECCIONE UN CAMPO DISCIPLINARIO</option>
				<?php foreach ($camposd as $key => $value) { ?>
					<option value="<?= $value['id'] ?>"> <?= $value['nombre'] ?></option>
				<?php } ?>
			</select>
    </div>
  </div><!-- col-md-4 -->
</div><!-- row -->
<div class="row justify-content-end mt-3">
  <div class="col-md-3 col-lg-2 mt-2">
    <?= anchor(base_url(), 'Regresar', array('class' => 'btn btn-info text-light btn-block')) ?>
  </div><!--  col-sm-6 -->
  <div class="col-md-3 col-lg-2 mt-2">
    <?= form_submit('mysubmit', 'Buscar', array('id' => 'btn_busqueda_xestadozona', 'class'=>'btn btn-success btn-block text-light' )); ?>
  </div><!--  col-sm-6 -->
</div><!-- row -->

<script src="<?= base_url('assets/js/planea/planea.js') ?>"></script>
