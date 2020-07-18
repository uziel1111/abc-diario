<main role="main">
	<div class="container">
		<div class="card shadow">
			<div class="card-header bg-warning text-light">
				<div class="row">
					<div class="col-10">
						<i class="fas fa-search"></i> <?=isset($seccion)? $seccion : 'Localiza tu escuela'?>(<?= isset($subseccion)? $subseccion: ''?>)
					</div>
					<div class="col-2 text-light text-right">
						<?php if (isset($subseccion) && $subseccion=='Por escuela'): ?>
							<a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="Datos de tu escuela" data-content="Principales elementos de diagnóstico de tu escuela con datos oficiales, como insumo para el Plan Escolar de Mejora Continua. Se puede ingresar rápidamente con la clave de centro de trabajo o mediante algunos datos de referencia, como municipio, nivel, nombre de escuela, etc."><i class="fa fa-info-circle"></i></a>
						<?php endif; ?>
						<?php if (isset($subseccion) && $subseccion=='Riesgo de abandono por escuela'): ?>
							<a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="Riesgo de abandono escolar" data-content="Datos de los alumnos de tu escuela que están en riesgo de abandonar la escuela, por su incidencia en reprobar asignaturas, contar con inasistencias a las clases y tener algún rezago en la edad reglamentaria. La fuente de información es el sistema SIEE de la entidad."><i class="fa fa-info-circle"></i></a>
						<?php endif; ?>
						<?php if (isset($subseccion) && $subseccion=='Resultados PLANEA por escuela'): ?>
							<a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="PLANEA de tu escuela" data-content="Resultados de las últimas dos pruebas PLANEA de tu escuela. Además de los niveles de logro, se exponen los resultados por contenidos temáticos, para orientar las acciones de reforzamiento académico en donde más se requiera."><i class="fa fa-info-circle"></i></a>
						<?php endif; ?>
						<!-- <?php if (isset($subseccion) && $subseccion=='En listado de escuelas'): ?>
							<a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="Titulo" data-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."><i class="fa fa-info-circle"></i></a>
						<?php endif; ?> -->
					</div>
				</div>

			</div>
			<input type="hidden" name="itxt_seccion_eventos" id="itxt_seccion_eventos" value="<?= isset($seccion_corta)? $seccion_corta : ''?>">
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
								<option value="0">Todos</option>
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
	            <div class="row">
									<div class="col-3 text-left align-left">
										<div class="input-group-prepend">
											<div class="input-group-text fw800" id="btnGroupAddon">25</div>
											<?=form_input('cct', '', array('class' => 'form-control fw800', 'id' => 'busquedaxcct'));?>
										</div>

									</div>
									<div class="col-md-3 col-lg-2 mt-2">
										<button class="btn btn-info text-light btn-block" type="button" id="btn_limpiar_busqueda_xcct">Limpiar</button>
									</div>
									<div class="col-md-3 col-lg-2 mt-2">
										<button class="btn btn-success btn-block text-light" type="button" id="btn_buscar_escuelas_xcct">Buscar</button>
									</div>
	              </div>
	            </div>
							<!-- <label>CCT:</label>
							<input name="busquedaxcct" id="busquedaxcct" class="form-control"> -->
						</div>
					</div>

					<!-- <div class="row justify-content-end mt-3">

					</div> -->

				</div>
				<br>
				<div id="div_lista_escuelas">

				</div>
			</div>
		</div>
	</div>
</main>

<script src="<?= base_url('assets/js/escuela/busqueda.js'); ?>"></script>
