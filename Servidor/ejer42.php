<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>4. Mostrar la Concatenacio de 10 valores</h1>
        <?php
            $servername = "localhost";
            $username = "prueba";
            $password = "1234";
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=ejer4", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo 'YAI';
            } catch (Exception $e) {
                echo "Conexion Fallida: ". $e->getMessage();
            }

            $conn->close();
        ?>
    </body>
</html>
