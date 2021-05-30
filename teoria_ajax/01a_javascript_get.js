/* VARIABLES GLOBALS */
var http_request = false;
var url = '01a_javascript_get.php';

/* ESPEREM A QUE ES CARREGUI LA PÀGINA HTML */
window.onload = function(){	
	document.getElementById("boto").addEventListener("click", peticioAjax);
};

function peticioAjax() {

	http_request = false;

	if (window.XMLHttpRequest) { // Mozilla, Safari,...

		http_request = new XMLHttpRequest();

		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/xml');
			// http_request.overrideMimeType('text/text');
			// http_request.overrideMimeType('text/json');
		}

	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				console.log('Ni ajax ni ajox!');
			}
		}
	}

	if (!http_request) {
		alert('Error :( No és posible crear una instancia XMLHTTP');
		return false;
	}
	
	http_request.onreadystatechange = respostaAjax;
	http_request.open('GET', url, true /*asíncron*/);
	http_request.send(null);
}

function respostaAjax() {
	if (http_request.readyState == 4 && http_request.status == 200) {
		alert(http_request.responseText);

		/*
		var p = document.createElement("P");
		var text = document.createTextNode(http_request.responseText);
		p.appendChild(text);
		document.body.appendChild(p);
		*/
	}
}