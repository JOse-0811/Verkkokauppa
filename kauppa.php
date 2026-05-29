<?php
require_once 'yhteys.php';
session_start();




?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mun.css">
    <title>Kauppa</title>
</head>

<body>

    <?php include 'nav.php';?>
 
    <?php

        $nimi = !empty($_GET["nimi"]) ? "%" . $_GET["nimi"] . "%" : "%";

$valitut = [];
if (!empty($_GET["L1"])) $valitut[] = 1;
if (!empty($_GET["L2"])) $valitut[] = 2;
if (!empty($_GET["L3"])) $valitut[] = 3;
if (!empty($_GET["L4"])) $valitut[] = 4;
if (!empty($_GET["L5"])) $valitut[] = 5;
if (!empty($_GET["L6"])) $valitut[] = 6;

$kategoria = (!empty($_GET["kaikki"]) || empty($valitut))
    ? "1,2,3,4,5,6"
    : implode(",", $valitut);

        $sql = "SELECT name, category_id, description, prize FROM products WHERE name LIKE ? AND category_id IN ($kategoria)";
        $stmt = $yhteys->prepare($sql);
        $stmt -> bind_param("s", $nimi);
        $stmt -> execute();
        $tulos= $stmt->get_result();
    ?>


<h2>Verkkokauppa</h2>

<!-- HAKU -->
<form method="GET">

    <input type="text" id="nimi" name="nimi" placeholder="Etsi tuotteita">

    <br><br>

    <input type="checkbox" id="kaikki" name="kaikki" value="kaikki"
        <?= !empty($_GET["kaikki"]) ? "checked" : "" ?>>
    <label for="kaikki">Kaikki</label>

    <input type="checkbox" id="L1" name="L1"
        <?= !empty($_GET["L1"]) ? "checked" : "" ?>>
    <label for="L1">Liha</label>

    <input type="checkbox" id="L2" name="L2"
        <?= !empty($_GET["L2"]) ? "checked" : "" ?>>
    <label for="L2">Kala</label>

    <input type="checkbox" id="L3" name="L3"
        <?= !empty($_GET["L3"]) ? "checked" : "" ?>>
    <label for="L3">Vilja</label>

    <input type="checkbox" id="L4" name="L4"
        <?= !empty($_GET["L4"]) ? "checked" : "" ?>>
    <label for="L4">Marjat</label>

    <input type="checkbox" id="L5" name="L5"
        <?= !empty($_GET["L5"]) ? "checked" : "" ?>>
    <label for="L5">Juustot</label>

    <input type="checkbox" id="L6" name="L6"
        <?= !empty($_GET["L6"]) ? "checked" : "" ?>>
    <label for="L6">Muut</label>

</form>

<!-- TUOTTEET GRID -->
<div class="tuotteet-grid">

<?php while ($rivi = $tulos->fetch_assoc()): ?>

    <div class="tuote-kortti">

        <div class="nimi">
            <?= htmlspecialchars($rivi["name"]) ?>
        </div>

        <div class="tuote">
            <?= htmlspecialchars($rivi["description"]) ?>
        </div>

        <div class="hinta">
            <?= htmlspecialchars($rivi["prize"]) ?> €
        </div>

        <button class="lisaa-koriin"
            data-nimi="<?= htmlspecialchars($rivi["name"]) ?>"
            data-hinta="<?= htmlspecialchars($rivi["prize"]) ?>">
            Lisää koriin
        </button>

    </div>

<?php endwhile; ?>

</div>

<!-- SCRIPTIT -->
<script>

// checkbox submit
document.querySelectorAll("input[type=checkbox]").forEach(cb => {
    cb.addEventListener("change", () => {
        document.querySelector("form").submit();
    });
});

// haku viiveellä
let viive;
document.getElementById("nimi").addEventListener("input", function () {
    clearTimeout(viive);
    viive = setTimeout(() => {
        document.querySelector("form").submit();
    }, 600);
});

// lisää koriin
document.querySelectorAll(".lisaa-koriin").forEach(nappi => {
    nappi.addEventListener("click", function () {

        const nimi = this.dataset.nimi;
        const hinta = this.dataset.hinta;

        fetch("lisaa_koriin.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "nimi=" + encodeURIComponent(nimi) +
                  "&hinta=" + encodeURIComponent(hinta)
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById("kori-maara").textContent = data.maara;
        });

    });
});

</script>

<?php $yhteys->close(); ?>

<!-- FOOTER -->
<footer class="tiedot">
    <p>&copy; Verkkokauppa 2026</p>
    <p>Josette Collin & Jheel Kumari</p>
    <p>Omnia</p>
</footer>

</body>
</html>