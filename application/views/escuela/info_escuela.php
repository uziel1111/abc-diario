<main role="main">
	<div class="container">
		<div class="card shadow">
			<div class="card-header bg-warning text-light">
				<div class="row">
					<div class="col-10">
						<i class="fas fa-search"></i> Datos generales de la escuela
					</div>
					<div class="col-2 text-light text-right">
						<a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="Titulo" data-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."><i class="fa fa-info-circle"></i></a>
					</div>
				</div>
			</div>
			<input type="hidden" name="itxt_seccion_event" id="itxt_seccion_event" value="<?=$seccion?>">
			<div class="card-body">
				<input type="hidden" id="idturnoinfo" value="<?= $info[0]['idturno'] ?>">
				<input type="hidden" id="cctinfo" value="<?= $info[0]['cct'] ?>">
				<div class="card shadow bg-light mb-3">
					<div class="card-header"><?= $info[0]['nombre'] ?></div>
					<div class="card-body">
						<h2 class="border-bottom"><?= $info[0]['cct'] ?></h2>
						<div class="row">
							<div class="col-12 col-md-6">
								Turno: <span class="font-weight-bold"><?= $info[0]['turno'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Nivel: <span class="font-weight-bold"><?= $info[0]['nivel'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Modalidad: <span class="font-weight-bold"><?= $info[0]['modalidad'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Sostenimiento: <span class="font-weight-bold"><?= $info[0]['sostenimiento'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Domicilio: <span class="font-weight-bold"><?= $info[0]['domicilio'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Localidad: <span class="font-weight-bold"><?= $info[0]['localidad'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Municipio: <span class="font-weight-bold"><?= $info[0]['municipio'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Estatus de la escuela: <span class="font-weight-bold"><?= $info[0]['estatus'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Nombre del director: <span class="font-weight-bold"><?= $info[0]['nombre_direct_encargado'] ?></span>
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-12 col-md-6">
								<a href="javascript:history.go(-1)" class="btn btn-success text-light">Regresar</a>
								<!-- <?=base_url('Info_escuela/busqueda_general')?> -->
							</div>
						</div>
					</div>
				</div>
				<ul class="nav nav-pills nav-fill mt-4">
					<li class="nav-item">
						<a class="nav-link p-2 h5 font-weight-bold active" data-toggle="tab" href="#asistencia_info" id="tab_asistencia_info">Asistencia</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-2 h5 font-weight-bold" data-toggle="tab" href="#permanencia_info" id="tab_permanencia_info">Permanencia</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-2 h5 font-weight-bold" data-toggle="tab" href="#aprendizaje_info" id="tab_aprendizaje_info">Aprendizaje</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
				  <div class="tab-pane fade active show" id="asistencia_info">

				  </div>
				  <div class="tab-pane fade" id="permanencia_info">

				  </div>
				  <div class="tab-pane fade" id="aprendizaje_info">

				  </div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= base_url('assets/js/utilerias/progressbar.min.js');?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<script src="<?= base_url('assets/js/planea/graficas.js') ?>"></script>
<script src="<?= base_url('assets/js/info_escuela/info_escuela.js') ?>"></script>
