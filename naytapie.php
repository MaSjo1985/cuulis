<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    if (isset($_POST[nayta])) {
        $db->query("update itseprojektit set edistymispie=1 where id='" . $_POST[id] . "'");
    } else if (isset($_POST[piilota]))
        $db->query("update itseprojektit set edistymispie=0 where id='" . $_POST[id] . "'");





    header('location: itsetyot.php?i=' . $_POST[id] . '#takas');
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