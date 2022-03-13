<?php
session_start(); 



ob_start();



echo '<br><form action="muokkaalista.php" method="post"  enctype="multipart/form-data">

	<br><b>Tekstu:&nbsp&nbsp&nbsp </b> <input type="text" name="teksti" maxlength="50"> <br>	<br><br>					

	´
	<br><input type="submit" value="&#10003 Lisää">
	
	</form>';
//$db->query("delete from testi");

//if (!$haetiedostot = $db->query("select distinct * from tiedostot where linkki = 0")) {
//                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//}
//
// while ($rowt = $haetiedostot->fetch_assoc()) {
//     $teksti = $rowt[omatallennusnimi];
//     
//     $db->query("insert into testi set omatallennusnimi = '".$teksti."'");
// }
 