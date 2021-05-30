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
    <title>Document</title>
    <link rel="stylesheet" href="plantilla.css">
    <link rel="stylesheet" href="administrador.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div id="head"> 
            <div id="logoIns">
                <img src="img/logo-header.png" width="150px" id="logo">
            </div>
            <div id="titolHead">
            <h2><?php echo "<h1>Bienvenido - ".$_SESSION['usuario']."</h1>"?></h2>
            </div>
            <div id="menuLogoPersona">
                <div class="botonPerfil"><img src="img/unknown.png" width="100px"></div>
                <div class="submenuPersona">
                    <a href="./perfilAdmin.php">Editar Perfil</a>
                    <a href="../Login-Registro/Salir.php">Deslogear</a>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="box">
            
            <div class="divNom">
                <label for="nomInst">Nombre Institución: </label>
                <input type="text" value="Institut Nicolau Copèrnic" name="nomInsti" id="instText">
                <button id="toggle"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
            </div>
            <div class="divLogo">
                <label for="upload">Logo: </label>
                <div class="imgLogo"><img src="" id="imgLogo"></div>
                <input type="file" class="upload">
            </div>
            <div class="divTheme">
                <label for="theme">Tema principal: </label>
                <input type="text" value="#FFD8AD" name="theme" maxlength="7" id="theme">
                <div class="colTheme">
                    <div class="color" id="changeCol"></div>
                </div>
            </div>
            <div class="divBtns">
                <button class="llistat" id="llistat">Listar Profesores</button>
                <button id="save" class="save">Guardar cambios</button>
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
    
    <script src="administrador.js"></script>
    <script src="../isImage.js"></script>
    
</body>
</html>
<?php
}
else{
    header("location:../Login.php");
    
}
