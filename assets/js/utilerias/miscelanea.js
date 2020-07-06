
var Miscelanea = {
  showPDF : function(idModal, urlPdf){
    var dom = '<iframe src="'+urlPdf+'" width="100%" height="500" style="border: none;"></iframe>';
    $("#"+idModal +" .modal-body").empty();
    $("#"+idModal +" .modal-body").html(dom);
    $("#"+idModal).modal("show");
  },

  goto_seccion : function(id_dv_seccion){
    if (id_dv_seccion!='') {
      setTimeout(function () {
        var my_element = document.getElementById(id_dv_seccion);
        my_element.scrollIntoView({
          behavior: "smooth",
          block: "start",
          inline: "nearest"
        });
      }, 400);
    }
  }
};
