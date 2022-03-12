<?php
session_start(); 



ob_start();



include("yhteys.php");

echo '<div class="cm8-container" style="padding:20px 20px 20px 40px; ">';

echo'<div class="cm8-half" style="display: inline-block; padding: 0px; margin: 0px 0px 10px 0px">';
echo'<b style="font-size: 0.8em">Cuulis-oppimisympäristö &nbsp</b> &copy;  <br><br><a href="admininfo.php" style="font-size: 0.8em">Marianne Sjöberg</a><br><a href="mailto: marianne.sjoberg@cm8solution.fi" style="font-size: 0.8em">marianne.sjoberg@cm8solutions.fi</a>';
echo'</div>';
echo'<div class="cm8-half" style="display: inline-block; padding: 0px; margin: 20px 0px 0px 0px">';
echo'<u style="font-size: 0.8em"><a href="kayttoehdot.php" target="_blank">Käyttöehdot</a><br><br><a href="tietosuojaseloste.php" target="_blank">Tietosuojaseloste</u>';
echo'</div>';
echo'</div>';

?>
