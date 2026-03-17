<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="etusivu.css">
    <title>Etusivu</title>
</head>
<body>

<!--Logo ja nappi kaupaan-->
    <header class="eks">
            <img class=logo src="FAVICON.jpg" alt="eLogo">
            <button class="esk"><a href="siiry_kaupaan.php">Kauppaan</a></button>
    </header>
<!--Tervetuloviesti ja nappi-->
    <ul class="ept">
        <h1 class="eo">Tuoretta lähiruokaa suoraan kotiovellesi!</h1>
        <p class="es">Tuottajamarket - Kaupunkilaisille vaivatonta lähiruoan hankintaa.</p>
        <button class="etsk"><a href="siiry_kaupaan.php">Selaa tuotteitta</a></button>
<!--Kuinka se toimii teksti-->
        <div class="toiminta">
            <h2 class="tteksti">Kuinka se toimii</h2>
            <div class="ekarivi">
            <ul class="o1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                <h4>1. Rekisteröityminen</h4>
                <p>Aloita rekisteröitymällä Tuottajamarket-
                    <br>
                    verkkopalveluun omalla 
                    <br>
                    käyttäjätunnuksellasi ja salasanallasi.</p>
            </ul>
            <ul class="o2">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                <h4>2. Selaa tuotteita</h4>
                <p>Kirjauduttuasi sisään voit selata 
                    <br>
                    monipuolista valikoimaa laadukkaita ja 
                    <br>
                    lähellä tuotettuja tuotteita. Käy läpi eri 
                    <br>
                    tuotekategorioita ja tutustu tarjontaan.</p>
            </ul>
            <ul class="o3">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                <h4>3. Lisää ostoskoriin</h4>
                <p>Valittuasi haluamasi tuotteet voit lisätä ne 
                    <br>
                    ostoskoriin. Voit valita useita tuotteita eri 
                    <br>
                    kategorioista.</p>
            </ul>
            </div>
            <br><br>
            <div class="tokarivi">
            <ul class="o4">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M620-520q25 0 42.5-17.5T680-580q0-25-17.5-42.5T620-640q-25 0-42.5 17.5T560-580q0 25 17.5 42.5T620-520Zm-280 0q25 0 42.5-17.5T400-580q0-25-17.5-42.5T340-640q-25 0-42.5 17.5T280-580q0 25 17.5 42.5T340-520Zm263.5 221.5Q659-337 684-400h-66q-22 37-58.5 58.5T480-320q-43 0-79.5-21.5T342-400h-66q25 63 80.5 101.5T480-260q68 0 123.5-38.5ZM324-111.5Q251-143 197-197t-85.5-127Q80-397 80-480t31.5-156Q143-709 197-763t127-85.5Q397-880 480-880t156 31.5Q709-817 763-763t85.5 127Q880-563 880-480t-31.5 156Q817-251 763-197t-127 85.5Q563-80 480-80t-156-31.5ZM480-480Zm227 227q93-93 93-227t-93-227q-93-93-227-93t-227 93q-93 93-93 227t93 227q93 93 227 93t227-93Z"/></svg>
                <h4>4. Tarkista ostokset</h4>
                <p>Siirry ostoskoriin ja tarkista valintasi 
                    <br>
                    ennen tilauksen vahvistamista. Voit 
                    <br>
                    muuttaa määriä tai poistaa tuotteita 
                    <br>
                    tarvittaessa.</p>
            </ul>
            <br>
            <ul class="o5">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M720-120H280v-520l280-280 50 50q7 7 11.5 19t4.5 23v14l-44 174h258q32 0 56 24t24 56v80q0 7-2 15t-4 15L794-168q-9 20-30 34t-44 14Zm-360-80h360l120-280v-80H480l54-220-174 174v406Zm0-406v406-406Zm-80-34v80H160v360h120v80H80v-520h200Z"/></svg>
                <h4>5. Tilauksen vahvistus</h4>
                <p>Kun olet tyytyväinen ostoskoriisi, vahvista 
                    <br>
                    tilauksesi ja syötä tarvittavat 
                    <br>
                    toimitustiedot.</p>
            </ul>
            <br>
            <ul class="o6">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M160-80v-440H80v-240h208q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q23 0 43 8.5t37 23.5q17-16 37-24t43-8q50 0 85 35t35 85q0 11-2 20.5t-6 19.5h208v240h-80v440H160Zm371.5-748.5Q520-817 520-800t11.5 28.5Q543-760 560-760t28.5-11.5Q600-783 600-800t-11.5-28.5Q577-840 560-840t-28.5 11.5ZM360-800q0 17 11.5 28.5T400-760q17 0 28.5-11.5T440-800q0-17-11.5-28.5T400-840q-17 0-28.5 11.5T360-800ZM160-680v80h280v-80H160Zm280 520v-360H240v360h200Zm80 0h200v-360H520v360Zm280-440v-80H520v80h280Z"/></svg>
                <h4>6. Toimitus kotiovelle</h4>
                <p>Odota tuotteiden saapumista kotiovellesi. 
                    <br>
                    Tuottajamarket-verkkopalvelu toimittaa 
                    <br>
                    laadukkaat lähiruokatuotteet 
                    <br>
                    vaivattomasti sinulle.</p>
            </ul>
            </div>
            <br>
            <div class="o7">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg>
                <h4>7. Nauti lähiruoasta</h4>
                <p>Saapuneet tuotteet ovat nyt valmiita 
                    <br>
                    nautittavaksi. Nauti herkullisista ja 
                    <br>
                    laadukkaista lähiruoista omassa arjessasi!</p>
            </div>
    </ul>
<!--nimet jatiedot-->
    <footer class="tiedot">
        <br>
        <p>&copy; verkkokauppa 2026</p>
        <p>Josette Collin</p>
        <p>Omnia</p>
        <br>
    </footer>
</body>
</html>