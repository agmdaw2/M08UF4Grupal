$(function() {
    // url = "08.xml";
    url = "http://localhost/teoria_ajax/08.xml";
    $("#boto").click(peticioXML);
});

function peticioXML() {
    $.ajax(url, {dataType:"xml"})
        .done(function(data) { mostraContingut(data); })
        .fail(function() { alert( "Error");  })
        .always(function() { alert( "Fí"); });
}

function mostraContingut(data) {
    console.log(data.all[0].innerHTML);
    $("#p1").html(data.all[0].innerHTML);
    $("#p2").text(data.all[0].innerHTML);
    arrayAlumnes = data.children[0].children;
    for (var i=0;i<arrayAlumnes.length;i++) {
        $("#p3").html($("#p3").html() + arrayAlumnes[i].children[0].textContent + " ");
        $("#p3").html($("#p3").html() + arrayAlumnes[i].children[1].textContent + " ");
        $("#p3").html($("#p3").html() + arrayAlumnes[i].children[2].textContent + "<br/>");

        // console.log(arrayAlumnes[i].children[0].textContent);
        // console.log(arrayAlumnes[i].children[1].textContent);
        // console.log(arrayAlumnes[i].children[2].textContent);
    }
}