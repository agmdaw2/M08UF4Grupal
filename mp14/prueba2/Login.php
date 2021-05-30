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
                    <img src="/alumno/media/logo-header.png" width="150px">
                </div>
                <div id="titolHead">
                    <h1 id="welcome">Página de Inicio de Sesión </h1>
                </div>
            </div>
        </header>

        <body>
            <form action="Login.php" method="post" class="formularioregistro">
                <h1>Iniciar Sesión</h1>
                <input type="" name="t1" required placeholder="Correo electrónico"> <br><br>
                <input type="" name="t2" required placeholder="Contraseña"><br><br>
                <select name="t3">
                    <option>Profesor</option>
                    <option>Alumno</option>
                    <option>Administrador</option>
                </select><br><br>

                <input type="submit" name="" value="Ingresar">
            </form>

            <h1>No tienes cuenta? Registrate <a href="index.php">AQUÍ</a></h1>

        </body>

        <?php
        if($_POST){
            session_start();
            require('Login-Registro/con_db.php');
            $u = $_POST['t1'];
            $p = $_POST['t2'];
            $r = $_POST['t3'];
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $conn -> prepare("SELECT * FROM usuari where mail= :u AND pw = :p AND rol = :r");

            $query ->bindParam(":u", $u);
            $query ->bindParam(":p", $p);
            $query ->bindParam(":r", $r);

            $query ->execute();
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            if($usuario){
                $_SESSION['usuario'] = $usuario["nombre"];

                if($r == "Profesor"){
                    header("location:profesor/profesor.php");
                }
                else if($r == "Alumno") {
                    header("location:alumno/alumno.php");
                }
                else if($r == "Administrador"){
                    header("location:administrador/administrador.php");
                }
            }
            else {
                echo "Usuario o Contraseña son incorrectos";
            }
        }
        ?>
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
    </body>
</html>




