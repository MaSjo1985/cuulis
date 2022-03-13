<?php
session_start(); 



ob_start();



include("yhteys.php");

 // ready to go!
$db->query("update kurssit set keskakt=1 where id = '" . $_SESSION[KurssiId] . "'");

$stmt2 = $db->prepare("insert into kurssin_keskustelut (kurssi_id, keskusteluaihe, otsikko) values (?, ?, ?)");
$stmt2->bind_param("iss", $kid, $aihe2, $otsikko2);
$aihe2 = nl2br($_POST[aihe]);
$otsikko2 = nl2br($_POST[otsikko]);
$kid = $_SESSION[KurssiId];

$stmt2->execute();
$stmt2->close();


if (!$hae_eka = $db->query("select id from kurssin_keskustelut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


while ($rivieka = $hae_eka->fetch_assoc()) {
    $eka_id = $rivieka[id];
}



header("location: keskustelut.php?r=" . $eka_id);
?>
