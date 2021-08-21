<?php

include("yhteys.php");

if (!$RTsuljettu = $db->query("select distinct sulkeutuu from kyselyt where kurssi_id=219")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($RTs = $RTsuljettu->fetch_assoc()) {

    $w = $RTs[sulkeutuu];
}

if ($w == NULL) {
    echo'nuaaaaaaaaaall';
} else if ($w == ' ') {
    echo'tyhjä';
} else if (empty($w)) {
    echo'empty';
} else {
    echo'ei kumpikaan';
}

