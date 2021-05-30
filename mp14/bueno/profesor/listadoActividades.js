var divTable = document.getElementById("list");
var busca = document.getElementById("inpSrch");
var lupa = document.getElementById("lupa");
var parell = 0;
var len = 0;

crear_tabla();
removeId();

console.log(json);

function crear_tabla() {

    var div = "<div class='table'>";

    div += "<div class='row thr'>";

    div += "<div class='cell thc'>Asignatura</div>";
    div += "<div class='cell thc'>Tema</div>";
    div += "<div class='cell thc'>Ver actividad</div>";
    div += "<div class='cell thc'>Eliminar actividad</div>";

    div += "</div>";

    for (let i = 0; i < json.length; i++) {

        if (parell % 2 == 0) {
            div += "<div class='row parell'>";
        } else {
            div += "<div class='row senar'>";
        }

        div += "<div class='cell id'><p>" + json[i]["id"] + "</p></div>";
        div += "<div class='cell'>" + json[i]["asignatura"] + "</div>";
        div += "<div class='cell'>" + json[i]["examen"] + "</div>";
        div += "<div class='cell mod'><a href='#'>Detalles</a></div>";
        div += "<div class='cell rem'><a href='#'>Eliminar</a></div>";

        div += "</div>";
        parell++;

    }

    div += "</div>";

    divTable.innerHTML = div;

}

function crear_uni_table() {

    parell = 0;

    var first = true;

    for (let num in json){

        if (busca.value == json[num]["asignatura"]){

            if (first){
                var div = "<div class='table'>";
                first = false;
            }

            if (parell % 2 == 0) {
                div += "<div class='row parell'>";
            } else {
                div += "<div class='row senar'>";
            }

            div += "<div class='cell id'><p>" + json[num]["id"] + "</p></div>";
            div += "<div class='cell'>" + json[num]["asignatura"] + "</div>";
            div += "<div class='cell'>" + json[num]["examen"] + "</div>";
            div += "<div class='cell mod'><a href='#'>Detalles</a></div>";
            div += "<div class='cell rem'><a href='#'>Eliminar</a></div>";

            div += "</div>";
            parell++;

        }

    }

    if (!first){
        div += "</div>";
        divTable.innerHTML = div;
    }


}

function removeId() {

    let id = document.getElementsByClassName("id");

    let rem = document.getElementsByClassName("rem");

    for (let i = 0; i < rem.length; i++) {
        rem[i].addEventListener("click", remove);
        id[i].style.display = "none";
    }

}

function remove() {
    let getId = this.parentElement.firstElementChild.firstElementChild.innerHTML;
    alert(getId);
}

lupa.onclick = function() {

    if (busca.value == ""){
        crear_tabla();
        removeId();
    } else {
        crear_uni_table();
        removeId();
    }

}
