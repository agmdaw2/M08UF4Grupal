var arrayAños = [];
var paisesUtilizados =[];
var paisMonedaValue;
var paisesGeo2;
var paisesContinente;

// REVISAR CALLBACK/PROMISE<ASYNC/AWAIT
$(function () {
    $("#boto").click(inicio);
  });

function inicio(){
    $("#pa").hide()
    crearDivTimer();
    peticioAjax();
}

function crearDivTimer(){
    $("#divTimer").show();
    if(document.getElementById("divTimer")){
    }else{
        let divTimer = document.createElement("div");
        divTimer.setAttribute("id", "divTimer");
        $("#boto").after(divTimer);
    }

    var hoy = new Date();
    var fecha = hoy.getDate()+"-"+(hoy.getMonth()+1)+"-"+hoy.getFullYear();
    var hora = hoy.getHours()+":"+hoy.getMinutes()+":"+hoy.getSeconds();
    var fechaYHora = fecha + " " + hora;
    
    // TIMEOUT de 5 Segundos
    const delay = ms => new Promise(resolve => setTimeout(resolve, ms));
    async function timer() {
        document.getElementById("divTimer").innerText = fechaYHora;
        await delay(5000);
        $("#divTimer").hide();
        $("#pa").show();
    }
    timer();
}

function peticioAjax() {
    url = "https://pkgstore.datahub.io/core/exchange-rates/yearly_json/data/33bd1573fe050adfe9c24bddbcad4336/yearly_json.json";
    var jqxhr = $.ajax(url)
    .done (async function (data) {
        // desde esta url me lee el JSON como String y por lo tanto necesito parsearlo a JSON again.
        paisMonedaValue = await JSON.parse(data);
        //console.log(paisMonedaValue);
    })
    .fail(function () {
        console.log("Error");
    })
    .always(function () {
        console.log("Valor de la moneda obtenido");
    });

    // SEGUNDA PETICION AJAX PARA EL GEOJSON
    (function (){
        url="https://datahub.io/core/geo-countries/r/countries.geojson";
        var jqxhr = $.ajax(url)
        .done(async function (data2) {
            paisesGeo2 =await JSON.parse(data2);
            //console.log(paisesGeo2);
            crearTabla(paisMonedaValue);
        })
        .fail(function () {
            console.log("Error");
        })
        .always(function () {
            console.log("Posiciones de los paises obtenido");
        });
    }());

    // TERCERA PETICION AJAX PARA SABER EL CONTINENTE DE CADA PAIS
    (function (){
        url="https://pkgstore.datahub.io/JohnSnowLabs/country-and-continent-codes-list/country-and-continent-codes-list-csv_json/data/c218eebbf2f8545f3db9051ac893d69c/country-and-continent-codes-list-csv_json.json";
        var jqxhr = $.ajax(url)
        .done(async function (data3) {
            paisesContinente = await JSON.parse(data3);
            console.log(paisesContinente);
        })
        .fail(function () {
            console.log("Error");
        })
        .always(function () {
            console.log("Continentes de cada pais obtenido");
        });
    }());
}

function crearTabla(data){
    //muestra el div Oculto
    $("#divTabla").show();

    let divTabla = document.createElement("div");
    divTabla.setAttribute("id", "divTabla");
    let tabla = document.createElement("table");
    tabla.setAttribute('id', 'tabla');
    let casilla ="";
    let contenido = "";

    let styleTabla = tabla.style;
    styleTabla.border = "5px solid black";
    styleTabla.textAlign = "center";
    for (const key in data) {
        
        fila = document.createElement("tr");

        if(key == 0){
            for(let i=0;i<3;i++){
                casilla = document.createElement("th");
                let cabezera =["Pais", "Año", "Valor en $"];
                contenido = document.createTextNode(cabezera[i]);
                $(casilla).append(contenido);
                $(fila).append(casilla);
                let stylecasilla= casilla.style;
                stylecasilla.border = "2px solid black";
            }

            $(tabla).append(fila);
            fila = document.createElement("tr");
        }

        let pais = data[key];

        for (const property in pais){
            casilla = document.createElement("td");
            if (property == "Date"){
                //el substring nos marcara solo el año no el mes y el dia
                let año = (data[key].Date).substring(0, 4);
                crearArrayAños(año);
                contenido = document.createTextNode(año);
            }else{
                contenido = document.createTextNode(pais[property]); 
            }
            if(property == "Country"){
                //Comprobar Si ya hemos repetido pais para añadirlo a la lista de filtros
                comprobarPaises(pais[property]);
            }
            $(casilla).append(contenido);
            $(fila).append(casilla);
        }
        $(tabla).append(fila);
    }
    $(divTabla).append(tabla);

    comprovarSiExisteDiv(document.getElementById('tabla'), $("#divTabla"), divTabla, $("#pa"), "append");

    //Filtro para las Graficas
    crearFiltro();
}

function comprovarSiExisteDiv(divAComprobar, divReemplazado, divAplicable, divPadre, modo){
    if(divAComprobar){
        divReemplazado.replaceWith(divAplicable);
    }else{
        divPadre[modo](divAplicable); 
    }
}

function crearArrayAños(añoEntrado){
// el includes es el antiguo indexOf para mirar si existe rapidamente el elemento dentro del array
    if(arrayAños.includes(añoEntrado)){
    }else{
        arrayAños.push(añoEntrado);
    }
}

