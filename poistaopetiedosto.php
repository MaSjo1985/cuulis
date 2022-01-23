<?php
ob_start();

echo'<html> 
<head>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$result = $db->query("select distinct * from tiedostot where id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = $row[nimi];
         $omatallennusnimi = $row[omatallennusnimi];
        $tuotu = $row[tuotu];
        $kuvaus = $row[kuvaus];
        $linkki = $row[linkki];
    }

    $tiedostonimi = 'tiedostot/'.$omatallennusnimi;
    if ($tuotu == 0 && $linkki == 0) {
        if (file_exists($tiedostonimi)) {
            unlink($tiedostonimi);
        }
    }
    if (!$result8 = $db->query("select distinct * from tiedostot where id = '" . $_GET[id] . "' AND tuotu=0")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //jos tiedostoa ei ole tuotu toisesta kurssista/opintojaksosta, niin haetaan onko se viety johonki toiseen, jolloin se pitää poistaa myös siitä kurssista/opintojaksosta JOS SE ON TIEDOSTO EIKÄ LINKKI

    if ($result8->num_rows > 0) {
        if ($linkki == 0) {
            if (!$result2 = $db->query("select distinct * from tiedostot where nimi = '" . $nimi . "' AND tuotu=1 AND linkki=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $db->query("delete from tiedostot where id = '" . $row2[id] . "'");
                }
            }
        }
    }


    $db->query("delete from tiedostot where id = '" . $_GET[id] . "'");


    header("location: tiedostot.php?k=" . $_GET[kaid]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}

echo "</div>";

include("footer.php");
?>

</body>
</html>