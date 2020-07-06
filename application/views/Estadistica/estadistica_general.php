<main role="main">
	<div class="container" id="dv_contenido">
		<div class="card shadow">
			<div class="card-header bg-primary text-light">
				<i class="fas fa-search"></i> Estadística
			</div>
			<div class="card-body">
				<div class="alert alert-info" role="alert">
					<div class="row">
						<div class="col-auto">
							<div class="custom-control custom-radio">
								<input name="busqueda_estadistica" id="busqueda_estadistica_municipio" value="municipio" type="radio" class="custom-control-input" checked>
								<label class="custom-control-label font-weight-bold" for="busqueda_estadistica_municipio"> Por Estado/Municipio</label>
							</div>
						</div>
						<div class="col-auto">
							<div class="custom-control custom-radio">
								<input name="busqueda_estadistica" id="busqueda_estadistica_zona_escolar" value="zona_escolar" type="radio" class="custom-control-input">
								<label class="custom-control-label font-weight-bold" for="busqueda_estadistica_zona_escolar"> Por Zona Escolar</label>
							</div>
						</div>
					</div>
				</div>

				<div id="filtros_municipio_estado">
					<div class="alert alert-info" role="alert">
						<div class="row">
							<div class="col-12 col-md-4 col-lg-3">
								<label>Estado/Municipio</label>
								<select name="filtro_municipio" id="filtro_municipio" class="form-control">
									<option value="0">Todos</option>
									<?php foreach ($municipios as $key => $value) { ?>
										<option value="<?= $value['idmunicipio'] ?>"> <?= $value['nombre'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<label>Nivel:</label>
								<select name="filtro_nivel" id="filtro_nivel" class="form-control" disabled>
									<option value="0">Todos</option>

								</select>
							</div>
							<div class="col-12 col-md-4 col-lg-2">
								<label>Sostenimiento:</label>
								<select name="filtro_sostenimiento" id="filtro_sostenimiento" class="form-control" disabled>
									<option>Todos</option>
								</select>
							</div>
							<div class="col-12 col-md-4 col-lg-2">
								<label>Modalidad:</label>
								<select name="filtro_modalidad" id="filtro_modalidad" class="form-control" disabled>
									<option>Todos</option>

								</select>
							</div>
							<div class="col-12 col-md-4 col-lg-2">
								<label>Ciclo escolar:</label>
								<select name="filtro_ciclo_escolar" id="filtro_ciclo_escolar" class="form-control">
									<?php foreach ($ciclo as $key => $value) { ?>
										<option value="<?= $value['idciclo'] ?>"> <?= $value['ciclo'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row justify-content-end mt-3">
							<div class="col-md-3 col-lg-2 mt-2">
								<button class="btn btn-info text-light btn-block" type="button" id="btn_limpiar_municipio_estado">Limpiar</button>
							</div>
							<div class="col-md-3 col-lg-2 mt-2">
								<button class="btn btn-success btn-block" type="button" id="btn_buscar_municipio_estado">Buscar</button>
							</div>
						</div>
					</div>
				</div>
				<?= $filtros_zona ?>
				<div id="div_estadistica">

				</div>
			</div>
		</div>
	</div>
</main>

<script src="<?= base_url('assets/js/Estadistica/estadistica_general.js'); ?>"></script>
<script src="<?= base_url('assets/js/Estadistica/estadistica_zona.js'); ?>"></script>
<script src="<?= base_url('assets/js/Estadistica/filtros_zona.js'); ?>"></script>
