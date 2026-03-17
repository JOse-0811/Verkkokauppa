<?php
    session_start();

    if(!isset($_SESSION['tunniste'])){
        $_SESSION['tunniste'] = bin2hex(random_bytes(15));
    }

    header('Location: kauppa.php');
    exit();
?>