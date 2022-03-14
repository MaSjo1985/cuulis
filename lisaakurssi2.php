<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisääkurssi/opintojakso</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';
    if ($_SESSION["Rooli"] == 'opettaja') {
        include("opnavi.php");
    }
    if ($_SESSION["Rooli"] == 'opeadmin') {
        include("opeadminnavi.php");
    }

    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"><br></div>';

    if ($_GET["muut"] == "ei") {


        echo '<b style="color: #e608b8;">Kurssin lisäys onnistui!</b>';
        echo '<br><br><a href="omatkurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa Omat kurssit/opintojaksot-osioon</a>';
    } else {


          echo '<b style="color: #e608b8;">Kurssin lisäys onnistui!</b>';
        echo '<br><br><a href="omatkurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa Omat kurssit/opintojaksot-osioon</a>';
    }

    echo'</div> ';
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

