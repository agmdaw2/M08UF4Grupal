<?php
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Guess my Number</title>
    </head>
    <body>
        <h1>Guess my Number Objetos</h1>
        <h3>Elige un juego!</h3>
   
        <form name="nMaquina" method="post" action="numeroMaquina.php">
        <strong>Adivina el número de la máquina :</strong>
            <input type="submit" value="A Jugar!">
        </form>

        <form name="nMio" method="post" action="numeroPropio.php">
        <strong>La maquina adivina tu número : </strong>
            <input type="submit" value="A Jugar!">
        </form>

        <form name="volver" method="post" action="estadisticas.php">
            <input type="submit" value="Ver estadisticas">
        </form>

        <?php
            echo "<a href='credits.php' target='credits.txt' onclick=\"window.open(this.href, this.target, ' width=400, height=300, menubar=no');return false;\"> Creditos </a>";
        ?>
    </body>
</html>
