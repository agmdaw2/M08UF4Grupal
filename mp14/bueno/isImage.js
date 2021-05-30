var logoItem = localStorage.getItem("newImg");
var colItem = localStorage.getItem("mainTheme");

var newLogo = document.getElementById("logo");


if (logoItem) {
    newLogo.src = logoItem;
}

if (colItem) {
    document.getElementById("head").style.backgroundColor = colItem;
    document.getElementById("footer").style.backgroundColor = colItem;
}
