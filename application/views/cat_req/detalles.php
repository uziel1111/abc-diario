<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">
            <span class=" text-muted">Nombre del requerimiento </span><br> <?=$arr_detalles->nombre_requierimiento?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Descripción del requerimiento </span><br> <?=$arr_detalles->descripcion_req?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Área que lo solicita a la escuela:</span><br> <?=str_replace(',',' ',str_replace('Otro <input type="text" name="otro_input">', "",$arr_detalles->area_solicitante))?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Forma de generar el requerimiento</span><br> <?=$arr_detalles->forma_de_generar?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Dirección URL</span><br> <?=$arr_detalles->url_si_sistema?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Nivel educativo</span><br> <?=$arr_detalles->niveles?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Forma de entregar el requerimiento</span><br> <?=$arr_detalles->forma_entregar_req?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">¿Se requiere oficio para entregar requerimiento?</span><br> <?=$arr_detalles->se_requiere_oficio?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Periodicidad </span><br> <?=$arr_detalles->periodicidad?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Meses en que se entrega</span><br> <?=$arr_detalles->fechas_entrega?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">¿Qué función tiene?</span><br> <?=$arr_detalles->utilidad?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Fundamento legal</span><br> <?=$arr_detalles->fudamento_legal?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">¿Se solicitan anexos?</span><br> <?=$arr_detalles->con_anexos?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success my-1 py-1" role="alert">

            <span class=" text-muted">Tipo de sostenimiento</span><br> <?=$arr_detalles->sostenimiento?>
        </div>
    </div>
</div>
