<?php
session_start(); 



ob_start();



include("yhteys.php");
//
$db->query("insert into testi (omatallennusnimi) values('" . $_POST[teksti] . "')");
//
//
//    
header("location: muokkaalistaeka.php");
//$lause = 'Tämä Ån lause missä åökkÖsiä sisÄllä';
//echo'<br><b>TÄMÄ ON ALKUPERÄINEN LAUSE</b><br>'.$lause;
//
//
//$korjattavat = array("ä", "ö", "å", "Ä", "Ö", "Å");
//
//$lause = str_replace($korjattavat, "?", $lause, $count);
//
//
//echo'<br><br><br><b>TÄMÄ ON LOPPUTULOS</b><br>'.$lause;
//if (!$haetiedostot = $db->query("select distinct * from tiedostot where linkki =1")) {
//                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//}
//$maara=0;
//  while ($rowt = $haetiedostot->fetch_assoc()) {
//      $lause = $rowt[omatallennusnimi];
////  $korjattavat = array("ä", "ö", "å", "Ä", "Ö", "Å");
//
//$lause = str_replace("a?", "?", $lause, $uusimaara);
//$maara = $maara + $uusimaara;
//  }
echo'	&#97;';
