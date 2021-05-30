$(function() {
    // url = "06_getJSON.json";
    url = "http://localhost/teoria_ajax/06_getJSON.json";
    $("#boto").click(peticioJSON);
});

function peticioJSON() {
    $.getJSON(url, function( data ) {
        var items = [];
        $.each( data, function( key, val ) {
            items.push( "<li id='" + key + "'>" + val + "</li>" );
        });
        $("#p").append("<ul id='ul'></ul>");
        $("#ul").append(items);
    })
    .done(function() { console.log("ok");})
    .fail(function() { console.log( "Error");  })
    .always(function() { console.log( "Fí"); });
}