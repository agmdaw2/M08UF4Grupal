<?php

function actividades($idAsignatura){

    $servername = "localhost";
    $username = "root";
    $password = "password";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); 
    }
    $result = $conn->prepare("SELECT *
                                    FROM examen
                                    WHERE examen.asig_id='$idAsignatura'");

    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    $numPreg = 0;
    echo "Selecciona una actividad para corregirlas";
    while ($row = $result->fetch()){
        echo "<div id='actividad".++$numPreg."'>";
        echo "<input class='actividades' type='button' id='".$row['exam_id']."' value='".$row['nombre']."'>";
        echo "</div>";
    };
}
?>