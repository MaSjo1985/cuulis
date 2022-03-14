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
    $db->query("update linkit set kuvaus='" . $sisalto . "' where id = '" . $_POST[id] . "'");
    $db->query("update linkit set osoite='" . $_POST[osoite] . "' where id = '" . $_POST[id] . "'");



    header("location: linkit.php");


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

