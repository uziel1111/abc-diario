<main role="main">
	<div class="container">
		<div class="card shadow">
			<div class="card-header bg-secondary text-light">
			<i class="fas fa-search"></i> Localiza tu escuela
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<input name="busqueda_escuela" id="busqueda_xmunicipioxnivelxsostenimiento" value="municipio_busqueda" type="radio" checked>Por municipio, nivel, sostenimiento
					</div>
					<div class="col-md-6">
						<input name="busqueda_escuela" id="busqueda_cct" value="cct" type="radio">Por clave de centro de trabajo
					</div>
				</div>
				<br>
				<div  id="filtros_xmunicipio">
					<div class="row">
						<div class="col-md-4">
							<label>Municipio</label>
							<select name="filtro_municipio_busqueda" id="filtro_municipio_busqueda" class="form-control">
								<option value="0">Todos</option>
								<?php foreach ($municipios as $key => $value) { ?>
			 							<option value="<?= $value['idmunicipio'] ?>"> <?= $value['nombre'] ?></option>
			 						<?php } ?>
							</select>
						</div>
						<div class="col-md-4">
							<label>Nivel:</label>
							<select name="filtro_nivel_busqueda" id="filtro_nivel_busqueda" class="form-control">
								<option value="0">Todos</option>
								<?php foreach ($nivel as $key => $value) { ?>
			 							<option value="<?= $value['idnivel'] ?>"> <?= $value['nombre'] ?></option>
			 						<?php } ?>
							</select>
						</div>
						<div class="col-md-4">
							<label>Sostenimiento:</label>
							<select name="filtro_sostenimiento_busqueda" id="filtro_sostenimiento_busqueda" class="form-control">
								<?php foreach ($sostenimiento as $key => $value) { ?>
			 							<option value="<?= $value['idsostenimiento'] ?>"> <?= $value['nombre'] ?></option>
			 						<?php } ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label>Nombre de la escuela:</label>
							<input name="nombre_cct" id="nombre_cct" class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10"></div>
						<div class="col-md-1">
							<button class="btn btn-success" type="button" id="btn_limpiar_busqueda_general">Limpiar</button>
						</div>
						<div class="col-md-1">
							<button class="btn btn-info text-light" type="button" id="btn_buscar_escuelas_xmunicipioxnivelxsostenimiento">Buscar</button>
						</div>
					</div>
				</div>
				<div id="filtroxcct">
					<div class="row">
						<div class="col-md-12">
							<label>CCT:</label>
							<input name="busquedaxcct" id="busquedaxcct" class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10"></div>
						<div class="col-md-1">
							<button class="btn btn-danger" type="button" id="btn_limpiar_busqueda_xcct">Limpiar</button>
						</div>
						<div class="col-md-1">
							<button class="btn btn-info" type="button" id="btn_buscar_escuelas_xcct">Buscar</button>
						</div>
					</div>
				</div>
				<br>
				<div id="div_lista_escuelas">

				</div>
			</div>
		</div>
	</div>
</main>

<script src="<?= base_url('assets/js/escuela/busqueda.js'); ?>"></script>
