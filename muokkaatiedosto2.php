<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisää linkki </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';

    include("opnavi.php");

    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    $sisalto = $_POST[kuvaus];
    $sisalto = nl2br($sisalto);

    $db->query("update tiedostot set omatallennusnimi='" . $sisalto . "' where id = '" . $_POST[id] . "'");
    $db->query("update tiedostot set kuvaus='" . $_POST[osoite] . "' where id = '" . $_POST[id] . "'");





    header("location: tiedostot.php?k=" . $_POST[kaid]);


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
</html>	

