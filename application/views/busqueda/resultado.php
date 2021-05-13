<main role="main">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-light">
                Portafolio de Documentos Autorizados
                <span class="float-right"><a href="<?= base_url('Busqueda/index'); ?>"><i class="fas fa-arrow-left text-light"></i></a></span>
            </div>
            <div class="card-body p-0">
                <div class="row">

                    <div class="col">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-decoration-none font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="far fa-calendar-check"></i> Calendarizados
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle" scope="col">#</th>
                                                        <th class="align-middle" scope="col">Nombre del documento</th>
                                                        <th class="align-middle" scope="col">Sostenimiento</th>
                                                        <th class="align-middle" scope="col">Modalidad</th>
                                                        <th class="align-middle" scope="col">Periodicidad</th>
                                                        <th class="align-middle" scope="col">Fecha</th>
                                                        <th class="align-middle text-center" scope="col">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="align-middle" scope="row">1</th>
                                                        <td class="align-middle font-weight-bold">Sistema Integral Educativo Estatal (SIEE)</td>
                                                        <td class="align-middle">Autónomo, Estatal, Federalizado, Particular</span>
                                                        </td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle">Permanente</td>
                                                        <td class="align-middle">Agosto, Marzo</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-contacto"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle" scope="row">2</th>
                                                        <td class="align-middle font-weight-bold">Plantilla de personal por centro de trabajo</td>
                                                        <td class="align-middle">Estatal, Federalizado</td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle">Permanente</td>
                                                        <td class="align-middle">-</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle" scope="row">3</th>
                                                        <td class="align-middle font-weight-bold">Reporte de Inasistencias injustificadas </td>
                                                        <td class="align-middle">Autónomo, Estatal, Federalizado, Particular</td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle">Mensual</td>
                                                        <td class="align-middle">-</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle" scope="row">4</th>
                                                        <td class="align-middle font-weight-bold">Formatos de CEPS</td>
                                                        <td class="align-middle">Estatal, Federalizado, Particular</td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle">Trimestral</td>
                                                        <td class="align-middle">Agosto, Marzo</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-decoration-none font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="far fa-calendar-times"></i> No calendarizados
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle" scope="col">#</th>
                                                        <th class="align-middle" scope="col">Nombre del documento</th>
                                                        <th class="align-middle" scope="col">Sostenimiento</th>
                                                        <th class="align-middle" scope="col">Modalidad</th>
                                                        <th class="align-middle text-center" scope="col">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="align-middle" scope="row">1</th>
                                                        <td class="align-middle font-weight-bold">Sistema Integral Educativo Estatal (SIEE)</td>
                                                        <td class="align-middle">Autónomo, Estatal, Federalizado, Particular</span>
                                                        </td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle" scope="row">2</th>
                                                        <td class="align-middle font-weight-bold">Plantilla de personal por centro de trabajo</td>
                                                        <td class="align-middle">Estatal, Federalizado</td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle" scope="row">3</th>
                                                        <td class="align-middle font-weight-bold">Reporte de Inasistencias injustificadas </td>
                                                        <td class="align-middle">Autónomo, Estatal, Federalizado, Particular</td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-detalle"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle" scope="row">4</th>
                                                        <td class="align-middle font-weight-bold">Formatos de CEPS</td>
                                                        <td class="align-middle">Estatal, Federalizado, Particular</td>
                                                        <td class="align-middle">Todas</td>
                                                        <td class="align-middle text-center text-nowrap">
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver documento">
                                                                <a class="btn btn-link btn-sm" href="#" role="button" data-toggle="modal" data-target="#modal-documento"><i class="fas fa-file-alt"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-glasses"></i></a>
                                                            </span>
                                                            <span data-toggle="tooltip" data-placement="top" title="Ver contacto">
                                                                <a class="btn btn-link btn-sm" href="#" role="button"><i class="fas fa-address-card"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Ver documento-->
