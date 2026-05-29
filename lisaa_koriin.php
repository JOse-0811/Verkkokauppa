<?php
include_once("yhteys.php");
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nimi  = $_POST["nimi"];
    $hinta = $_POST["hinta"];


    $_SESSION["kori"][] = [
        "nimi"  => $nimi,
        "hinta" => $hinta
    ];

    // Hae product_id nimen perusteella
    $session_id = session_id();
    $stmt = $yhteys->prepare("SELECT id FROM products WHERE name = ?");
    $stmt->bind_param("s", $nimi);
    $stmt->execute();
    $tuote = $stmt->get_result()->fetch_assoc();
    $product_id = $tuote["id"];

    // Tarkista onko korilla jo sessio
    $stmt = $yhteys->prepare("SELECT id FROM cart WHERE session = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $tulos = $stmt->get_result();

    if($tulos->num_rows == 0){
        $stmt = $yhteys->prepare("INSERT INTO cart (session) VALUES (?)");
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        $cart_id = $yhteys->insert_id;
    }
    else {
        $cart_id = $tulos->fetch_assoc()["id"];
    }

    // Tarkista onko tuote jo korissa
    $stmt = $yhteys->prepare("SELECT id, amount FROM cart_item WHERE cart_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $cart_id, $product_id);
    $stmt->execute();
    $tulos = $stmt->get_result();

    if($tulos->num_rows == 0){
        $stmt = $yhteys->prepare("INSERT INTO cart_item (cart_id, product_id, amount) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $cart_id, $product_id);
        $stmt->execute();
    }
    else {
        $rivi = $tulos->fetch_assoc();
        $uusi_maara = $rivi["amount"] + 1;
        $stmt = $yhteys->prepare("UPDATE cart_item SET amount = ? WHERE id = ?");
        $stmt->bind_param("ii", $uusi_maara, $rivi["id"]);
        $stmt->execute();
    }

    header("Content-Type: application/json");
    echo json_encode(["maara" => count($_SESSION["kori"])]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mun.css">
</head>
<body>
     <?php include 'nav.php';?>
 
    
</body>
</html>