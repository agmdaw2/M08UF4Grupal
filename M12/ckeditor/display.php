<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CKEditor 5 – Showing content</title>
 
 
    </head>
    <body>
        <?php
            $mysqli = new mysqli("localhost", "root", "admin", "tecnoticos");
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                exit();
            }
    
            $sql = "SELECT titulo_dilema FROM dilema where id_dilema = 52";
            echo "<h2>Displaying content from database</h2>";
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    echo($row[0]);
                }
            }

            $sql2 = "SELECT MAX(id_dilema) AS id_dilema FROM dilema";
                echo "<h2>PRUEBA 2</h2>";
                if ($result = $mysqli->query($sql2)) {
                    while ($row = $result->fetch_row()) {
                        echo($row[0]);
                    }
            }

            $mysqli->close();
        ?>
    </body>
</html>