<?php

session_start();

function preguntas(){

    $servername = "localhost";
    $username = "root";
    $password = "admin";

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
    echo "<form id='formResp'>";
    while ($row = $result->fetch()){
        if($numPreg < 1){
            echo "<h1 id='titulo'>".$row['nombre']."</h1>";
            echo "<div id='preguntas'>";
        }
        echo "<div id='preg".++$numPreg."'>";
        echo "<div id='titPreg".$numPreg."'>Pregunta nº".$numPreg."</div>";
        echo $row['pregunta'];
        echo "<input id='respPreg".$numPreg."' name='res_corta[".$numPreg."][respuesta_".$row['corta_id']."]' type='text' placeholder='Escribe tú respuesta aquí'>";
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
        echo "<div id='titPreg".$numPreg."'>Pregunta nº".$numPreg."</div>";
        echo $row['pregunta'];
        echo "<input id='respPreg".$numPreg."' name='res_larga[".$numPreg."][respuesta]' type='text' placeholder='Escribe tú respuesta aquí'>";
        echo "<input id='id".$numPreg."' name='res_larga[".$numPreg."][respuesta_id]' type='hidden' value='". $row['larga_id'] ."'>";
        echo "</div>";
    }

//[res_corta][num][respuesta_2]
    // echo "</div>";
    echo "<input type='submit' value='Guarda y Envia' id='enviar'>";
    echo "</form>";
    echo "</div>";
}

if((isset($_POST['res_larga']) && !empty($_POST['res_larga'])) || (isset($_POST['res_corta']) && !empty($_POST['res_corta']))){

    $idExamen = $_SESSION['idex'];
    
    foreach ($_POST['res_larga'] as $key => $values) {

        $res_larga = $values['respuesta'];
        $id_preg = $values['respuesta_id'];

        echo '1'.$values['res_larga'];
        echo '2'.$res_larga;
        echo '3'.$id_preg;

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
    
    /*if($result){
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $ex_id = $row['exam_id'];
    }
    
    if((isset($_POST['preg_larga']) && !empty($_POST['preg_larga']))){
        foreach ($_POST['preg_larga'] as $key => $values) {
            $preg_lar = $values['enun'];
            
            $query = "INSERT INTO preg_larga (pregunta, exam_id) VALUES (:pregunta, :exam_id)";
            $query = $conn->prepare($query);
            
            $query->bindParam(':pregunta',$preg_lar,PDO::PARAM_STR);
            $query->bindParam(':exam_id',$ex_id,PDO::PARAM_INT);
            
            $query->execute();
        }
    }
    
    if((isset($_POST['preg_corta']) && !empty($_POST['preg_corta']))){
        foreach ($_POST['preg_corta'] as $key => $values) {
            $preg_cor = $values['enun'];
            $res = $values['resp'];
            
            $query = "INSERT INTO preg_corta (pregunta, res_corr ,exam_id) VALUES (:pregunta, :res_corr, :exam_id)";
            $query = $conn->prepare($query);
            
            $query->bindParam(':pregunta',$preg_cor,PDO::PARAM_STR);
            $query->bindParam(':res_corr',$res,PDO::PARAM_STR);
            $query->bindParam(':exam_id',$ex_id,PDO::PARAM_INT);
            
            $query->execute();
        }
    }*/
}
?>