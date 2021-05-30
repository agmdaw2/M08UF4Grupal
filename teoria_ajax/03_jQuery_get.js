$(function() {
    _url = "http://localhost/teoria_ajax/03_jQuery_get.php";
    $("#boto").click(peticioAjax);
});

function peticioAjax() {
    var jqxhr = $.get({ url:_url,
                        data:{
                            usuari:$("#usuari").val(),
                            password:$("#password").val()
                        }
                })
                .done(function(data) { 
                    $("#pa").text(data);
                    alert(data);
                })
                .fail(function() { alert( "Error");  })
                .always(function() { alert( "Fí"); });                    
}  