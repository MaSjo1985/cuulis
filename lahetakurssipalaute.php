<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Kurssipalaute </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if ($_POST[viesti] != "") {
        $sisalto = $_POST[viesti];
        $sisalto = nl2br($sisalto);
        $stmt = $db->prepare("INSERT INTO palautteet (kurssi_id, kayttaja_id, sisalto) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $kurssi, $kayttaja, $sisalto2);
        // prepare and bind
        $kurssi = $_SESSION["KurssiId"];
        $kayttaja = $_SESSION["Id"];
        $sisalto2 = $sisalto;

        $stmt->execute();
        $stmt->close();

        header("location: vahvistus_palaute.php");
    } else {
        header('location: kurssi.php?id=' . $_SESSION["KurssiId"]);
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";

include("footer.php");
?>

</body>
</html>	