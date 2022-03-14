<?php
session_start();
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Poistu oppimisympäristöstä</title>';


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

    echo '<p style="font-weight: bold; font-size: 1.2em" >Haluatko todella poistua kokonaan Cuulis-oppimisympäristöstä?</p>';
    echo '<p style="font-weight: bold; color: #e608b8" >Tämän jälkeen kaikki tietosi poistuvat oppimisympäristöstä!</p>';

    echo '<br><br><a href="poistu.php" class="myButton9"  role="button"  style="margin-right: 30px">Kyllä</a>';
    echo '<a href="omattiedot.php" class="myButton9"  role="button" >En</a><br>';


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

