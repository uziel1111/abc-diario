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
				  <div class="tab-pane fade active show" id="asistencia">
				    <div id="conten_alumnos_info"></div>
				    <div id="conten_grupos_info"></div>
				    <div id="conten_docentes_info"></div>
				  </div>
				  <div class="tab-pane fade" id="permanencia">
				    <div class="container">
				    	<div class="row">
				    		<div class="col-xs-12 col-sm-12 col-md-3">
						      <div class="form-group">
						        <label for="itxt_ciclo_info" class="control-label">Ciclo</label>
						        <select id="itxt_ciclo_info" name="itxt_ciclo_info" class="form-control font-family text-uppercase">
						          <option value="">Seleccione</option>
						          <?php foreach ($ciclos as $ciclo): ?>
						            <option value="<?= $ciclo['ciclo']?>"><?= $ciclo['ciclo']?></option>
						          <?php endforeach ?>
						        </select>
						      </div><!-- .form-group -->
						    </div><!-- .col-xs-12 col-sm-12 col-md-2 -->
						    <div class="col-xs-12 col-sm-12 col-md-3">
						      <div class="form-group">
						        <label for="itxt_periodo_info" class="control-label">Periodo</label>
						        <select id="itxt_periodo_info" name="itxt_periodo_info" class="form-control font-family text-uppercase">
						          <option value="">Seleccione</option>
						          <option value="1">Periodo 1</option>
						          <option value="2">Periodo 2</option>
						          <option value="3">Periodo 2</option>
						        </select>
						      </div><!-- .form-group -->
						    </div><!-- .col-xs-12 col-sm-12 col-md-2 -->
						    <div class="col-xs-12 col-sm-12 col-md-3">
						    	<br>
						    	<button class="btn btn-primary" id="btn_buscar_permanencia">Buscar</button>
						    </div><!-- .col-xs-12 col-sm-12 col-md-2 -->
				    	</div>
				    	<div id="div_riesgo_info"></div>
				    	<div id="div_tabla_riesgo_grafica_pie_info"></div>
				    	<div id="div_riesgo_grafica_barras_info"></div>
				    	<div id="div_tabla_riesgo_grafica_barras_info"></div>
				    	<div class="row">
				    		<div class="col-md-4"><div id="containerRPB03ete_info"></div></div>
				    		<div class="col-md-4"><div id="dv_info_graf_Retencion_info"></div></div>
				    		<div class="col-md-4">
				    			<div id="dv_info_graf_aprobacion_info"></div>
				    		</div>
				    	</div>
				    </div>
				  </div>
				  <div class="tab-pane fade" id="aprendizaje">
				  	<br>
				    <p>
					  <a id="btn_planea_info" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
					    Planea por contenido tematico Lenguaje y comunicación
					  </a>
					</p>
					<div class="collapse" id="collapseExample">
					  <div class="card card-body">
					    <div id="div_planea_lyc_info"></div>
					  </div>
					</div>
					<p>
						<a id="btn_planea_info_mate" class="btn btn-primary" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
						    Planea por contenido tematico Matemáticas
						</a>
					</p>
					<div class="collapse" id="collapseExample2">
					  <div class="card card-body">
					    <div id="div_planea_mate_info"></div>
					  </div>
					</div>
					<p>
						<a id="btn_planea_info_nlogro"  class="btn btn-primary" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
					    	Planea por niveles de logro
					  	</a>
					</p>
					<div class="collapse" id="collapseExample3">
					  <div class="card card-body">
					    <div id="div_planea_info_nlogro_tabla"></div>
					    <div id="div_planea_info_nlogro_lyc"></div>
					    <div id="div_planea_info_nlogro_mate"></div>
					  </div>
					</div>
					<p>
						<a id="btn_planea_info_ete" class="btn btn-primary" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample">
					    	Eficiencia termial efectiva
					  	</a>
					</p>
					<div class="collapse" id="collapseExample4">
					  <div class="card card-body">
					    De quienes inician el nivel educativo, ¿Qué porcentaje lo termina y además aprende lo esencial?

						A esta pregunta responde el nuevo indicador de Eficiencia Terminal Efectiva (ETE), que toma como base la eficiencia terminal tradicional y le aplica el porcentaje de estudiantes que supera el nivel I en PLANEA.
						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<div id="div_ete_info"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								Eficiencia Terminal Efectiva
								Porcentaje de alumnos egresados con aprendizajes suficientes.
								<h5 id="conten_planea_ciclo"></h5>
							</div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= base_url('assets/js/utilerias/progressbar.min.js');?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/highcharts.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/modules/data.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<!--Problemas con esta versión<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->

<script src="<?= base_url('assets/js/info_escuela/asistencia.js') ?>"></script>
<script src="<?= base_url('assets/js/info_escuela/permanencia.js') ?>"></script>
<script src="<?= base_url('assets/js/planea/graficas.js') ?>"></script>
<script src="<?= base_url('assets/js/info_escuela/aprendizaje.js') ?>"></script>
<script src="<?= base_url('assets/js/info_escuela/info_escuela.js') ?>"></script>
