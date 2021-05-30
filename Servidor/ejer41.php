<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>4. Mostrar la Concatenacio de 10 valores</h1>
        <?php
            $servername = "localhost";
            $username = "agm";
            $password = "admin";
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=ejer4", $username, $password);
            } catch (Exception $e) {
                echo "Conexion Fallida: ". $e->getMessage();
            }
            
            $query = "SELECT GROUP_CONCAT(letra) concat FROM abecedario;";
            $result = $conn->prepare($query);
            
            $result->execute();
          
            if($result->rowCount() > 0){
                $row = $result->fetch(PDO::FETCH_ASSOC);
                    echo $row['concat'];
            }else{
                echo "No se ha encontrado ningun resultado";
            }
            $conn->close();
        ?>
    </body>
</html>
