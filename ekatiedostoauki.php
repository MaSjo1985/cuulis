<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    if ($_POST[auki] == 1) {
        $db->query("update kansiot set ekakansio=1 where id='" . $_POST[kansio] . "'");
    } else if ($_POST[auki] == 0) {
        $db->query("update kansiot set ekakansio=0 where id='" . $_POST[kansio] . "'");
    }







    header("location: tiedostot.php?k=" . $_POST[kansio]);
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