<?php

function notas($id_alu){
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

    $result = $conn->prepare("SELECT res_corta.bool_nota, res_corta.exam_id FROM res_corta WHERE res_corta.users_id ='$id_alu'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    $notas = array();
    
    $piv = false;
    
    foreach ($result as $key => $value) {
        if (count($notas) == 0){
            $notas[0] = array($value['exam_id'], $value['bool_nota'], 1, true);
        }
        else{
            for($var = 0; $var < count($notas); $var++) {
                if (!$piv){
                    if ($notas[$var][0] == $value['exam_id']){
                        $notas[$var][1] = $notas[$var][1] + $value['bool_nota'];
                        $notas[$var][2] = $notas[$var][2] + 1;
                        $piv = true;
                    }
                }
             }
             if(!$piv){
                array_push($notas, array($value['exam_id'], $value['bool_nota'], 1, true));
                $piv = false;
            }
            else{
                $piv = false;
            }
        }
    }
    
    $result2 = $conn->prepare("SELECT res_larga.bool_nota, res_larga.bool_corr, res_larga.exam_id FROM res_larga WHERE res_larga.users_id ='$id_alu'");
    $result2->setFetchMode(PDO::FETCH_ASSOC);
    $result2->execute();
    
    $piv = false;
    
    foreach ($result2 as $key => $value) {
        if (count($notas) == 0){
            $notas[0] = array($value['exam_id'], $value['bool_nota'], 1, 1);
        }
        else{
            for($var = 0; $var < count($notas); $var++) {
                if (!$piv){
                    if ($notas[$var][0] == $value['exam_id']){
                        $notas[$var][1] = $notas[$var][1] + $value['bool_nota'];
                        $notas[$var][2] = $notas[$var][2] + 1;
                        if ($value['bool_corr'] == 0){
                            $notas[$var][3] = 0;
                        }
                        $piv = true;
                    }
                }
             }
             if(!$piv){
                array_push($notas, array($value['exam_id'], $value['bool_nota'], 1, 1));
                $piv = false;
            }
            else{
                $piv = false;
            }
        }
    }
    
    for($var = 0; $var < count($notas); $var++) {
        if ($notas[$var][3] == 1){
            $nombre = $notas[$var][0];
            
            $result = $conn->prepare("SELECT examen.nombre FROM examen WHERE examen.exam_id ='$nombre'");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            foreach ($result as $key => $value) {
                echo "<h3>" . $value['nombre'] . ":</h3>";
            }
            
            $cara = $notas[$var][1] / $notas[$var][2];
            
            if ($cara > 0.74){
                echo "<img src='media/top.png' alt=`'Cara muy feliz' style='width: 50px;'>";
            }
            else if ($cara > 4.9 && $cara < 7.4) {
                echo "<img src='media/mid.png' alt=`'Cara feliz' style='width: 50px;'>";
            }
            else{
                echo "<img src='media/low.png' alt=`'Cara triste' style='width: 50px;'>";
            }
        }
    }
}