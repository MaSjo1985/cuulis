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

    $stmt = $db->prepare("UPDATE ryhmat2 SET palaute_tallennettu = ? WHERE id = ?");
    $stmt->bind_param("ii", $tall, $id4);

    $tall = 0;

    $id4 = $_POST[tyoid];

    $stmt->execute();


    $stmt->close();

    header("location: ryhmatyot.php?r=" . $_POST[pid] . "#" . $id4);
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