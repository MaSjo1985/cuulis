<?php
session_start(); 


ob_start();

echo'
<html>
 
<head>

<title> Muokkaa tietoja </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {
    $db->query("update kurssit set koodi='" . $_POST[uusikoodi] . "' where id = '" . $_POST[id] . "'");
    header('location: muokkaakurssi.php?id=' . $_POST[id]);
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