<main role="main">
	<div class="container">
		<div class="card shadow">
			<div class="card-header bg-primary text-light">
				<i class="fas fa-search"></i> Datos generales de la escuela
			</div>
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
								Localidad: <span class="font-weight-bold"><?= $info[0]['localidad'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Nombre del director: <span class="font-weight-bold"><?= $info[0]['nombre'] ?></span>
							</div>
							<div class="col-12 col-md-6">
								Estatus de la escuela: <span class="font-weight-bold"><?= $info[0]['estatus'] ?></span>
							</div>
						</div>
					</div>
				</div>
				<ul class="nav nav-pills nav-fill mt-4">
					<li class="nav-item">
						<a class="nav-link p-2 h5 font-weight-bold active" data-toggle="tab" href="#asistencia" id="tab_asistencia_info">Asistencia</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-2 h5 font-weight-bold" data-toggle="tab" href="#permanencia" id="tab_permanencia_info">Permanencia</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-2 h5 font-weight-bold" data-toggle="tab" href="#aprendizaje" id="tab_aprendizaje_info">Aprendizaje</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade active show m-2 p-3" id="asistencia">
						<div id="conten_alumnos_info"></div>
						<div id="conten_grupos_info"></div>
						<div id="conten_docentes_info"></div>
					</div>
					<div class="tab-pane fade m-2 p-3" id="permanencia">
						<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
					</div>
					<div class="tab-pane fade m-2 p-3" id="aprendizaje">
						<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/highcharts.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/modules/data.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<!--Problemas con esta versión<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->
<script src="<?= base_url('assets/js/info_escuela/asistencia.js') ?>"></script>