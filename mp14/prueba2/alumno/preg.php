<?php

session_start();

function preguntas(){

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

    if(!isset($_SESSION['idex'])){
        $_SESSION['idex'] = $_GET['idExamen'];
        $idExamen = $_SESSION['idex'];
    }
    else{
        $idExamen = $_SESSION['idex'];
    }

    $result = $conn->prepare("SELECT preg_corta.pregunta, preg_corta.corta_id, examen.nombre 
                                    FROM examen, preg_corta
                                    WHERE preg_corta.exam_id=examen.exam_id 
                                        AND examen.exam_id='$idExamen'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    $numPreg = 0;

    echo "<div id='todo'>";
    echo "<form id='formResp' method='POST'>";
    while ($row = $result->fetch()){
        if($numPreg < 1){
            echo "<h1 id='titulo'>".$row['nombre']."</h1>";
            echo "<div id='preguntas'>";
        }
        echo "<div id='preg".++$numPreg."'>";
        echo "<div id='titPreg".$numPreg.">Pregunta nº".$numPreg."</div>";
        echo $row['pregunta'];
        echo "<input id='respPreg".$numPreg."' name='res_corta[".$numPreg."][respuesta]' type='text' placeholder='Escribe tú respuesta aquí'>";
        echo "<input id='id".$numPreg."' name='res_corta[".$numPreg."][respuesta_id]' type='hidden' value='". $row['corta_id'] ."'>";
        echo "</div>";
    }

    $result = $conn->prepare("SELECT preg_larga.pregunta, preg_larga.larga_id, examen.nombre 
                                FROM examen, preg_larga 
                                WHERE preg_larga.exam_id=examen.exam_id 
                                    AND examen.exam_id='$idExamen'");

    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    while($row = $result->fetch()){
        echo "<div id='preg".++$numPreg."'>";
        echo "<div id='titPreg".$numPreg."'class='titulo'><h3>Pregunta ".$numPreg."</h3></div>";
        echo "<p class='enunPreg'>" . $row['pregunta'] . "</p>";
        echo "<input id='respPreg".$numPreg."' class='respPreg' name='res_larga[".$numPreg."][respuesta]' type='text' placeholder='Escribe tú respuesta aquí'>";
        echo "<input id='id".$numPreg."' name='res_larga[".$numPreg."][respuesta_id]' type='hidden' value='". $row['larga_id'] ."'>";
        echo "</div>";
    }

//[res_corta][num][respuesta_2]
    // echo "</div>";
    echo "<br><input type='submit' value='Guarda y Envia' id='enviar' class='envia'>";
    echo "</form>";
    echo "</div>";

    if((isset($_POST['res_larga']) && !empty($_POST['res_larga']))){
    
        $idExamen = $_SESSION['idex'];
        
        foreach ($_POST['res_larga'] as $key => $values) {
            $res_larga = $values['respuesta'];
            $id_preg = $values['respuesta_id'];
            $bool_nota = 0;
            $bool_corr = 0;
            $user_id = 1;
            
            $query = "INSERT INTO res_larga (respuesta, exam_id, users_id, larga_id, bool_nota, bool_corr) VALUES (:respuesta, :exam_id, :users_id, :larga_id, :bool_nota, :bool_corr)";
            $query = $conn->prepare($query);
            
            $query->bindParam(':respuesta',$res_larga,PDO::PARAM_STR);
            $query->bindParam(':exam_id',$idExamen,PDO::PARAM_INT);
    
            $query->bindParam(':users_id',$user_id,PDO::PARAM_INT);
            $query->bindParam(':larga_id',$id_preg,PDO::PARAM_INT);
            $query->bindParam(':bool_nota',$bool_nota,PDO::PARAM_BOOL);
            $query->bindParam(':bool_corr',$bool_corr,PDO::PARAM_BOOL);
            
            $query->execute();
        }
    }
    
    if((isset($_POST['res_corta']) && !empty($_POST['res_corta']))){
    
        $idExamen = $_SESSION['idex'];
        
        foreach ($_POST['res_corta'] as $key => $values) {
            $res_corta = $values['respuesta'];
            $id_preg = $values['respuesta_id'];
            
            $result = $conn->query("SELECT preg_corta.res_corr FROM preg_corta WHERE preg_corta.corta_id='$id_preg'");
            
            if($result){
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $res_corr = $row['res_corr'];
                echo $res_corr;
            }
            
            $res_corr = strtolower($res_corr);
            $res_ex = strtolower($res_corta);
            
            if($res_corr == $res_ex){
                $bool_nota = 1;
            }
            else{
                $bool_nota = 0;
            }
            
            
            $user_id = 1;
            
            $query = "INSERT INTO res_corta (respuesta, exam_id, users_id, corta_id, bool_nota) VALUES (:respuesta, :exam_id, :users_id, :corta_id, :bool_nota)";
            $query = $conn->prepare($query);
            
            $query->bindParam(':respuesta',$res_corta,PDO::PARAM_STR);
            $query->bindParam(':exam_id',$idExamen,PDO::PARAM_INT);
    
            $query->bindParam(':users_id',$user_id,PDO::PARAM_INT);
            $query->bindParam(':corta_id',$id_preg,PDO::PARAM_INT);
            $query->bindParam(':bool_nota',$bool_nota,PDO::PARAM_BOOL);
            
            $query->execute();
        }
    }
}
?>
