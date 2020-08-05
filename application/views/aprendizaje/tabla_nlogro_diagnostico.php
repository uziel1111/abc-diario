<div class="table-responsive">
<table id="tabla_diagnostico" class="table table-gray table-hover">
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

<?php if (isset($diagnostico_subs) && count($diagnostico_subs)>0): ?>
	<tr>
		<td colspan="9" style="background-color:silver;">DIAGNÓSTICO <?=$diagnostico_subs['periodo_planea'] ?></td>
	</tr>
	<tr>
		<th class="text-center"> <?=$diagnostico_subs['subsistema'] ?></th>
		<th class="text-center"><?=$diagnostico_subs['ni_lyc'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['nii_lyc'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['niii_lyc'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['niv_lyc'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['ni_mat'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['nii_mat'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['niii_mat'] ?>%</th>
		<th class="text-center"><?=$diagnostico_subs['niv_mat'] ?>%</th>
	</tr>
<?php endif; ?>
			<?php if (isset($diagnostico_muni) && count($diagnostico_muni)>0): ?>
				<tr>
					<td colspan="9" style="background-color:silver;">DIAGNÓSTICO <?=$diagnostico_muni['periodo_planea'] ?></td>
				</tr>
				<tr>
					<th class="text-center">Municipio </th>
					<th class="text-center"><?=$diagnostico_muni['ni_lyc'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['nii_lyc'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['niii_lyc'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['niv_lyc'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['ni_mat'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['nii_mat'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['niii_mat'] ?>%</th>
					<th class="text-center"><?=$diagnostico_muni['niv_mat'] ?>%</th>
				</tr>
			<?php endif; ?>
			<?php if (count($diagnostico_estado)>0): ?>
				<tr>
					<td colspan="9" style="background-color:silver;">DIAGNÓSTICO <?=$diagnostico_estado['periodo_planea'] ?></td>
				</tr>

							<tr>
								<th class="text-center">Estado de Sinaloa </th>
								<th class="text-center"><?=$diagnostico_estado['ni_lyc'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['nii_lyc'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['niii_lyc'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['niv_lyc'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['ni_mat'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['nii_mat'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['niii_mat'] ?>%</th>
								<th class="text-center"><?=$diagnostico_estado['niv_mat'] ?>%</th>
							</tr>
			<?php endif; ?>



	</tbody>
</table>
</div>
