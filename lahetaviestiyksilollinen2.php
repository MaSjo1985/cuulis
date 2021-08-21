<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Viestin lähetys </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    include("header.php");

    echo'</div>';
    echo '<div class="cm8-container7"  style="padding-left: 40px; padding-top:20px;" >';
    echo'<div class="cm8-margin-top"></div>';





    echo '<p style="font-weight: bold">Viestisi on lähetetty!</p>';

    echo '<a href="' . $_GET[url] . '"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';



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
</html>	