<?php

function asignatura(){

    $servername = "localhost";
    $username = "root";
    $password = "password";
    $ronda = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $result = $conn->prepare("SELECT asignatura.nombre, asignatura.asig_id
                                    FROM asignatura");

    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();


    while ($row = $result->fetch()){

        if ($ronda == 0){
            echo "<div class='row'>";
        }

        echo "<input class='asignaturas' type='submit' id='".$row['asig_id']."' value='".$row['nombre']."'>";
        $ronda ++;

        if ($ronda == 3){
            echo "</div>";
            $ronda = 0;
        }
    };

}
?>
