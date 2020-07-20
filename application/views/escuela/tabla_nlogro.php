<div class="table-responsive">
<table id="tabla_planea" class="table table-gray table-hover">
	<thead>
		<tr>
			<th class="text-center" rowspan="2"></th>
			<th class="text-center" colspan="4">Lenguaje y Comunicación</th>
			<th class="text-center" colspan="4">Matemáticas</th>
		</tr>
		<tr>
			<th class="text-center">I
				<br><span style="font-weight:normal">Insuficiente</span>
			</th>
			<th class="text-center">II
				<br><span style="font-weight:normal">Elemental</span>
			</th>
			<th class="text-center">III
				<br><span style="font-weight:normal">Bueno</span>
			</th>
			<th class="text-center">IV
				<br><span style="font-weight:normal">Excelente</span>
			</th>
			<th class="text-center">I
				<br><span style="font-weight:normal">Insuficiente</span>
			</th>
			<th class="text-center">II
				<br><span style="font-weight:normal">Elemental</span>
			</th>
			<th class="text-center">III
				<br><span style="font-weight:normal">Bueno</span>
			</th>
			<th class="text-center">IV
				<br><span style="font-weight:normal">Excelente</span>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="9" style="background-color:silver;">PLANEA <?=((isset($ciclos[0]))?$ciclos[0]:'')?></td>
		</tr>
		<tr>
			<?php if (isset($centrocfg[0]['periodo'] ) && count($centrocfg)>0 && $centrocfg[0]['periodo'] == $ciclos[0]): ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center"><?= $centrocfg[0]['ni_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['nii_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['niii_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['niv_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['ni_mat']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['nii_mat']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['niii_mat']?>%</th>
			<th class="text-center"><?= $centrocfg[0]['niv_mat']?>%</th>
			<?php else: ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>
		<tr>
			<?php if (isset($entidad[0]['periodo'] ) && count($entidad)>0 && $entidad[0]['periodo'] == $ciclos[0]): ?>
			<th class="text-center">Estado de Sinaloa</th>
			<th class="text-center"><?= $entidad[0]['ni_lyc']?>%</th>
			<th class="text-center"><?= $entidad[0]['nii_lyc']?>%</th>
			<th class="text-center"><?= $entidad[0]['niii_lyc']?>%</th>
			<th class="text-center"><?= $entidad[0]['niv_lyc']?>%</th>
			<th class="text-center"><?= $entidad[0]['ni_mat']?>%</th>
			<th class="text-center"><?= $entidad[0]['nii_mat']?>%</th>
			<th class="text-center"><?= $entidad[0]['niii_mat']?>%</th>
			<th class="text-center"><?= $entidad[0]['niv_mat']?>%</th>
			<?php else: ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>
		<tr>
			<?php if (isset($nacional[0]['periodo']) && count($nacional)>0 && $nacional[0]['periodo'] == $ciclos[0]): ?>
			<th class="text-center">Nacional</th>
			<th class="text-center"><?= $nacional[0]['ni_lyc']?>%</th>
			<th class="text-center"><?= $nacional[0]['nii_lyc']?>%</th>
			<th class="text-center"><?= $nacional[0]['niii_lyc']?>%</th>
			<th class="text-center"><?= $nacional[0]['niv_lyc']?>%</th>
			<th class="text-center"><?= $nacional[0]['ni_mat']?>%</th>
			<th class="text-center"><?= $nacional[0]['nii_mat']?>%</th>
			<th class="text-center"><?= $nacional[0]['niii_mat']?>%</th>
			<th class="text-center"><?= $nacional[0]['niv_mat']?>%</th>
			<?php else: ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>

		<tr>
			<td colspan="9" style="background-color:silver;">PLANEA <?=((isset($ciclos[1]))?$ciclos[1]:'')?></td>
		</tr>
		<tr>
			<?php if (isset($centrocfg[1]['periodo']) && count($centrocfg)>0 && $centrocfg[1]['periodo'] == $ciclos[1]): ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center"><?= (isset($centrocfg[1]['ni_lyc']))?$centrocfg[1]['ni_lyc']:'-'?>%</th>
			<th class="text-center"><?= $centrocfg[1]['nii_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[1]['niii_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[1]['niv_lyc']?>%</th>
			<th class="text-center"><?= $centrocfg[1]['ni_mat']?>%</th>
			<th class="text-center"><?= $centrocfg[1]['nii_mat']?>%</th>
			<th class="text-center"><?= $centrocfg[1]['niii_mat']?>%</th>
			<th class="text-center"><?= $centrocfg[1]['niv_mat']?>%</th>
			<?php else: ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>
		<tr>
			<?php if (isset($entidad[1]['periodo']) && count($entidad)>0 && $entidad[1]['periodo'] == $ciclos[1]): ?>
			<th class="text-center">Estado de Sinaloa</th>
			<th class="text-center"><?= $entidad[1]['ni_lyc']?>%</th>
			<th class="text-center"><?= $entidad[1]['nii_lyc']?>%</th>
			<th class="text-center"><?= $entidad[1]['niii_lyc']?>%</th>
			<th class="text-center"><?= $entidad[1]['niv_lyc']?>%</th>
			<th class="text-center"><?= $entidad[1]['ni_mat']?>%</th>
			<th class="text-center"><?= $entidad[1]['nii_mat']?>%</th>
			<th class="text-center"><?= $entidad[1]['niii_mat']?>%</th>
			<th class="text-center"><?= $entidad[1]['niv_mat']?>%</th>
			<?php else: ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>
		<tr>
			<?php if (isset($nacional[1]['periodo']) && count($nacional)>0 && $nacional[1]['periodo'] == $ciclos[1]): ?>
			<th class="text-center">Nacional</th>
			<th class="text-center"><?= $nacional[1]['ni_lyc']?>%</th>
			<th class="text-center"><?= $nacional[1]['nii_lyc']?>%</th>
			<th class="text-center"><?= $nacional[1]['niii_lyc']?>%</th>
			<th class="text-center"><?= $nacional[1]['niv_lyc']?>%</th>
			<th class="text-center"><?= $nacional[1]['ni_mat']?>%</th>
			<th class="text-center"><?= $nacional[1]['nii_mat']?>%</th>
			<th class="text-center"><?= $nacional[1]['niii_mat']?>%</th>
			<th class="text-center"><?= $nacional[1]['niv_mat']?>%</th>
			<?php else: ?>
			<th class="text-center">Tu escuela</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>
	</tbody>
</table>
</div>
<?php if (isset($centrocfg[0]['periodo'] ) ): ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div style="display:inline-block; width:20px; height:20px; background-color:#ECC462; border: 1px solid black;"></div>
			<p style="display:inline-block; font-size:1.5em; margin-left:10px;"><?= ((isset($ciclos[0]))?$ciclos[0]:'')?></p>
		</div>
	</div>
<?php endif; ?>
<?php if (isset($centrocfg[1]['periodo'] ) ): ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div style="display:inline-block; width:20px; height:20px; background-color:#D5831C; border: 1px solid black;"></div>
			<p style="display:inline-block; font-size:1.5em; margin-left:10px;"><?=((isset($ciclos[1]))?$ciclos[1]:'')?></p>
		</div>
	</div>
<?php endif; ?>
