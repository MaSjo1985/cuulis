<?php
session_start(); 



ob_start();



include("yhteys.php");
if (!$haekesk = $db->query("select distinct id from keskustelut where kurssin_keskustelut_id = '" . $_GET[r] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowkesk = $haekesk->fetch_assoc()) {
    $id = $rowkesk[id];
    $db->query("delete from kayttajan_tykkaykset where keskustelut_id ='" . $id . "'");
}
$db->query("delete from keskustelut where kurssin_keskustelut_id = '" . $_GET[r] . "'");

header("location: keskustelut.php?r=" . $_GET[r]);
?>
