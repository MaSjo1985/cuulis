<?php
session_start();
ob_start();

echo'
<!DOCTYPE html>
<html>
 
<head>

<title> Rekisteröinti suoritettu</title>';

include("yhteys.php");

include("header.php");

echo'<div class="cm8-container3">';
echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
echo'<div class="cm8-margin-top"></div>';

echo '<p style="font-size:1.2em">Rekisteröinti onnistui!</p><br><p> Sähköpostiisi on lähetetty rekisteröintiisi liittyvät vahvistustiedot.</p><br><p style="color: #e608b8">Huom! Tarkista <u>roskapostilaatikko</u>, jos viestiä ei näy.</p>';

echo '<br><br><a href="etusivu.php">Jatka etusivulle tästä <p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8631</p></a>';
echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>	