$(function () {
  url = "https://pkgstore.datahub.io/core/exchange-rates/yearly_json/data/33bd1573fe050adfe9c24bddbcad4336/yearly_json.json";
  $("#boto").click(peticioAjax);
});

function peticioAjax() {
  var jqxhr = $.ajax(url)
    .done(function (data) {
      console.log(data);
      for (const key in data) {
        console.log(key);

            $("#pa").append("<strong>Post: </strong>" + data[key].Country + "<br/>");
            $("#pa").append(
              "<strong>Usuario: </strong>" + data[key].Date + "<br/>"
            );
            $("#pa").append(
              "<strong>Descripció: </strong>" + data[key].Value + "<br/><br/>"
            );
          }
        
      
    })
    .fail(function () {
      alert("Error");
    })
    .always(function () {
      //alert("Fí");
    });
}
