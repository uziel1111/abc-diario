$(function () {
    // obj_graficap = new Graficasm();
});

$("#tab_asistencia_info").click(function(e){
  e.preventDefault();
  Asistencia.get_datos_asistencia();
});