<?php
ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    $db->query("update projektit set palautus_suljettu=1 where id='" . $_POST[pid] . "'");





    header("location: ryhmatyot.php?r=" . $_POST[pid]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	