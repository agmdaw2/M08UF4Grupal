$(function() {
    // url = "07.html";
    url = "http://localhost/teoria_ajax/07.html";
    $("#boto").click(peticioLoad);
});

function peticioLoad() {
    $("#p").load(url);
}