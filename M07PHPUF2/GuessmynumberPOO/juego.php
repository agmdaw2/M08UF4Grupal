<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="funcions.js"></script>
</head>
<body>


    <?php
    session_start();
    inicio();

    function inicio(){
        if($_SESSION['modo']=="usuario"){
            $_SESSION['juego'] = new JuegoMaquinaAcierta();

        }elseif($_SESSION['modo']=="maquina"){
            $_SESSION['juego'] = new JuegoUsuarioAcierta();
        } 
    }

    if (isset($_POST['peque'])){
        $_SESSION['juego']->botonesAcierto(1);
    }

    if (isset($_POST['gran'])){
        $_SESSION['juego']->botonesAcierto(2);
    }

    if (isset($_POST['acertado'])){
        $_SESSION['juego']->botonesAcierto(3);
    }



    //Clase padre
        abstract class Juego{
            public $intentos;  
            public $max;
            public $min;
            public $nivel;
            public $resultado;
            public function start(){
                if($this->nivel=="I"){
                    echo "<p id='texto3'><strong>PARA JUGAR ESCRIBE UN NÚMERO ENTRE 1 Y 10</strong></p>";
                    echo "<script>borrarTexto3();</script>";
                }elseif($this->nivel=="II"){
                    echo "<p id='texto3'><strong>PARA JUGAR ESCRIBE UN NÚMERO ENTRE 1 Y 50</strong></p>";
                    echo "<script>borrarTexto3();</script>";
                }elseif($this->nivel=="III"){
                    echo "<p id='texto3'><strong>PARA JUGAR ESCRIBE UN NÚMERO ENTRE 1 Y 100</strong></p>";
                    echo "<script>borrarTexto3();</script>";
                }
            }
        }

    // Clase Hijo
        class JuegoMaquinaAcierta extends Juego{
            public $mitad;
            public $maximo;
           //CONSTRUCTOR
            function __construct(){
                $this->intentos = 0;
                $this->imprimir();
                $this->preStart();
            }

            function preStart(){
                if(empty($this->max) && empty($this->min)){
                    $this->establecerNivel();
                    $this->sacarMitad();
                    $this->start();
                } 
            }
            
            function imprimir(){
                echo "<form method='post'>";
                echo "<input type='submit' class='button' value='Más Pequeño' name='peque'>";
                echo "<input type='submit' class='button' value='SI' name='acertado'>";
                echo "<input type='submit' class='button' value='Más Grande' name='gran'>";
                echo "</form>";
            }            

            function botonesAcierto(int $opcion){
                switch ($opcion) {
                    case 1:
                    $this->intentos+=1;
                    $this->max=$this->mitad;
                    $this->sacarMitad();
                    break;

                    case 2:
                    $this->intentos+=1;
                    $this->min=$this->mitad;
                    $this->sacarMitad();
                    break;
                    
                    case 3:
                    $this->intentos+=1;
                    $this->resultado="<br>"."!HE ACERTADO SOY UN ORDENADOR MUY LISTO¡";
                    $this->resultado=$this->resultado."<br><br>"."HE ACERTADO EN ".$this->intentos." INTENTOS.</p>";
                    $_SESSION['resultado'] = $this->resultado;
                    header("Location: resultado.php");
                }
            }
            
            function establecerNivel() {
                $this->nivel=$_SESSION['nivel'];
                if($this->nivel=="I"){
                    $this->maximo=10;
                    $this->max=10;
                    $this->min=1;
                }elseif($this->nivel=="II"){
                    $this->maximo=50;
                    $this->max=50;
                    $this->min=1;
                }elseif($this->nivel=="III"){
                    $this->maximo=100;
                    $this->max=100;
                    $this->min=1;
                } 
            }
    
            function sacarMitad(){
                $this->mitad=round(($this->min+$this->max)/2);
                
                if($this->min==$this->maximo-1){
                    echo "<p id='texto'><strong>¿TU NÚMERO ES EL ".$this->maximo."?</strong></p>";
                    echo "<script>borrarTexto();</script>";
                }else{
                    echo "<p id='texto'><strong>¿TU NÚMERO ES EL ".$this->mitad."?</strong></p>";
                    echo "<script>borrarTexto();</script>";
                }      
            }
        }

    // Clase Hijo
        class JuegoUsuarioAcierta extends Juego{
            public $numaleatori;
            //CONSTRUCTOR
            function __construct(){
                $this->intentos = 0;
                $this->numaleatori = $this->randomNumber();
                $this->nivel = $_SESSION['nivel'];
                $this->imprimir();
                $this->start();
            }

            function imprimir(){
                echo "<form method='post'>";
                echo "Número: <input type='number' name='num'>";
                echo "<input type='submit' value='Enviar' name='enviar' onclick='entrada()'>";
                echo "</form>";
            }

            function entrada(){
                if (isset($_POST['enviar'])){
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        $name = htmlspecialchars($_REQUEST['num']);
                        if (empty($name)) {
                            echo "<strong>ESCRIBE UN NÚMERO</strong>";
                        }else{
                            if($this->nivel=="I"){
                                if($name<1 || $name>10){
                                    echo "<strong>EL ".$name." NO ES UN NÚMERO ENTRE 1 Y 10</strong>";
                                }else{
                                    $this->comprobarNumero($name,$numaleatori);
                                }
                            }elseif($$this->nivel=="II"){
                                if($name<1 || $name>50){
                                    echo "<strong>EL ".$name." NO ES UN NÚMERO ENTRE 1 Y 50</strong>";
                                }else{
                                    $this->comprobarNumero($name,$numaleatori);
                                }
                            }elseif($this->nivel=="III"){
                                if($name<1 || $name>100){
                                    echo "<strong>EL ".$name." NO ES UN NÚMERO ENTRE 1 Y 100</strong>";
                                }else{
                                    $this->comprobarNumero($name,$numaleatori);
                                }
                            }
                        }
                        
                    }
                }
            }
            
            function randomNumber() {
                if( $this->nivel=="I"){
                    $this->numaleatori=rand(1,10);
                    $this->max=10;
                    $this->min=1;
                    return $numaleatori;
                }elseif( $this->nivel=="II"){
                    $this->numaleatori=rand(1,50);
                    $this->max=50;
                    $this->min=1; 
                    return $numaleatori;
                }elseif( $this->nivel=="III"){
                    $this->numaleatori=rand(1,100);
                    $this->max=100;
                    $this->min=1; 
                    return $numaleatori;
                } 
            }
            
            function comprobarNumero($n,$numaleatori) {
                $numero=$n;
                if($numero<$numaleatori){
                    $this->min=$numero;
                    echo "<p id='texto'><strong>El número es más grande</strong></p>";
                    echo "<p id='texto2'><strong>El número está entre ".$_SESSION['min']." y ".$_SESSION['max']."</strong></p>";
                    echo "<script>borrarTexto();</script>";
                    $this->intentos+=1;
                }else if($numero>$numaleatori){
                    $this->max=$numero;
                    echo "<p id='texto'><strong>El número es más pequeño</strong></p>";
                    echo "<p id='texto2'><strong>El número está entre ".$_SESSION['min']." y ".$_SESSION['max']."</strong></p>";
                    echo "<script>borrarTexto();</script>";
                    $this->intentos+=1;
                }else{
                    $this->intentos+=1;

                    $this->resultado="<br>"."!FELICIDADES HAS ACERTADO EL NÚMERO¡";
                    $this->resultado= $this->resultado."<br><br>"."HAS ACERTADO EN ". $this->intentos." INTENTOS.";
                    
                    header("Location: resultado.php");
                }
            }
        }
    ?>
</body>
</html>