<?php
session_start(); 



ob_start();



include("yhteys.php");


$db->query("update kurssit set keskakt=1 where id = '" . $_POST[id] . "'");
$db->query("INSERT INTO keskustelut (kurssi_id, tyhja) VALUES ( '" . $_SESSION["KurssiId"] . "', 1)");
$stmt = $db->prepare("UPDATE kurssit SET keskusteluaihe=?, otsikko=? WHERE id=?");
$stmt->bind_param("ssi", $aihe, $otsikko, $id);
// prepare and bind

$aihe = nl2br($_POST[aihe]);
$aiheotsikko = nl2br($_POST[otsikko]);
$id = $_POST[id];
$stmt->execute();
$stmt->close();




header("location: keskustelut.php");
?>
