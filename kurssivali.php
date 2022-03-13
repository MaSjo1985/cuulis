<?php
session_start(); 



ob_start();





include("yhteys.php");


if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


while ($rivi2 = $tulos2->fetch_assoc()) {
    $nimi = $rivi2[nimi];

    $koodi = $rivi2[koodi];
}
$_SESSION["KurssiNimi"] = $nimi;

$_SESSION["Koodi"] = $koodi;

header('location: kurssi.php?id=' . $_GET[id]);
?>      