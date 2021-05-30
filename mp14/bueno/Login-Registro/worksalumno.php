<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["usuario"])){
    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Has iniciado Sesión como alumno !!!!!!!!!!!</h1>
    <h2><?php echo "<h4>Bienvenido - ".$_SESSION['usuario']."</h4>"?></h2>
</body>
</html>

<?php
}
else{
    header("location:../Login.php");
    
}