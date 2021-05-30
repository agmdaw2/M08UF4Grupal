<?php

function asignaturas($id){

    $servername = "localhost";
    $username = "root";
    $password = "admin";
    $ronda = 0;
    $color = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $result = $conn->prepare("SELECT asignatura.nombre, asignatura.asig_id FROM asignatura, curs, usuari WHERE usuari.users_id = '{$id}' AND usuari.curso_id = curs.curso_id AND asignatura.curso_id = curs.curso_id");

    $result->setFetchMode(PDO::FETCH_ASSOC);

    $result->execute();

    while ($row = $result->fetch()){

        if ($ronda == 0){
            echo "<div class='row'>";
        }

        if ($color == 7){
            $color = 0;
        } 

        echo "<button id='{$row["asig_id"]}' class='asig col" . $color . "'>{$row["nombre"]}</button>";
        $ronda++;

        if ($ronda == 3){
            echo "</div>";
            $ronda = 0;
        }

        $color++;
    }
}
?>
