<main role="main">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-secondary text-light">
              <div class="row">
      					<div class="col-11">
      						<i class="fas fa-search"></i> Aprendizaje(<?= isset($subtitulo)? $subtitulo :""?>)
      					</div>
      					<div class="col-1 text-light text-right">
                  <?php if (isset($subtitulo) && $subtitulo=='Resultados PLANEA por estado / municipio'): ?>
                    <a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="PLANEA estatal y municipal" data-content="Resultados de las últimas dos pruebas PLANEA de primaria y secundaria a nivel estatal y por municipio. Además de los niveles de logro, se exponen los resultados por contenidos temáticos, para orientar las acciones de reforzamiento académico en donde más se requiera."><i class="fa fa-info-circle"></i></a>
                  <?php endif; ?>
                  <?php if (isset($subtitulo) && $subtitulo=='Resultados PLANEA por zona escolar'): ?>
                    <a tabindex="0" class="btn btn-lg btn-info" role="button" data-toggle="popover" data-trigger="focus" title="PLANEA de tu Zona" data-content="Resultados de las últimas dos pruebas PLANEA de tu zona escolar. Además de los niveles de logro, se exponen los resultados por contenidos temáticos, para orientar las acciones de reforzamiento académico que se impulsen en cada supervisión escolar, en donde más se requiera."><i class="fa fa-info-circle"></i></a>
                  <?php endif; ?>

      					</div>
      				</div>

            </div>
            <input type="hidden" name="itxt_planea_event" id="itxt_planea_event" value="<?= $seccion_event?>">
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <ul class="nav nav-pills nav-fill" id="tab_busqg" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active p-2 h5 font-weight-bold" id="xest_muni-tab" data-toggle="tab" href="#xest_muni" role="tab" aria-controls="xest_muni" aria-selected="true">Por estado / municipio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2 h5 font-weight-bold" id="xzona-tab" data-toggle="tab" href="#xzona" role="tab" aria-controls="xzona" aria-selected="false">Por zona escolar</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-light rounded" id="myTabContent_busqg">
                        <div class="tab-pane fade show active m-2 p-3" id="xest_muni" role="tabpanel" aria-labelledby="xest_muni-tab">
                            <?= $buscador ?>
                        </div><!-- xest_muni -->
                        <div class="tab-pane fade m-2 p-3" id="xzona" role="tabpanel" aria-labelledby="xzona-tab">
                            <div class="row">
                                <div class="col">
                                    <div id="buscador_zona"></div>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col">
                                    <div id="planea_zona"></div>
                                </div>
                            </div><!-- row -->
                        </div>
                    </div>
                </div>
                <div class="card mb-3 card-style-1 mt-3">
                    <div class="card-header card-1-header bgcolor-2 text-muted">Resultados de búsqueda</div>
                    <div class="card-body">
                        <div id="div_contenedor_planea">
                          <div id="cont_cont_tematico">
                            <p>
                              <a id="btn_planea_info" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                PLANEA por contenido temático / reactivo
                              </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                <div class="row">
                                  <div class="col-1">
                                      <div class="div_grafiaca_txt rotate" hidden="true">Contenidos temáticos</div>
                                  </div>
                                    <div class="col-10">
                                        <div id="div_graficas_masivo"></div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <div id="cont_planea_nlogro">
                          <p>
                              <a id="btn_planea_info_mate" class="btn btn-primary" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                  PLANEA por nivel de logro
                              </a>
                          </p>
                          <div class="collapse" id="collapseExample2">
                            <div class="card card-body">
                              <div class="row">
                                  <div class="col-12">
                                      <div id="div_planea_tabla">
                                      </div>
                                      <div id="div_planea_nlogro_generico"></div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                </div>

            </div>
        </div><!-- card -->
    </div>
</main>


<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/highcharts.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/modules/data.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<!--Problemas con esta versión<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->
<script src="<?= base_url('assets/js/planea/graficas.js') ?>"></script>
<script src="<?= base_url('assets/js/planea/index_planea.js') ?>"></script>
<script src="<?= base_url('assets/js/planea/planea.js') ?>"></script>
