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
        include_once("yhteys.php");
        $sql = "SELECT name, category_id, description, prize FROM products";
        $tulos = $yhteys->query($sql);
    ?>
    <header class="kauppa">
        <img class=logo src="FAVICON.jpg" alt="eLogo">
        <a class="siiryost"href="ostoskori.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg></a>
        <a class="esk"href="etusivu.php">Etusivu</a>
    </header>
    <h2>Verkkokaupa</h2>
<!--Haku ja luokkat-->
    <form>
    <input type="text" id="nimi" name="nimi" placeholder="Etsi tuoteitta">
    <br><br>
    <input type="checkbox" id="kaikki" name="kaikki" value="kaikki">
    <label for="kaikki"> Kaikki</label><br>
    <input type="checkbox" id="L1" name="L1" value="liha">
    <label for="L1"> 1 Liha</label>
    <input type="checkbox" id="L2" name="L2" value="kala">
    <label for="L2"> 2 Kala</label>
    <input type="checkbox" id="L3" name="L3" value="viljatuotteet">
    <label for="L3"> 3 Viljatuotteet</label>
    <input type="checkbox" id="L4" name="L4" value="marjat">
    <label for="L4"> 4 Marjat</label>
    <input type="checkbox" id="L5" name="L5" value="juustot">
    <label for="L5"> 5 Juustot</label>
    <input type="checkbox" id="L6" name="L6" value="muut">
    <label for="L6"> 6 Muut tuoteet</label>
    </form>
    <table>
        <?php
            while ($rivi= $tulos->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo htmlspecialchars($rivi["name"]) ?></td>
            <td><?php echo htmlspecialchars($rivi["category_id"]) ?></td>
            <td><?php echo htmlspecialchars($rivi["description"]) ?></td>
            <td><?php echo htmlspecialchars($rivi["prize"]) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php $yhteys->close();?>
</body>
</html>