<?php
    function createLink(){
        $link = mysqli_connect( "127.0.0.1", "<user>", "<password>", "<database>");
    if(!$link){
        echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
        echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
    }
    return $link;
    }

?>