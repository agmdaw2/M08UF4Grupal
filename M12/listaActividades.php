<?php
  session_start();
  if(isset($_SESSION["usuario"])){
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tecnoetica</title>
  <link rel="stylesheet" type="text/css" href="css/main2.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <meta charset="UTF-8">
</head>
<body>
  <div id="pagina">
    <div id="cabecera">
      <a href="index.php"><img src="img/logotipo.png" alt="logo" width="300px" height="90px"></a>
    </div>
    <div class="Login-Registro">
      <a href="Login.php"><img src="img/Perfil.png" alt="Perfil" width="50px" height="50px"></a>
            <?php
                if(isset($_SESSION["usuario"])){
                    echo'<a href="logout.php"><img src="img/logout.png" alt="Logout" width="50px" height="50px"></a>';
                }
            ?>
    </div>
    <div class="navbar">
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='index.php'">Inicio <i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='listaActividades.php'">Dilemas Tecnoeticos<i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='propuestaDidactica.php'">Propuesta Didactica<i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='tecnoeticaFutura.php'">Tecnoetica Futura<i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='contacto.php'">Contacto<i class="fa fa-caret-down"></i></button>
      </div>
    </div>
    <hr>
    <div class="search-container">
      <form action="/action_page.php">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <div id="contenido" class="scroll">

      <?php
      $mysqli = new mysqli("localhost", "root", "admin", "tecnoticos");
      if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      }

      $sql = "SELECT titulo_dilema FROM dilema;";

      if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
          echo ('<div id="dilema1">' . $row[0] . '</div>');
        }
      }
      $mysqli->close();
      ?>
    </div>

    <div id="dilemaSeleccionado">
      <?php
      $mysqli = new mysqli("localhost", "root", "admin", "tecnoticos");
      if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      }

      $sql = "SELECT resumen_dilema FROM dilema where id_dilema=1";

      if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
          echo ('<p>' . $row[0] . '<p>');
        }
      }
      $mysqli->close();
      ?>
    </div>

    <div class="Footer">
      <div id="footerContacto" class="ContenidoFooter">Correo:</div>
      <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
      <div id="footerRedes" class="ContenidoFooter">Twitter</div>
    </div>
  </div>
</body>

</html>