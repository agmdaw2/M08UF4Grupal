<?php
    if($_REQUEST["saludar"] === "hola"){
        echo "Hola Nicolau Copernic\n";
        sleep(3);
        echo "Hola Nicolau Copernic";
    } elseif($_REQUEST["saludar"] === "adeu") {
        echo "Adeu Nicolau Copernic\n";
        sleep(3);
        echo "Adeu Nicolau Copernic";
    } else {
        echo "Nicolau Copernic\n";
        sleep(3);
        echo "Nicolau Copernic";
    }
?>