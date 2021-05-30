<?php

$servername = "localhost";
$username = "root";
$password = "admin";

$array = array();

try {
    $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
}

$result = $conn->prepare("

SELECT asi.nombre as 'asignatura', asi.asig_id, asi.curso_id, exa.nombre as 'examen', exa.exam_id as 'id', exa.cod_ext as 'code'
FROM asignatura asi, examen exa
WHERE asi.asig_id = exa.asig_id

");

$result->setFetchMode(PDO::FETCH_ASSOC);
$result->execute();

while ($row = $result->fetch()){
    
    $newArray = array (
    
        "id" => $row['id'],
        "asignatura" => $row['asignatura'],
        "examen" => $row['examen'],
        "code" => $row['code'],
        "curso_id" => $row['curso_id'],
        "asig_id" => $row['asig_id']
        
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
    <link rel="stylesheet" href="listadoActividades.css">
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
                    <input type="text" placeholder="Parámetros de búsqueda" class="sText">
                    <label class="sLabel">Lupa</label>
                </div>
            </div>
            
            <div class="listBox">
                <div class="list" id="list">
                    
                </div>
            </div>
            <div class="buttons">
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
        var json = <?php echo json_encode($array); ?>;
    </script>
    <script type="text/javascript" src="listadoActividades.js"></script>
    
</body>
</html>