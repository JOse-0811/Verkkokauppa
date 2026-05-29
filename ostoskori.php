<?php
require_once 'yhteys.php';
session_start();
 
// Pakotetaan käyttäjä kirjautumaan, jos istuntoa ei löydy

?>
<?php 

// 2. OTETAAN TIETOKANTAYHTEYS KÄYTTÖÖN
include_once("yhteys.php");

// Muuttuja, jolla seurataan onko tilaus tehty onnistuneesti
$tilaus_tehty = false;

// 3. MÄÄRÄN PÄIVITYS (Kun käyttäjä muuttaa tuotteen määrää nuolilla)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paivita_maara'])) {
    $tuote_id = $_POST['tuote_id'];
    $uusi_maara = (int)$_POST['maara'];
    
    if ($uusi_maara <= 0) {
        unset($_SESSION["kori"][$tuote_id]); 
    } else {
        $_SESSION["kori"][$tuote_id]['maara'] = $uusi_maara;
    }
    header("Location: ostoskori.php");
    exit;
}

// 4. TILAUKSEN TALLENNUS TIETOKANTAAN (Kun painetaan "Tee tilaus")
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tee_tilaus'])) {
    
    // Otetaan lomakkeen tiedot talteen muuttujiin
    $nimi = $_POST['nimi'];
    $sahkoposti = $_POST['sahkoposti'];
    $puhelin = $_POST['puhelinnumero'];
    
    // Luodaan istuntotunniste (session id), kuten tietokantarakenne vaatii
    $session_id = session_id();

    // TALLENNETAAN TILAUS TILAUSTAULUUN (Mukaan NOW() eli päivämäärä automaattisesti!)
    // Huom: käytä tässä oman projektisi mukaista yhteysmuuttujaa (esim. $yhteys tai $conn)
    $sql = "INSERT INTO orders (session, name, email, phone, datetime) 
            VALUES ('$session_id', '$nimi', '$sahkoposti', '$puhelin', NOW())";
    
    if (mysqli_query($yhteys, $sql)) {
        
        // Tilaus onnistui -> tyhjennetään ostoskori sessiosta, kuten ohje vaatii
        unset($_SESSION["kori"]);
        
        // Merkataan tilaus tehdyksi, jotta osataan näyttää kiitos-viesti
        $tilaus_tehty = true;
        
    } else {
        echo "Virhe tilauksen tallennuksessa: " . mysqli_error($yhteys);
    }
}

// Tarkistetaan onko kori tyhjä (tätä käytetään näyttämään oikea näkymä)
$ostoskori_on_tyhja = empty($_SESSION["kori"]);
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
        <a class="esk" href="kauppa.php">Takaisin kauppaan</a>
    </header>

    <main class="kori-sisalto">
        <h2>Ostoskori</h2>

        <?php if ($tilaus_tehty): ?>
            <div class="tyhja-keskitys">
                <h3>Kiitos tilauksesta!</h3>
                <p>Tilauksesi on vastaanotettu ja se tallennettiin tietokantaan.</p>
                <br>
                <a href="kauppa.php" class="kori-nappi">← Tee uusi tilaus</a>
            </div>

        <?php elseif ($ostoskori_on_tyhja): ?>
            <div class="tyhja-keskitys">
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
                    foreach ($_SESSION["kori"] as $index => $tuote): 
                        $maara = isset($tuote['maara']) ? (int)$tuote['maara'] : 1;
                        $hinta_numero = (float)str_replace('€', '', $tuote['hinta']);
                        $rivin_kokonaishinta = $hinta_numero * $maara;
                        $yhteishinta += $rivin_kokonaishinta;
                    ?>
                        <div class="kori-tuote-rivi">
                            <div class="kori-tuote-info">
                                <strong><?php echo htmlspecialchars($tuote['nimi']); ?></strong><br>
                                <small>Tuote</small>
                            </div>
                            
                            <div class="kori-tuote-maara">
                                <form method="POST" action="ostoskori.php" style="margin:0;">
                                    <input type="hidden" name="tuote_id" value="<?php echo $index; ?>">
                                    <input type="hidden" name="paivita_maara" value="1">
                                    <input type="number" name="maara" value="<?php echo $maara; ?>" min="0" class="maara-kentta" onchange="this.form.submit()">
                                </form>
                            </div>
                            
                            <div class="kori-tuote-hinta">
                                <?php echo number_format($rivin_kokonaishinta, 2, ',', ' '); ?>€
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="kori-alaosa">
                        <a href="kauppa.php">← Takaisin kauppaan</a>
                        <div class="kori-loppusumma">Yhteensä: <strong><?php echo number_format($yhteishinta, 2, ',', ' '); ?>€</strong></div>
                    </div>
                </div>

                <div class="kori-lomake">
                    <h3>Tilaustiedot</h3>
                    <form action="ostoskori.php" method="POST">
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
        <p>&copy; Verkkokauppa 2026</p>
        <p>Josette Collin & Jheel Kumari</p>
        <p>Omnia</p>
    </footer>
 
</body>
</html>