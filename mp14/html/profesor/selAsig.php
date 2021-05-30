<?php

function asignatura(){

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

    $result = $conn->prepare("SELECT asignatura.nombre, asignatura.asig_id
                                    FROM asignatura");

    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();


    while ($row = $result->fetch()){
        echo "<input class='asignaturas' type='submit' id='".$row['asig_id']."' value='".$row['nombre']."'>";
    };



}
?>