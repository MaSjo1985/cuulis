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

    $db->query("insert into kayttajan_tykkaykset (keskustelut_id, kayttaja_id) values('" . $_GET[id] . "', '" . $_SESSION[Id] . "')");
    $db->query("UPDATE keskustelut SET tykkaykset = tykkaykset + 1 WHERE id = '" . $_GET[id] . "'");
    $paluu = $_GET[id];

    header('location: keskustelut.php#' . $paluu);
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

