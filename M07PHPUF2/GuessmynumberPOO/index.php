<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="#">
    <title>GUESS MY NUMBER</title>
</head>
<body id="inicio">
        <h1>GUESS MY NUMBER POO</h1>
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