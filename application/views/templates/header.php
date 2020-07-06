<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo_sinaloa.png') ?>">
  <title>Portal Sinaloa</title>

  <!-- Bootstrap 4.4.1 -->
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">

  <!-- Style CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

  <!-- Fontawesome -->
  <!-- <script src="https://kit.fontawesome.com/bcaa9c2716.js" crossorigin="anonymous"></script> -->
  <script src="https://use.fontawesome.com/releases/v5.9.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    var base_url = "<?= base_url() ?>";
  </script>

</head>

<body>

  <section id="header-bg-1">
    <div class="container px-0">
      <nav class="navbar navbar-expand-lg">
        <div class="container nav-box shadow">
          <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url('assets/img/template/horizontal_sepyc.png'); ?>" class="img-fluid border-right pr-4" alt="">
            <img src="<?= base_url('assets/img/template/main-logo.png'); ?>" class="img-fluid pl-2" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
          </button>
          <span class="navbar-text">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown nav-primary">
                  <a class="nav-link dropdown-toggle" href="#" id="DropEstadisticas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa-layers fa-fw">
                      <i class="fas fa-circle text-primary"></i>
                      <i class="fa-inverse far fa-chart-bar fa-sm" data-fa-transform="shrink-6"></i>
                    </span>
                    <p>Estadísticas</p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="DropEstadisticas">

                    <a class="dropdown-item" href="<?=base_url('Estadistica/estadistica_general/estado_municipio/alumnos');?>">General</a>
                    <a class="dropdown-item" href="<?= base_url('Riesgo_Abandono/vista_principal_riesgo'); ?>">Riesgo de abandono</a>
                    <a class="dropdown-item" href="<?= base_url('Planea'); ?>">Resultados de PLANEA</a>
                  </div>
                </li>
                <li class="nav-item dropdown nav-secondary">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa-layers fa-fw">
                      <i class="fas fa-circle text-secondary"></i>
                      <i class="fa-inverse fas fa-school fa-xs" data-fa-transform="shrink-6"></i>
                    </span>
                    <p>Escuela</p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('Estadistica/estadistica_especifica'); ?>">Datos de la escuela</a>
                    <a class="dropdown-item" href="<?= base_url('Info_escuela/busqueda_general'); ?>">Localiza tu escuela</a>
                    <a class="dropdown-item" href="<?= base_url('Mapa/busqueda_x_mapa/'); ?>">Tu escuela en el mapa</a>
                  </div>
                </li>
              </ul>
            </div>
          </span>
        </div>
      </nav>
    </div>
  </section>

  <style>
    .ir-arriba {
      display: none;
      background-repeat: no-repeat;
      font-size: 20px;
      color: black;
      cursor: pointer;
      position: fixed;
      bottom: 50px;
      right: 10px;
      z-index: 2;
    }
  </style>

  <a class="ir-arriba" javascript:void(0) title="Volver arriba">
    <span class="fa-stack">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
    </span>
  </a>

  <a class="ir-arriba" javascript:void(0) title="Volver arriba">
    <span class="fa-stack">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
    </span>
  </a>
  <script src="<?= base_url('assets/js/index.js'); ?>"></script>

  <section id="content">
