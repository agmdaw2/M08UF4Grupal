let preg = document.getElementById("preguntas");

var input = myForm.myInput;
var reader = new FileReader;

input.addEventListener('change', onChange);


function onChange(event) {
    var file = event.target.files[0];   
    reader.readAsText(file);    
    reader.onload = onLoad; 
}

function onLoad() {
    var result = reader.result;    
    var lineas = result.split('\n');
    let cont_preg = 1;
    let cont_res = 1;

    for(var linea of lineas) {
        let wol = linea.trim();

        if (wol.charAt(0) == "p" || wol.charAt(0) == "P"){
            let txt_preg = document.createTextNode('Pregunta ' + cont_preg);
            let p_preg = document.createElement('p');
            p_preg.appendChild(txt_preg);
            preg.appendChild(p_preg);
            cont_res = 0;
            if (wol.charAt(1) == "c" || wol.charAt(1) == "C"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'pc' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
            }
            if (wol.charAt(1) == "l" || wol.charAt(1) == "L"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'pl' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
                let txt = document.createTextNode('El alumno deberá escribir la respuesta en un textbox.')
                let p_aux = document.createElement('p');
                p_aux.appendChild(txt);
                preg.appendChild(p_aux);
            }
            if (wol.charAt(1) == "m" || wol.charAt(1) == "M"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'pm' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
            }
            if (wol.charAt(1) == "s" || wol.charAt(1) == "S"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'ps' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
            }
            if (wol.charAt(1) == "v" || wol.charAt(1) == "V"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'pv' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
            }
            if (wol.charAt(1) == "r" || wol.charAt(1) == "R"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'pr' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
            }
            if (wol.charAt(1) == "b" || wol.charAt(1) == "B"){
                wol = wol.slice(3);
                let txt_preg = document.createTextNode(wol);
                let p_preg = document.createElement('p');
                p_preg.setAttribute('id', 'pb' + cont_preg);
                p_preg.appendChild(txt_preg);
                preg.appendChild(p_preg);
            }
            cont_preg++;
        }

        else if (wol.charAt(0) == "r" || wol.charAt(0) == "R"){
            if (wol.charAt(1) == "c" || wol.charAt(1) == "C"){
                wol = wol.slice(3);
                let txt_res = document.createTextNode("Respuesta Correcta: " + wol);
                let p_res = document.createElement('p');
                p_res.setAttribute('id', 'rc' + cont_preg + '-' + cont_res);
                p_res.appendChild(txt_res);
                preg.appendChild(p_res);
                cont_res++;
            }
            if (wol.charAt(1) == "i" || wol.charAt(1) == "I"){
                wol = wol.slice(3);
                let txt_res = document.createTextNode("Respuesta Incorrecta: " + wol);
                let p_res = document.createElement('p');
                p_res.setAttribute('id', 'ri' + cont_preg + '-' + cont_res);
                p_res.appendChild(txt_res);
                preg.appendChild(p_res);
                cont_res++;
            }
            if (wol.charAt(1) == "v" || wol.charAt(1) == "V"){
                wol = wol.slice(3);
                let txt_res = document.createTextNode("Respuesta Verdadera: " + wol);
                let p_res = document.createElement('p');
                p_res.setAttribute('id', 'rv' + cont_preg + '-' + cont_res);
                p_res.appendChild(txt_res);
                preg.appendChild(p_res);
                cont_res++;
            }
            if (wol.charAt(1) == "f" || wol.charAt(1) == "F"){
                wol = wol.slice(3);
                let txt_res = document.createTextNode("Respuesta Falsa: " + wol);
                let p_res = document.createElement('p');
                p_res.setAttribute('id', 'rf' + cont_preg + '-' + cont_res);
                p_res.appendChild(txt_res);
                preg.appendChild(p_res);
                cont_res++;
            }
            if (wol.charAt(1) != "r" || wol.charAt(1) != "R"){
                if (wol.charAt(2) == "a" || wol.charAt(2) == "A"){
                    wol = wol.slice(4);
                    let txt_res = document.createTextNode("Respuesta A" + cont_res + ": " + wol);
                    let p_res = document.createElement('p');
                    p_res.setAttribute('id', 'ra' + cont_preg + '-' + cont_res);
                    p_res.appendChild(txt_res);
                    preg.appendChild(p_res);
                }
                if (wol.charAt(2) == "b" || wol.charAt(2) == "B"){
                    wol = wol.slice(4);
                    let txt_res = document.createTextNode("Respuesta B" + cont_res + ": " + wol);
                    let p_res = document.createElement('p');
                    p_res.setAttribute('id', 'ra' + cont_preg + '-' + cont_res);
                    p_res.appendChild(txt_res);
                    preg.appendChild(p_res);
                    cont_res++;
                }
            }
        }
    }
}