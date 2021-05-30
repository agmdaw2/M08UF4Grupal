$(function() {
    url = "http://localhost/teoria_ajax/02_jQuery_ajax.php";
    $("#boto").click(peticioAjax);
});

function peticioAjax(){
    var jqxhr = $.ajax(url)
                    .done(function(data) { 
                        $("#pa").text(data);
                        alert( "Ok " + data);
                    })
                    .fail(function() { alert( "Error");  })
                    .always(function() { alert( "Fí"); }); 
}