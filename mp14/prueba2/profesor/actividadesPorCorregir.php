<?php
session_start();

require 'activCorrec.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="plantilla.css">
        <link rel="stylesheet" href="correcciones.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div id="head">
                <div id="logoIns">
                    <img src="media/logo-header.png" width="150px" id="logo">
                </div>
                <div id="titolHead">
                    <div><h2><?php echo "<h1>Bienvenido - ".$_SESSION['usuario']."</h1>"?></h2></div>
                    <div class="i"><i id="iclass" class="fa fa-chevron-circle-left fa-5x" aria-hidden="true"></i></div>
                </div>
                <div id="menuLogoPersona">
                    <div class="botonPerfil"><img src="media/unknown.png" width="100px"></div>
                    <div class="submenuPersona">
                        <a href="./perfilAlumno.php">Editar Perfil</a>
                        <a href="#">Deslogear</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="box">
                <div class="listbox">
                    <div id='practicas' class="list">
                        <?php
                        $idAsignatura = $_GET["asignatura"];
                        actividades($idAsignatura);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let activ = document.querySelectorAll('.actividades');
            for(let i= 0; i<activ.length;i++){
                activ[i].addEventListener("click", function(){
                    let id = this.id;
                    location.href = "actividadesPorAlumno.php?correccion=" + id;
                });
            }
        </script>

        <footer>
            <div id="footer">
                <div class="footerChild">
                    <p>Cookies</p>
                </div>
                <div class="footerChild">
                    <p>Derechos Autor</p>
                </div>
                <div class="footerChild">
                    <p>Sobre Nosotros</p>
                </div>
            </div>
        </footer>

        <script src="../isImage.js"></script>
        <script>
            let i = document.getElementById("iclass");
            i.onclick = function() {
                location.href = "profesor.php";
            }
        </script>
    </body>
</html>
