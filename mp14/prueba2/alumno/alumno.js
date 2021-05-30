asig = document.querySelectorAll('.asig');
        for(let i=0;i<asig.length;i++){
            asig[i].addEventListener("click", function(){
                let id = this.id;
                location.href = "asignatura.php?asignatura=" + id;
            }); 
        }

asig = document.querySelectorAll('.notas');
    for(let i=0;i<asig.length;i++){
        asig[i].addEventListener("click", function(){
            let id = this.id;
            location.href = "notas.php?usu=" + id;
        }); 
}