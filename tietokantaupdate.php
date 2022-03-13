<?php
session_start();

// ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

if (!$haeid = $db->query("select distinct id from itsetehtavatkp where tehty=1")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if (!$haeid2 = $db->query("select distinct id from itsetehtavatkp where kommentti <> ''")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if (!$haeid3 = $db->query("select distinct id from itsetehtavatkp")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

$maara = 0;
while ($row = $haeid->fetch_assoc()) {
    $id = $row[id];
    $maara++;

    $db->query("update itsetehtavatkp set tallennettu=1 where id = '" . $id . "'");
}

echo'<br>TYHJÄT KOMMENTIT JA TALLENNETUT: ' . $maara;

$maara2 = 0;
while ($row2 = $haeid2->fetch_assoc()) {
    $id2 = $row2[id];
    $maara2++;
//
// $db->query("update itsetehtavatkp set tallennettu=0 where id = '" . $id . "'");
}
echo'<br>EI-TYHJÄT KOMMENTIT: ' . $maara2;

$maara3 = 0;
while ($row3 = $haeid3->fetch_assoc()) {
    $id3 = $row3[id];
    $maara3++;
//
// $db->query("update itsetehtavatkp set tallennettu=0 where id = '" . $id . "'");
}

echo'<br>KAIKKI: ' . $maara3;


