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

    if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkoprojekti->num_rows != 0) {


        if (!$onkosuljettu = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $_POST[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
$maara=$onkosuljettu->num_rows;
if($maara !=0){
           while ($row = $onkosuljettu->fetch_assoc()) {

            if (($row[lopullinen] == 0) ) {


                if (!$maara = $db->query("select * from ryhmat where projekti_id='" . $_POST[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $ryhmanimi = (($maara->num_rows) + 1);

                $nimi = "Ryhmä " . $ryhmanimi . " ";

                $db->query("insert into ryhmat (suljettu, nimi, projekti_id) values(0, '" . $nimi . "', '" . $_POST[id] . "')");
          
                }
        } 
}
else{
         if (!$maara = $db->query("select * from ryhmat where projekti_id='" . $_POST[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $ryhmanimi = (($maara->num_rows) + 1);

                $nimi = "Ryhmä " . $ryhmanimi . " ";

                $db->query("insert into ryhmat (suljettu, nimi, projekti_id) values(0, '" . $nimi . "', '" . $_POST[id] . "')");
              
}

    }

    if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($maxrowa = $resultmaxa->fetch_assoc()) {
        $maxa = $maxrowa[suurin];
    }

    header("location: ryhmatyot.php?r=" . $_POST[id] . "#" . $maxa);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>	

