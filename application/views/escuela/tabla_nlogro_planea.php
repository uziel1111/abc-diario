<div class="table-responsive">
<table id="tabla_planea" class="table table-gray table-hover">
	<thead>
		<tr>
			<th class="text-center" rowspan="2"></th>
			<?php if ($campodisip == 1): ?>
				<th class="text-center" colspan="4">Lenguaje y Comunicación</th>
			<?php else: ?>
				<th class="text-center" colspan="4">Matemáticas</th>
			<?php endif ?>

			
			
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
			<!-- <th class="text-center">I
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
			</th> -->
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="9" style="background-color:silver;">PLANEA <?=$ciclo?></td>
		</tr>
		<?php if (isset($municipio)): ?>
			<tr>
				<?php if (isset($municipio[0]['periodo']) && $idmunicipio != 0): ?>
				<th class="text-center">Municipio: <?= $name_muni[0]['nombre']?></th>
				<?php if ($campodisip == 1): ?>
					<th class="text-center"><?= $municipio[0]['ni_lyc']?>%</th>
					<th class="text-center"><?= $municipio[0]['nii_lyc']?>%</th>
					<th class="text-center"><?= $municipio[0]['niii_lyc']?>%</th>
					<th class="text-center"><?= $municipio[0]['niv_lyc']?>%</th>
				<?php else: ?>
					<th class="text-center"><?= $municipio[0]['ni_mat']?>%</th>
					<th class="text-center"><?= $municipio[0]['nii_mat']?>%</th>
					<th class="text-center"><?= $municipio[0]['niii_mat']?>%</th>
					<th class="text-center"><?= $municipio[0]['niv_mat']?>%</th>
				<?php endif ?>
				
				<?php else: ?>
				<th class="text-center">Municipio:</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<?php endif ?>
			</tr>
		<?php else: ?>
			<tr>
				<?php if (isset($zona[0]['periodo'])): ?>
				<th class="text-center">Zona: <?= $zona[0]['zona']?></th>
				<?php if ($campodisip == 1): ?>
					<th class="text-center"><?= $zona[0]['ni_lyc']?>%</th>
					<th class="text-center"><?= $zona[0]['nii_lyc']?>%</th>
					<th class="text-center"><?= $zona[0]['niii_lyc']?>%</th>
					<th class="text-center"><?= $zona[0]['niv_lyc']?>%</th>
				<?php else: ?>
					<th class="text-center"><?= $zona[0]['ni_mat']?>%</th>
					<th class="text-center"><?= $zona[0]['nii_mat']?>%</th>
					<th class="text-center"><?= $zona[0]['niii_mat']?>%</th>
					<th class="text-center"><?= $zona[0]['niv_mat']?>%</th>
				<?php endif ?>
				
				<?php else: ?>
				<th class="text-center">Zona</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<?php endif ?>
			</tr>
		<?php endif ?>
		
		<tr>
			<?php if (isset($estado[0]['periodo'])): ?>
			<th class="text-center">Estado Sinaloa</th>
			<?php if ($campodisip == 1): ?>
				<th class="text-center"><?= $estado[0]['ni_lyc']?>%</th>
				<th class="text-center"><?= $estado[0]['nii_lyc']?>%</th>
				<th class="text-center"><?= $estado[0]['niii_lyc']?>%</th>
				<th class="text-center"><?= $estado[0]['niv_lyc']?>%</th>
			<?php else: ?>
				<th class="text-center"><?= $estado[0]['ni_mat']?>%</th>
				<th class="text-center"><?= $estado[0]['nii_mat']?>%</th>
				<th class="text-center"><?= $estado[0]['niii_mat']?>%</th>
				<th class="text-center"><?= $estado[0]['niv_mat']?>%</th>
			<?php endif ?>
			
			<?php else: ?>
			<th class="text-center">Nacional</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>

		<tr>
			<?php if (isset($nacional[0]['periodo'])): ?>
			<th class="text-center">Nacional</th>
			<?php if ($campodisip == 1): ?>
				<th class="text-center"><?= $nacional[0]['ni_lyc']?>%</th>
				<th class="text-center"><?= $nacional[0]['nii_lyc']?>%</th>
				<th class="text-center"><?= $nacional[0]['niii_lyc']?>%</th>
				<th class="text-center"><?= $nacional[0]['niv_lyc']?>%</th>
			<?php else: ?>
				<th class="text-center"><?= $nacional[0]['ni_mat']?>%</th>
				<th class="text-center"><?= $nacional[0]['nii_mat']?>%</th>
				<th class="text-center"><?= $nacional[0]['niii_mat']?>%</th>
				<th class="text-center"><?= $nacional[0]['niv_mat']?>%</th>
			<?php endif ?>
			
			<?php else: ?>
			<th class="text-center">Nacional</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<th class="text-center">-</th>
			<?php endif ?>
		</tr>
	</tbody>
</table>
</div>
<div class="row">		
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div style="display:inline-block; width:20px; height:20px; background-color:#ECC462; border: 1px solid black;"></div>
		<p style="display:inline-block; font-size:1.5em; margin-left:10px;"><?= $ciclo?></p>
	</div>
</div>