$(function() {
    _url = "http://localhost/teoria_ajax/04_jQuery_post.php";
    $("#boto").click(peticioAjax);
});

function peticioAjax() {
    var jqxhr = $.post({ url:_url,
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