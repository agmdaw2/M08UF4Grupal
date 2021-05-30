<?php

function actividades($idAsignatura){

    $servername = "localhost";
    $username = "root";
    $password = "admin";
    $parell = 0;

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
    echo "<div class='select'>Selecciona una actividad para corregirlas: </div>";
    echo "<div class='whole'>";
    while ($row = $result->fetch()){

        echo "<div id='actividad".++$numPreg."' class='acts'>";
        if ($parell % 2 == 0){
            echo "<input class='actividades parell' type='button' id='".$row['exam_id']."' value='".$row['nombre']."'>";
        } else {
            echo "<input class='actividades senar' type='button' id='".$row['exam_id']."' value='".$row['nombre']."'>";
        }
        echo "</div>";
        $parell++;
    };
    echo "</div>";
}
?>
