<?php
session_start(); 


ob_start();

echo'
<html>
 
<head>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {

// header("Content-Type: text/plain");
// ini_set("error_reporting", E_ALL | E_STRICT);
// ini_set("display_errors", 1);
// Otetaan funktiot mukaan.
    require_once("upload.php");


    $db->query("insert into tiedostot (kurssi_id, kuvaus) values('" . $_SESSION["KurssiId"] . "', '" . $_POST[kuvaus] . "')");

    // Esimerkki: Tarkistetaan, että tiedosto on lähetetty ja että se on kooltaan
    // enintään 5,0 megatavua. Käsitellään myös virheilmoitus.

    try {
        $nimi = upload_tarkista("tiedosto", 5.0 * 1024 * 1024);
    } catch (UploadException $e) {

        die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="tiedostot.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    // echo("Tarkistus onnistui. Tiedoston nimeksi ilmoitettiin {$nimi}.\n");
    // Esimerkki: Tarkistetaan tiedoston pääte ja yritetään tallentaa se palvelimelle.
    // Funktion toinen parametri on tallennushakemisto, "." tarkoittaa tätä hakemistoa.
    // HUOMIO! Virhettä ei tässä erikseen käsitellä.
    try {
        list($vanha, $nimi) = upload_tallenna_turvallinen("tiedosto", "tiedostot", array(".txt", ".pdf", ".rar", ".zip", ".tns", ".tnsp", ".odt", ".ods", ".doc", ".docx", ".rtf", ".dat", ".pptx", ".ppt", ".xls", ".xlsx", ".TXT", ".PDF", ".DOC", ".DOCX", ".RTF", ".DAT", ".PPTX", ".PPT", ".XLS", ".XLSX"));
    } catch (UploadException $e) {

        die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="tiedostot.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if (!$haetiedostot = $db->query("select distinct * from tiedostot where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowt = $haetiedostot->fetch_assoc()) {
        $id = $rowt[id];
    }


    $db->query("update tiedostot set nimi='" . $nimi . "' where id = '" . $id . "'");
    $db->query("update tiedostot set omatallennusnimi='" . $vanha . "' where id = '" . $id . "'");

    header("location: tiedostot.php#link1");
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
