<!-- BUSCADOR IMPLEMENTADO EN OTRA VISTA -->
<main role="main">
  <div class="container">

    <div class="card shadow mt-4">
      <div class="card-header bg-success text-light">
        <i class="fas fa-search"></i> Ubica tu escuela(<?= isset($subtitulo)? $subtitulo :""?>)
      </div>
      <div class="card-body pb-1 pt-1">

          <div><?= $buscador; ?> </div>
          <div id="contenedor_mapa_id"></div>

        <!-- DIV DE IMAGENES -->
        <div class="container-fluid pb-1 pt-1">
          <div class="row">
            <div class="col-12 alert alert-dark pb-0 pt-2" role="alert">
              <div class="row">
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#000000;"></i> Especial</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#810000;"></i> Inicial</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#0101ff;"></i> Preescolar</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#6b8f1e;"></i> Primaria</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#2ece2e;"></i> Secundaria</label>
                </div>
              </div>
              <div class="row">
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#9471dc;"></i> Media superior</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#ff8d00;"></i> Superior</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#ff0000;"></i> Formación para el trabajo</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#ff00ff;"></i> Otro nivel educativo</label>
                </div>
                <div class="col-sm mb-1">
                  <label class="d-inline-flex fw500"><i class="fa fa-map-marker" style="color:#ffff00;"></i> No aplica</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- CONTENEDOR DEL MAPA -->
        <div class="row">
          <div class="col-12">
            <div class="p-3" style="height: 400px" id="map"></div>
          </div>
        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>
</main>

<script src="https://jawj.github.io/OverlappingMarkerSpiderfier/bin/oms.min.js"></script>
<script src="<?= base_url('assets/js/mapa/mapa.js') ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer>
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- es la key de escuelapoblana -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBORp5ivGEk1dyiq2_6K5c85IbDOzuYymQ&callback=myMap&libraries=geometry"></script> -->
