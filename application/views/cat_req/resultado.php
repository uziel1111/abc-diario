<main role="main">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-light">
                Catálogo Simplificado de Requerimientos Autorizados
                <span class="float-right"><a href="<?= base_url('Cat_req/index'); ?>"><i class="fas fa-arrow-left text-light"></i></a></span>
            </div>
            <div class="card-body p-0">
                <div class="row">

                    <div class="col">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-decoration-none font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="far fa-calendar-check"></i> Calendarizados
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="d-flex">
                                                        <th class="align-middle" scope="col" width="4%">#</th>
                                                        <th class="align-middle" scope="col" width="27%">Nombre del documento</th>
                                                        <th class="align-middle" scope="col" width="10%">Sostenimiento</th>
                                                        <th class="align-middle" scope="col" width="8%">Modalidad</th>
                                                        <th class="align-middle" scope="col" width="9%">Periodicidad</th>
                                                        <th class="align-middle" scope="col" width="10%">Fecha</th>
                                                        <th class="align-middle text-center" scope="col" width="10%">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                  <?php $aux_num=1; foreach ($arr_requerimeintos as $key => $value): ?>
                                                    <?php if ($value['tipo']=='Calendarizable'): ?>
                                                      <tr class="d-flex">
                                                          <th class="align-middle" scope="row" width="4%"><?=$aux_num?></th>
                                                          <td class="align-middle font-weight-bold" width="27%"><?=$value['nombre_requierimiento']?></td>
                                                          <td class="align-middle" width="10%"><?=$value['sostenimiento']?></span></td>
                                                          <td class="align-middle" width="8%"><?=$value['modalidad']?></td>
                                                          <td class="align-middle" width="9%"><?=$value['periodicidad']?></td>
                                                          <td class="align-middle" width="10%"><?=$value['fechas_entrega']?></td>
                                                          <td class="align-middle text-center text-nowrap" width="10%">
                                                              <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                  <a class="btn btn-link btn-sm" role="button" onclick="ver_documento(<?=$value['folio']?>)"><i class="fas fa-file-alt"></i></a>
                                                              </span>
                                                              <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                  <a class="btn btn-link btn-sm" href="#" role="button" onclick="ver_detalle(<?=$value['folio']?>)"><i class="fas fa-glasses"></i></a>
                                                              </span>
                                                              <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                  <a class="btn btn-link btn-sm" href="#" role="button" onclick="ver_contacto(<?=$value['folio']?>)"><i class="fas fa-address-card"></i></a>
                                                              </span>
                                                          </td>
                                                      </tr>
                                                    <?php $aux_num++; endif; ?>
                                                  <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-decoration-none font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="far fa-calendar-times"></i> No calendarizados
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="d-flex">
                                                        <th class="align-middle" scope="col" width="4%">#</th>
                                                        <th class="align-middle" scope="col" width="55%">Nombre del documento</th>
                                                        <th class="align-middle" scope="col" width="15%">Sostenimiento</th>
                                                        <th class="align-middle" scope="col" width="10%">Modalidad</th>
                                                        <th class="align-middle text-center" scope="col" width="10%">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php $aux_num=1; foreach ($arr_requerimeintos as $key => $value): ?>
                                                    <?php if ($value['tipo']=='Circunstancial'): ?>
                                                      <tr class="d-flex">
                                                          <th class="align-middle" scope="row" width="4%"><?=$aux_num?></th>
                                                          <td class="align-middle font-weight-bold" width="55%"><?=$value['nombre_requierimiento']?></td>
                                                          <td class="align-middle" width="15%"><?=$value['sostenimiento']?></span></td>
                                                          <td class="align-middle" width="10%"><?=$value['modalidad']?></td>
                                                          <td class="align-middle text-center text-nowrap" width="10%">
                                                              <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                  <a class="btn btn-link btn-sm" href="#" role="button" onclick="ver_documento(<?=$value['folio']?>)"><i class="fas fa-file-alt"></i></a>
                                                              </span>
                                                              <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                  <a class="btn btn-link btn-sm" href="#" role="button" onclick="ver_detalle(<?=$value['folio']?>)"><i class="fas fa-glasses"></i></a>
                                                              </span>
                                                              <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                  <a class="btn btn-link btn-sm" href="#" role="button" onclick="ver_contacto(<?=$value['folio']?>)"><i class="fas fa-address-card"></i></a>
                                                              </span>
                                                          </td>
                                                      </tr>
                                                    <?php $aux_num++; endif; ?>
                                                  <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
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

<!-- Modal Ver documento-->
<div class="modal fade" id="modal-documento" tabindex="-1" aria-labelledby="modal-documentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-documentoLabel">Documento</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- PDF -->
                <div class="embed-responsive embed-responsive-1by1">
                    <embed class="embed-responsive-item" id="urldoc" src=""></emhttps:>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary btn-sm">Descargar</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver detalle-->
<div class="modal fade" id="modal-detalle" tabindex="-1" aria-labelledby="modal-documentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-documentoLabel">Detalle del documento</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detallesModal">
                <!-- Modal Detalle -->

                <!-- End Modal -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver contacto-->
<div class="modal fade" id="modal-contacto" tabindex="-1" aria-labelledby="modal-documentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-documentoLabel">Contacto</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contacto -->
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 text-center">
                            <img src="<?= base_url('assets/img/empty-user.png'); ?>" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" id="contacto_cont">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/cat_req/cat_req.js') ?>"></script>
