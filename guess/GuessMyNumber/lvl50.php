<?php
require 'utiles.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Guess my Number</title>
    </head>
    <body>
        
        <h1>Nivel 1-50</h1>
        <?php
            //CONEXION BBDD mediante Procedimental
            $mysql = new databaseProc('localhost', 'root', 'admin', 'm07uf3');
            $mysql->connect();

            ///STATS DE BASE DE DATOSS
                // BBDDProcedimental
            $consulta = $mysql->totalVictorias('Huma', 2);
            $imprimir='';
            
            while ($row = $consulta->fetch_row()) {
                $imprimir = $row[0]; 
            }

            echo "Total de victorias: " . $imprimir;
        ?>
        <br><br>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Numero: <input type="text" name="num">
            <input type="submit">
            <br><br>

            <?php
            if (!isset($_SESSION['secret_50'])){
                $num_maq = new Num();
                $num_maq->setNum_m(rand(1, 50));
                $_SESSION['secret_50'] = $num_maq;
            }

            $obj = $_SESSION['secret_50'];
            $secretNumber = $obj->getNum_m();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // collect value of input field
                //LIMPIA CADENAS
                if (empty($_REQUEST['num'])){
                    echo '';
                }
                else{
                    $num_for = htmlspecialchars($_REQUEST['num']);
                }
                if (empty($num_for)) {
                    echo "";
                } else {
                    if ($num_for >= 1 && $num_for <= 50){
                        if ($num_for < $obj->getNum_m()) {
                            $obj->setCont_gen($obj->getCont_gen() + 1);
                            echo $num_for . " es mas pequeño que el número que buscamos, llevas " . $obj->getCont_gen() . " intentos";
                        } else if ($num_for > $obj->getNum_m()) {
                            $obj->setCont_gen($obj->getCont_gen() + 1);
                            echo $num_for . " es mas grande que el número que buscamos, llevas " . $obj->getCont_gen() . " intentos";
                        } else {
                            echo "Felicidades lo has acertado\n";

                            //INSERT en BBDDProcedimental
                            $mysql->insert('Huma','2', "'".$obj->getCont_gen()."'");

                            unset($_SESSION['secret_50']);
                            $_SESSION['vic50']++;
                            echo "<input type='submit' value='Vuelve a jugar'>";
                        }
                    }
                    else{
                        echo 'El numero ' . $num_for . ' no es valido (1-50)';
                    }
                }
            }
            ?>
        </form>
        
        <form name="volver" method="post" action="index.php">
            <input type="submit" value="Volver a inicio">
        </form>

    </body>
</html>