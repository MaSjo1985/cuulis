<?php
session_start(); 


ob_start();

echo'<html> 
<head>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {

    $db->query("delete from opiskelijankirja where kayttaja_id = '" . $_SESSION[Id] . "' AND itseprojekti_id='" . $_GET[i] . "'");
    if ($_GET[paluu] == 'muokkaus') {
        header("location: testaamuokkaus.php?id=" . $_GET[i]);
    } else {
        header("location: itsetyot.php?i=" . $_GET[i]);
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