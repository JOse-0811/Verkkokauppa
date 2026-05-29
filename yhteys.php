<?php

    $palvelin = 'localhost';
    $käyttäjä = 'root';
    $salasana = '';
    $tietokanta = 'verkkokauppa2';

    $yhteys = new mysqli($palvelin, $käyttäjä, $salasana, $tietokanta);
    if ($yhteys -> connect_error) {
        die('Yhteyden mudostaminen epäonnistui; ');
    };
    $yhteys -> set_charset('utf8');
    ?>