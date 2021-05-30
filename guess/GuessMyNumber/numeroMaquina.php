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
        <h3>Adivina el número de la máquina</h3>
    
        <form name="form10" method="post" action="lvl10.php">
            <strong>Nivel 1-10 : </strong> 
            <input type="submit" value="Entra">
        </form>
        
        <form name="form50" method="post" action="lvl50.php">
        <strong>Nivel 1-50 : </strong>
            <input type="submit" value="Entra">
        </form>

        <form name="form100" method="post" action="lvl100.php">
            <strong>Nivel 1-100 : </strong>
            <input type="submit" value="Entra">
        </form>
        
        <form name="volver" method="post" action="index.php">
            <input type="submit" value="Volver a inicio">
        </form>
    </body>
</html>