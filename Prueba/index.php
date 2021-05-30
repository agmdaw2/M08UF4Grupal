<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

//require 'funciones.php';

$servername = "localhost";
$username = "root";
$password = "admin";

try {
  $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

/* AhÃ­ ya has recogido los valores del objeto **`param`** que recibiÃ³ el servidor, esto es un ejemplo lo cual aquÃ­ podrÃ¡s tu manipular los datos como creas conveniente*/

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
        foreach ($_POST['preg_larga'] as $key => $values) {
            $preg_lar = $values['enun'];
            
            $query = "INSERT INTO preg_larga (pregunta, exam_id) VALUES (:pregunta, :exam_id)";
            $query = $conn->prepare($query);
            
            $query->bindParam(':pregunta',$preg_lar,PDO::PARAM_STR);
            $query->bindParam(':exam_id',$ex_id,PDO::PARAM_INT);
            
            $query->execute();
        }
    }
}
/*
 * <div id="preguntas">
            <p id='pl1'>Pregunta larga de prueba</p>
        </div>
        
        <div>
            <button action="">Guarda el examen</button>
        </div>
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 591</title>
    </head>
    <body>
        <form method="POST">
            Nombre examen:<input id="dato1" type="text" name="nom_ex"><br>
            <p>Pregunta 1</p>
            Enunciado:<input id="enun1" type="text" name="preg_larga[1][enun]"><br>
            <!--preg_larga[1][resp_larga1]-->
            <p>Pregunta 2</p>
            Enunciado:<input id="enun2" type="text" name="preg_larga[2][enun]"><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
