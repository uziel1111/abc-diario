$("#busquedalista_nombreescuela").keyup(function() {
    $("#busquedalista_nombreescuela_reporte").val($(this).val());
  });

  $(document).on("click", "#table_escuelas tbody tr", function(e) {
    e.preventDefault();
      var idcentrocfg = $(this).data('idcentrocfg');
      var form = document.createElement("form");
      var element1 = document.createElement("input");
      element1.type = "hidden";
      element1.name="idcfg";
      element1.value = idcentrocfg;

      form.name = "form_escuelas_getinfo";
      form.id = "form_escuelas_getinfo";
      form.method = "POST";

      form.action = base_url+"Info_escuela/info_escuela/";

      document.body.appendChild(form);
      form.appendChild(element1);
      form.submit();
    
});