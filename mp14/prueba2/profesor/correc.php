<?php

function pregExamen($userActividad){

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
    //Gracias al list crearemos dos variables con el explode separaremos lo que haya dentro de la variable. 
    list($usuarioId, $examenId) = explode("-", $userActividad);

 
    $result = $conn->prepare("SELECT examen.nombre FROM examen WHERE examen.exam_id='$examenId'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    $nombreActividad = $result->fetch();
    //Necesitamos convertir $nombreActividad de un Array a un String
    $nombreActividad = implode($nombreActividad);

    $result = $conn->prepare("SELECT usuari.nombre, usuari.apellidos FROM usuari WHERE usuari.users_id='$usuarioId'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    $nombreAlumno = $result->fetch();
    //Necesitamos convertir $nameAct de un Array a un String
    $nombreAlumno = implode($nombreAlumno);
    
    $result = $conn->prepare("SELECT DISTINCT preg_larga.pregunta, res_larga.respuesta, preg_larga.larga_id, res_larga.reslar_id
                                FROM examen, res_larga, preg_larga
                                WHERE res_larga.larga_id = preg_larga.larga_id
                                    AND res_larga.users_id ='$usuarioId'
                                    AND res_larga.exam_id=examen.exam_id 
                                    AND examen.exam_id=preg_larga.exam_id
                                    AND examen.exam_id='$examenId'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    echo "<div id='todo'>";
    echo "<h1>".$nombreActividad."</h1>";
    echo "<h3>".$nombreAlumno."</h3>";
    $numPregunta = 1;
    echo "<div id='allPreguntas'>";
    echo "<form method='POST' id='all'>";
    while ($row = $result->fetch()){
        echo "<div id='".$numPregunta."' class='divPreg'>";
        echo "<div class='enun'>Pregunta ".$numPregunta++.":  ".$row['pregunta']."</div>";
        echo "<div>Respuesta: <b>".$row['respuesta']."</b></div>";
        echo "<div class='select'>";
        $examenUserPregResp = $examenId."-".$usuarioId."-".$row['larga_id']."-".$row['reslar_id'];
        echo "<select id='respuesta' name='respuesta".$numPregunta."' form='all'>";
        echo "<option value='".$examenUserPregResp."-bien.'>Bien</option>";
        echo "<option value='".$examenUserPregResp."-mal.'>Mal</option>";
        echo "</select>";
        echo "</div>";
        echo "</div>";
    }

    echo "<input type='submit' value='Guarda y Envia' id='enviar' class='enviar'>";
    echo "</form>";
    echo "</div>";

    // todo el post dentro de una variable
    $input_data = $_POST;

    foreach ($input_data as $key => $values) {
        list($todo) = explode(".", $values);
        list($exam, $user, $idPreg, $idResp, $resp) = explode("-", $todo);
        $respCorr = 1;
        if($resp == 'mal'){
            $resp = '0';
        }else{
            $resp = '1';
        }

        $update = "UPDATE res_larga SET bool_nota=:resp, bool_corr=:respCorr 
                                    WHERE reslar_id=:idResp 
                                        AND exam_id=:exam
                                        AND users_id=:user
                                        AND larga_id=:idPreg";

        $query = $conn->prepare($update);

        $query->bindParam(':resp',$resp,PDO::PARAM_STR);
        $query->bindParam(':respCorr',$respCorr,PDO::PARAM_STR);
        $query->bindParam(':idResp',$idResp,PDO::PARAM_STR);
        $query->bindParam(':exam',$exam,PDO::PARAM_STR);
        $query->bindParam(':user',$user,PDO::PARAM_STR);
        $query->bindParam(':idPreg',$idPreg,PDO::PARAM_INT);

        $query->execute();

    }

}
?>
