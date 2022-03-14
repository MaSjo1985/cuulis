<?php
session_start();
ob_start();

echo'<html> 
<head>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$result = $db->query("select distinct * from tiedostot where id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = $row[nimi];
        $omatallennusnimi = $row[omatallennusnimi];
        $tuotu = $row[tuotu];
        $kuvaus = $row[kuvaus];
        $linkki = $row[linkki];
    }

    if ($linkki == 0) {
        if (!$resultmuut = $db->query("select distinct * from tiedostot where id <> '" . $_GET[id] . "' AND nimi='" . $nimi . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($resultmuut->num_rows == 0) {

            if (file_exists($nimi)) {
                unlink($nimi);
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
exit();
}

echo "</div>";

include("footer.php");
?>

</body>
</html>