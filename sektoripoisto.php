<?php
session_start();

ob_start();



include("yhteys.php");
// poistaa kaikki sektorikuvat
if (!$haekurssit = $db->query("select distinct id from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rivik = $haekurssit->fetch_assoc()) {
    $kid = $rivik[id];


    if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id = '" . $kid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rivi = $haeopiskelijat->fetch_assoc()) {
        $id = $rivi[opiskelija_id];



        $pienimi = 'images/sektori' . $id . '.png';
        if (file_exists($pienimi)) {
            unlink($pienimi);
        }
    }
}
?>