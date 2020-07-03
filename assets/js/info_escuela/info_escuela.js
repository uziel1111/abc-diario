$(function () {
    // obj_graficap = new Graficasm();
});

$("#tab_asistencia_info").click(function(e){
  e.preventDefault();
  Asistencia.get_datos_asistencia();
});


$("#tab_aprendizaje_info").click(function(e){
  e.preventDefault();
  alert("importacion");
});