<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    $db->query("delete from kayttajankoulut where kayttaja_id = '" . $_GET[id] . "' AND koulu_id='" . $_GET[kouluid] . "'");



    header("location: muokkaakayttaja.php?id=" . $_POST[id]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>