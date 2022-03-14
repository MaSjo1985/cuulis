<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    $sisalto = $_POST[viesti];
    $sisalto = nl2br($sisalto);

    $stmt = $db->prepare("UPDATE opiskelijankurssit SET tavoite = ? WHERE kurssi_id = ? AND opiskelija_id = ?");
    $stmt->bind_param("sii", $sisalto2, $kurssi, $kayttaja);
    // prepare and bind
    $sisalto2 = $sisalto;
    $kurssi = $_SESSION["KurssiId"];
    $kayttaja = $_SESSION["Id"];


    $stmt->execute();
    $stmt->close();

    header("location: kurssi.php?id=$_SESSION[KurssiId]");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo '</div>';

include("footer.php");
?>

</body>
</html>