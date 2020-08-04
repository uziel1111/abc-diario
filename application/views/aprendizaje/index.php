<main role="main">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-secondary text-light">
              <div class="row">
      					<div class="col-11">
      						<i class="fas fa-search"></i> Aprendizaje (Resultados Aprendamos Juntos Media Superior por estado / municipio)
      					</div>
                <div class="col-1 text-light text-right">
                    <a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="Resultados Aprendamos Juntos" data-content="En Media Superior garantiza el acompañamiento de las y los estudiantes de tercer año de bachillerato."><i class="fa fa-info-circle"></i></a>

      					</div>
      				</div>
            </div>

            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <div class="tab-content bg-light rounded" id="myTabContent_busqg">
                        <div class="tab-pane fade show active m-2 p-3" id="xest_muni" role="tabpanel" aria-labelledby="xest_muni-tab">
                            <?= $buscador ?>
                        </div><!-- xest_muni -->

                    </div>
                </div>
                <div class="card mb-3 card-style-1 mt-3">
                    <div class="card-header card-1-header bgcolor-2 text-muted">Resultados de búsqueda</div>
                    <div class="card-body">
                        <div id="div_contenedor_aprend">
                          <div id="cont_cont_aprend"></div>
                      </div>
                    </div><!-- card-body -->
                </div>

            </div>
        </div><!-- card -->
    </div>
</main>

<script src="<?= base_url('assets/js/aprendizaje/aprendizaje.js') ?>"></script>
