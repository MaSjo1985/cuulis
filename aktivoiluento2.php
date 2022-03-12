<?php
session_start(); 



ob_start();



include("yhteys.php");


$db->query("update kurssit set luentoaihe='" . $_POST[aihe] . "' where id = '" . $_POST[id] . "'");

$db->query("update kurssit set luentopvm='" . $_POST[luentopvm] . "' where id = '" . $_POST[id] . "'");

header("Location: luento.php");
?>
