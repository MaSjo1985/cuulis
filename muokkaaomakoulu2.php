<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa tietoja </title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';

    include("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';




    if ($_SESSION["Rooli"] == "opiskelija") {



        echo "<br><b>Oppilaitokseen liittyminen onnistui!</b>";
    } else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opeadmin") {


        echo "<br><b>Saat vahvistusviestin sähköpostiisi, kun oppilaitoksen ylläpitäjä on hyväksynyt liittymisesi kyseiseen oppilaitokseen.</b>";
    }


    echo'<br><br><a href="omattiedot.php?id=' . $_SESSION["Id"] . '" > <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';


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
