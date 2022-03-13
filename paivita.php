<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (!$result = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($row2 = $result->fetch_assoc()) {

    $alku = $row2[alkupvm];
    $loppu = $row2[loppupvm];
    $id = $row2[id];
    $alku = date("Y-m-d", strtotime($alku));
    $loppu = date("Y-m-d", strtotime($loppu));

    $db->query("update kurssit set alkupvm='" . $alku . "' where id = '" . $id . "'");
    $db->query("update kurssit set loppupvm='" . $loppu . "' where id = '" . $id . "'");
}
?>
