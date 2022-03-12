<?php
session_start(); 



ob_start();



include("yhteys.php");
$db->query("delete from kayttajan_tykkaykset where keskustelut_id ='" . $_GET[kesid] . "'");
$db->query("delete from keskustelut where id = '" . $_GET[kesid] . "'");

    header('location: keskustelut.php?r=' . $_GET[id]);

?>
