<?php
require 'utiles.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //CONEXION BBDD mediante Procedimental
        $mysql = new databaseProc('localhost', 'root', 'admin', 'm07uf3');
        $mysql->connect();
    ?>
    <h1>Estadisticas</h1>
    <h2>Adivina el numero de la maquina</h2>
    <ul>
        <li>
            <h3>Nivel 1-10</h3>
            <form name="1" method="post" action="estadisticas.php">
                <input name='tabla1[1][nivell]' type='hidden' value='1'>
                <input name='tabla1[1][modalitat]' type='hidden' value='Huma'>
                <input type="submit" value="Ver">
            </form>
            <?php
                if((isset($_POST['tabla1']) && !empty($_POST['tabla1']))){
                    $nivell='';
                    $modalitat='';
                    foreach ($_POST['tabla1'] as $key => $values) {
                        $nivell = $values['nivell'];
                        $modalitat = $values['modalitat'];
                    }
                    $consulta = $mysql->selectAllNivellModalitat($modalitat, $nivell);
                    echo "<table>";
                    $contador = 1;
                    while ($row = $consulta->fetch_row()) {
                        if($contador++==1){
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Modalitat</th>";
                            echo "<th>Nivell</th>";
                            echo "<th>Data</th>";
                            echo "<th>Intents</th>";
                            echo "";
                            echo "</tr>";
                        }
                        if($contador != 1){
                            echo "<tr>";
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo "<td>".$row[4]."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                }                
            ?>
        </li>

        <li>
            <h3>Nivel 1-50</h3>
            <form name="1" method="post" action="estadisticas.php">
                <input name='tabla2[2][nivell]' type='hidden' value='2'>
                <input name='tabla2[2][modalitat]' type='hidden' value='Huma'>
                <input type="submit" value="Ver">
            </form>
            <?php
                if((isset($_POST['tabla2']) && !empty($_POST['tabla2']))){
                    $nivell='';
                    $modalitat='';
                    foreach ($_POST['tabla2'] as $key => $values) {
                        $nivell = $values['nivell'];
                        $modalitat = $values['modalitat'];
                    }
                    $consulta = $mysql->selectAllNivellModalitat($modalitat, $nivell);
                    echo "<table>";
                    $contador = 1;
                    while ($row = $consulta->fetch_row()) {
                        if($contador++==1){
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Modalitat</th>";
                            echo "<th>Nivell</th>";
                            echo "<th>Data</th>";
                            echo "<th>Intents</th>";
                            echo "";
                            echo "</tr>";
                        }
                        if($contador != 1){
                            echo "<tr>";
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo "<td>".$row[4]."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                } 
            ?>
        </li>
        
        <li>
            <h3>Nivel 1-100</h3>
            <form name="1" method="post" action="estadisticas.php">
                <input name='tabla3[3][nivell]' type='hidden' value='3'>
                <input name='tabla3[3][modalitat]' type='hidden' value='Huma'>
                <input type="submit" value="Ver">
            </form>
            <?php
                if((isset($_POST['tabla3']) && !empty($_POST['tabla3']))){
                    $nivell='';
                    $modalitat='';
                    foreach ($_POST['tabla3'] as $key => $values) {
                        $nivell = $values['nivell'];
                        $modalitat = $values['modalitat'];
                    }
                    $consulta = $mysql->selectAllNivellModalitat($modalitat, $nivell);
                    echo "<table>";
                    $contador = 1;
                    while ($row = $consulta->fetch_row()) {
                        if($contador++==1){
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Modalitat</th>";
                            echo "<th>Nivell</th>";
                            echo "<th>Data</th>";
                            echo "<th>Intents</th>";
                            echo "";
                            echo "</tr>";
                        }
                        if($contador != 1){
                            echo "<tr>";
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo "<td>".$row[4]."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                } 
            ?>
        </li>
        
    </ul>

    <h2>Adivina el numero del Humano</h2>
    <ul>
        <li>
            <h3>Nivel 1-10</h3>
            <form name="1" method="post" action="estadisticas.php">
                <input name='tabla4[4][nivell]' type='hidden' value='1'>
                <input name='tabla4[4][modalitat]' type='hidden' value='Maquina'>
                <input type="submit" value="Ver">
            </form>
            <?php
                if((isset($_POST['tabla4']) && !empty($_POST['tabla4']))){
                    $nivell='';
                    $modalitat='';
                    foreach ($_POST['tabla4'] as $key => $values) {
                        $nivell = $values['nivell'];
                        $modalitat = $values['modalitat'];
                    }
                    $consulta = $mysql->selectAllNivellModalitat($modalitat, $nivell);
                    echo "<table>";
                    $contador = 1;
                    while ($row = $consulta->fetch_row()) {
                        if($contador++==1){
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Modalitat</th>";
                            echo "<th>Nivell</th>";
                            echo "<th>Data</th>";
                            echo "<th>Intents</th>";
                            echo "";
                            echo "</tr>";
                        }
                        if($contador != 1){
                            echo "<tr>";
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo "<td>".$row[4]."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                } 
            ?>
        </li>

        <li>
            <h3>Nivel 1-50</h3>
            <form name="1" method="post" action="estadisticas.php">
                <input name='tabla5[5][nivell]' type='hidden' value='2'>
                <input name='tabla5[5][modalitat]' type='hidden' value='Maquina'>
                <input type="submit" value="Ver">
            </form>
            <?php
                if((isset($_POST['tabla5']) && !empty($_POST['tabla5']))){
                    $nivell='';
                    $modalitat='';
                    foreach ($_POST['tabla5'] as $key => $values) {
                        $nivell = $values['nivell'];
                        $modalitat = $values['modalitat'];
                    }
                    $consulta = $mysql->selectAllNivellModalitat($modalitat, $nivell);
                    echo "<table>";
                    $contador = 1;
                    while ($row = $consulta->fetch_row()) {
                        if($contador++==1){
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Modalitat</th>";
                            echo "<th>Nivell</th>";
                            echo "<th>Data</th>";
                            echo "<th>Intents</th>";
                            echo "";
                            echo "</tr>";
                        }
                        if($contador != 1){
                            echo "<tr>";
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo "<td>".$row[4]."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                } 
            ?>
        </li>
        
        <li>
            <h3>Nivel 1-100</h3>
            <form name="1" method="post" action="estadisticas.php">
                <input name='tabla6[6][nivell]' type='hidden' value='3'>
                <input name='tabla6[6][modalitat]' type='hidden' value='Maquina'>
                <input type="submit" value="Ver">
            </form>
            <?php
                if((isset($_POST['tabla6']) && !empty($_POST['tabla6']))){
                    $nivell='';
                    $modalitat='';
                    foreach ($_POST['tabla6'] as $key => $values) {
                        $nivell = $values['nivell'];
                        $modalitat = $values['modalitat'];
                    }
                    $consulta = $mysql->selectAllNivellModalitat($modalitat, $nivell);
                    echo "<table>";
                    $contador = 1;
                    while ($row = $consulta->fetch_row()) {
                        if($contador++==1){
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Modalitat</th>";
                            echo "<th>Nivell</th>";
                            echo "<th>Data</th>";
                            echo "<th>Intents</th>";
                            echo "";
                            echo "</tr>";
                        }
                        if($contador != 1){
                            echo "<tr>";
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo "<td>".$row[4]."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                } 
            ?>
        </li>
        
    </ul>

</body>
</html>