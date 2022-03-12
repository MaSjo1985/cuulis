<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title>Anna palautetta</title>
<meta name="description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö.">';

include("yhteys.php");
include("header.php");

echo'<div class="cm8-container7" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px">';



echo' <h4 style="padding-top: 20px; margin-top: 0px; color: #2b6777">Lähetä viesti Cuulis-oppimisympäristön ylläpitäjälle</h4>';
echo'<a href="etusivu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa etusivulle</a><br><br>';
echo'<p style="color:#e608b8 ; font-size:1.1em">Sähköpostiosoite on virheellinen!</p><br><br>';
echo'<div class="cm8-quarter style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px">';

echo'<form action="lahetapalaute.php" method="post">
<b>Lähettäjän tiedot:</b> <br> <br>
	   Nimi: <br> <input type="text"name="Nimi" value="' . $_GET[nimi] . '"> <br><br>
	   Käyttäjätunnus: <b style="color: #e608b8">*</b><br> <input type="email" name="sposti" > <br><br>
	   Puhelinnumero:<br> <input type="text" name="Puh" value="' . $_GET[puh] . '"> <br><br>
	<br> <b>Viesti:</b><br><textarea name="Viesti" rows="8"  >' . $_GET[viesti] . '</textarea> </div>
	   	
	
</div>
	   
	   <div class="cm8-container3" style="padding-bottom: 60px">
	   
   <br><b>Haluan, että minuun otetaan yhteyttä</b><br><br>
   <input type="checkbox" name="Vastaus sähköpostitse" value="kyllä"> Sähköpostitse <br>
   <input type="checkbox" name="Vastaus puhelimitse" value="kyllä"> Puhelimitse <br><br><br>

	<input type="submit" class="myButton9" value="📧 &nbsp Lähetä" >
    
</div>
  </form></div>';



include("footer.php");
?>
</body>
</html>	