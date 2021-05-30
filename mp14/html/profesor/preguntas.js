let all;
let contador_div;
let contador_divRespuesta;


function eliminarhijos(div){
    let elemento = div;
    while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
    }
}

window.onload = function(){
    inicio();
}

function inicio(){
    // True si queremos meterle el form, False para que sea un div normal
    //              Nos sirve para probar
    let elemento = eleccionForm(true);
    let titulo = document.createElement('h1');
    titulo.setAttribute('id','actividad');
    titulo.setAttribute('class', 'defMargin');
    contenidoTitulo = document.createTextNode("Seleccione la asignatura: ")
    titulo.appendChild(contenidoTitulo);
    elemento.appendChild(titulo);
    let div = document.createElement('div');
    div.setAttribute('id', 'all');
    elemento.appendChild(div);
    let padre = document.getElementById('todo');
    padre.appendChild(elemento);
    all = document.getElementById("all");
    setTipoAsignatura();
    
    let divAll = document.getElementById("all");
    divAll.style.display = "none";
}

function eleccionForm(quieresForm){
    let elemento;
    if(quieresForm == true){
        elemento = document.createElement('form');
        elemento.setAttribute('id', 'bodyAll');
        elemento.setAttribute('method', "POST"); 
    }else{
        elemento = document.createElement('div');
        elemento.setAttribute('id', 'bodyAll');
    }
    return elemento;
}

function setTipoAsignatura(){
    let padre = document.getElementById("actividad");
    let sel = document.createElement("select");
    sel.setAttribute('id','selAsignatura');
    padre.appendChild(sel);
    sel.setAttribute("onchange", "setTipoActividad()");
    let option1 = document.createElement("option");
    option1.appendChild(document.createTextNode("Selecciona la asignatura..."));
    sel.appendChild(option1);
    let option2 = document.createElement("option");
    option2.appendChild(document.createTextNode("Naturales"));
    option2.setAttribute('value', "Naturales" );
    option2.setAttribute('name', "Naturales" );
    sel.appendChild(option2);
    let option3 = document.createElement("option");
    option3.appendChild(document.createTextNode("Sociales"));
    option3.setAttribute('value', "Sociales" );
    option3.setAttribute('name', "Sociales" );
    sel.appendChild(option3);
}

function setTipoActividad(){
    segundaParte();
    let tipoActividad = document.getElementById("selAsignatura").value;
    let titulo = document.getElementById("actividad");
    let contenidoTitulo = "Nueva Actividad de "+ tipoActividad;
    titulo.innerHTML = contenidoTitulo;
    titulo.setAttribute('name', tipoActividad);
    let inputActividad = document.createElement('input');
    inputActividad.setAttribute('name', 'nom_ex');
    inputActividad.setAttribute('type', "text");
    inputActividad.setAttribute('placeholder', "Titulo de la Actividad");
    titulo.appendChild(inputActividad);
    let divAll = document.getElementById("all");
    divAll.style.display = "";
}

function segundaParte(){
    crear_preguntas(null);
    botonFinalizar();
    botonNuevaPregunta(false);
}

function botonNuevaPregunta(existe){
    if(existe == false){
        let txt1 = document.createTextNode("Nueva Pregunta");
        let bt1 = document.createElement("button");
        let nodoBefore = document.getElementById("acabar");
        bt1.setAttribute('id','nuevaPreg');
        bt1.setAttribute('class','btn');
        all.appendChild(bt1);
        bt1.appendChild(txt1);
        bt1.setAttribute('onclick', "nuevaPregunta(event)");
    }
}

function nuevaPregunta(evento){
    evento.preventDefault();
    contador_div += 1;
    crear_preguntas(contador_div);
    let boton = document.getElementById("nuevaPreg")
    all.removeChild(boton);
    let nodoBefore = document.getElementById("acabar");
    all.appendChild(boton);
}

function botonFinalizar(){
    let boton = document.createElement('input');
    boton.setAttribute('type', 'submit');
    boton.setAttribute('id', 'acabar');
    boton.setAttribute('value', 'Guardar Actividad');
    let padre = document.getElementById('bodyAll');
    padre.appendChild(boton);
}

// Apuntes, hay una nueva opcion en CSS que se llama clear para que los elementos 
// siguientes no sean flotantes de tal manera que podemos hacer el tipico breakLine
// que con el nuevo HTML5 esta desaconsejado https://developer.mozilla.org/es/docs/Web/CSS/clear

