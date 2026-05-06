<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mun.css">
    <title>Kirjaudu</title>
</head>
<body class= "kirjaudu">
    <?php
        include_once("yhteys.php");
    ?>
    <header class="eks">
        <img class=logo src="FAVICON.jpg" alt="eLogo">
        <button class="rekisteri"><a href="rekisteri.php">Rekisteri</a></button>
        <button class="esk"><a href="etusivu.php">Etusivu</a></button>
    </header>
        <h2>Kirjaudu sisään</h2>
<!--kentät-->
    <form  method="post">
    <input type="text" id="kaytaja" name="kaytaja" placeholder="Käytäjätunnus" required><br><br>
    <input type="password" id="salasana" name="salasana" placeholder="salasana" required><br><br>
    <button type="submit" name="kirjaudu">Kirjaudu</button>
    </form>
    <?php

    if(isset($_POST['kirjaudu'])){
        $kaytanimi= $_POST['kaytaja'];
        $salasana= $_POST['salasana'];
        //kumpikaan kentistä ei saa olla tyhjiä
        if(empty($kaytanimi) || empty($salasana)){
            echo "<p class= 'virhe'>Täytä kaikki kentät</p>";
        }
        //Hakee käytäjää käytäjätunnuksella
        else{
            $stmt= $yhteys->prepare("SELECT salasana, rooli FROM kayttaja WHERE käyttäjätunnus = ?");
            $stmt->bind_param("s", $kaytanimi);
            $stmt->execute();
            $tulos = $stmt->get_result();
            /*Tarkistetaan salasana*/
            if($tulos -> num_rows === 1){
                $rivi =$tulos->fetch_assoc();

                if(password_verify($salasana, $rivi['salasana'])){

                    /*Kirjautuminen onnistuu*/
                    $_SESSION['kaytajanimi'] = $kaytanimi;
                    $_SESSION['rooli'] = $rivi['rooli'];

                    header("Location: etusivu.php");
                    exit;
                }
                else{
                    echo "<p class= 'virhe'>Väärä salasana</p>";
                }
            }
            else{
                echo "<p class= 'virhe'>Käytäjää ei löydy</p>";
            }
        }
    }
    $yhteys-> close();

    ?>
</body>
</html>