<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Viesti ylläpitäjälle </title>';
include("yhteys.php");
include("header.php");

echo'<div class="cm8-container7">';
echo'<div class="cm8-margin-bottom" style="padding-left: 40px">';










echo "<br>Kiitos, viestisi on vastaanotettu ja se pyritään käsittelemään mahdollisimman pian!";
echo '<br><br><a href="etusivu.php">Etusivulle <p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8631</p></a>';


echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>