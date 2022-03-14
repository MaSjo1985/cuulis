<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisää linkki </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    echo'<div class="cm8-container7">';

    $stmt = $db->prepare("INSERT INTO opiskelijankirja (kayttaja_id, linkki, kurssi_id, kirjautuminen, itseprojekti_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isisi", $kayttaja, $linkki, $kurssi, $kirjautuminen, $itseprojekti);
    // prepare and bind
    $kayttaja = $_SESSION["Id"];
    $linkki = $_POST[osoite];
    $kurssi = $_SESSION[KurssiId];
    $kirjautuminen = $_POST[kirjautuminen];
    $itseprojekti = $_POST[ipid];

    $stmt->execute();
    $stmt->close();


    if ($_POST[paluu] == 'muokkaus') {
        header('location: testaamuokkaus.php?id=' . $_POST[ipid]);
    } else {
        header('location: itsetyot.php?i=' . $_POST[ipid]);
    }



    echo'</div>';
    echo'</div>';

    include("footer.php");
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

