<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nivel</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
    
<form method="post" action="nivel.php"> 
    <label>Escoge el nivel: </label>
        <select name="nivel" style="border-radius: 5px">
            <option>...</option>
            <option>I</option>
            <option>II</option>
            <option>III</option>
        </select>
        <input type="submit" value="Enviar" name="submit">
</form>
<p><strong>Nivel I: Números entre 1 y 10</strong></p>
<p><strong>Nivel II: Números entre 1 y 50</strong></p>
<p><strong>Nivel III: Números entre 1 y 100</strong></p>
<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nivel'])){
            $nivel=$_POST['nivel'];
            
            if($nivel=="..."){
                echo "<strong>¡ESCOGE UN NIVEL!</strong>";
            }else{
                $_SESSION['nivel'] = $nivel;

                if($_SESSION['modo']=="usuario"){
                    header("Location: usuarioacierta.php");
                }elseif($_SESSION['modo']=="maquina"){
                    header("Location: maquinaacierta.php");
                }
               
            }
        } 
    }
?>
</body>
</html>