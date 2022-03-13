<?php
session_start(); 



ob_start();



include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

$uusi = $_REQUEST['uusi'];
$kello = $_REQUEST['kello'];
$paiva = $_REQUEST['paiva'];
$kuid = $_REQUEST['kuid'];
$kaid = $_SESSION['Id'];


$uusi = nl2br($uusi);
$db->query("insert into kysymykset (sisalto, kayttaja_id, kurssi_id, paiva, kello) values('" . $uusi . "', '" . $kaid . "', '" . $kuid . "', '" . $paiva . "', '" . $kello . "')");

if (!$haekyslkm = $db->query("select distinct * from kurssit where id='" . $kuid . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowLKM = $haekyslkm->fetch_assoc()) {
    $kyslkm = $rowLKM[kyslkm];
    $kyslkmvanha = $rowLKM[kyslkmvanha];
}

$kyslkm = $kyslkm + 1;

$db->query("update kurssit set kyslkm='" . $kyslkm . "' where id = '" . $kuid . "'");


echo'<br><br><table class="cm8-table4">';
if (!$haekysymykset = $db->query("select distinct * from kysymykset where kurssi_id='" . $kuid . "' order by id desc")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowv = $haekysymykset->fetch_assoc()) {
    echo '<tr><td  style="width: 80%">' . $rowv[paiva] . ' ' . $rowv[kello] . ':&nbsp&nbsp&nbsp<b>' . $rowv[sisalto] . '</b></td></tr>';
}
echo' </table><br><br>';
?>