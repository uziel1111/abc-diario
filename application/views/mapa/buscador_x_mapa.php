    <div class="row">
        <div class="col-xs-12 col-sm-6 col-lg-4" <?=(($tipo_busqueda=='paramentros')?'':(($tipo_busqueda=='')?'':'hidden'))?>>
            <div class="form-group form-group-style-1">
          <?=form_label('Municipio', 'minicipio', array('class' => 'mr-sm-2'));?>
          <?=form_dropdown('minicipio', $municipios, 'large', array('class' => 'form-control', 'id' => 'slt_municipio_mapa'));?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4" <?=(($tipo_busqueda=='paramentros')?'':(($tipo_busqueda=='')?'':'hidden'))?>>
            <div class="form-group form-group-style-1">
          <?=form_label('Nivel', 'nivel');?>
          <?=form_dropdown('nivel', $niveles, 'large', array('class' => 'form-control', 'id' => 'slt_nivel_mapa'));?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4" <?=(($tipo_busqueda=='paramentros')?'':(($tipo_busqueda=='')?'':'hidden'))?>>
            <div class="form-group form-group-style-1">
            <?=form_label('Sostenimiento', 'sostenimiento');?>
            <?=form_dropdown('sostenimiento', $sostenimientos, 'large', array('class' => 'form-control', 'id' => 'slt_sostenimiento_mapa'));?>
            </div>
        </div>
    </div>
    <div class="row mb-15">
        <div class="col-xs-12 col-sm-6 col-lg-4" <?=(($tipo_busqueda=='paramentros')?'':(($tipo_busqueda=='')?'':'hidden'))?>>
            <div class="form-group form-group-style-1">
            <?=form_label('Nombre de la escuela (opcional)', 'n_escuela');?>
            <?=form_input('n_escuela', '', array('class' => 'form-control', 'id' => 'txt_nombre_escuela'));?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4" <?=(($tipo_busqueda=='cct')?'':(($tipo_busqueda=='')?'':'hidden'))?>>
            <div class="form-group form-group-style-1">
             <?=form_label('Clave Centro de Trabajo (opcional)', 'cct');?>
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text fw800" id="btnGroupAddon">25</div>
                </div>
                <?=form_input('cct', '', array('class' => 'form-control fw800', 'id' => 'txt_cct_escuela'));?>
              </div>
            </div>
        </div>
          <div class="col-xs-12 col-sm-6 col-lg-4 mt-2 d-none">
            <?=form_label('', '');?>
            <button class="btn btn-success btn-block text-light btn-style-1 d-none" id="btn_ayuda_mapa">Ayuda</button>
          </div><!--  col-sm-6 -->

          <div class="col-xs-12 col-sm-6 col-lg-4 mt-2">
            <?=form_label('', '');?>
            <button class="btn btn-info btn-block btn-style-1" id="btn_buscar_mapa">Buscar</button>
          </div><!--  col-sm-6 -->

    </div>



<script src="<?= base_url('assets/js/mapa/funcionalidad_mapa.js') ?>"></script>
