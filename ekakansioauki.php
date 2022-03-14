<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    if ($_POST[auki] == 1) {
        $db->query("update kurssit set ekakansio=1 where id='" . $_SESSION[KurssiId] . "'");
    } else if ($_POST[auki] == 0) {
        $db->query("update kurssit set ekakansio=0 where id='" . $_SESSION[KurssiId] . "'");
    }







    header("location: tiedostot.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	