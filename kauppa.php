<?php include_once("yhteys.php"); ?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mun.css">
    <title>Kauppa</title>
</head>
<body>
    <?php
        $nimi = !empty($_GET["nimi"]) ? "%" . $_GET["nimi"] . "%" : "%";

        $valitut= [];
        if (!empty($_GET["L1"])) $valitut[]= 1;
        if (!empty($_GET["L2"])) $valitut[]= 2;
        if (!empty($_GET["L3"])) $valitut[]= 3;
        if (!empty($_GET["L4"])) $valitut[]= 4;
        if (!empty($_GET["L5"])) $valitut[]= 5;
        if (!empty($_GET["L6"])) $valitut[]= 6;

        $kategoria= (!empty($_GET["kaikki"]) || empty($valitut))
            ? "1,2,3,4,5,6": implode(",", $valitut);

        $sql = "SELECT name, category_id, description, prize FROM products WHERE name LIKE ? AND category_id IN ($kategoria)";
        $stmt = $yhteys->prepare($sql);
        $stmt -> bind_param("s", $nimi);
        $stmt -> execute();
        $tulos= $stmt->get_result();
    ?>
    <!--HEAD-->
    <header class="kauppa">
        <img class=logo src="FAVICON.jpg" alt="eLogo">
        <br>
        <a class="siiryost" href="ostoskori.php">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
            <span id="kori-maara"><?= isset($_SESSION["kori"]) ? count($_SESSION["kori"]) : 0 ?></span>
        </a>

        <a class="esk" href="etusivu.php">Etusivu</a>

    </header>
    <h2>Verkkokaupa</h2>
<!--Haku ja luokkat-->
    <form method="GET">
    <input type="text" id="nimi" name="nimi" placeholder="Etsi tuoteitta">
    <br><br>
    <input type="checkbox" id="kaikki" name="kaikki" value="kaikki"
        <?= !empty($_GET["kaikki"]) ? "checked" : "" ?>>
    <label for="kaikki"> Kaikki</label><br>
    <input type="checkbox" id="L1" name="L1" value="liha"
        <?= !empty($_GET["L1"]) ? "checked" : "" ?>>
    <label for="L1"> 1 Liha</label>
    <input type="checkbox" id="L2" name="L2" value="kala"
        <?= !empty($_GET["L2"]) ? "checked" : "" ?>>
    <label for="L2"> 2 Kala</label>
    <input type="checkbox" id="L3" name="L3" value="viljatuotteet"
        <?= !empty($_GET["L3"]) ? "checked" : "" ?>>
    <label for="L3"> 3 Viljatuotteet</label>
    <input type="checkbox" id="L4" name="L4" value="marjat"
        <?= !empty($_GET["L4"]) ? "checked" : "" ?>>
    <label for="L4"> 4 Marjat</label>
    <input type="checkbox" id="L5" name="L5" value="juustot"
        <?= !empty($_GET["L5"]) ? "checked" : "" ?>>
    <label for="L5"> 5 Juustot</label>
    <input type="checkbox" id="L6" name="L6" value="muut"
        <?= !empty($_GET["L6"]) ? "checked" : "" ?>>
    <label for="L6"> 6 Muut tuoteet</label>
    <br>
    <br>
    </form>
    <table>
        <?php
            while ($rivi= $tulos->fetch_assoc()):
        ?>
        <tr>
            <td><div class="nimi"><?php echo htmlspecialchars($rivi["name"]) ?></div></td>
            <td><div class="id"><?php echo htmlspecialchars($rivi["category_id"]) ?></div></td>
            <td><div class="tuote"><?php echo htmlspecialchars($rivi["description"]) ?></div></td>
            <td><div class="hinta"><?php echo htmlspecialchars($rivi["prize"]) ?>€</div></td>
        </tr>
        <td>
        <button class="lisaa-koriin" 
                data-nimi="<?= htmlspecialchars($rivi["name"]) ?>" 
                data-hinta="<?= htmlspecialchars($rivi["prize"]) ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M440-600v-120H320v-80h120v-120h80v120h120v80H520v120h-80ZM223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM40-800v-80h131l170 360h280l156-280h91L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68.5-39t-1.5-79l54-98-144-304H40Z"/></svg>
        </button>
        </td>
        <?php endwhile; ?>
    </table>

    <script>
        //chekboxit lähetää suoraan kun klikataan
        document.querySelectorAll("input[type=checkbox]").forEach(function(cb){
            cb.addEventListener("change", function(){
                document.querySelector("form"). submit();
            });
        });
        //hakukenttä lähetetään kun kirjoitetaan
        var viive;
        document.getElementById("nimi").addEventListener("input", function(){
            clearTimeout(viive);
            viive= setTimeout(function(){
            document.querySelector("form").submit();
        }, 600 );
        });

        //Ostoskorin vienti mappi
        document.querySelectorAll(".lisaa-koriin").forEach(function(nappi){
            nappi.addEventListener("click", function(){
                var nimi = this.dataset.nimi;
                var hinta = this.dataset.hinta;

                fetch("lisaa_koriin.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "nimi=" + encodeURIComponent(nimi) + "&hinta=" + encodeURIComponent(hinta)
                })
                .then(function(vastaus) {return vastaus.json();})
                .then(function(data){
                    //Päivitä korin tuotemäärä headerissa
                    document.getElementById("kori-maara").textContent = data.maara;
                });
            });
        });
    </script>

    <?php $yhteys->close();?>
</body>
</html>