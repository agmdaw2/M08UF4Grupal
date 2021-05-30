$(function() {
    // url = "05_getScript_remot.js";
    url = "http://localhost/teoria_ajax/05_getScript_remot.js";
    $("#boto").click(peticioScript);
});

function peticioScript() {
    $.getScript(url)
        .done(function() { console.log("ok");})
        .fail(function() { console.log( "Error");  })
        .always(function() { console.log( "Fí"); });                    
}