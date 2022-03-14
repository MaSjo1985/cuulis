<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Profiilikuvan lisäys</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';
    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else
        include ("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    require_once("kuvaupload.php");

    try {
        $nimi = upload_tarkista("uusikuva", 5.0 * 1024 * 1024);
    } catch (UploadException $e) {

        die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href=href="muokkaakayttaja.php?url=' . $url . '&id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if (!$result = $db->query("select distinct * from kayttajat where id = '" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = $row[omakuva];
    }



    if (file_exists($nimi)) {
        unlink($nimi);
    }


    try {
        list($vanha, $nimi) = upload_tallenna_turvallinen("uusikuva", "images", array(".jpg", ".gif", ".png", ".jpeg", ".JPG", ".GIF", ".PNG", ".JPEG"));
    } catch (UploadException $e) {

        die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href=href="muokkaakayttaja.php?url=' . $url . '&id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }





    $db->query("update kayttajat set omakuva='" . $nimi . "' where id = '" . $_POST["id"] . "'");


    header("location: lisaaomakuva2k2.php?id=" . $_POST[id]);

    echo'</div>';
    echo'</div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>			
