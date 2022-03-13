<?php
session_start(); 



ob_start();



include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


$pid = $_REQUEST['r'];

if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($RTs = $RTsuljettu->fetch_assoc()) {
    $suljettu = $RTs[palautus_suljettu];
    $sulkeutuu = $RTs[palautus_sulkeutuu];
}
$ryhma = false;
if (!$haeryhma = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND opiskelija_id='" . $_SESSION["Id"] . "' AND ryhma_id<>0")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($haeryhma->num_rows > 0) {
    $ryhma = true;
    while ($rowryhma = $haeryhma->fetch_assoc()) {
        $opryhmaid = $rowryhma[ryhma_id];
    }
}

if (!empty($sulkeutuu) && $sulkeutuu != ' ') {

    $nyt = date("Y-m-d H:i");
    $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
    $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
    $sulkeutumiskello = substr($sulkeutuu, 11, 5);

    $takaraja = $sulkeutuu;


    $takarajaon = 1;
}

if (($suljettu == 0 && $takarajaon == 0) || ($takarajaon == 1 && $nyt < $takaraja && $suljettu == 0)) {



    if ($takarajaon == 1) {
        echo'<br>Kurssitöiden palautuksen takaraja on <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
    }
    if ($ryhma) {

        echo'<br><br><form action="tiedosto.php" method="post"><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Palauta uusi työ" style="margin-right: 30px; padding: 2px"></form>';
    } else {

        echo'<br><br>Voit tehdä palautuksen vasta, kun olet liittynyt johonkin ryhmään.<br><br>';
    }
} else if ($suljettu == 1 || ($takarajaon == 1 && ($nyt >= $takaraja))) {
    if ($suljettu == 1) {
        echo'<p><em>Kurssitöiden palautusmahdollisuus on suljettu.</em></p>';
    } else if (($takarajaon == 1 && ($nyt >= $takaraja))) {

        echo'<br><b style="color:#e608b8"> Kurssitöiden palautuksen takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
        echo'<p>Voit silti palauttaa työn, mutta siihen tulee merkintä myöhästymisestä.</p>';
        echo'<br><form action="tiedosto.php" method="post"><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Palauta uusi työ" style="margin-right: 30px; padding: 2px"></form>';
    }
}
?>