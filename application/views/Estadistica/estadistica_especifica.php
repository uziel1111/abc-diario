<main role="main">
    <div class="container">
        <div class="card ">
            <div class="card-header">
                <h5 align="center">Estadística Específica</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="cct">Escriba clave de CT (escuela)</label>
                            <input type="text" class="form-control" id="cct" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="ciclo_escolar">Turno</label>
                            <select id="turno_est_esp" class="form-control">
                                <option value="0" disabled selected>Seleccione un turno</option>
                                <?php foreach ($turnos as $key => $c) { ?>
                                <option value="<?=$c['idturno']?>"><?=$c['turno']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="ciclo_escolar">Ciclo escolar</label>
                            <select id="ciclo_escolar" class="form-control">
                                <option value="0" disabled selected>Seleccione un ciclo escolar</option>
                                <?php foreach ($ciclos as $key => $c) { ?>
                                <option value="<?=$c['idciclo']?>"><?=$c['ciclo']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" id="limpiar_filtros" class="btn btn-danger btn-sm">Limpiar</button>
                        <button type="button" id="buscar_filtros" class="btn btn-primary btn-sm">Buscar</button>
                    </div>
                </div>
                <!-- datos de la escuela inicio-->
                <div id="datos_escuela"></div>
                <!-- datos de la escuela fin-->
                <!-- grafica escuela inicio -->
                <div class="row">
                    <div class='col-4'>
                      <div id="dv_info_graf_alumn"></div>
                    </div>
                    <div class='col-4'>
                      <div id="dv_info_graf_grupos"></div>
                    </div>
                    <div class='col-4'>
                      <div id="dv_info_graf_docen"></div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-4'>
                    <div id='containerRPB03ete'></div>
                    </div>
                    <div class='col-4'></div>
                    <div class='col-4'>
                    <div id='dv_info_graf_Retencion'></div>
                    </div>
                </div>
                <!-- grafica escuela fin -->
            </div>
        </div>
    </div>
</main>
<!-- <div class="container">




</div> -->
<script src="<?= base_url('assets/js/utilerias/progressbar.min.js');?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/highcharts.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/modules/data.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<!--Problemas con esta versión<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->
<script src="<?= base_url('assets/js/Estadistica/estadistica_especifica.js') ?>"></script>
