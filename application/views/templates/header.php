<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="icon" type="image/png" href="<?=base_url('assets/img/logo_sinaloa.png')?>">
	<title>Portal Sinaloa</title>
<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sticky-footer-navbar/" >

  <!-- Bootstrap 4.4.1 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Main CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">

  <!-- Fontawesome -->
  <script src="https://kit.fontawesome.com/bcaa9c2716.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    var base_url = "<?= base_url() ?>";
  </script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= base_url(); ?>">Portal de Información Educativa para el Estado de Sinaloa</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
         <a class="nav-link" href="<?= base_url(); ?>">Inicio</a>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#"  id="DropEstadisticas"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Estadísticas</a>
         <div class="dropdown-menu" aria-labelledby="DropEstadisticas">

           <a class="dropdown-item" href="<?= base_url('estadistica/estadistica_general'); ?>" >General</a>
           <a class="dropdown-item" href="<?= base_url('Estadistica/estadistica_especifica'); ?>">Especifica</a>

           <a class="dropdown-item" href="<?= base_url('Riesgo_Abandono/vista_principal_riesgo'); ?>">Riesgo de abandono</a>
           <a class="dropdown-item" href="<?= base_url('planea'); ?>">Resultados de PLANEA</a>
         </div>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Escuela
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="<?= base_url('Info_escuela/busqueda_general'); ?>">Localiza tu escuela</a>
           <a class="dropdown-item" href="<?= base_url('mapa'); ?>">Tu escuela en el mapa</a>
           <a class="dropdown-item" href="#">¿Sabía usted que?</a>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#">Servicios</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#">Otros</a>
       </li>
     </ul>
   </div>
</nav>

<style> .ir-arriba{
   display:none;
   background-repeat:no-repeat;
   font-size:20px;
   color:black;
   cursor:pointer;
   position:fixed;
   bottom:10px;
   right:10px;
   z-index:2;
   }</style>

  <a class="ir-arriba"  javascript:void(0) title="Volver arriba">
    <span class="fa-stack">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
    </span>
</a>
<script src="<?= base_url('assets/js/index.js'); ?>"></script>
