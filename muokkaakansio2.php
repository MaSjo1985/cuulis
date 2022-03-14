<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    $nimi = $_POST[nimi];
    $nimi = nl2br($nimi);
    $stmt = $db->prepare("UPDATE kansiot SET nimi=? WHERE id=?");
    $stmt->bind_param("si", $nimi2, $id);
    // prepare and bind

    $nimi2 = $nimi;
    $id = $_POST[id];
    $stmt->execute();
    $stmt->close();



    header('location: tiedostot.php?k=' . $_POST[id]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>		
</html>	

