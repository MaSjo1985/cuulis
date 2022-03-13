<?php
session_start(); 



ob_start();

include("yhteys.php");
if (!$haeaihe = $db->query("select distinct id from itsetehtavat where aihe IS NULL")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($roweka = $haeaihe->fetch_assoc()) {
    $id = $roweka[id];



    $db->query("update itsetehtavat set aihe=0 where id='" . $id . "'");
}

        
