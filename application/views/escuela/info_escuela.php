<main role="main">
	<div class="container">
		<div class="card ">
			<div class="card-header">
				<h5 align="center">Datos generales de la escuela</h5>
			</div>
			<div class="card-body">
				<input type="hidden" id="idturnoinfo" value="<?= $info[0]['idturno']?>">
				<input type="hidden" id="cctinfo" value="<?= $info[0]['cct']?>">
				<div class="container">
					<div class="row">
						<div class="col-12">
							Nombre del centro de trabajo: <?=$info[0]['nombre']?>
							<div class="row">
								CCT: <?=$info[0]['cct']?>
								Turno: <?=$info[0]['turno']?>
								Nivel: <?=$info[0]['nivel']?>
							</div>
							<div class="row">
								Modalidad: <?=$info[0]['modalidad']?>
								Sostenimiento: <?=$info[0]['sostenimiento']?>
							</div>
							<div class="row">
								Domicilio: <?=$info[0]['domicilio']?>
								Localidad: <?=$info[0]['localidad']?>
								Municipio: <?=$info[0]['municipio']?>
							</div>
							<div class="row">
								Nombre del director: <?=$info[0]['nombre']?>
								Estatus de la escuela: <?=$info[0]['estatus']?>
							</div>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="tab" href="#asistencia" id="tab_asistencia_info">Asistencia</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#permanencia" id="tab_permanencia_info">Permanencia</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#aprendizaje" id="tab_aprendizaje_info">Aprendizaje</a>
				  </li>
				</ul>
				<div id="myTabContent" class="tab-content">
				  <div class="tab-pane fade active show" id="asistencia">
				    <div id="conten_alumnos_info"></div>
				    <div id="conten_grupos_info"></div>
				    <div id="conten_docentes_info"></div>
				  </div>
				  <div class="tab-pane fade" id="permanencia">
				    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
				  </div>
				  <div class="tab-pane fade" id="aprendizaje">
				    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
				  </div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= base_url('assets/js/info_escuela/asistencia.js') ?>"></script>
