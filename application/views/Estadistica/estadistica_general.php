<main role="main">
	<div class="container">
		<div class="card ">
			<div class="card-header">
				<h5 align="center">Estadística</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<input name="busqueda_estadistica" id="busqueda_estadistica_municipio" value="municipio" type="radio" checked>Por Estado/Municipio
					</div>
					<div class="col-md-6">
						<input name="busqueda_estadistica" id="busqueda_estadistica_zona_escolar" value="zona_escolar" type="radio">Por Zona Escolar
					</div>
				</div>
				<br>
				<div  id="filtros_municipio_estado">
					<div class="row">
						<div class="col-md-2">
							<label>Estado/Municipio</label>
							<select name="filtro_municipio" id="filtro_municipio" class="form-control">
								<option value="0">Todos</option>
								<?php foreach ($municipios as $key => $value) { ?>
			 							<option value="<?= $value['idmunicipio'] ?>"> <?= $value['nombre'] ?></option>
			 						<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Nivel:</label>
							<select name="filtro_nivel" id="filtro_nivel" class="form-control" disabled>
								<option value="0">Todos</option>

							</select>
						</div>
						<div class="col-md-2">
							<label>Sostenimiento:</label>
							<select name="filtro_sostenimiento" id="filtro_sostenimiento" class="form-control" disabled>
								<option>Todos</option>
							</select>
						</div>
						<div class="col-md-2">
							<label>Modalidad:</label>
							<select name="filtro_modalidad" id="filtro_modalidad" class="form-control" disabled>
								<option>Todos</option>

							</select>
						</div>
						<div class="col-md-2">
							<label>Ciclo escolar:</label>
							<select name="filtro_ciclo_escolar" id="filtro_ciclo_escolar" class="form-control">
								<?php foreach ($ciclo as $key => $value) { ?>
			 							<option value="<?= $value['idciclo'] ?>"> <?= $value['ciclo'] ?></option>
			 					<?php } ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10"></div>
						<div class="col-md-1">
							<button class="btn btn-danger" type="button" id="btn_limpiar_municipio_estado">Limpiar</button>
						</div>
						<div class="col-md-1">
							<button class="btn btn-info" type="button" id="btn_buscar_municipio_estado">Buscar</button>
						</div>
					</div>

				</div>
					<?=$filtros_zona ?>
				<br>
				<div id="div_estadistica">

				</div>
			</div>
		</div>
	</div>
</main>

<script src="<?= base_url('assets/js/Estadistica/estadistica_general.js'); ?>"></script>
<script src="<?= base_url('assets/js/Estadistica/estadistica_zona.js'); ?>"></script>
<script src="<?= base_url('assets/js/Estadistica/filtros_zona.js'); ?>"></script>
