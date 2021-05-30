<?php

session_start();

//require 'funciones.php';

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

if((isset($_POST['nom_ex']) && !empty($_POST['nom_ex']))){
    
    $nom = $_POST['nom_ex'];
    $wop = 'Wololo';
    $idd = 1;
    
    $query = "INSERT INTO examen (nombre, cod_ext, asig_id) VALUES (:nombre, :cod_ext, :asig_id)";
    $query = $conn->prepare($query);
    
    $query->bindParam(':nombre',$nom,PDO::PARAM_STR);
    $query->bindParam(':cod_ext',$wop,PDO::PARAM_STR);
    $query->bindParam(':asig_id',$idd,PDO::PARAM_INT);
    
    $query->execute();
    
    $ex_id = '';
    
    $result = $conn->query("SELECT exam_id FROM examen WHERE nombre = '". $nom ."'");
    
    if($result){
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
    }
}
?>