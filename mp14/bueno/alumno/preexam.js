asig = document.querySelectorAll('.exam');
        for(let i=0;i<asig.length;i++){
            asig[i].addEventListener("click", function(){
                let id = this.id;
                location.href = "preguntas.php?idExamen=" + id;
            }); 
        }