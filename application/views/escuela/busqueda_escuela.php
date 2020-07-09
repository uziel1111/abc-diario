<main role="main">
	<div class="container">
		<div class="card shadow">
			<div class="card-header bg-warning text-light">
				<i class="fas fa-search"></i> <?=isset($seccion)? $seccion : 'Localiza tu escuela'?>(<?= isset($subseccion)? $subseccion: ''?>)
			</div>
			<div class="card-body">
				<div class="alert alert-info" role="alert">
					<div class="row">
						<div class="col-auto">
							<div class="custom-control custom-radio">
								<input name="busqueda_escuela" id="busqueda_xmunicipioxnivelxsostenimiento" value="municipio_busqueda" type="radio" class="custom-control-input" checked>
								<label class="custom-control-label font-weight-bold" for="busqueda_xmunicipioxnivelxsostenimiento"> Por municipio, nivel, sostenimiento</label>
							</div>
						</div>

						<div class="col-auto">
							<div class="custom-control custom-radio">
								<input name="busqueda_escuela" id="busqueda_cct" value="cct" type="radio" class="custom-control-input">
								<label class="custom-control-label font-weight-bold" for="busqueda_cct"> Por clave de centro de trabajo</label>
							</div>
						</div>
					</div>
				</div>
				<div id="filtros_xmunicipio">
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

					<div class="row justify-content-end mt-3">
						<div class="col-md-3 col-lg-2 mt-2">
							<button class="btn btn-info text-light btn-block" type="button" id="btn_limpiar_busqueda_general">Limpiar</button>
						</div>
						<div class="col-md-3 col-lg-2 mt-2">
							<button class="btn btn-success btn-block text-light" type="button" id="btn_buscar_escuelas_xmunicipioxnivelxsostenimiento">Buscar</button>
						</div>
					</div>

				</div>
				<div id="filtroxcct">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-style-1">
	             <?=form_label('Clave Centro de Trabajo', 'cct');?>
	            <div class="input-group">
	                <div class="input-group-prepend">
	                  <div class="input-group-text fw800" id="btnGroupAddon">25</div>
	                </div>
	                <?=form_input('cct', '', array('class' => 'form-control fw800', 'id' => 'busquedaxcct'));?>
	              </div>
	            </div>
							<!-- <label>CCT:</label>
							<input name="busquedaxcct" id="busquedaxcct" class="form-control"> -->
						</div>
					</div>

					<div class="row justify-content-end mt-3">
						<div class="col-md-3 col-lg-2 mt-2">
							<button class="btn btn-info text-light btn-block" type="button" id="btn_limpiar_busqueda_xcct">Limpiar</button>
						</div>
						<div class="col-md-3 col-lg-2 mt-2">
							<button class="btn btn-success btn-block text-light" type="button" id="btn_buscar_escuelas_xcct">Buscar</button>
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
