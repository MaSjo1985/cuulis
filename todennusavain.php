<?php
session_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>
<title> Onnistunut kirjautuminen </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7" style="padding-left: 40px; padding-top: 40px">';




    echo "<b>Kirjautuminen kurssille/opintojaksolle onnistui!</b>";

    echo '<br><br><a href="kurssi.php?id=' . $_SESSION[KurssiId] . '">Jatka kurssin/opintojakson sivulle tästä <p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8631</p> </a>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
echo '</div>';
echo '</div>';

include("footer.php");
?>
</body>
