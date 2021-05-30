<html>
    <head>
        <meta charset="utf-8">
        <title>Juega</title>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
        <script src="funcions.js"></script>
    </head>
    <body>

        <form method="post" action="maquinaacierta.php"> 
            <input type="submit" value="Más Pequeño" name="peque">
            <input type="submit" value="SI" name="acertado">
            <input type="submit" value="Más Grande" name="gran">
        </form>
        
        <?php
        session_start();

        if(empty($_SESSION["max"]) && empty($_SESSION['min'])){
            establecerNivel();
            if($_SESSION['nivel']=="I"){
                echo "<p id='texto3'><strong>PIENSA UN NÚMERO ENTRE 1 Y 10</strong></p>";
                echo "<script>borrarTexto3();</script>";
            }elseif($_SESSION['nivel']=="II"){
                echo "<p id='texto3'><strong>PIENSA UN NÚMERO ENTRE 1 Y 50</strong></p>";
                echo "<script>borrarTexto3();</script>";
            }elseif($_SESSION['nivel']=="III"){
                echo "<p id='texto3'><strong>PIENSA UN NÚMERO ENTRE 1 Y 100</strong></p>";
                echo "<script>borrarTexto3();</script>";
            }
        }
        
        if(empty($_SESSION['Mitad'])){
            sacarMitad();
        }

        if(empty($_SESSION['intentos'])){
            $_SESSION['intentos']=0;
        }

        if (isset($_POST['peque'])){
            $_SESSION['intentos']+=1;
            $_SESSION['max']=$_SESSION['Mitad'];
            sacarMitad();
        }

        if (isset($_POST['gran'])){
            $_SESSION['intentos']+=1;
            $_SESSION['min']=$_SESSION['Mitad'];
            sacarMitad();
        }

        if (isset($_POST['acertado'])){
            $_SESSION['intentos']+=1;

            $_SESSION['resultado']="<br>"."!HE ACERTADO SOY UN ORDENADOR MUY LISTO¡";
            $_SESSION['resultado']=$_SESSION['resultado']."<br><br>"."HE ACERTADO EN ".$_SESSION['intentos']." INTENTOS.</p>";

            header("Location: resultado.php");
        }
        
        function establecerNivel() {
            $nivel=$_SESSION['nivel'];
            if($nivel=="I"){
                $_SESSION['Maximo']=10;
                $_SESSION["max"]=10;
                $_SESSION['min']=1;
            }elseif($nivel=="II"){
                $_SESSION['Maximo']=50;
                $_SESSION["max"]=50;
                $_SESSION['min']=1;
            }elseif($nivel=="III"){
                $_SESSION['Maximo']=100;
                $_SESSION["max"]=100;
                $_SESSION['min']=1;
            } 
        }

        function sacarMitad(){
                $_SESSION['Mitad']=($_SESSION['min']+$_SESSION['max'])/2;
                $_SESSION['Mitad']=floor($_SESSION['Mitad']);

                if($_SESSION['min']==$_SESSION['Maximo']-1){
                    echo "<p id='texto'><strong>¿TU NÚMERO ES EL ".$_SESSION['Maximo']."?</strong></p>";
                    echo "<script>borrarTexto();</script>";
                }else{
                    echo "<p id='texto'><strong>¿TU NÚMERO ES EL ".$_SESSION['Mitad']."?</strong></p>";
                    echo "<script>borrarTexto();</script>";
                }      
        }
        ?> 
        
    </body>
</html>