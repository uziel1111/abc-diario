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
				    	</div>
				    </div>
				  </div>
				  <div class="tab-pane fade" id="aprendizaje">
				    
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
<script src="<?= base_url('assets/js/info_escuela/info_escuela.js') ?>"></script>
