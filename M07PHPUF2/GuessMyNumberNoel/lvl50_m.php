<?php
require 'funciones.php';
?>

<html>
    <head>
        <link rel=StyleSheet href="CSS/general.css" type="text/css" media=screen>
        <meta charset="UTF-8">
        <title>Guess my Number</title>
    </head>
    <body>
        
        <h1>Nivel 1-50</h1>
        
        <h2>La máquina adivina tu número</h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" value="Es menor" name="sub_maq">
            <input type="submit" value="Es el número" name="sub_maq">
            <input type="submit" value="Es mayor" name="sub_maq">
            <br><br>

            <?php
            if (!isset($_SESSION['num_maq_50'])) {
                $maq = new Maq();
                $maq->setPiv_d(50);
                $maq->setPiv_i(1);
                $_SESSION['num_maq_50'] = $maq;
            }
            
            $maqui = $_SESSION['num_maq_50'];

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
                        unset($_SESSION['num_maq_50']);
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