function crearFiltro(){
    
    let formulario = document.createElement("form");
    formulario.name ="formulario";
    formulario.id="filtroPais";

    let selector = document.createElement("select");
    selector.id ="paisEscogido";

    for(let i=0; i<paisesUtilizados.length;i++){
        let contenido = document.createElement("option");
        contenido.value = paisesUtilizados[i];
        let contenidoTxt = document.createTextNode(paisesUtilizados[i]);
        $(contenido).append(contenidoTxt);
        $(selector).append(contenido);
        if(i==paisesUtilizados.length-1){
            let contenidoTxt = document.createTextNode("Todos");
            let contenido = document.createElement("option");
            contenido.value = "Todos";
            $(contenido).append(contenidoTxt);
            $(selector).append(contenido);
        }
    }

    selector.setAttribute("onchange", "crearGrafico()");

    comprovarSiExisteDiv(document.getElementById('paisEscogido'), $("#paisEscogido"), selector, $("#divTabla"), "before");

    crearBotonMapa();
}

function crearGrafico(){
    let divGrafico = document.createElement("div");
        divGrafico.setAttribute("id", "divGrafico");
        $("#divGrafico").show();

    if(document.getElementById("paisEscogido").value == "Todos"){
        crearGraficoTodos();
    }else{
        paisSeleccionado = document.getElementById("paisEscogido").value;
        console.log(paisSeleccionado);
        
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBackgroundColor);

        function drawBackgroundColor() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Año');
            data.addColumn('number', 'Moneda');
            
            datos = datosPaisSeleccionado(paisSeleccionado);
            data.addRows(datos);
            
            var options = {
            title: paisSeleccionado,
            hAxis: {
                title: 'Años'
            },
            vAxis: {
                title: 'Valor segun $'
            },
            backgroundColor: '#f1f8e9'
            };

            document.getElementById("divGrafico").style ="width; 900px; height: 500px";
            var chart = new google.visualization.LineChart(document.getElementById('divGrafico'));
            chart.draw(data, options);
        }
    }

    $("#pa").append(divGrafico);

    // oculta el div
    $("#divTabla").hide();
    $("#myMap").hide();
}

function crearGraficoTodos(){
    alert("Working...")
}

function comprobarPaises(nombrePais){
    let verdad = false;
    for(let i=0;i<paisesUtilizados.length;i++){
                    
        if(nombrePais != paisesUtilizados[i]){
            
        }else{
            verdad = true;
        }
    }
    if(verdad == false){
        paisesUtilizados.push(nombrePais);
    }
    
}

function datosPaisSeleccionado(p){
    let datosPais = [];
    for (const key in paisMonedaValue) {
        if(paisMonedaValue[key].Country == p){
            let contenido = [];
            pais = paisMonedaValue[key];
            for (const property in pais){
                if (property == "Date"){
                    let año = (paisMonedaValue[key].Date).substring(0, 4);
                    año = parseInt(año);
                    contenido.push(año);
                    let añoRepetido = false;
                    

                }else if(property == "Value"){
                    contenido.push(pais[property]);
                }
            }
            datosPais.push(contenido);
        }
    }
    //console.log(datosPais);


    return datosPais;
}

function crearBotonMapa(){
    let boton = document.createElement("button");
    let contenido = document.createTextNode("Crear Mapa");
    boton.id = "crearMapa";
    boton.setAttribute("onclick", "crearMapa()");
    $(boton).append(contenido);

    comprovarSiExisteDiv(document.getElementById('crearMapa'),  $("#crearMapa"), boton, $("#divTabla"), "before");
}

function crearMapa(){
    $("#myMap").show();
    $("#divTabla").hide();
    $("#divGrafico").hide();

    if(document.getElementById("myMap")){

    }else{
        crearDivMapa();
    }

    var myMap = L.map('myMap').setView([41.5664, 2.0179], 3);;
    myMap.createPane("labels");
    myMap.getPane('labels').style.zIndex= 650;
    myMap.getPane('labels').style.pointerEvents = 'none';
    var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
        attribution: '©OpenStreetMap, ©CartoDB'
    }).addTo(myMap);

    var positronLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
            attribution: '©OpenStreetMap, ©CartoDB',
            pane: 'labels'
    }).addTo(myMap);

    var geojson = L.geoJson(paisesGeo2, {filter: devolverPaisesConDivisa});

    geojson.eachLayer(function (layer) {
        let datos = datosPaisSeleccionado(layer.feature.properties.ADMIN);
        //Con la funcion anonima consigo que me devuelva los valores de la moneda y el año con BreakLine
        layer.bindPopup(layer.feature.properties.ADMIN + (function (){
                                                            let txt="";
                                                            for(const año in datos){
                                                                txt +="<br>"+datos[año][0]+" - "+datos[año][1];     
                                                            }
                                                            return txt;
                                                        }()));
    });

    // Filtros de Mapa No conseguido
    var overlayMaps = {
        "Todo": geojson,
    };
    L.control.layers(overlayMaps).addTo(myMap);
    ///////

    myMap.fitBounds(geojson.getBounds());

    function devolverPaisesConDivisa(feature, layer){
        let paisesCoinciden = false;
        for(const o in paisesUtilizados){
            if(feature.properties.ADMIN == paisesUtilizados[o]){
                paisesCoinciden = true; 
            }
        }
        return paisesCoinciden;
    }
}

function crearDivMapa(){
    let div = document.createElement("div");
    div.id = "myMap";
    div.style = "height:600px;";
    $("#pa").append(div);

}