function crear_preguntas(wololo) {
    contador_divRespuesta = 1;
    // div preguntas
    let divp = document.createElement("div");

    if (wololo == null){
        contador_div = 1;
        all.appendChild(divp);
    }
    else{
        contador_div = wololo;
        let divBefore = document.getElementById("nuevaPreg");
        all.insertBefore(divp, divBefore);
    }
    
    // div preguntas
    divp.setAttribute('id', 'divPreg' + contador_div);
    divp.setAttribute('class', 'divPreg' + contador_div);
    divp.className += " pregBox";
    
    // div pregunta
    let divx = document.getElementById('divPreg' + contador_div);
    let divEnunciado = document.createElement('h2');
    let txt_divEnunciado = document.createTextNode('Pregunta  : ');
    divEnunciado.appendChild(txt_divEnunciado);
    divx.appendChild(divEnunciado);

    // seleccion de pregunta
    sel= document.createElement("select");
    sel.setAttribute('id','sel' + contador_div);
    divx.appendChild(sel);
    let option1 = document.createElement("option");
    option1.appendChild(document.createTextNode("Selecciona un tipo de pregunta..."));
    sel.appendChild(option1);
    // let option2 = document.createElement("option");
    // option2.setAttribute('value', "tipoRelacionar" );
    // option2.appendChild(document.createTextNode("Tipo Relacionar"));
    // sel.appendChild(option2);
    // let option3 = document.createElement("option");
    // option3.setAttribute('value', "tipoBox" );
    // option3.appendChild(document.createTextNode("Tipo Box"));
    // sel.appendChild(option3);
    let option4 = document.createElement("option");
    option4.setAttribute('value', "tipoRespuestaCorta" );
    option4.appendChild(document.createTextNode("Tipo Respuesta Corta"));
    sel.appendChild(option4);
    let option5 = document.createElement("option");
    option5.setAttribute('value', "tipoRespuestaLarga" );
    option5.appendChild(document.createTextNode("Tipo Respuesta Larga"));
    sel.appendChild(option5);
    let option6 = document.createElement("option");
    // option6.appendChild(document.createTextNode("Tipo Respuesta Múltiple/Simple"));
    // option6.setAttribute('value', "tipoRespuestaMultipleSimple" );
    // sel.appendChild(option6);
    // let option7 = document.createElement("option");
    // option7.setAttribute('value', "tipoV_F" );
    // option7.appendChild(document.createTextNode("Tipo Respuesta Verdadero/Falso"));
    // sel.appendChild(option7);

    // Seleccionar el contador_div de la pregunta que pertoca por si añadimos una pregunta nueva no tengamos problemas 
    // para añadir respuestas en la pregunta anterior a causa de cambiar el contador_div
    // let cadenaId = divx.getAttribute('id');
    // let ultimoCaracter = cadenaId.charAt(cadenaId.length - 1);
    // let contadorReal = parseInt(ultimoCaracter);

    preguntas = document.querySelectorAll('.divPreg' + contador_div);
    let mismaPregunta = false;
    preguntas[0].addEventListener("change", function(){
        
        let idSelect = this.id.substring(7);
   

        if(mismaPregunta == false){   
            //input ENUNCIADO
            let inputEnunciado = document.createElement('input');
            inputEnunciado.setAttribute('type', "text");
            inputEnunciado.setAttribute('placeholder', "ENUNCIADO");


            let preg = document.getElementById('sel' + idSelect).value;
            let divdiv = document.createElement('div');

            divdiv.setAttribute('id', 'divRespAll' + contador_div);
            divdiv.setAttribute('class', 'corr_word');

            divdiv.setAttribute('id', 'divRespAll' + idSelect);

            divx.appendChild(divdiv);
            //variable que asignara si se necesita el boton de NuevaRespuesta
            let seNecesitaButtonNuevaResp = false;
            let divRespuesta = document.createElement("div");
            let label = document.createElement("label");

            // if (preg == 'tipoRelacionar'){
            //     console.log(preg);
            // }
            // if (preg == 'tipoBox'){
            //     console.log(preg);   
            // }
            if (preg == 'tipoRespuestaCorta'){
                inputEnunciado.setAttribute('name', 'preg_corta['+idSelect+'][enun]');
                divRespuesta.setAttribute('id','divResp'+ idSelect + contador_divRespuesta);
                label.setAttribute("for", 'nuevaRespuesta'+ idSelect +contador_divRespuesta);
                inputRespuesta = document.createElement('input');
                inputRespuesta.setAttribute('type', 'text');
                inputRespuesta.setAttribute('id', 'nuevaRespuesta' + idSelect  + contador_divRespuesta);
                inputRespuesta.setAttribute('name', 'preg_corta['+idSelect+'][resp]');
                inputRespuesta.setAttribute('placeholder', 'Escribe la palabra correcta')
                label.appendChild(inputRespuesta);
                divRespuesta.appendChild(label);  
            } 
            if (preg == 'tipoRespuestaLarga'){
                inputEnunciado.setAttribute('name', 'preg_larga['+idSelect+'][enun]');
            }
            // if (preg == 'tipoRespuestaMultipleSimple'){
                // divRespuesta.setAttribute('id','nuevaRespuesta' + contador_divRespuesta);
                // label.setAttribute("for", 'pregMultSim'+contador_divRespuesta);
                // inputRespuesta = document.createElement('input');
                // inputRespuesta.setAttribute('type', 'text');
                // inputRespuesta.setAttribute('id', 'pregMultSim' +contador_divRespuesta);
                // inputCheckbox = document.createElement('input');
                // inputCheckbox.setAttribute('type', 'checkbox');
                // inputCheckbox.setAttribute('id', 'pregMultSim' +contador_divRespuesta);
                // label.appendChild(inputCheckbox);
                // label.appendChild(inputRespuesta);
                // divRespuesta.appendChild(label);  
                // Nueva Respuesta no funciona correctamente
            // }

            // if (preg == 'tipoV_F'){
            //     console.log(preg);
            // }
            
            divEnunciado.appendChild(inputEnunciado);
            divdiv.appendChild(divRespuesta);

            if(seNecesitaButtonNuevaResp == true){
                divdiv.appendChild(crearBotonNuevaRespuesta());
                // boton para borrar Respuestas
                let textoBoton = document.createTextNode("X");
                let botonEliminarResp = document.createElement("button");
                botonEliminarResp.setAttribute('id','eliminarResp' + contador_divRespuesta);
                botonEliminarResp.setAttribute('class','btn');
                label.appendChild(botonEliminarResp);
                botonEliminarResp.appendChild(textoBoton);
                botonEliminarResp.setAttribute('onclick', "borrarElemento(divRespAll"+idSelect+",divResp"+idSelect+contador_divRespuesta+")");
            }
            mismaPregunta = true;
        }else{ 
        } 
    });
    let txtEliminarPreg = document.createTextNode("Eliminar Pregunta");
    let botonEliminarPreg = document.createElement("button");
    botonEliminarPreg.setAttribute('id','eliminar' + contador_div);
    botonEliminarPreg.setAttribute('class','btn');
    botonEliminarPreg.setAttribute('onclick', "borrarElemento(1,divPreg"+contador_div+")");
    divp.appendChild(botonEliminarPreg);
    botonEliminarPreg.appendChild(txtEliminarPreg);
}

