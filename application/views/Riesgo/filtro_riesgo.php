<main role="main">
	<div class="container">
		<div class="card ">
			<div class="card-header">
				<h5 align="center">Riesgo de Abandono Municipal/Estatal</h5>
			</div>
			<div class="card-body">				
				<br>
				<div  id="filtros_riesgo_municipio_estado">
					<div class="row">
						<div class="col-md-2">
							<label>Estado/Municipio</label>
							<select name="filtro_municipio_riesgo" id="filtro_municipio_riesgo" class="form-control">
								<option value="0">Todos</option>
								<?php foreach ($municipios as $key => $value) { ?>
			 							<option value="<?= $value['idmunicipio'] ?>"> <?= $value['nombre'] ?></option>
			 						<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Nivel:</label>
							<select name="filtro_nivel_riesgo" id="filtro_nivel_riesgo" class="form-control">
								<option value="0">Seleccione</option>
								<?php foreach ($nivel as $key => $value) { ?>
			 							<option value="<?= $value['idnivel'] ?>"> <?= $value['nombre'] ?></option>
			 					<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Ciclo escolar:</label>
							<select name="filtro_ciclo_escolar_riesgo" id="filtro_ciclo_escolar_riesgo" class="form-control">
								<?php foreach ($ciclo as $key => $value) { ?>
			 							<option value="<?= $value['idciclo'] ?>"> <?= $value['ciclo'] ?></option>
			 					<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Periodo:</label>
							<select name="filtro_periodo_riesgo" id="filtro_periodo_riesgo" class="form-control">	
			 					<option value="1">1</option>
			 					<option value="2">2</option>
			 					<option value="3">3</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10"></div>
						<div class="col-md-1">
							<button class="btn btn-danger" type="button" id="btn_limpiar_municipio_estado_riesgo">Limpiar</button>
						</div>
						<div class="col-md-1">
							<button class="btn btn-info" type="button" id="btn_buscar_municipio_estado_riesgo">Buscar</button>
						</div>
					</div>
				</div>

				<br>
				<div id="div_general_riesgo" class="row">
					<div id="div_riesgo" class="col-md-6">
					</div>
					<div id="div_riesgo_grafica_barras" class="col-md-6">
					</div>
				</div>
				<br>
				<div id="div_pinta_tabla_riesgo" class="row">
					<div id="div_tabla_riesgo_grafica_pie" class="col-md-6">
					</div>
					<div id="div_tabla_riesgo_grafica_barras" class="col-md-6">
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script><
<script src="<?= base_url('assets/js/Riesgo_abandono/riesgo.js'); ?>"></script>