<?php
session_start();

ob_start();
include("yhteys.php");
$lista = $_POST["sisalto"];

$value = $lista;
$db->query("insert into testitaulu (info) values('" . $value . "')");

if (!$tulos = $db->query("select * from testitaulu where paiva='0000-00-00'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
echo'<p> SISÄLTÖ: </p>';
while ($rivi = $tulos->fetch_assoc()) {
    $str = $rivi[info];
    echo '<p>' . htmlspecialchars_decode($str) . '</p>';
}
?>