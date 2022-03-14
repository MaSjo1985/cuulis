<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    $kuvaus = $_POST[kuvaus];
    $kuvaus = nl2br($kuvaus);

    $stmt = $db->prepare("UPDATE projektit SET kuvaus=? WHERE id=?");
    $stmt->bind_param("si", $ilmoitus, $id);
    $ilmoitus = $kuvaus;
    $id = $_POST[id];
    $stmt->execute();
    $stmt->close();



    header("location: ryhmatyot.php?r=" . $_POST[id]);
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

