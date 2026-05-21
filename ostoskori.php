<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tarkistetaan onko kaverin luomassa "kori"-istunnossa tuotteita.
$ostoskori_on_tyhja = (!isset($_SESSION["kori"]) || count($_SESSION["kori"]) == 0);
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mun.css">
    <title>Ostoskori</title>
</head>
<body>

    <header class="kauppa">
        <img class="logo" src="FAVICON.jpg" alt="eLogo">
        <br>
        <a class="esk" href="kauppa.php">Takaisin kauppaan</a>
    </header>

    <main class="kori-sisalto">
        <h2>Ostoskori</h2>

        <?php if ($ostoskori_on_tyhja): ?>
            <div class="kori-laatikko tyhja-keskitys">
                <p>Pahoittelemme, mutta ostoskorisi on tällä hetkellä tyhjä.</p>
                <p>Jatka ostosten tekemistä lisätäksesi tuotteita ostoskoriin.</p>
                <br>
                <a href="kauppa.php" class="kori-nappi">← Selaa tuotteita</a>
            </div>

        <?php else: ?>
            <div class="kori-rakenne">
                
                <div class="kori-tuotteet">
                    <?php 
                    $yhteishinta = 0;
                    foreach ($_SESSION["kori"] as $tuote): 
                        $hinta_numero = (float)str_replace('€', '', $tuote['hinta']);
                        $yhteishinta += $hinta_numero;
                    ?>
                        <div class="kori-tuote-rivi">
                            <div class="kori-tuote-info">
                                <strong><?php echo htmlspecialchars($tuote['nimi']); ?></strong><br>
                                <small style="color: #666;">Tuote</small>
                            </div>
                            <div class="kori-tuote-maara">
                                <input type="number" value="1" min="0" class="maara-kentta">
                            </div>
                            <div class="kori-tuote-hinta"><strong><?php echo htmlspecialchars($tuote['hinta']); ?>€</strong></div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="kori-alaosa">
                        <a href="kauppa.php" style="color: black; font-weight: bold;">← Takaisin kauppaan</a>
                        <div class="kori-loppusumma">Yhteensä: <strong><?php echo $yhteishinta; ?>€</strong></div>
                    </div>
                </div>

                <div class="kori-laatikko kori-lomake">
                    <h3>Tilaustiedot</h3>
                    <form action="tilaus.php" method="POST">
                        <input type="text" name="nimi" placeholder="Nimi" required>
                        <input type="email" name="sahkoposti" placeholder="Sähköpostiosoite" required>
                        <input type="tel" name="puhelinnumero" placeholder="Puhelinnumero" required>
                        
                        <button type="submit" name="tee_tilaus" class="kori-nappi">Tee tilaus »</button>
                    </form>
                </div>

            </div>
        <?php endif; ?>
    </main>

    <footer class="tiedot">
        <p>© TAITAJA 2024</p>
        <p>Etu Sukunimi<br>Oppilaitos</p>
    </footer>

</body>
</html>