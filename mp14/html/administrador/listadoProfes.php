<?php

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
    </head>
    <body>
        <header>
            <div id="head"> 
                <div id="logoIns">
                    <img src="img/logo-header.png" width="150px">
                </div>
                <div id="titolHead">
                    <h1 id="welcome">Bienvenido "Persona que acaba de logear"</h1>
                </div>
                <div id="menuLogoPersona">
                    <div class="botonPerfil"><img src="img/unknown.png" width="100px"></div>
                    <div class="submenuPersona">
                        <a href="./perfilAdmin.php">Editar Perfil</a>
                        <a href="#">Deslogear</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="box">

                <div class="search">
                    <div class="sBox">
                        <input type="text" placeholder="Nombre del profesor" class="sText">
                        <label class="sLabel">Lupa</label>
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

                            <div class="formulario">
                                <div class="campo">
                                    <div class="label"><label>Nombre: </label></div>
                                    <div class="input"><input type="text" id="inpNombre"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Apellidos: </label></div>
                                    <div class="input"><input type="text" id="inpApellidos"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Correo: </label></div>
                                    <div class="input"><input type="text" id="inpCorreo"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Contraseña: </label></div>
                                    <div class="input"><input type="text" id="inpPassword"></div>
                                </div>
                                <div class="campo">
                                    <div class="label"><label>Curso: </label></div>
                                    <div class="input">
                                        <select name="curso">
                                            <option>Default 1</option>
                                            <option>Default 2</option>
                                            <option>Default 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form_buttons">
                                <button class="newProf" id="modCancel">Cancelar</button>
                                <button class="save_mod">Crear</button>
                            </div>
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

        <script type="text/javascript"> var json= <?php echo json_encode($array); ?>; </script>
        <script type="text/javascript" src="listProfesores.js"></script>

    </body>
</html>