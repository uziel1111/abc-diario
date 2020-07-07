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
	          <option value="3">Periodo 3</option>
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
<script src="<?= base_url('assets/js/info_escuela/permanencia.js') ?>"></script>