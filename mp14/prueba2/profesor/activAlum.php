<?php

function pregExamen($idExamen){

    $servername = "localhost";
    $username = "root";
    $password = "password";
    $parell = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $result = $conn->prepare("SELECT examen.nombre FROM examen WHERE examen.exam_id='$idExamen'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    $nameAct = $result->fetch();
    //Necesitamos convertir $nameAct de un Array a un String
    $nameAct = implode($nameAct);


    $result = $conn->prepare("SELECT DISTINCT usuari.nombre, usuari.apellidos, usuari.users_id, examen.exam_id
                                FROM examen, res_larga, usuari, preg_larga
                                WHERE res_larga.exam_id=examen.exam_id 
                                    AND res_larga.users_id = usuari.users_id
                                    AND examen.exam_id='$idExamen'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    echo "<div id='todo'>";

    echo "<div class='user th'>";
    echo "<div class='nameAct'>Examen</div>";
    echo "<div class='nomAl'>Nombre Alumno</div>";
    echo "<div class='cellcorr'>Corregir examen</div>";
    echo "</div>";

    while ($row = $result->fetch()){

        if ($parell % 2 == 0){
            echo "<div id='".$row['users_id']."' class='user parell'>";
        } else {
            echo "<div id='".$row['users_id']."' class='user senar'>";
        }

        echo "<div class='nameAct'>" . $nameAct . "</div>";
        echo "<div class='nomAl'>" . $row['nombre'] . " " . $row['apellidos'] . "</div>";
        echo "<input type=button class='activUsuario' id='".$row['users_id']."-".$row['exam_id']."' value='Corregir!'>";
        echo "</div>";

        $parell++;

    }

    echo "</div>";
}

?>
