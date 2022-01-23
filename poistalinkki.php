<?php
ob_start();

echo'<html> 
<head>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {



    $db->query("delete from linkit where id = '" . $_GET[id] . "'");
    header("location: linkit.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}

echo "</div>";

include("footer.php");
?>

</body>
</html>