var newActBtn = document.getElementById("nuevaAct");
var listActBtn = document.getElementById("listAct");
var listAlumBtn = document.getElementById("listAlum");
var corrActiv = document.getElementById("corrAct");

newActBtn.onclick = function() {
    location.href = "nuevaActividad.php";
}

listActBtn.onclick = function() {
    location.href = "listadoAct.php";
}

listAlumBtn.onclick = function() {
    location.href = "listadoAlumnos.php";
}

corrActiv.onclick = function() {
    location.href = "selAsignaturaCorreg.php";
}
