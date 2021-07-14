<main id="main-index">
    <div class="container">

        <div class="card-columns">

            <div class="card card-index card-home-primary shadow-sm mb-5 mb-lg-0">
                <div class="card-header">
                    <h5 class="card-title">
                        <div class="row no-gutters">
                            <div class="col-auto mr-2">
                                <i class="fas fa-chart-bar fa-lg"></i>
                            </div>
                            <div class="col">
                                Estadística, indicadores y resultados educativos
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="card-body pt-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Estadistica/estadistica_general/estado_municipio/alumnos'); ?>">Por estado / municipio</a></li>
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Estadistica/estadistica_general/zona_escolar/alumnos'); ?>">Por zona escolar</a></li>
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Info_escuela/busqueda_general/estadistica/escuela'); ?>">Por escuela</a></li>
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Riesgo_abandono/vista_principal_riesgo/estadistica'); ?>">Riesgo de abandono escolar por estado / municipio</a></li>
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Info_escuela/busqueda_general/estadistica/rescuela'); ?>">Riesgo de abandono por escuela</a></li>
                    </ul>
                </div>
            </div>

            <div class="card card-index card-home-secondary shadow-sm mb-5 mb-lg-0">
                <div class="card-header">
                    <h5 class="card-title">
                        <div class="row no-gutters">
                            <div class="col-auto mr-2">
                                <i class="fas fa-check fa-lg"></i>
                            </div>
                            <div class="col">
                                Aprendizaje (Resultados)
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="card-body pt-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Planea/index/estado_mun'); ?>">PLANEA por estado / municipio</a></li>

                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Planea/index/zona'); ?>">PLANEA por zona escolar</a></li>

                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Info_escuela/busqueda_general/aprendizaje/escuela'); ?>">PLANEA y Aprendamos Juntos por escuela</a></li>

                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Aprendamos/index/estado_mun'); ?>">Aprendamos Juntos Media Superior por estado / municipio / subsistema</a></li>
                    </ul>
                </div>
            </div>

            <div class="card card-index card-home-success shadow-sm mb-5 mb-lg-0">
                <div class="card-header">
                    <h5 class="card-title">
                        <div class="row no-gutters">
                            <div class="col-auto mr-2">
                                <i class="fas fa-map-marker-alt fa-lg"></i>
                            </div>
                            <div class="col">
                                Ubica tu escuela
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="card-body pt-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Mapa/busqueda_x_mapa/cct'); ?>">
                                Por clave de escuela</a></li>

                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Mapa/busqueda_x_mapa/parametros'); ?>">
                                Por municipio, nivel, sostenimiento y nombre</a></li>

                    </ul>
                </div>
            </div>

            <div class="card card-index card-home-warning shadow-sm mb-5 mb-lg-0 mt-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <div class="row no-gutters">
                            <div class="col-auto mr-2">
                                <i class="fas fa-briefcase fa-lg"></i>
                            </div>
                            <div class="col">
                                Descarga administrativa
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="card-body pt-1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action"><a class="text-dark text-decoration-none" href="<?= base_url('Cat_req/index'); ?>">
                                <span class="new-sign text-muted"><i class="fas fa-star fa-xs"></i></span>
                                Catálogo Simplificado de Requerimientos Autorizados</a></li>
                    </ul>
                </div>
            </div>
        </div>



    </div>
</main>
