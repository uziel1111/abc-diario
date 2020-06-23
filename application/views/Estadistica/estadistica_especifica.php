<div class="container">
    <!-- Buscador Inicio-->
    <div class="row">
        <center>
            <h3>Estadística Específica</h3>
        </center>
    </div>
    <div class="row">
        <label for="cct">Escriba clave de CT (escuela)</label>
        <input type="" id="cct">
        <label for="ciclo_escolar">Ciclo escolar</label>
        <select id="ciclo_escolar">
            <option value="0" disabled selected>Seleccione un ciclo escolar</option>
            <?php foreach ($ciclos as $key => $c) { ?>
            <option value="<?=$c['idciclo']?>"><?=$c['ciclo']?></option>
            <?php } ?>
        </select>
        <button id="limpiar_filtros">Limpiar</button>
        <button id="buscar_filtros">Buscar</button>
    </div>
    <!-- Buscador fin-->

    <!-- datos de la escuela inicio-->
    <div id="datos_escuela"></div>
    <!-- datos de la escuela fin-->
    <!-- grafica escuela inicio -->
    <div id="dv_info_graf_alumn"></div>
    <div id="dv_info_graf_grupos"></div>
    <div id="dv_info_graf_docen"></div>
   <div class="col-sm-12">
    <div class='col-sm-4'>
    <div id='containerRPB03ete'></div>
    </div>
	<div class='col-sm-4'>
    <div id='dv_info_graf_Retencion'></div>
    </div>
	<div>
	

    <!-- grafica escuela fin -->

</div>
<script src="<?= base_url('assets/js/utilerias/progressbar.min.js');?>"></script>
<script src="<?= base_url('assets/highcharts5.0.3/highcharts.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/highcharts.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/data.js'); ?>"></script>
<!--Problemas con esta versión <script src="https://code.highcharts.com/modules/data.js"></script>-->
<script src="<?= base_url('assets/highcharts5.0.3/modules/drilldown.js'); ?>"></script>
<!--Problemas con esta versión<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->
<script src="<?= base_url('assets/js/Estadistica/estadistica_especifica.js') ?>"></script>