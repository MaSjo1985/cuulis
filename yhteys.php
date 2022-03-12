<?php
session_start();

$db = @mysqli_connect('mysql1.shellit.org', 'u38085', 'Mariann3', 'u38085B1');

if (!$db)
    die('<br><br><b style="font-size: 1.2em">Tietokantayhteydessä ongelmia. Vikaa korjataan. Yritä myöhemmin uudelleen.</b>');
else
    mysqli_set_charset($db, "utf8");
?>
