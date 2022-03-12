<?php
session_start(); 


ob_start();



include("yhteys.php");

$db->query("delete from kysymykset where id = '" . $_GET[kysid] . "'");

header("location: kysymykset2.php?w1=" . $_GET[w1] . "&w2=" . $_GET[w2]);
?>
