<br>
<?php if ($idnivel=='2' || $idnivel=='3'): ?>
<p>
  <a id="btn_planea_info" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    PLANEA por contenido temático Lenguaje y comunicación
  </a>
</p>
<?php endif; ?>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <div class="row">
      <div class="col-1">
          <div class="div_grafiaca_txt rotate">Contenidos temáticos</div>
      </div>
        <div class="col-10">
            <div id="div_planea_lyc_info"></div>
        </div>
    </div>
    <div class="pie_tabla bg-info text-light font-weight-bold">
      <div id="fuentes_pie">Fuente: SEP Federal.</div>
    </div>
  </div>
</div>
<?php if ($idnivel=='2' || $idnivel=='3'): ?>
<p>
	<a id="btn_planea_info_mate" class="btn btn-primary" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
	    PLANEA por contenido temático Matemáticas
	</a>
</p>
<?php endif; ?>
<div class="collapse" id="collapseExample2">
  <div class="card card-body">
    <div class="row">
      <div class="col-1">
          <div class="div_grafiaca_txt rotate">Contenidos temáticos</div>
      </div>
        <div class="col-10">
            <div id="div_planea_mate_info"></div>
        </div>
    </div>
    <div class="pie_tabla bg-info text-light font-weight-bold">
      <div id="fuentes_pie">Fuente: SEP Federal.</div>
    </div>
  </div>
</div>
<p>
	<a id="btn_planea_info_nlogro"  class="btn btn-primary" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
    	PLANEA por niveles de logro
  	</a>
</p>
<div class="collapse" id="collapseExample3">
  <div class="card card-body">
    <div id="div_planea_info_nlogro_tabla"></div>
    <div id="div_planea_info_nlogro_lyc"></div>
    <div id="div_planea_info_nlogro_mate"></div>
    <div class="pie_tabla bg-info text-light font-weight-bold">
      <div id="fuentes_pie">Fuente: SEP Federal.</div>
    </div>
  </div>
</div>
<p>
	<a id="btn_planea_info_ete" class="btn btn-primary" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample">
    	Eficiencia terminal efectiva
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
  <!-- <div class="pie_tabla bg-info text-light font-weight-bold">
    <div id="fuentes_pie">Fuente: SEP Federal.</div>
  </div> -->
  </div>
</div>

<script src="<?= base_url('assets/js/info_escuela/aprendizaje.js') ?>"></script>
