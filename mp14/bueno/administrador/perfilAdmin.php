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
        <link rel="stylesheet" href="perfilAdmin.css">
    </head>
    <body>
        <header>
            <div id="head"> 
                <div id="logoIns">
                    <img src="img/logo-header.png" width="150px">
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
                
                <div class="A">
                    <div class="boxA">
                        
                        <div class="divImg">
                            <div class="pfp"></div>
                        </div>
                        <button class="changePfp">Cambiar imagen</button>
                        
                    </div>
                    
                </div>
                <div class="B">
                    <div class="boxB">
                        
                        <input type="text" value="Gerard Martínez Miquel" class="txtNom" disabled>
                        <!--<input type="text" placeholder="Introduce tu alias aquí" class="txtAlias">-->
                        
                    </div>
                </div>
            </div>
            
            <div class="save">
                <button class="saveBtn" id="save">Guardar cambios</button>
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

        <script>
            let save = document.getElementById("save");
            save.onclick = function() {
                location.href = "administrador.php";
            }
        </script>

    </body>
</html>

<?php
}
else{
    header("location:../Login-Registro/Login.php");
    
}
