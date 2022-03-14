<?php
session_start(); 



ob_start();



include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}

if (isset($_SESSION["Kayttajatunnus"])) {


    $db->query("insert into projektit (kurssi_id, kuvaus, ryhmienmaksimi, opmaksimi, opminimi) values('" . $_POST["kurssiId"] . "', '" . $_POST["kuvaus"] . "', '" . $_POST["lkm"] . "', '" . $_POST["maksimi"] . "', '" . $_POST["minimi"] . "')");

    if (!$haeid = $db->query("select * from projektit where kurssi_id='" . $_POST["kurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
//projektin id
    while ($rowid = $haeid->fetch_assoc()) {
        $pid = $rowid[pid];
    }







    /* 	if($maara->num_rows==0)
      {
      $db->query("update kurssit set ryhmienmaksimi='".$_POST[lkm]."' where id='".$_POST["kurssiId"]."'");
      $db->query("update kurssit set opminimi='".$_POST[minimi]."' where id='".$_POST["kurssiId"]."'");
      $db->query("update kurssit set opmaksimi='".$_POST[maksimi]."' where id='".$_POST["kurssiId"]."'");

      $_SESSION["ryhmienmaksimi"]=$_POST[lkm];
      $_SESSION["opmaksimi"]=$_POST[maksimi];
      $_SESSION["opminimi"]=$_POST[minimi];
      } */
    //asetetaan uudet nimet
    //asetetaan arvontaid:t


    if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $pid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $pid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($minrowa = $resultmina->fetch_assoc()) {
        $mina = $minrowa[pienin];
    }

    while ($maxrowa = $resultmaxa->fetch_assoc()) {
        $maxa = $maxrowa[suurin];
    }
    $a = 0;
    for ($j = $mina; $j <= $maxa; $j++) {
        $a++;
    }


    $ryhmanimi = $a;

    $nimi = "Ryhmä " . $ryhmanimi . " ";

    $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $pid . "', '" . $nimi . "', 0)");


    header("location: ryhmatyot.php?r=" . $pid);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>	

