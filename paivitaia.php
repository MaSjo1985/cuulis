<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (!$haekurssit = $db->query("select distinct id from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rivi1 = $haekurssit->fetch_assoc()) {
    $kurssi_id = $rivi1[id];

    if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $kurssi_id . "' AND projekti_id=0 AND itseprojekti_id=0")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rivi2 = $haeopiskelijat->fetch_assoc()) {
        if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $kurssi_id . "' AND aihe=0 AND valiaihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rivi3 = $haearvioinnit->fetch_assoc()) {
            if (!$haekp = $db->query("select distinct * from itsearvioinnitkp where kayttaja_id='" . $rivi2[opiskelija_id] . "' AND itsearvioinnit_id='" . $rivi3[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haekp->num_rows == 0) {
                $db->query("insert into itsearvioinnitkp (itsearvioinnit_id, kayttaja_id) values('" . $rivi3[id] . "', '" . $rivi2[opiskelija_id] . "')");
            }
        }
    }
}
?>

