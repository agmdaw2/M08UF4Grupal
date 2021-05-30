
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>5. Mostrar la Concatenacio de 10 valores</h1>
        <?php
            $servername = "localhost";
            $username = "agm";
            $password = "admin";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=ejer4", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Conexion Fallida: ". $e->getMessage();
            }
            
            $query = "SELECT letra FROM abecedario;";
            $result = $conn->prepare($query);
            
            $result->execute();
            
            if($result){
                if($result->rowCount() > 0){
                    $concat = "";
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $concat = $concat . $row['letra']. ", ";
                    }
                    echo $concat;
                }else{
                    echo "No se ha encontrado ningun resultado";
                }
            }
          
            $conn->close();
        ?>
    </body>
</html>


