<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Salasana vaihdettu </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


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


    if(!isset($_GET[url])){
         echo('<br><b style="color: #c7ef00;">Salasanasi on vaihdettu!</b> <br><br><a href="omattiedot.php?id=' . $_SESSION["Id"] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>');

    }
    else{
        echo'<br><b style="color: #c7ef00;">Salasanasi on vaihdettu!</b><br><br><a href="kirjautuminen2.php?url='.$_GET[url].'">Jatka Cuulis-oppimisympäristöön  tästä &nbsp&nbsp<p style="font-size: 1.2em; display: inline-block; padding:0; margin: 0">&#8631</p></b> </a>';
 
           
    }

   

    echo'</div>';

    echo'</div>';
    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>
</body>
</html>		
