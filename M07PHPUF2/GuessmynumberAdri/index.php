<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio</title>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    </head>
    <body id="inicio">
        <h1>GUESS MY NUMBER</h1>
        <form id="formIni" method="post" action="index.php">
            <p>
                <input type="submit" name="usuarioacierta" value="Acierta el usuario">
            </p>
            <p>
                <input type="submit" name="maquinaacierta" value="Acierta la máquina">
            </p>
        </form>

        <p><strong>Acierta el usuario: La máquina piensa un número y tú lo tienes que adivinar</strong></p>
        <p><strong>Acierta la máquina: Tú piensas un número y la máquina lo adivinará</strong></p>

        <?php
        session_start();
            if (isset($_POST['usuarioacierta'])){
                $_SESSION['modo']="usuario";
                header("Location: nivel.php");
            }elseif(isset($_POST['maquinaacierta'])){
                $_SESSION['modo']="maquina";
                header("Location: nivel.php");
            }
        ?>
    </body>
</html>