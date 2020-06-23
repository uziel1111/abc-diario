
var Miscelanea = {
  showPDF : function(idModal, urlPdf){
    var dom = '<iframe src="'+urlPdf+'" width="100%" height="500" style="border: none;"></iframe>';
    $("#"+idModal +" .modal-body").empty();
    $("#"+idModal +" .modal-body").html(dom);
    $("#"+idModal).modal("show");
  }

};
