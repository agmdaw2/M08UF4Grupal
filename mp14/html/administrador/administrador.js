var instText = document.getElementById("instText");
var instBtn = document.getElementById("toggle");

var profsBtn = document.getElementById("llistat");
var logo = document.getElementById("imgLogo");

var colField = document.getElementById("theme");
var divColor = document.getElementById("changeCol");

window.onload = function() {
    instText.style.cursor = "no-drop";
    instText.disabled = true;
    
    logo.src = "img/logo-header.png";
    divColor.style.backgroundColor = colField.value;
    
}

instBtn.addEventListener("click", toggleField);

profsBtn.onclick = function() {
    location.href = "listadoProfes.php";
}

function toggleField() {
    
    if (instText.disabled == true) {
        instText.disabled = false;
        instText.style.cursor = "text";
        instBtn.innerHTML = '"Cerrar candado"';
    } else {
        instText.disabled = true;
        instText.style.cursor = "no-drop";
        instBtn.innerHTML = '"Abrir candado"';
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