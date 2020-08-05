<div class="row">
  <div class="col-12 col-md-4 col-lg-3 mt-2">
    <div class="form-group form-group-style-1">
      <?= form_label('Subsistemas:', 'subsistemas', array('class' => 'mr-sm-2')); ?>
      <?= form_dropdown('minicipio', $subsistemas, 'large', array('class' => 'form-control', 'id' => 'slt_subsistema')); ?>
    </div>
  </div><!-- col-md-4 -->

  <div class="col-12 col-md-4 col-lg-3 mt-2">
    <div class="form-group form-group-style-1">
      <?= form_label('Periodo:', 'periodo'); ?>
      <?= form_dropdown('periodo', $periodos, 'large', array('class' => 'form-control', 'id' => 'slt_periodo_pzona', 'disabled' => 'disabled')); ?>
    </div>
  </div><!-- col-md-4 -->
  <div class="col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <?= form_label('', ''); ?>
    <?= anchor(base_url(), 'Regresar', array('class' => 'btn btn-info text-light btn-block')) ?>
    </div>
  </div><!--  col-sm-6 -->
  <div class="col-md-3 col-lg-2 mt-2">
    <div class="form-group form-group-style-1">
      <?= form_label('', ''); ?>
    <?= form_submit('mysubmit', 'Buscar', array('id' => 'btn_busqueda_xzona', 'class' => 'btn btn-success btn-block text-light')); ?>
    </div>
  </div><!--  col-sm-6 -->

</div><!-- row -->
