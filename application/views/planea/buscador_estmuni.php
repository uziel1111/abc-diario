<div class="row">
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 mt-2">
    <div class="form-group form-group-style-1">
      <?=form_label('Municipio:', 'minicipio', array('class' => 'mr-sm-2'));?>
      <?=form_dropdown('minicipio', $municipios, 'large', array('class' => 'form-control', 'id' => 'slt_municipio_planea'));?>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <?=form_label('Nivel:', 'nivel');?>
      <?=form_dropdown('nivel', $niveles, 'large', array('class' => 'form-control', 'id' => 'slt_nivel_planeaxm'));?>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <?=form_label('Periodo:', 'periodo');?>
      <?=form_dropdown('periodo', $periodos, 'large', array('class' => 'form-control', 'id' => 'slt_periodo_planeaxm'));?>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 mt-2">
    <div class="form-group form-group-style-1">
      <?=form_label('Campo disciplinario:', 'campoD');?>
      <?=form_dropdown('campoD', $camposd, 'large', array('class' => 'form-control', 'id' => 'slt_campod_planeaxm'));?>
    </div>
  </div><!-- col-md-4 -->
</div><!-- row -->
<div class="row">
  <div class="col-0 col-sm-0 col-md-8 col-lg-8 mt-2"></div><!--  col-0 -->
  <div class="col-6 col-sm-6 col-md-2 col-lg-2 mt-2">
    <?= anchor(base_url(), 'Regresar', array('class' => 'btn btn-light btn-block btn-style-1')) ?>
  </div><!--  col-sm-6 -->
  <div class="col-6 col-sm-6 col-md-2 col-lg-2 mt-2">
    <?= form_submit('mysubmit', 'Buscar', array('id' => 'btn_busqueda_xestadomun', 'class'=>'btn btn-info btn-block btn-style-1' )); ?>
  </div><!--  col-sm-6 -->
</div><!-- row -->
