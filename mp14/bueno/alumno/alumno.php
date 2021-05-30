<?php
    session_start();
    require 'asig.php';

    /* impo */
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
</head>
<body>
    <header>
        <div id="head"> 
            <div id="logoIns">
                <img src="media/logo-header.png" width="150px" id="logo">
            </div>
            <div id="titolHead">
            <h2><?php echo "<h1>Bienvenido - ".$_SESSION['usuario']."</h1>"?></h2>
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
                    asignaturas($id_alu);
                ?>
            </div>   
        </div>
        <button class='notas' id='{$id_alu}'>Notas</button>
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
</body>
</html>
<?php
}
else{
    header("location:../Login.php");
}
