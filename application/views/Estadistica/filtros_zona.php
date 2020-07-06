<div id="filtros_zona_escolar">
	<div class="row">
		<div class="col-12 col-md-4 col-lg-3">
			<label>Nivel</label>
			<select name="filtro_nivel_zona" id="filtro_nivel_zona" class="form-control">
				<option value="0" disabled="true" selected='true'>SELECCIONE UN NIVEL EDUCATIVO</option>
				<?php foreach ($nivel as $key => $value) { ?>
					<option value="<?= $value['idnivel'] ?>"> <?= $value['nombre'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-12 col-md-4 col-lg-3">
			<label>Sostenimiento</label>
			<select name="filtro_sostenimiento_zona" id="filtro_sostenimiento_zona" class="form-control" disabled>
				<option value="0" disabled="true" selected='true'>SELECCIONE</option>
			</select>
		</div>
		<div class="col-12 col-md-4 col-lg-3">
			<label>Número de zona escolar</label>
			<select name="filtro_num_zona" id="filtro_num_zona" class="form-control" disabled>
				<option value="0" disabled="true" selected='true'>SELECCIONE</option>
			</select>
		</div>
		<div class="col-12 col-md-4 col-lg-3">
			<label>Ciclo escolar</label>
			<select name="filtro_ciclo_escolar_zona" id="filtro_ciclo_escolar_zona" class="form-control" disabled>
				<option value="0" disabled="true" selected='true'>SELECCIONE</option>
			</select>
		</div>
	</div>
	<div class="row justify-content-end mt-3">
		<div class="col-md-3 col-lg-2 mt-2">
			<button class="btn btn-info text-light btn-block" type="button" id="btn_limpiar_zona_escolar">Limpiar</button>
		</div>
		<div class="col-md-3 col-lg-2 mt-2">
			<button class="btn btn-success btn-block text-light"" type=" button" id="btn_buscar_zona_escolar">Buscar</button>
		</div>
	</div>
</div>