function crearBotonNuevaRespuesta(){
    let texto = document.createTextNode("Nueva Respuesta");
    let botonNuevaResp = document.createElement("button");
    botonNuevaResp.setAttribute('id','botonNuevaResp' + contador_div);
    botonNuevaResp.setAttribute('class','btn');
    botonNuevaResp.appendChild(texto);
    botonNuevaResp.setAttribute('onclick', "nuevaRespuesta(botonNuevaResp"+contador_div+")");
    return botonNuevaResp;
}

function nuevaRespuesta(botonNewResp){
    contador_divRespuesta = contador_divRespuesta + 1;
    let idBoton = botonNewResp.id;
    let contadorDeReferencia = idBoton.charAt(idBoton.length-1);
    let ultimoNodoResp = botonNewResp.previousSibling; //con esto selecionaremos  el hermano del boton NuevaRespuesta que es el ultimo div de Respuestas
    let copiaNodo = ultimoNodoResp.cloneNode(true); // el true nos copiara todo el txt que haya dentro del nodo copiado
    copiaNodo.setAttribute('id','divResp' + contador_div + contador_divRespuesta);
    copiaNodo.firstChild.setAttribute('for', 'nuevaRespuesta'+ contador_div +contador_divRespuesta);
    copiaNodo.firstChild.childNodes[0].setAttribute('id', 'nuevaRespuesta'+ contador_div+contador_divRespuesta);
    copiaNodo.firstChild.childNodes[1].setAttribute('id', 'eliminarResp'+ contador_div+contador_divRespuesta);
    copiaNodo.firstChild.childNodes[1].setAttribute('onclick', "borrarElemento(divRespAll"+contador_div+",divResp"+contador_div+contador_divRespuesta+")");
    let nodoPadre = document.getElementById('divRespAll'+contadorDeReferencia);
    nodoPadre.insertBefore(copiaNodo, nodoPadre.lastChild); // con el lastChild conseguiremos añadir la copia de InputResp despues de todos los InputsResp
}


function borrarElemento(nodoPadre, nodoHijo){
    if(nodoPadre==1){
        all.removeChild(nodoHijo);
    }else{
        nodoPadre.removeChild(nodoHijo);
    }
}
