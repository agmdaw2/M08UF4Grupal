<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <title>Resultado</title>
</head>
<body>
    <form method="post" action="resultado.php">     
        <input type="submit" value="Volver a jugar" name="inicio">
    </form>
    <?php
        session_start();
        echo "<strong>".$_SESSION['resultado']."</strong>";
        
        session_unset();

        if(isset($_POST['inicio'])){
            header("Location: index.php");
        }
    ?>
</body>
</html>