<?php
session_start();

$db = @mysqli_connect('mysql1.shellit.org', 'u38085', 'Mariann3', 'u38085B2');

if (!$db)
    die('<br><br><b style="font-size: 1.2em">Tietokantayhteydessä ongelmia. Yritä myöhemmin uudelleen!</b>');
else
    mysqli_set_charset($db, "utf8");
?>
