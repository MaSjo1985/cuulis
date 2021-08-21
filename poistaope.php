<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Osallistujat </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {




    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';

    if ($_POST["valinta"] == "ei")
        header("location: osallistujat.php");

    else {




        $db->query("delete from opiskelijankurssit where opiskelija_id = '" . $_POST[id] . "' AND kurssi_id='" . $_SESSION[KurssiId] . "'");


        header("location: osallistujat.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}

echo "</div>";

include("footer.php");
?>

</body>
</html>			