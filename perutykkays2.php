<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!



$db->query("delete from kayttajan_tykkaykset where keskustelut_id = '" . $_POST[cookieValue] . "' AND kayttaja_id='" . $_SESSION[Id] . "'");
$db->query("UPDATE keskustelut SET tykkaykset = tykkaykset - 1 WHERE id = '" . $_POST[cookieValue] . "'");
?>

