<?php
session_start();
require 'wewe.php';

$id_alu = $_SESSION['user_id'];
if(isset($_SESSION["usuario"])){

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="plantilla.css">
        <link rel="stylesheet" href="alumno.css">
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
                        <a href="../Login-Registro/Salir.php">Deslogear</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="main_content">
                <div id='assig'>
                    <?php
    notas($id_alu);
                    ?>
                </div>
            </div>
            <button class='notas' id='{$id_alu}'></button>
        </div>

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

        <script src="alumno.js"></script>
        <script src="../isImage.js"></script>
        <script type="text/javascript">
            let i = document.getElementById("iclass");
            i.onclick = function() {
                location.href = "alumno.php";
            }
        </script>
    </body>
</html>
<?php
                               }
else{
    header("location:Login.php");
}
