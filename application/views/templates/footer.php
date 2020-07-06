</section>
<footer class="footer mt-auto bg-dark">
  <div class="container">
    <img src="<?= base_url('assets/img/template/purosinaloa.png'); ?>" height="auto" width="45px" class="img-fluid" alt=""> <span class="text-muted"><i class="far fa-copyright"></i> Algunos derechos reservados. 2020. </span>
  </div>
</footer>

<!-- Modal Reactivos -->
<div class="modal fade" id="modal_visor_reactivos" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-style-1">
            <div class="modal-header bgcolor-2">
                <h5 class="modal-title text-white" id="exampleModalLabel">Consulta por reactivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="fz-18 fw800" id="modal_reactivos_title"></span>
                <hr>
                <div id="div_reactivos"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Apoyos -->
<div class="modal fade" id="modal_visor_pdfc2" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-style-1">
            <div class="modal-header bgcolor-2">
                <h5 class="modal-title text-white" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_listalinks"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Apoyos -->
<div class="modal fade" id="modal_visor_pdfc3" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-style-1">
            <div class="modal-header bgcolor-3">
                <h5 class="modal-title text-white" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_listalinks"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

</body>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?= base_url('assets/js/utilerias/miscelanea.js');?>"></script>
<script src="<?= base_url('assets/js/utilerias/mensaje_alert.js'); ?>"></script>
<script src="<?= base_url('assets/js/index.js'); ?>"></script>

</html>
