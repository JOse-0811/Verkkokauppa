<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nimi= $_POST["name"];
        $hinta= $_POST["prize"];

        //Lisää tuotte session
        $_SESSION["kori"][]=[
            "name"=> $nimi,
            "prize"=> $hinta
        ];

        //Palauta korissa olleiden tuotteiden määrä
        echo json_decode(["maara" => count($_SESSION["kori"])]);
    }
?>