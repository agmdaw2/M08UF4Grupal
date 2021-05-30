<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "password";

$array = array();

try {
    $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
}

$result = $conn->prepare(" SELECT users_id as 'id', nombre, apellidos, mail, pw as 'password', curso_id, rol FROM usuari WHERE rol = 'profesor' ");
$result->setFetchMode(PDO::FETCH_ASSOC);
$result->execute();

while ($row = $result->fetch()){

    $newArray = array(

        "id" => $row['id'],
        "nombre" => $row['nombre'],
        "apellidos" => $row['apellidos'],
        "correo" => $row['mail'],
        "contraseña" => $row['password'],
        "curso_id" => $row['curso_id'],
        "rol" => $row['rol']

    );
    $array = array_merge($array, array($newArray));

}

if((isset($_POST['alumno']) && !empty($_POST['alumno']))){

    if (isset ($_SESSION['already_refreshed'])){
        unset($_SESSION['already_refreshed']);
    }

    $nombre = $_POST['alumno']['nombre'];
    $apellidos = $_POST['alumno']['apellidos'];
    $mail = $_POST['alumno']['mail'];
    $pw = $_POST['alumno']['pw'];
    $rol = "profesor";
    //$curso = $values['curso'];
    $curso = 1;

    $query = "INSERT INTO usuari(nombre, apellidos, mail, pw, rol, curso_id) VALUES (:nombre, :apellidos, :mail, :pw, :rol, :curso_id)";
    $query = $conn->prepare($query);

    $query->bindParam(':nombre',$nombre,PDO::PARAM_STR);
    $query->bindParam(':apellidos',$apellidos,PDO::PARAM_STR);
    $query->bindParam(':mail',$mail,PDO::PARAM_STR);
    $query->bindParam(':pw',$pw,PDO::PARAM_STR);
    $query->bindParam(':rol',$rol,PDO::PARAM_STR);
    $query->bindParam(':curso_id',$curso,PDO::PARAM_INT);

    $query->execute();

    if(!isset($_SESSION['already_refreshed'])){
        $ActualizarDespues= 1;
        header('Refresh:'.$ActualizarDespues);
        $_SESSION['already_refreshed'] = true;
    }
}
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
        <link rel="stylesheet" href="listadoProfes.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div id="head"> 
                <div id="logoIns">
                    <img src="img/logo-header.png" width="150px" id="logo">
                </div>
                <div id="titolHead">
                    <div><h2><?php echo "<h1>Bienvenido - ".$_SESSION['usuario']."</h1>"?></h2></div>
                    <div class="i"><i id="iclass" class="fa fa-chevron-circle-left fa-5x" aria-hidden="true"></i></div>
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

                <div class="search">
                    <div class="sBox">
                        <input type="text" placeholder="Nombre del profesor" class="sText" id="inpSrch">
                        <label class="sLabel"><i class="fa fa-search" id="lupa"></i></label>
                    </div>
                </div>
                <div class="listBox">
                    <div class="list" id="list">
                    </div>
                </div>
                <div class="buttons">
                    <button id="myBtn" class="newProf">Añadir profesor</button>

                    <div id="myModal" class="modal">
                        <div class="modal-content">

                            <form class="formulario" method="POST">
                                <div class="campo">
                                    <div class="label"><label>Nombre: </label></div>
                                    <div class="input"><input type="text" id="inpNombre" name="alumno[nombre]"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Apellidos: </label></div>
                                    <div class="input"><input type="text" id="inpApellidos" name="alumno[apellidos]"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Correo: </label></div>
                                    <div class="input"><input type="text" id="inpCorreo" name="alumno[mail]"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Contraseña: </label></div>
                                    <div class="input"><input type="text" id="inpPassword" name="alumno[pw]"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Curso: </label></div>
                                    <div class="input">
                                        <select name="alumno[curso]">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form_buttons">
                                    <button class="newProf" id="modCancel">Cancelar</button>
                                    <input type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="save">Guardar cambios</button>
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

        <script type="text/javascript">
            var json= <?php echo json_encode($array); ?>;
            let i = document.getElementById("iclass");
            i.onclick = function() {
                location.href = "administrador.php";
            }
        </script>
        <script type="text/javascript" src="listProfesores.js"></script>
        <script src="../isImage.js"></script>

    </body>
</html>
<?php
                               }
else{
    header("location:../Login-Registro/Login.php");

}

?>
