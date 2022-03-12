<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if ($_POST['arvo'] == 'joo') {

    $db->query("update kurssit set tav_akt=1 where id = '" . $_SESSION["KurssiId"] . "'");
} else if ($_POST['arvo'] == 'ei') {
    $db->query("update kurssit set tav_akt=0 where id = '" . $_SESSION["KurssiId"] . "'");
}

header("location: kurssi.php?id=$_SESSION[KurssiId]");
?>