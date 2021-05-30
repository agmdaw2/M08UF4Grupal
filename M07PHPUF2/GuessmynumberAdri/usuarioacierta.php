<html>
    <head>
        <meta charset="utf-8">
        <title>Juega</title>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
        <script src="funcions.js"></script>
    </head>
    <body>

        <form method="post" action="usuarioacierta.php"> 
            Número: <input type="number" name="num">
            <input type="submit" value="Enviar" name="enviar">
        </form>
        
        <?php
        session_start();
        $numaleatori;

        if(empty($_SESSION['intentos'])){
            $_SESSION['intentos']=0;
        }

        if(empty($_SESSION['numaleatori'])){
            $numaleatori=randomNumber(); 
            $_SESSION['numaleatori']=$numaleatori;
            
            if($_SESSION['nivel']=="I"){
                echo "<p id='texto3'><strong>PARA JUGAR ESCRIBE UN NÚMERO ENTRE 1 Y 10</strong></p>";
                echo "<script>borrarTexto3();</script>";
            }elseif($_SESSION['nivel']=="II"){
                echo "<p id='texto3'><strong>PARA JUGAR ESCRIBE UN NÚMERO ENTRE 1 Y 50</strong></p>";
                echo "<script>borrarTexto3();</script>";
            }elseif($_SESSION['nivel']=="III"){
                echo "<p id='texto3'><strong>PARA JUGAR ESCRIBE UN NÚMERO ENTRE 1 Y 100</strong></p>";
                echo "<script>borrarTexto3();</script>";
            }
        }else{
            $numaleatori=$_SESSION['numaleatori'];
        }
        
        if (isset($_POST['enviar'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $name = htmlspecialchars($_REQUEST['num']);
                if (empty($name)) {
                    echo "<strong>ESCRIBE UN NÚMERO</strong>";
                }else{
                    if($_SESSION['nivel']=="I"){
                        if($name<1 || $name>10){
                            echo "<strong>EL ".$name." NO ES UN NÚMERO ENTRE 1 Y 10</strong>";
                        }else{
                            comprobarNumero($name,$numaleatori);
                        }
                    }elseif($_SESSION['nivel']=="II"){
                        if($name<1 || $name>50){
                            echo "<strong>EL ".$name." NO ES UN NÚMERO ENTRE 1 Y 50</strong>";
                        }else{
                            comprobarNumero($name,$numaleatori);
                        }
                    }elseif($_SESSION['nivel']=="III"){
                        if($name<1 || $name>100){
                            echo "<strong>EL ".$name." NO ES UN NÚMERO ENTRE 1 Y 100</strong>";
                        }else{
                            comprobarNumero($name,$numaleatori);
                        }
                    }
                }
                
            }
        }
        
        function randomNumber() {
            $nivel=$_SESSION['nivel'];
            if($nivel=="I"){
                $numaleatori=rand(1,10);
                $_SESSION["max"]=10;
                $_SESSION['min']=1;
                return $numaleatori;
            }elseif($nivel=="II"){
                $numaleatori=rand(1,50);
                $_SESSION["max"]=50;
                $_SESSION['min']=1; 
                return $numaleatori;
            }elseif($nivel=="III"){
                $numaleatori=rand(1,100);
                $_SESSION["max"]=100;
                $_SESSION['min']=1; 
                return $numaleatori;
            } 
        }
        
        function comprobarNumero($n,$numaleatori) {
            $numero=$n;

            if($numero<$numaleatori){
                $_SESSION['min']=$numero;
                echo "<p id='texto'><strong>El número es más grande</strong></p>";
                echo "<p id='texto2'><strong>El número está entre ".$_SESSION['min']." y ".$_SESSION['max']."</strong></p>";
                echo "<script>borrarTexto();</script>";
                $_SESSION['intentos']+=1;
            }else if($numero>$numaleatori){
                $_SESSION['max']=$numero;
                echo "<p id='texto'><strong>El número es más pequeño</strong></p>";
                echo "<p id='texto2'><strong>El número está entre ".$_SESSION['min']." y ".$_SESSION['max']."</strong></p>";
                echo "<script>borrarTexto();</script>";
                $_SESSION['intentos']+=1;
            }else{
                $_SESSION['intentos']+=1;

                $_SESSION['resultado']="<br>"."!FELICIDADES HAS ACERTADO EL NÚMERO¡";
                $_SESSION['resultado']=$_SESSION['resultado']."<br><br>"."HAS ACERTADO EN ".$_SESSION['intentos']." INTENTOS.";
                
                header("Location: resultado.php");
            }
        }
        ?>
        
    </body>
</html>