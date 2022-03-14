<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    $db->query("delete from kurssiaikataulut where kurssi_id ='" . $_SESSION[KurssiId] . "'");
    $db->query("update kurssit set aikatauluakt=0 where id = '" . $_SESSION[KurssiId] . "'");

    header("location: kurssi.php?id=$_SESSION[KurssiId]");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>