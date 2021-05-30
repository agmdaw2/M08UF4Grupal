var divTable = document.getElementById("list");
var parell = 0;

crear_tabla();

console.log(json[0]);

function crear_tabla() {
    
    var div = "<div class='table'>";
    
    for (let i = 0; i < json.length; i++) {
        
        if (parell % 2 == 0) {
            div += "<div class='row parell'>";
        } else {
            div += "<div class='row senar'>";
        }
        
        let nom_complet = json[i]["nombre"] + " " + json[i]["apellidos"];
        
        div += "<div class='cell id'><p>" + json[i]["id"] + "</p></div>";
        div += "<div class='cell'>" + nom_complet + "</div>";
        div += "<div class='cell'><a href='#'>Detalles</a></div>"
        div += "<div class='cell mod'><a href='#'>Modificar</a></div>"
        div += "<div class='cell rem'><a href='#'>Eliminar</a></div>"
        
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
    console.log(getId);
}

var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var cancelar = document.getElementById("modCancel");

cancelar.onclick = function() {
    modal.style.display = "none";
}

window.onload = function() {
    modal.style.display = "none";
}

btn.onclick = function() {
    modal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == modal) modal.style.display = "none";
}