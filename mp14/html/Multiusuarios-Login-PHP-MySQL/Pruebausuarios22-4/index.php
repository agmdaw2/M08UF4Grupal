<!DOCTYPE html>
<html>
    <head>
    <tittle> Registrar Usuario</tittle>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="">
    </head>    
    <body>
        <form method="POST">
            <h1>Registrate</h1>
            <input type="text" name="nombre" placeholder="Nombre"> <br>
            <input type="apellidos" name="apellidos" placeholder="Apellidos"><br>
            <input type="email" name="email" placeholder="Correo electrónico"><br>
            <input type="password" name="pw" placeholder="Contraseña"><br>
            <input type="text" name="curso_id" placeholder="Curso"><br>
            <input type="text" name="rol" placeholder ="ROL"><br>
            <input type="submit" name="registrarse"><br>
        </form>
        <?php
            include("registrar.php");
        ?>
    </body>
</html>
