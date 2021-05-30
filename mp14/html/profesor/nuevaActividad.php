<?php
require 'guarda_ex.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="plantilla.css">
    <link rel="stylesheet" href="nuevaActividad.css">
</head>
<body>
    <header>
        <div id="head"> 
            <div id="logoIns">
                <img src="media/logo-header.png" width="150px">
            </div>
            <div id="titolHead">
                <h1 id="welcome">Bienvenido "Persona que acaba de logear"</h1>
            </div>
            <div id="menuLogoPersona">
                <div class="botonPerfil"><img src="media/unknown.png" width="100px"></div>
                <div class="submenuPersona">
                    <a href="perfil.php">Editar Perfil</a>
                    <a href="#">Deslogear</a>
                </div>
            </div>
        </div>
    </header>
    <div class="panelFlex">
        <div class="panelBox">
            <div id="todo"></div>
            <button class="docTxt">Documento.txt</button>
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
    <script src="preguntas.js"></script>
</body>
</html>
