<?php
require 'utiles.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Guess my Number</title>
    </head>
    <body>
        
        <h1>Nivel 1-100</h1>
        <?php
            //CONEXION BBDD mediante Procedimental
            $mysql = new databaseProc('localhost', 'root', 'admin', 'm07uf3');
            $mysql->connect();

            ///STATS DE BASE DE DATOS

            // BBDDProcedimental
            $consulta = $mysql->totalVictorias('Maquina', 3);
            $imprimir='';
            
            while ($row = $consulta->fetch_row()) {
                $imprimir = $row[0]; 
            }

            echo "Total de victorias de la maquina: " . $imprimir;
        ?>
        <h2>La máquina adivina tu número</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" value="Es menor" name="sub_maq">
            <input type="submit" value="Es el número" name="sub_maq">
            <input type="submit" value="Es mayor" name="sub_maq">
            <br><br>

            <?php
            if (!isset($_SESSION['num_maq_100'])) {
                $maq = new Maq();
                $maq->setPiv_d(100);
                $maq->setPiv_i(1);
                $_SESSION['num_maq_100'] = $maq;
            }
            
            $maqui = $_SESSION['num_maq_100'];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (isset($_POST['sub_maq'])){
                    if ($_POST['sub_maq'] == "Es menor"){
                        $maqui->setCont($maqui->getCont() + 1);
                        $maqui->setPiv_d($maqui->getNum_maq() - 1);
                        $maqui->setNum_maq(rand($maqui->getPiv_i(), $maqui->getPiv_d()));
                        echo 'Es ' . $maqui->getNum_maq() . ' el número que buscas? Llevo ' . $maqui->getCont() . ' intentos';
                    }
                    else if ($_POST['sub_maq'] == "Es mayor"){
                        $maqui->setCont($maqui->getCont() + 1);
                        $maqui->setPiv_i($maqui->getNum_maq() + 1);
                        $maqui->setNum_maq(rand($maqui->getPiv_i(), $maqui->getPiv_d()));
                        echo 'Es ' . $maqui->getNum_maq() . ' el número que buscas? Llevo ' . $maqui->getCont() . ' intentos';
                    }
                    else if ($_POST['sub_maq'] == "Es el número"){
                        echo 'La máquina ha adivinado el número ' . $maqui->getNum_maq() . ' en ' . $maqui->getCont() . ' intentos';

                        //CONEXION BBDD mediante Procedimental
                        $mysql = new databaseProc('localhost', 'root', 'admin', 'm07uf3');
                        $mysql->connect();
                        $mysql->insert('Maquina','3', "'".$maqui->getCont()."'");

                        unset($_SESSION['num_maq_100']);
                        echo "<input type='submit' value='Vuelve a jugar' name='sub_maq'>";
                    }
                    else if ($_POST['sub_maq'] == "Vuelve a jugar"){
                        $maqui->setNum_maq(rand($maqui->getPiv_i(), $maqui->getPiv_d()));
                        echo 'Es ' . $maqui->getNum_maq() . ' el número que buscas?';
                        $maqui->setCont($maqui->getCont() + 1);
                    }
                }
                else{
                    $maqui->setNum_maq(rand($maqui->getPiv_i(), $maqui->getPiv_d()));
                    echo 'Es ' . $maqui->getNum_maq() . ' el número que buscas?';
                    $maqui->setCont($maqui->getCont() + 1);
                }
            }
            ?>
        </form>
        
        <form name="volver" method="post" action="index.php">
            <input type="submit" value="Volver a inicio">
        </form>

    </body>
</html>