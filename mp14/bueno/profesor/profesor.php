<?php
session_start();
if(isset($_SESSION["usuario"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escenario 1</title>
    <link rel="stylesheet" href="plantilla.css">
    <link rel="stylesheet" href="profesor.css">
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
                    <a href="perfilProfesor.php">Editar Perfil</a>
                    <a href="../Login-Registro/Salir.php">Deslogear</a>
                </div>
            </div>
        </div>
    </header>
    
    
    <div class="container flex">
        <div class="box">

            <div class="mb">
                <button id="nuevaAct">Creación de Actividades</button>
                <button id="listAct" class="ml">Listado de Actividades</button>
            </div>
            <div>
                <button id="corrAct">Correción de Actividades</button>
                <button id="listAlum" class="ml2">Lista de Alumnos</button>
            </div>

        </div>
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

    <script src="profesor.js"></script>
    <script src="../isImage.js"></script>

</body>
</html>
<?php
}
else{
    header("location:../Login.php");
    
}
