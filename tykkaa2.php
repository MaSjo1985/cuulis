<?php
session_start();

include("yhteys.php");

$db->query("insert into kayttajan_tykkaykset (keskustelut_id, kayttaja_id) values('" . $_POST[cookieValue] . "', '" . $_SESSION[Id] . "')");
$db->query("UPDATE keskustelut SET tykkaykset = tykkaykset + 1 WHERE id = '" . $_POST[cookieValue] . "'");
$paluu = $_GET[id];
?>
