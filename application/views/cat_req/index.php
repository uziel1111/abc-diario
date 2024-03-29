<main role="main">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-light">
                Profes sin tanto papeleo
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12 mb-3 mb-md-0 col-md-3 col-lg-3 text-center">
                        <img src="<?= base_url('assets/img/professintantopapeleo-3.png'); ?>" width="100" alt="">
                    </div>
                    <div class="col-12 col-md-9 col-lg-9">
                        <div class="alert alert-info text-left role="alert">
                            <span class="font-weight-bold">Con el propósito de reducir de forma sustantiva la carga administrativa de las escuelas de educación básica en Sinaloa, se revisaron 158 requerimientos de información, de los cuales se acordó de forma colegiada eliminar 90 de ellos, por lo que a continuación se presenta los 68 requerimientos simplificados (entre formatos y sistemas automatizados) que son indispensables y obligatorios para el ciclo escolar 2021-2022</span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php foreach ($num_xnivel as $key => $value) : ?>
                        <?php
                        switch ($value['nivel']) {
                            case 'Inicial':
                        ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Educación inicial</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-puzzle-piece fa-3x text-primary si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-primary"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Preescolar':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Preescolar</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-shapes fa-3x text-secondary si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-secondary"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Primaria':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Primaria</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-book-reader fa-3x text-success si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-success"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Secundaria':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Secundaria</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-microscope fa-3x text-danger si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-danger"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Especial':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Educación especial</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-sign-language fa-3x text-warning si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-warning"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Educación indígena':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Educación indígena</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <img src="<?= base_url('assets/img/danza-icono.png'); ?>" class="img-fluid si-icon" width="49%" height="auto" alt="...">
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-info"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Educación para Adultos':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Educ. para adultos</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-user-friends fa-3x text-primary si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-primary"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            case 'Educación migrante':
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong>Educación migrante</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-flag fa-3x text-secondary si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-secondary"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                break;
                            default:
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= base_url('cat_req/resultado/') . $value['nivel']; ?>" class="search-item">
                                        <div class="card mb-3 p-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="text-muted"><strong><?= $value['nivel'] ?></strong></h5>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-4">
                                                    <i class="fas fa-flag fa-3x text-secondary si-icon"></i>
                                                </div>
                                                <div class="col-8 text-right">
                                                    <small class="text-muted d-block">Total</small>
                                                    <span class="h4 text-secondary"><?= number_format($value['num_req']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                                break;
                        } ?>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</main>