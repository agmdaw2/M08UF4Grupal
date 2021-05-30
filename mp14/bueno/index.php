<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Login-Registro/usuarios.css">
    <link rel="stylesheet" href="Login-Registro/plantilla.css">

</head>
<body>
    <header>
        <div id="head"> 
            <div id="logoIns">
                <img src="alumno/media/logo-header.png" width="150px">
            </div>
            <div id="titolHead">
                <h1 id="welcome">Página de Registro </h1>
            </div>
        </div>
    </header>
   
    <body>
        <form method="POST" class="formularioregistro">
            <h1>Registrate</h1>
            <input type="text" name="nombre" placeholder="Nombre"> <br>
            <input type="apellidos" name="apellidos" placeholder="Apellidos"><br>
            <input type="email" name="email" placeholder="Correo electrónico"><br>
            <input type="password" name="pw" placeholder="Contraseña"><br>
            <input type="text" name="curso_id" placeholder="Curso"><br>
            <select name="rol">
                    <option>Profesor</option>
                    <option>Alumno</option>

            </select><br><br><br>
            <input type="submit" name="registrarse" action="Login.php" placeholder="Registrarse"><br>
        </form>
        
        <h1 id="yaestasregis">Ya estás registrado? haz clic <a href="Login.php">AQUÍ</a></h1>
        <?php
            include("Login-Registro/registrar.php");
        ?>
    </body>

    
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

    <script src="isImage.js"></script>
        
</body>
</html>
