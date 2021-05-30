<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>4. Mostrar la Concatenacio de 10 valores</h1>
        <?php
            $servername = "srv-agm";
            $username = "agm";
            $password = "admin";
            $dbname = "ejer4";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error){
                die("Conexion Fallida: ". $conn->connect_error);
            }
            
            $sql = "SELECT group_concat(letra) FROM abecedario";
            $result = $conn->query($sql);
            
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo $row["group_concat(letra)"]."<br>";
                }
            }else{
                echo "No se ha encontrado ningun resultado";
            }
            $conn->close();
        ?>
    </body>
</html>