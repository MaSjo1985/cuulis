<?php

ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    $db->query("update opiskelijankurssit set ryhma_id=0 where opiskelija_id = '" . $_GET["oid"] . "' AND projekti_id='" . $_GET[pid] . "'");
    header("location: ryhmatyot.php?r=" . $_GET[pid] . '#' . $_GET[ryid]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>	

