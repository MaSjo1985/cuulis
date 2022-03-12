<?php
session_start(); 



ob_start();



include("yhteys.php");

 // ready to go!

$stmt2 = $db->prepare("update itseprojektit set taulu=? WHERE id=?");
$stmt2->bind_param("si", $otsikko2, $id);

$otsikko2 = nl2br($_POST[otsikko]);
$id = $_POST[ipid];

$stmt2->execute();
$stmt2->close();





header("location: itsetyot.php?i=" . $id);
?>