<div class="modal fade" id="modal-documento" tabindex="-1" aria-labelledby="modal-documentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-documentoLabel">Documento</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- PDF -->
                <div class="embed-responsive embed-responsive-1by1">
                    <embed class="embed-responsive-item" src="https://qual-edu.org/levantamiento_de_requerimientos/evidencias/19/146/Sub_Edu_Bas_FEsquivel_146_1566841163.pdf"></emhttps: //qual-edu.org/levantamiento_de_requerimientos/evidencias/19/146/Sub_Edu_Bas_FEsquivel_146_1566841163.pdf>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm">Descargar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver detalle-->
<div class="modal fade" id="modal-detalle" tabindex="-1" aria-labelledby="modal-documentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-documentoLabel">Detalle del documento</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detallesModal">
                <!-- Modal Detalle -->
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">
                            <span class=" text-muted">Nombre del requerimiento </span><br> Registro y Funcionamiento de Comisiones de Seguridad y Salud en el Trabajo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Descripción del requerimiento </span><br> Atendiendo al marco legal que regula la seguridad y salud en el trabajo una de las premisas más trascendentes para salvaguardar la vida, salud e integridad física de los trabajadores afiliados al ISSSTE, es aquella orientada a prevenir riesgos del trabajo y fomentar las condiciones óptimas para el desempeño de las actividades laborales que realizan las Dependencia y Entidades, mediante el establecimiento eficiente de las Comisiones de Seguridad y Salud en el Trabajo. Se proporciona a los representantes de las Comisiones de Seguridad y Salud en el Trabajo un material de apoyo documental que les facilite reforzar sus conocimientos para el adecuado registro e integración de dichos órganos.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Área que lo solicita a la escuela:</span><br> Nivel educativo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Forma de generar el requerimiento</span><br> Manual
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Dirección URL</span><br> Https://www.cuda-sedu.mx/
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Nivel educativo</span><br> Especial, Inicial, Preescolar, Primaria, Secundaria, Educación para Adultos, Extraescolar
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Forma de entregar el requerimiento</span><br> Captura en sistema
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">¿Se requiere oficio para entregar requerimiento?</span><br> No
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Periodicidad </span><br> Trimestral
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Meses en que se entrega</span><br> Marzo, Junio, Septiembre, Diciembre
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">¿Qué función tiene?</span><br> Proporciona elementos para prevenir accidentes de trabajo en las escuelas de educación básica
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Fundamento legal</span><br> Conforme a la Ley del ISSSTE Artículo V.- En todos los centros de trabajo deben de constituirse estos órganos para preservar la salud de los trabajadores, investigar las causas de los accidentes de trabajo, medidas de prevención y vigilar el estricto cumplimiento
                            Reglamento de Seguridad, Higiene y Medio Ambiente en el Trabajo del Sector Público Federal. Publicado en el Diario Oficial de la Federación el 29 de noviembre del 2006
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">¿Se solicitan anexos?</span><br> No
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">
                            <span class=" text-muted">Responsable</span><br> El director(a)
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">
                            <span class=" text-muted">Dirección Encargada</span><br> Dirección Estatal Del Programa Nacional de Convivencia Escolar
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="alert alert-success my-1 py-1" role="alert">

                            <span class=" text-muted">Tipo de sostenimiento</span><br> Federalizado
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver contacto-->
<div class="modal fade" id="modal-contacto" tabindex="-1" aria-labelledby="modal-documentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-documentoLabel">Contacto</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contacto -->
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 text-center">
                            <img src="<?= base_url('assets/img/empty-user.png'); ?>" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Felipe de Jesús Esquivel Juárez</h5>
                                <ul class="fa-ul">
                                    <li class="text-muted"><span class="fa-li"><i class="far fa-building"></i></span>Director Estatal Del Programa Nacional de Convivencia Escolar </li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-phone"></i></span> 844-1-22-77-09 </li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-envelope"></i></span><a href="#" target="_blank"> felipedejesus.esquivel@sinaloa.gob.mx</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>