<?php

$servername = "localhost";
$username = "root";
$password = "admin";

try {
  $conn = new PDO("mysql:host=$servername;dbname=anjoyal", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


if(isset($_POST['registrarse'])){
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['apellidos']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['pw']) >= 1 && strlen($_POST['curso_id']) >= 1 && strlen($_POST['rol']) >= 1)  
    {
        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $email = trim($_POST['email']);
        $pw = trim($_POST['pw']);
        $curso_id = trim($_POST['curso_id']);
        $rol = trim($_POST['rol']);
        
        //CREAS EL INSERT
        $consulta = "INSERT INTO usuari(nombre,apellidos,mail,pw,curso_id,rol) VALUES(:nombre,:apellidos,:email,:pw,:curso_id,:rol)";
        //PREPARAS LA CONEXION
        $consulta = $conn->prepare($consulta);  
        //DAS VALOR A LOS VALUES
        $consulta->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $consulta->bindParam(':apellidos',$apellidos,PDO::PARAM_STR);
        $consulta->bindParam(':email',$email,PDO::PARAM_STR);
        $consulta->bindParam(':pw',$pw,PDO::PARAM_STR);
        $consulta->bindParam(':curso_id',$curso_id,PDO::PARAM_INT);
        $consulta->bindParam(':rol',$rol,PDO::PARAM_STR);
        $consulta->execute();

        if($consulta){
            ?>
            <h3> "Registro correcto" </h3>
            <?php
        } else {
            ?>
            <h3> "Registro no ha sido posible, intente de nuevo" </h3>
            <?php
    }}
        else {
            ?>
            <h3> "Completa todos los campos!" </h3>
            <?php
        }

    }

?>
