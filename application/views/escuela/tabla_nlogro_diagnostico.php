<div class="table-responsive">
<table id="tabla_diagnostico" class="table table-gray table-hover">
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
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="9" style="background-color:silver;">DIAGNÓSTICO <?=$periodo?></td>
		</tr>
		<?php if ($idmunicipio!=0): ?>
			<tr>
				<?php if ($periodo==2020): ?>
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
				<th class="text-center">Municipio: </th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<?php endif ?>
			</tr>
		<?php else: ?>
			<tr>
				<?php if ($periodo==2020): ?>
				<th class="text-center">Estado Sinaloa </th>
				<?php if ($campodisip == 1): ?>
					<th class="text-center"><?= $diagnostico[0]['ni_lyc']?>%</th>
					<th class="text-center"><?= $diagnostico[0]['nii_lyc']?>%</th>
					<th class="text-center"><?= $diagnostico[0]['niii_lyc']?>%</th>
					<th class="text-center"><?= $diagnostico[0]['niv_lyc']?>%</th>
				<?php else: ?>
					<th class="text-center"><?= $diagnostico[0]['ni_mat']?>%</th>
					<th class="text-center"><?= $diagnostico[0]['nii_mat']?>%</th>
					<th class="text-center"><?= $diagnostico[0]['niii_mat']?>%</th>
					<th class="text-center"><?= $diagnostico[0]['niv_mat']?>%</th>
				<?php endif ?>

				<?php else: ?>
				<th class="text-center">Estado Sinaloa </th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<th class="text-center">-</th>
				<?php endif ?>
			</tr>
		<?php endif ?>

	</tbody>
</table>
</div>
