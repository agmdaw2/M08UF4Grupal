<?php
function actividades(){
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

    if(!empty($_GET['asignatura'])){
        $asignatura = $_GET['asignatura'];

        //asig (num) -> asig (nom)

        $result = $conn->prepare("SELECT asignatura.nombre FROM asignatura WHERE asignatura.asig_id = $asignatura");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $nomAsig = $result->fetch();
        $nomAsig = implode($nomAsig);

        echo '<h1 class="h1">Actividades de ' . $nomAsig . ":</h1><br>";

        $result = $conn->prepare("SELECT examen.nombre, examen.exam_id FROM asignatura, examen WHERE examen.asig_id = asignatura.asig_id AND asignatura.asig_id = $asignatura");

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        while ($row = $result->fetch()){

            if ($ronda == 0){
                echo "<div class='exrow'>";
            }

            echo "<button id='{$row["exam_id"]}' class='exam'>{$row["nombre"]}</button>";
            $ronda++;

            if ($ronda == 3){
                echo "</div>";
                $ronda = 0;
            }

        }
    }
}
?>
