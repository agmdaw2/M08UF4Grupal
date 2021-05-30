var instText = document.getElementById("instText");
var instBtn = document.getElementById("toggle");

var profsBtn = document.getElementById("llistat");
var logo = document.getElementById("imgLogo");

var colField = document.getElementById("theme");
var divColor = document.getElementById("changeCol");

var saveBtn = document.getElementById("save");

window.onload = function() {
    instText.style.cursor = "no-drop";
    instText.disabled = true;
    
    logo.src = "img/logo-header.png";
    divColor.style.backgroundColor = colField.value;
    
}

instBtn.addEventListener("click", toggleField);
saveBtn.addEventListener("click", saveChanges);

profsBtn.onclick = function() {
    location.href = "listadoProfes.php";
}

function toggleField() {
    
    if (instText.disabled == true) {
        instText.disabled = false;
        instText.style.cursor = "text";
        instBtn.innerHTML = '<i class="fa fa-lock" aria-hidden="true"></i>';
    } else {
        instText.disabled = true;
        instText.style.cursor = "no-drop";
        instBtn.innerHTML = '<i class="fa fa-unlock-alt" aria-hidden="true"></i>';
    }
    
}

colField.addEventListener("blur", toggleColour);

function toggleColour() {
    
    let val = theme.value;
    divColor.style.backgroundColor = val;
    
}

saveImg();
generateImg();

function saveImg() {
    
    document.querySelector('input[type="file"]').addEventListener("change", function(){
        
        let reader = new FileReader();
        
        reader.addEventListener("load", () => {
            localStorage.setItem("newImg", reader.result);
        });
        
        reader.readAsDataURL(this.files[0]);
        
    });
    
}

function generateImg() {
    
    document.querySelector('input[type="file"]').addEventListener("change", function() {
        
        if (this.files && this.files[0]){
            
            logo.onload = () => {
                URL.revokeObjectURL(logo.src);
            };
            
            logo.src = URL.createObjectURL(this.files[0]);
        }
        
    });
    
}

function saveChanges() {

    let path = "http://localhost/projecteMP14/Etapa2/Vagrant/html/administrador/img/logo-header.png";

    if (logo.src == path){
        localStorage.removeItem("newImg");
    } else {
        console.log(localStorage.getItem("newImg"));
    }

    if (colField.value == "#FFD8AD") {
        localStorage.removeItem("mainTheme");
    } else {
        localStorage.setItem("mainTheme", colField.value);
    }

}
