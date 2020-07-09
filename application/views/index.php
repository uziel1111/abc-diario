<main id="main-index">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-sm-2 col-md-4 mb-5">
                <div class="card card-index card-home-primary shadow">
                    <div class="card-header">
                        <span class="fa-layers fa-fw fa-5x">
                            <i class="fas fa-circle rounded-circle"></i>
                            <i class="fa-inverse fas fa-chart-bar fa-xs" data-fa-transform="shrink-6"></i>
                        </span>
                        <h5 class="card-title">Estadística, indicadores y resultados educativos</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <a href="<?=base_url('Estadistica/estadistica_general/estado_municipio/alumnos');?>"><li class="list-group-item list-group-item-action">Por estado / municipio</li></a>
                            <a href="<?=base_url('Estadistica/estadistica_general/zona_escolar/alumnos');?>"><li class="list-group-item list-group-item-action">Por zona escolar</li></a>
                            <a href="<?=base_url('Info_escuela/busqueda_general/estadistica/escuela');?>"><li class="list-group-item list-group-item-action">Por escuela</li></a>
                            <a href="<?=base_url('Riesgo_abandono/vista_principal_riesgo/estadistica');?>"><li class="list-group-item list-group-item-action">Riesgo de abandono escolar por estado / municipio</li></a>
                            <a href="<?=base_url('Info_escuela/busqueda_general/estadistica/rescuela');?>"><li class="list-group-item list-group-item-action">Riesgo de abandono por escuela</li></a>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-2 col-md-4 mb-5">
                <div class="card card-index card-home-secondary shadow">
                    <div class="card-header">
                        <span class="fa-layers fa-fw fa-5x">
                            <i class="fas fa-circle rounded-circle"></i>
                            <i class="fa-inverse fas fa-check fa-xs" data-fa-transform="shrink-6"></i>
                        </span>
                        <h5 class="card-title">Aprendizaje</h5>
                    </div>
                    <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <a href="<?=base_url('Planea/index/estado_mun');?>"><li class="list-group-item list-group-item-action">Resultados PLANEA por estado / municipio</li></a>
                        <a href="<?=base_url('Planea/index/zona');?>"><li class="list-group-item list-group-item-action">Resultados PLANEA por zona escolar</li></a>
                      <a href="<?=base_url('Info_escuela/busqueda_general/aprendizaje/escuela');?>"><li class="list-group-item list-group-item-action">Resultados PLANEA por escuela</li></a>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-2 col-md-4 mb-5">
                <div class="card card-index card-home-success shadow">
                    <div class="card-header">
                        <span class="fa-layers fa-fw fa-5x">
                            <i class="fas fa-circle rounded-circle"></i>
                            <i class="fa-inverse fas fa-map-marker-alt fa-xs" data-fa-transform="shrink-6"></i>
                        </span>
                        <h5 class="card-title">Ubica tu escuela</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <a href="<?=base_url('Mapa/busqueda_x_mapa/cct');?>"><li class="list-group-item list-group-item-action">Por clave de escuela</li></a>
                            <a href="<?=base_url('Mapa/busqueda_x_mapa/paramentros');?>"><li class="list-group-item list-group-item-action">Por municipio, nivel, sostenimiento y nombre</li></a>
                            <a href="<?=base_url('Info_escuela/busqueda_general/ubica/listado');?>"><li class="list-group-item list-group-item-action">En listado de escuelas</li></a>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- <div class="col-12 col-sm-2 col-md-4 mb-5">
                <div class="card card-index card-home-info shadow">
                    <div class="card-header">
                        <span class="fa-layers fa-fw fa-5x">
                            <i class="fas fa-circle rounded-circle"></i>
                            <i class="fa-inverse fas fa-tachometer-alt fa-xs" data-fa-transform="shrink-6"></i>
                        </span>
                        <h5 class="card-title">Indicadores</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <a href="<?=base_url('Estadistica/estadistica_general/estado_municipio/asistencia');?>"><li class="list-group-item list-group-item-action">Resultados PLANEA por estado / Municipio</li></a>
                            <a href="<?=base_url('Estadistica/estadistica_general/zona_escolar/asistencia');?>"><li class="list-group-item list-group-item-action">Resultados PLANEA por escuela</li></a>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!--
            <div class="col-12 col-sm-2 col-md-4 mb-5">
                <div class="card card-index card-home-warning shadow">
                    <div class="card-header">
                        <span class="fa-layers fa-fw fa-5x">
                            <i class="fas fa-circle rounded-circle"></i>
                            <i class="fa-inverse fas fa-sign-out-alt fa-xs" data-fa-transform="shrink-6"></i>
                        </span>
                        <h5 class="card-title">Riesgo de abandono</h5>
                    </div>
                    <div class="card-body">
                    <ul class="list-group list-group-flush">
                            <a href="<?=base_url('Riesgo_abandono/vista_principal_riesgo');?>"><li class="list-group-item list-group-item-action">Estado / Municipio</li></a>
                            <a href="<?=base_url('Info_escuela/busqueda_general');?>"><li class="list-group-item list-group-item-action">Por escuela</li></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</main>
