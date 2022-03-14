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

    $db->query("delete from kayttajan_tykkaykset where keskustelut_id = '" . $_GET[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "'");
    $db->query("UPDATE keskustelut SET tykkaykset = tykkaykset - 1 WHERE id = '" . $_GET[id] . "'");


    header('location: keskustelut.php#' . $_GET[id] . '');


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

