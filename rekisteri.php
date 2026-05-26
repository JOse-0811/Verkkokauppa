<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mun.css">
    <title>Rekisteri</title>
</head>
<body>
    <?php
        include_once("yhteys.php");
    ?>
    <header class="eks">
        <img class=logo src="FAVICON.jpg" alt="eLogo">
        <a class="esk"href="kirjaudu.php">Kirjaudu</a>
        <a class="esk" href="etusivu.php">Etusivu</a>
    </header>
    
    	<h2>Rekistöröidy jotta voit tilata!</h2>
<!--laatikot -->
    <form method="post">
        <input type="text" id="kaytaja" name="kaytaja" placeholder="Käytäjätunnus"><br><br>
        <input type="text" id="sahkoposti" name="sahkoposti" placeholder="sähköposti"><br><br>
        <input type="password" id="salasana" name="salasana" placeholder="salasana"><br><br>
        <button type="submit" name="rekisteri">rekistöröidy</button>
    </form>
    <br>
    <p>Rekisteröityessäsi verkkokaupaan käyttäjäksi hyväksyt henkilötietojesi käsitelyehdot.</p>
    <p>Lue täältä <a href="tietosuoja.php">Tuottajamarket tietosuojaseloste</a>.</p>

    <?php
    if(isset($_POST["rekisteri"])){
        $kautajanimi= $_POST['kaytaja'];
        $salasana= $_POST['salasana'];
        $sahkoposti= $_POST['sahkoposti'];
        // Salasana hashataan (Eri hash joka kerta)
        $salattu= password_hash($salasana, PASSWORD_DEFAULT);

        // Tarkistaa onko kaikki kentät täytetty
        if(empty($kautajanimi) || empty($salasana) || empty($sahkoposti)){
            echo "<p class='virhe'>Täyttä kaikki kentät</p>";
        }
        // Tarkistaa onko käytäjä jo olemassa
        else{
            $haku= "SELECT * FROM kayttaja WHERE email = '$sahkoposti'";
            $tulos= $yhteys -> query($haku);

            if($tulos -> num_rows > 0){
                echo "<p class='virhe'>Käyttäjä on jo olemassa</p>";
            }
            // Tallentaa käyttäjän
            else{
                $lisays= "INSERT INTO kayttaja (käyttäjätunnus, salasana, rooli, email) VALUES ('$kautajanimi', '$salattu', '0', '$sahkoposti')";
                $tulos= $yhteys -> query($lisays);

                if($tulos == TRUE){
                    echo "<p class='onnistu'>Rekisteröinti onnistui</p>";
                }
                else{
                    echo "<p class='virhe'>Rekistöröinti epä onnistui</p>";
                }
            }
        }

    }
        $yhteys-> close();
    ?>
</body>
</html>