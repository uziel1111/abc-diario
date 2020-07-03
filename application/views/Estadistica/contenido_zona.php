<div class="dv_tablas_estzona col-md-12">
    <div class="card mb-3 card-style-1">
        <div class="card-header card-1-header bgcolor-2">Alumnos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-style-1 table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th rowspan="3" class="text-center align-middle">Nivel educativo</th>
                            <th colspan="21" class="text-center">Alumnos</th>
                        </tr>
                        <tr>
                            <th><i class="fa fa-female"></i></th>
                            <th><i class="fa fa-male"></i></th>
                            <th><i class="fa fa-female"></i><i class="fa fa-male"></i></th>
                            <th>1°</th>
                            <th>2°</th>
                            <th>3°</th>
                            <th>4°</th>
                            <th>5°</th>
                            <th>6°</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: rgb(255, 128, 0); cursor: pointer;" class="parent" id="SECUNDARIA" title="Click para expander/contraer">
                            <td class="pl-1"><img style="width:12px" class="mr-5" src="http://sarape.gob.mx/assets/img/expand-button.svg"><?= $arr_datos_a_g_d_e['nivel']?></td>
                            <td><?= $arr_datos_a_g_d_e['t_alumnos_m']?></td>
                            <td><?= $arr_datos_a_g_d_e['t_alumnos_h']?></td>
                            <td><?= $arr_datos_a_g_d_e['t_alumnos']?></td>
                            <td><?= $arr_datos_a_g_d_e['alumnos1']?></td>
                            <td><?= $arr_datos_a_g_d_e['alumnos2']?></td>
                            <td><?= $arr_datos_a_g_d_e['alumnos3']?></td>
                            <td><?= $arr_datos_a_g_d_e['alumnos4']?></td>
                            <td><?= $arr_datos_a_g_d_e['alumnos5']?></td>
                            <td><?= $arr_datos_a_g_d_e['alumnos6']?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pie_tabla">
                    <div id="fuentes_pie">Fuente: SEPyC (Formato 911).</div>
                </div>
            </div>
        </div>
        <!-- card-body -->
    </div>
    <!-- card -->

    <div class="card mb-3 card-style-1">
        <div class="card-header card-1-header bgcolor-2">Personal docente</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-style-1 table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th rowspan="2" class="text-center align-middle">Nivel educativo</th>
                            <th class="text-center align-middle">Docentes</th>
                            <th class="text-center align-middle">Directivo con grupo</th>
                            <th class="text-center align-middle">Directivo sin grupo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: rgb(255, 128, 0); cursor: pointer;" class="parent" id="SECUNDARIA" title="Click para expander/contraer">
                            <td class="pl-1"><img style="width:12px" class="mr-5" src="http://sarape.gob.mx/assets/img/expand-button.svg"><?= $arr_datos_a_g_d_e['nivel']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['t_docentes']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['t_direc_congrupo']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['t_direc_singrupo']?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pie_tabla">
                    <div id="fuentes_pie">Fuente: SEPyC (Formato 911).</div>
                </div>
            </div>
        </div>
        <!-- card-body -->
    </div>
    <!-- card -->

    <div class="card mb-3 card-style-1">
        <div class="card-header card-1-header bgcolor-2">Infraestructura</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-style-1 table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th rowspan="2" class="text-center align-middle">Nivel educativo</th>
                            <th rowspan="2" class="text-center align-middle">Escuelas</th>
                            <th colspan="8" class="text-center align-middle">Grupos</th>
                        </tr>
                        <tr>
                            <th>1°</th>
                            <th>2°</th>
                            <th>3°</th>
                            <th>4°</th>
                            <th>5°</th>
                            <th>6°</th>
                            <th class="text-center align-middle">Multigrado</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: rgb(255, 128, 0); cursor: pointer;" class="parent" id="SECUNDARIA" title="Click para expander/contraer">
                            <td class="pl-1"><img style="width:12px" class="mr-5" src="http://sarape.gob.mx/assets/img/expand-button.svg"><?= $arr_datos_a_g_d_e['nivel']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['n_escuelas']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['grupos1']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['grupos2']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['grupos3']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['grupos4']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['grupos5']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['grupos6']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['gruposmulti']?></td>
                            <td class="text-center align-middle"><?= $arr_datos_a_g_d_e['t_grupos']?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pie_tabla">
                    <div id="fuentes_pie">Fuente: SEPyC (Formato 911).</div>
                </div>
            </div>
        </div>
        <!-- card-body -->
    </div>

		<div class="card mb-3 card-style-1">
	    <div class="card-header card-1-header bgcolor-2">Indicadores de asistencia</div>
	    <div class="card-body">
	        <div class="table-responsive">
	            <table class="table table-style-1 table-striped table-hover">
	                <thead class="bg-info">
	                    <tr>
	                        <th class="text-center align-middle">Nivel</th>
	                        <th class="text-center align-middle">Cobertura</th>
	                        <th class="text-center align-middle">Absorción</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr>
	                        <td><?= $arr_datos_ind['nivel']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_ind['cobertura']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_ind['absorcion']?></td>
	                    </tr>
	                </tbody>
	            </table>

	            <div class="pie_tabla">
	                <div id="fuentes_pie">Fuente: SEPyC (Formato 911).</div>
	            </div>
	        </div>
	    </div>
	    <!-- card-body -->
	</div>

	<div class="card mb-3 card-style-1">
	    <div class="card-header card-1-header bgcolor-2">Indicadores de permanencia</div>
	    <div class="card-body">
	        <div class="table-responsive">
	            <table class="table table-style-1 table-striped table-hover">
	                <thead class="bg-info">
	                    <tr>
	                        <th class="text-center align-middle">Nivel</th>
	                        <th class="text-center align-middle">Retención</th>
	                        <th class="text-center align-middle">Aprobación</th>
	                        <th class="text-center align-middle">Eficiencia Terminal</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr>
	                        <td><?= $arr_datos_ind['nivel']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_ind['retencion']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_ind['aprobacion']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_ind['eficiencia_terminal']?></td>
	                    </tr>
	                </tbody>
	            </table>

	            <div class="pie_tabla">
	                <div id="fuentes_pie">Fuente: SEPyC (Formato 911) - ciclo escolar 2016-2017</div>
	                <div id="">N/D : Dato no disponible</div>
	            </div>
	        </div>
	    </div>
	    <!-- card-body -->
	</div>
	<div class="card mb-3 card-style-1">
	    <div class="card-header card-1-header bgcolor-2">Indicadores de aprendizaje</div>
	    <div class="card-body">
	        <div class="table-responsive">
	            <table class="table table-style-1 table-striped table-hover">
	                <thead class="bg-info">
	                    <tr>
	                        <th rowspan="2" class="text-center align-middle">Resultados de la prueba Planea</th>
	                        <th colspan="5" class="text-center align-middle">Lenguaje y Comunicación</th>
	                        <th colspan="5" class="text-center align-middle">Matemáticas</th>
	                    </tr>
	                    <tr>
	                        <th colspan="4" class="text-center align-middle">Nivel de dominio</th>
	                        <th rowspan="2" class="text-center align-middle">Alumnos que superaron el nivel I</th>
	                        <th colspan="4" class="text-center align-middle">Nivel de dominio</th>
	                        <th rowspan="2" class="text-center align-middle">Alumnos que superaron el nivel I</th>
	                    </tr>
	                    <tr>
	                        <th class="text-center align-middle">Nivel</th>
	                        <th class="text-center align-middle">I
	                            <br><sub>Insuficiente</sub></th>
	                        <th class="text-center align-middle">II
	                            <br><sub>Elemental</sub></th>
	                        <th class="text-center align-middle">III
	                            <br><sub>Bueno</sub></th>
	                        <th class="text-center align-middle">IV
	                            <br><sub>Excelente</sub></th>
	                        <th class="text-center align-middle">I
	                            <br><sub>Insuficiente</sub></th>
	                        <th class="text-center align-middle">II
	                            <br><sub>Elemental</sub></th>
	                        <th class="text-center align-middle">III
	                            <br><sub>Bueno</sub></th>
	                        <th class="text-center align-middle">IV
	                            <br><sub>Excelente</sub></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr>
	                        <td><?= $arr_datos_indplanea['nivel']?> (<?= $arr_datos_indplanea['periodo_planea']?>)</td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['ni_lyc']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['nii_lyc']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['niii_lyc']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['niv_lyc']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['nii_lyc']+$arr_datos_indplanea['niii_lyc']+$arr_datos_indplanea['niv_lyc']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['ni_mat']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['nii_mat']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['niii_mat']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['niv_mat']?></td>
	                        <td style="text-align: center;"><?= $arr_datos_indplanea['nii_mat']+$arr_datos_indplanea['niii_mat']+$arr_datos_indplanea['niv_mat']?></td>
	                    </tr>
	                </tbody>
	            </table>

	            <div class="pie_tabla">
	                <div id="fuentes_pie">Fuente: SEP Federal.</div>
	            </div>
	        </div>
	    </div>
	    <!-- card-body -->
	</div>
    <!-- card -->
</div>
