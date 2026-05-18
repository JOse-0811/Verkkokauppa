<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nimi  = $_POST["nimi"];
    $hinta = $_POST["hinta"];

    $_SESSION["kori"][] = [
        "nimi"  => $nimi,
        "hinta" => $hinta
    ];

    header("Content-Type: application/json");
    echo json_encode(["maara" => count($_SESSION["kori"])]);
    exit();
}
?>