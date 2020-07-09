<main role="main">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-secondary text-light">
                <i class="fas fa-search"></i> Aprendizaje(<?= isset($subtitulo)? $subtitulo :""?>)
            </div>
            <input type="hidden" name="itxt_planea_event" id="itxt_planea_event" value="<?= $seccion_event?>">
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <h4>Seleccione tipo de búsqueda</h4>
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
                        <div class="row">
                          <div class="col-1">
                              <div class="div_grafiaca_txt rotate" hidden="true">Contenidos temáticos</div>
                          </div>
                            <div class="col-10">
                                <div id="div_graficas_masivo"></div>
                            </div>
                        </div>
                    </div><!-- card-body -->
                </div>

            </div>
        </div><!-- card -->
    </div>
</main>

<!-- Modal Apoyos -->
<div class="modal fade" id="modal_visor_apoyos_academ" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-style-1">
            <div class="modal-header bgcolor-4">
                <h5 class="modal-title text-white" id="exampleModalLabel">Apoyos académicos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_listalinks"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->







<!-- Modal Apoyos -->
<div class="modal fade" id="modal_visor_material_reactivos" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-style-1">
            <div class="modal-header bgcolor-4">
                <h5 class="modal-title text-white" id="exampleModalLabel"></h5>
                <button type="button" class="close" id="md_close_iframe" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_listalinks"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<!-- Modal Apoyos -->
<div class="modal fade" id="modal_operacion_recursos" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-style-1">
            <div class="modal-header bgcolor-4">
                <h5 class="modal-title text-white" id="exampleModalLabel">Propuestas de material de apoyo</h5>
                <button type="button" class="close" id="md_close_operacion_recursos" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Ayúdanos a mejorar los materiales de apoyo para nuestros alumnos, en este espacio puedes proponer videos, archivos o textos que en tu experiencia son efectivos.
                </p>
                <p>Muchas gracias.</p>
                <div class="form-group">
                    <label for="tipodematerial">Seleccione tipo de contenido a subir</label>
                    <select class="form-control" id="tipodematerial">
                        <?php foreach ($contenidos as $key => $value) : ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="div_contenedor_operaciones">
                    <div class="form-group">
                        <label for="inputtitulo">Introduzca un título para su contenido: </label>
                        <input type="text" class="form-control" id="inputtitulo" placeholder="Titulo">
                        <p id="mensaje_alertattitulo" style="color:red;">*El título es requerido</p>
                    </div>
                    <div class="form-group">
                        <label for="inputcampourl">Introduzca url: </label>
                        <input type="text" class="form-control" id="inputcampourl" placeholder="https://misitiodeapoyo.com">
                        <p id="mensaje_alertaurl" style="color:red;">*El url es requerido</p>
                        <p id="mensaje_alertaur2" style="color:red;">*El url no esta permitido</p>
                    </div>
                    <div class="form-group">
                        <label for="inputcampofuente">Introduzca fuente: </label>
                        <input type="text" class="form-control" id="inputcampofuente" name="fuenteurlvideo">
                        <p id="mensaje_alertafuente" style="color:red;">*La fuente es requerida</p>
                    </div>
                    <input type="hidden" name="idreactivo" id="idreactivoform_pub">
                    <button type="button" class="btn btn-info" onClick="obj_graficas.envia_url_pub()">Guardar</button>
                </div>
                <div id="div_contenedor_operaciones_files">
                    <!--el enctype debe soportar subida de archivos con multipart/form-data-->
                    <form enctype="multipart/form-data" class="formulario">
                        <label>Título</label><br />
                        <input name="titulo" type="text" id="titulofile" class="form-control" />
                        <p id="mensaje_alertatitulo_file" style="color:red;">*El título es requerido</p>
                        <input name="archivo" type="file" id="imagen" accept="application/pdf" />
                        <p id="mensaje_alertafile" style="color:red;">*Seleccione un archivo</p>
                        <div class="form-group">
                            <label for="inputcampofuentefile">Introduzca fuente: </label>
                            <input type="text" class="form-control" id="inputcampofuentefile" name="fuentefile">
                            <p id="mensaje_alertafuente_file" style="color:red;">*La fuente es requerida</p>
                        </div>
                        <!--div para visualizar mensajes-->
                        <div class="messages"></div><br /><br />
                        <!--div para visualizar en el caso de imagen-->
                        <div class="showImage"></div>
                        <input type="button" value="Subir" class="btn btn-info" id="btn_subir_pdf_imagen_pub" /><br />
                        <input type="hidden" name="tipo" id="idtipofileform">
                        <input type="hidden" name="idreactivo" id="idreactivofileform_pub">
                        <input type="hidden" name="idseleccionadofile" id="idseleccionadofile" value="false">
                        <input type="hidden" name="validaexixtente" id="validaexixtente" value="false">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/highcharts.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/modules/data.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<!--Problemas con esta versión<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->
<script src="<?= base_url('assets/js/planea/graficas.js') ?>"></script>
<script src="<?= base_url('assets/js/planea/planea.js') ?>"></script>
