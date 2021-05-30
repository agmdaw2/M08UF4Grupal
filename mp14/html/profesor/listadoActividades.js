var divTable = document.getElementById("list");
var parell = 0;
var len = 0;

crear_tabla();

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

let id = document.getElementsByClassName("id");

let rem = document.getElementsByClassName("rem");

for (let i = 0; i < rem.length; i++) {
    rem[i].addEventListener("click", remove);
    id[i].style.display = "none";
}

function remove() {
    let getId = this.parentElement.firstElementChild.firstElementChild.innerHTML;
    alert(getId);
}