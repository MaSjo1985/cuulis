<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    $db->query("delete from ryhmat where kurssi_id ='" . $_GET[id] . "'");
    $db->query("update opiskelijankurssit set ryhma_id=0 where kurssi_id ='" . $_GET[id] . "'");
    $db->query("update kurssit set opmaksimi=0 where id ='" . $_GET[id] . "'");
    $db->query("update kurssit set opminimi=0 where id ='" . $_GET[id] . "'");
    $db->query("update kurssit set ryhmienmaksimi=0 where id ='" . $_GET[id] . "'");
    header('location: kurssi.php');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>